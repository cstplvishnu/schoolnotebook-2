<?php

namespace App\Http\Controllers;
use \App;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Yajra\Datatables\Datatables;
use DB;
use Spatie\Activitylog\Models\Activity;

class ParentsController extends Controller
{
     public function __construct()
    {
         $currentUser = \Auth::user();
      
      
      $this->middleware('auth');
    
    }
    
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
     public function index()
     {
       
       $user = getUserWithSlug();

      if(!checkRole(getUserGrade(7)))
      {
        prepareBlockUserMessage();
        return back();
      }

       if(!isEligible($user->slug))
        return back();
 
       $data['records']      = FALSE;
       $data['user']         = $user;
       $data['title']        = getPhrase('children');
       $data['active_class'] = 'children';
       $data['sub_active_class'] = 'children';
       $data['layout']       = getLayout();
       return view('parent.list-users', $data);
     }

     /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    
    public function getDatatable($slug)
    {
        $records = array();
        $user = getUserWithSlug($slug);
        
        $records = User::select(['image','name', 'email',  'slug', 'id'])->where('parent_id', '=', $user->id)->get();
        
        return Datatables::of($records)
        ->addColumn('action', function ($records) {
         $buy_package = '';
        
          if(!isSubscribed('main',$records->slug)==1)


            return '<p id="social-buttons">

                      <a href="'.URL_USERS_EDIT.$records->slug.'" data-toggle="tooltip" data-placement="auto" title="'.getPhrase("edit").'"  class="btn btn-sm btn-icon btn-info"><i class="fa fa-pencil"></i></a></p>';

                           
           
            
            })
            
         ->editColumn('name', function($records)
         {
          return '<strong><a href="'.URL_USER_DETAILS.$records->slug.'" title="'.$records->name.'">'.ucfirst($records->name).'</a></strong>';
         })       
         ->editColumn('image', function($records){
            return '<a href="'.URL_USER_DETAILS.$records->slug.'" </a><img src="'.getProfilePath($records->image).'"  class="img-circle" />';
        })
         ->removeColumn('slug')
         ->removeColumn('id')

        ->make();
    }

    public function childrenAnalysis()
    {
       
       $user = getUserWithSlug();

      if(!checkRole(getUserGrade(7)))
      {
        prepareBlockUserMessage();
        return back();
      }

       if(!isEligible($user->slug))
        return back();
 
       $data['records']      = FALSE;
       $data['user']       = $user;
       $data['title']        = getPhrase('children_analysis');
       $data['active_class'] = 'analysis';
       $data['sub_active_class'] = 'analysis';
       $data['layout']       = getLayout();
       return view('parent.list-users', $data);
    }
}
