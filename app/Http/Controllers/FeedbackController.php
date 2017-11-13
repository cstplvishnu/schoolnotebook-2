<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \App;
use App\Feedback;
use Yajra\Datatables\Datatables;
use DB;
use Auth;
class FeedbackController extends Controller
{
     public function __construct()
    {
    	$this->middleware('auth');
     

    }

    /**
     * Course listing method
     * @return Illuminate\Database\Eloquent\Collection
     */
   public function index()
    {

      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $data['active_class'] = 'user_profile';
        $data['sub_active_class'] = 'dashboard';
        $data['layout']       = getLayout();
        $data['title']        = getPhrase('feed_backs');
    	  return view('feedbacks.list', $data);
    }


    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatable()
    {

      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $records = array();


            $records = Feedback::join('users', 'users.id','=','feedbacks.user_id')
            ->select(['users.image','title', 'users.name','subject','description','feedbacks.slug', 'feedbacks.id', 'feedbacks.updated_at'])
            ->orderBy('updated_at', 'desc');

        return Datatables::of($records)
        ->addColumn('action', function ($records) {

             $link_data = '<div class="m-drop">

                      <a href="'.URL_FEEDBACK_VIEW.$records->slug.'" data-toggle="tooltip" data-placement="auto" title="'.getPhrase("view").'"  class="btn btn-sm btn-icon btn-info"><i class="fa fa-eye"></i></a>';

                            $temp = '';
                            if(checkRole(getUserGrade(2))) {
                                $temp .= '&nbsp;<a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');" data-toggle="tooltip" data-placement="auto" title="'.getPhrase("delete").'"  class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></a>';
                            }

                            $temp .='</div>';

                            $link_data .= $temp;
                            
                    return $link_data;
       
            })

        ->editColumn('title', function($records)
        {
        	return '<strong><a href="'.URL_FEEDBACK_VIEW.$records->slug.'">'.$records->title.'</strong></a>';
        })
        ->editColumn('image', function($records)
        {
          $image = getProfilePath($records->image);
          
            return '<a href="'.URL_FEEDBACK_VIEW.$records->slug.'"><img src="'.$image.'" height="60" width="60"  class="img-circle" /></a>';
        })
       
        ->removeColumn('id')
        ->removeColumn('slug')
        ->make();
    }

    /**
     * This method loads the create view
     * @return void
     */
    public function create()
    {
      
      if(checkRole(getUserGrade(2)))
      {
        return back();
      }
      
    	$data['record']         	    = FALSE;
    	$data['layout']         	    = getLayout();
    	$data['active_class']         = 'user_profile';
      $data['sub_active_class']     = 'dashboard';
      	$data['title']              = getPhrase('give_feedback');
    	return view('feedbacks.add-edit', $data);
    }

     /**
     * This method adds record to DB
     * @param  Request $request [Request Object]
     * @return void
     */
    public function store(Request $request)
    {
      

	    $rules = [
         'title'          	   	   => 'bail|required|max:40' ,
         'subject'          	   => 'bail|required|max:40' ,
         'description'             => 'bail|required' ,
          ];
        $this->validate($request, $rules);
        $record = new Feedback();
      	$name  						=  $request->title;
		$record->title 				= $name;
       	$record->slug 				= $record->makeSlug($name);
        $record->subject			= $request->subject;
        $record->description		= $request->description;
        $record->user_id			= Auth::user()->id;
        $record->save();
     
        flash('success','feedback_submitted_successfully', 'success');
    	return redirect(URL_FEEDBACK_SEND);
    }

    public function details($slug)
    {
    
    	$record = Feedback::where('slug','=',$slug)->first();
    
    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);

    	$data['record']         	= $record;
    	$data['layout']         	= getLayout();
    	$data['active_class']       = 'user_profile';
      $data['sub_active_class'] = 'dashboard';
      	$data['title']              = getPhrase('feedback_details');
    	return view('feedbacks.details', $data);

    }

    public function isValidRecord($record)
    {
    	if ($record === null) {

    		flash('Ooops...!', getPhrase("page_not_found"), 'error');
   			return $this->getRedirectUrl();
		}

		return FALSE;
    }


    public function getReturnUrl()
    {	
       if(!checkRole(getUserGrade(2)))
      {
        return URL_FEEDBACK_SEND;
      }
      return URL_FEEDBACK_VIEW;
    	
    }

    public function delete($slug)
    {
     if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }
  	 $record = Feedback::where('slug', $slug)->first();
     if(!env('DEMO_MODE')) {
  	 $record->delete();
    }
  	 $response['status'] = 1;
     $response['message'] = getPhrase('deleted_successfully');
        return json_encode($response);
    }

}
