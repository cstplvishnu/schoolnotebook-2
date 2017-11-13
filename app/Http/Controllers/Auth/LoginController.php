<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use \Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;
	use AuthenticatesUsers {
		logout as performLogout;
	}

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   protected $redirectTo = '/';
    protected $dbuser = '';
    protected $provider = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);		
    }
	
       
     //this view the login page  	
     public function getLogin()
    {
        return view('auth.login');
    }

     //this view the login page  	
     public function getForgotPassword()
    {
        return view('auth.forgot_password');
    }



// This method auhtenticate the registered user
	public function postLogin(Request $request)
	{		

		$login_status = FALSE;
        if (Auth::attempt(['username' => $request->email, 'password' => $request->password,'status'=>1])) {
                // return redirect(PREFIX);
                $login_status = TRUE;
        } 

        elseif (Auth::attempt(['email'=> $request->email, 'password' => $request->password,'status'=>1])) {
            $login_status = TRUE;
        }

        if(!$login_status) 
        {
            $message = getPhrase("Please Check Your Details");
            flash('Ooops...!', $message, 'error');
			   return redirect()->back();


            //    return redirect()->back()
            // ->withInput($request->only($this->loginUsername(), 'remember'))
            // ->withErrors([
            //     $this->loginUsername() => $this->getFailedLoginMessage(),
            // ]);
        }

        /**
         * Check if the logged in user is parent or student
         * if parent check if admin enabled the parent module
         * if not enabled show the message to user and logout the user
         */
        
        if($login_status) {
            if(checkRole(getUserGrade(7)))  {
               if(!getSetting('parent', 'module')) {
                return redirect(URL_PARENT_LOGOUT);
               }
            } 
        }

        /**
         * The logged in user is student/admin/owner
         */
            if($login_status)
            {
                session()->put('is_student', '0');
                if(checkRole(getUserGrade(5)))
                {
                    $user = User::where('email','=',$request->email)->first();
                    if($user)
                    {
                        session()->put('is_student', '1');
                        session()->put('user_record', prepareStudentSessionRecord($user->slug));

                        
                    }
                }
                
                return redirect(PREFIX);
            } 
	}
	
	public function forgotpassword()
	{
		return view('auth.passwords.email');
	}
	
	public function forgotpasswordEmail( Request $request )
	{
		$details = User::where('email', '=', $request->email)->first();
		if( $details )
		{
			if( $details->status == 'Suspended' )
			{
				flash('Ooops...!', 'Admin has suspended your account. Please contact administrator', 'error');
			}
			else
			{
				$forgot_token = str_random(30);
				$details->forgot_token = $forgot_token;
				$random_password = str_random(30);
				//$details->password = bcrypt( str_random(30) );
				$details->save();
				$login_link = URL_USERS_LOGIN;
				$changepassword_link = URL_USERS_RESETPASSWORD . '/' . $forgot_token;
				$site_title = getSetting('site_title', 'site_settings');
				try{
					sendEmail('forgotpassword', array('user_name'=>$details->name, 'to_email' => $details->email, 'password' => $random_password, 'login_link' => $login_link, 'changepassword_link' =>  $changepassword_link, 'site_title' => $site_title));
					flash('Success...!', 'Reset Password Sent To Your Mail', 'success');
				}
				catch(Exception $ex)
				{
					flash('Ooops...!', 'There was an error : ' . $ex->getMessage(), 'error');
				}
			}			
			return redirect( URL_USERS_LOGIN );
		}
		else
		{
			flash('Ooops...!', 'We have not found your email address', 'error');
			return redirect( URL_USERS_FORGOTPASSWORD );
		}
	}
	
	public function resetpassword( $forgot_token )
	{
		$details = User::where('forgot_token', '=', $forgot_token)->first();
		if( $details )
		{
			$data['token'] = $forgot_token;
			$data['main_active'] 	= 'register';
			return view('auth.passwords.reset', $data);
		}
		else
		{
			flash('Ooops...!', 'link is not valid. please check your email for details', 'error');
			return redirect( URL_USERS_FORGOTPASSWORD );
		}
	}
	
	public function resetmypassword(Request $request)
	{
		$this->validate($request, [
        'password'  => 'required|min:6|confirmed',
		'password_confirmation'  => 'required|min:6',
        ]);
		$details = User::where('forgot_token', '=', $request->token)->first();
		if( $details )
		{
			$details->password = bcrypt($request->password);
			$details->forgot_token = null;
			$details->confirmed = 1;
			$details->confirmation_code = null;
			$details->status = 'Active';
			$details->save();
			flash('Congrulations...!', 'You have successfully reset your password. Please login here.', 'success');
			return redirect( URL_USERS_LOGIN);
		}
		else
		{
			flash('Ooops...!', 'link is not valid. please check your email for details', 'error');
			return redirect( URL_USERS_FORGOTPASSWORD );
		}
	}
}
