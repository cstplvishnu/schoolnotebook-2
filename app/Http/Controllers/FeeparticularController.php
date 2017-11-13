<?php
namespace App\Http\Controllers;
use \App;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Feeparticulars;
use Yajra\Datatables\Datatables;
use DB;

class FeeparticularController extends Controller
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
      if(!checkRole(getUserGrade(17)))
      {
        prepareBlockUserMessage();
        return back();
      }
        
        if(checkRole(getUserGrade(16))){
        $data['active_class']       = 'fee_particulars';
        }
        else{
           $data['active_class']       = 'fee'; 
        }
        $data['sub_active_class']   = 'fee_particulars';
        $data['layout']             = getLayout();
        $data['title']              = getPhrase('fee_particulars');
        return view('fee.feeparticulars.list', $data);
    }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatable($slug = '')
    {

      if(!checkRole(getUserGrade(17)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $records = array();
 
             

            $records = Feeparticulars::select(['id','title','slug','is_income','status'])
            ->orderBy('updated_at', 'desc');
             

        return Datatables::of($records)
        ->addColumn('action', function ($records) {

               $link_data = '<p id="social-buttons">

                      <a href="'.URL_FEE_PARTICULARS_EDIT.$records->slug.'" data-toggle="tooltip" data-placement="auto" title="'.getPhrase("edit").'"  class="btn btn-sm btn-icon btn-info"><i class="fa fa-pencil"></i></a>';

                            $temp = '';
                            if(checkRole(getUserGrade(17))) {
                                $temp .= '&nbsp;<a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');" data-toggle="tooltip" data-placement="auto" title="'.getPhrase("delete").'"  class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></a>';
                            }

                            $temp .='</p>';

                            $link_data .= $temp;
                            
                    return $link_data;
         })
        
        ->editColumn('status', function($records)
        {
            if($records->status==1){
                return $rec = '<span class="label label-success">'.getPhrase('active').'</span>';
            }
            else{

                return $rec = '<span class="label label-danger">'.getPhrase('Inactive').'</span>';   
            }
        })

        ->editColumn('is_income', function($records)
        {
            if($records->is_income==1){
                return $rec = '<span class="label label-info">'.getPhrase('Yes').'</span>';
            }
            else{

                return $rec = '<span class="label label-warning">'.getPhrase('no').'</span>';   
            }
        })
        
        ->editColumn('title',function($records){
             
             return '<strong>'.$records->title.'</strong>';
   
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
      if(!checkRole(getUserGrade(17)))
      {
        prepareBlockUserMessage();
        return back();
      }
        $data['record']              = FALSE;
        if(checkRole(getUserGrade(16))){
        $data['active_class']       = 'fee_particulars';
        }
        else{
           $data['active_class']       = 'fee'; 
        }
        $data['sub_active_class']    = 'fee_particulars';
        $data['title']               = getPhrase('create_fee_particular');
        $data['layout']              = getLayout();
        return view('fee.feeparticulars.add-edit', $data);
    }

    /**
     * This method loads the edit view based on unique slug provided by user
     * @param  [string] $slug [unique slug of the record]
     * @return [view with record]       
     */
    public function edit($slug)
    {
      if(!checkRole(getUserGrade(17)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $record = Feeparticulars::getRecordWithSlug($slug);
        if($isValid = $this->isValidRecord($record))
            return redirect($isValid);

        $data['record']              = $record;
       if(checkRole(getUserGrade(16))){
        $data['active_class']       = 'fee_particulars';
        }
        else{
           $data['active_class']       = 'fee'; 
        }
        $data['sub_active_class']   = 'fee_particulars';
        $data['title']               = getPhrase('edit_fee_particular');
        $data['layout']             = getLayout();
        return view('fee.feeparticulars.add-edit', $data);
    }

    /**
     * Update record based on slug and reuqest
     * @param  Request $request [Request Object]
     * @param  [type]  $slug    [Unique Slug]
     * @return void
     */
    public function update(Request $request, $slug)
    {
      if(!checkRole(getUserGrade(17)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $record = Feeparticulars::getRecordWithSlug($slug);
         $rules = [
         'title'            => 'bail|required|max:60' ,
         
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

        $record->title              = $name;
        $record->status             = $request->status;
        $record->is_income          = $request->is_income;
        $record->description        = $request->description;
        
        $record->save();
        flash('success','record_updated_successfully', 'success');
        return redirect(URL_FEE_PARTICULARS);
    }

    /**
     * This method adds record to DB
     * @param  Request $request [Request Object]
     * @return void
     */
    public function store(Request $request)
    {
      if(!checkRole(getUserGrade(17)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $rules = [
         'title'            => 'bail|required|max:60' ,
           ];
        $this->validate($request, $rules);
        $record                     = new Feeparticulars();
        $name                       =  $request->title;
        $record->title              = $name;
        $record->slug               = $record->makeSlug($name);
        $record->status             = $request->status;
        $record->is_income          = $request->is_income;
        $record->description        = $request->description;
        $record->save();
        flash('success','record_added_successfully', 'success');
        return redirect(URL_FEE_PARTICULARS);
    }
 
    /**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function delete($slug)
    {
      if(!checkRole(getUserGrade(17)))
      {
        prepareBlockUserMessage();
        return back();
      }
      /**
       * Delete the questions associated with this quiz first
       * Delete the quiz
       * @var [type]
       */
        $record = Feeparticulars::where('slug', $slug)->first();
        try{
            if(!env('DEMO_MODE')) {
                $record->delete();
            }
            $response['status'] = 1;
            $response['message'] = getPhrase('record_deleted_successfully');
        }
         catch ( Exception $e) {
                 $response['status'] = 0;
           if(getSetting('show_foreign_key_constraint','module'))
            $response['message'] =  $e->getMessage();
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
        return URL_FEE_PARTICULARS;
    }
}
