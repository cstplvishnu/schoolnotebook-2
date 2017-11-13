<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use App\Instruction;
use Yajra\Datatables\Datatables;
use DB;
use Auth;
use Exception;

class InstructionsController extends Controller
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

        $data['active_class']       = 'exams';
        $data['sub_active_class']   = 'instruction';
        $data['layout']             = getLayout();
        $data['title']              = getPhrase('instructions');
        $data['module_helper']      = getModuleHelper('exams-instructions-list');
    	return view('exams.instructions.list', $data);
    }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatable($slug = '')
    {

      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $records = array();

        
            $records = Instruction::select(['title', 'content', 'id', 'slug','updated_at'])
            ->orderBy('updated_at', 'desc');
             

        return Datatables::of($records)
        ->addColumn('action', function ($records) {

           $link_data = '<div class="m-drop">

                      <a href="'.URL_INSTRUCTIONS_EDIT.$records->slug.'" data-toggle="tooltip" data-placement="auto" title="'.getPhrase("edit").'"  class="btn btn-sm btn-icon btn-info"><i class="fa fa-pencil"></i></a>';

                            $temp = '';
                            if(checkRole(getUserGrade(1))) {
                                $temp .= '&nbsp;<a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');" data-toggle="tooltip" data-placement="auto" title="'.getPhrase("delete").'"  class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></a>';
                            }

                            $temp .='</div>';

                            $link_data .= $temp;
                            
                    return $link_data;
          })

        ->editColumn('title',function($records){
             
             return '<strong>'.$records->title.'</strong>';
   
        })
        
        ->removeColumn('id')
        ->removeColumn('slug')
        ->removeColumn('updated_at')
         
        ->make();
    }

    /**
     * This method loads the create view
     * @return void
     */
    public function create()
    {
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }
    	$data['record']         	= FALSE;
      $data['layout']       = getLayout();
    	$data['active_class']       = 'exams';
      $data['sub_active_class']   = 'instruction';
    	$data['title']              = getPhrase('add_instructions');
      $data['module_helper']      = getModuleHelper('add-instructions');
    	return view('exams.instructions.add-edit', $data);
    }

    /**
     * This method loads the edit view based on unique slug provided by user
     * @param  [string] $slug [unique slug of the record]
     * @return [view with record]       
     */
    public function edit($slug)
    {
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

    	$record = Instruction::getRecordWithSlug($slug);
    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);

    	$data['record']       		  = $record;
    	$data['active_class']       = 'exams';
      $data['sub_active_class']   = 'instruction';
    	$data['layout']             = getLayout();
    	$data['title']              = getPhrase('edit_instruction');
      $data['module_helper']      = getModuleHelper('exams-instructions-list'); 
    	return view('exams.instructions.add-edit', $data);
    }

    /**
     * Update record based on slug and reuqest
     * @param  Request $request [Request Object]
     * @param  [type]  $slug    [Unique Slug]
     * @return void
     */
    public function update(Request $request, $slug)
    {
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

    	$record = Instruction::getRecordWithSlug($slug);
		 $rules = [
         'title'          	   => 'bail|required|max:40' ,
         'content'           	=> 'bail|required' ,
            ];
         /**
        * Check if the title of the record is changed, 
        * if changed update the slug value based on the new title
        */
       $name = $request->title;
        if($name != $record->title)
            $record->slug = $record->makeSlug($name);
      
       //Validate the overall request
       $this->validate($request, $rules);
    	$record->title 		= $name;
       

        $record->content	= $request->content;
     
        $record->save();
        flash('success','record_updated_successfully', 'success');
    	return redirect(URL_INSTRUCTIONS);
    }

    /**
     * This method adds record to DB
     * @param  Request $request [Request Object]
     * @return void
     */
    public function store(Request $request)
    {
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

	    $rules = [
         'title'          	   => 'bail|required|max:40' ,
         'content'           	=> 'bail|required' ];
        $this->validate($request, $rules);
        $record = new Instruction();
      	$name  						=  $request->title;
		$record->title 				= $name;
       	$record->slug 				= $record->makeSlug($name);
        
        $record->content		= $request->content;
        $record->save();
        flash('success','record_added_successfully', 'success');
    	return redirect(URL_INSTRUCTIONS);
    }
 
    /**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function delete($slug)
    {
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }
      /**
       * Check if any quizzes are associated with this instructions page, 
       * if not delete
       * @var [type]
       */
        $record = Instruction::where('slug', $slug)->first();
        $response = [];
       try {
         if(!env('DEMO_MODE')) {
	        $record->delete();
          }
	        $response['status'] = 1;
	        $response['message'] = getPhrase('record_deleted_successfully');
    	}
       catch ( \Illuminate\Database\QueryException $e) {
                 $response['status'] = 0;
           if(getSetting('show_foreign_key_constraint','module'))
            $response['message'] =  $e->errorInfo;
           else
            $response['message'] =  getPhrase('this_record_is_in_use_in_other_modules');
       }
        return json_encode($response);
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
    	return URL_INSTRUCTIONS;
    }

}