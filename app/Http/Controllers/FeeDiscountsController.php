<?php

namespace App\Http\Controllers;
use \App;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\FeeDiscount;
use Yajra\Datatables\Datatables;
use DB;

class FeeDiscountsController extends Controller
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
        $data['active_class']       = 'settings';
        $data['title']              = getPhrase('fines');
        $data['layout']              = getLayout();
    	return view('fee.feediscounts.list', $data);
    }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatable()
    {


         $records = FeeDiscount::select([   
         	'feecategory_id', 'discount_name','description', 'id','slug']);
        
        return Datatables::of($records)
        ->addColumn('action', function ($records) {
         

            return '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_FEE_DISCOUNTS_EDIT.$records->slug.'"><i class="icon-packages"></i>'.getPhrase("edit").'</a></li>
                            
                            <li><a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="icon-packages"></i>'. getPhrase("delete").'</a></li>
                        </ul>
                    </div>';
            })
        ->removeColumn('id')
        ->removeColumn('slug')
        ->editColumn('feecategory_id', function($records){
        	return 
        	App\FeeCategory::find($records->feecategory_id)->fee_category;
        })
   
   
        ->make();
    }

    /**
     * This method loads the create view
     * @return void
     */
    public function create()
    {
    	$data['record']         	= FALSE;
    	$data['active_class']       = 'settings';
    	$data['fee_categories']    	= array_pluck(App\FeeCategory::all(),'fee_category', 'id');

    	$data['academics']    		= array_pluck(App\Academic::all(),'academic_year_title', 'id');
    	$data['course_parent_list']	= array_pluck(App\Course::getCourses(0), 'course_title', 'id');
    	// dd($data['course_parent_list']);
    	$data['course_list']        = array();
    	$data['categories']			= array_pluck(App\Category::all(), 'category_name', 'id');
        $data['title']              = getPhrase('add_discount');
    	$data['layout']              = getLayout();
    	return view('fee.feediscounts.add-edit', $data);
    }

    /**
     * This method loads the edit view based on unique slug provided by user
     * @param  [string] $slug [unique slug of the record]
     * @return [view with record]       
     */
    public function edit($slug)
    {
    	$record = FeeDiscount::where('slug', $slug)->get()->first();
    	$data['record']       		= $record;
    	$data['active_class']       = 'settings';
       	$data['fee_categories']    	= array_pluck(App\FeeCategory::all(),'fee_category', 'id');

    	$data['academics']    		= array_pluck(App\Academic::all(),'academic_year_title', 'id');
    	$data['course_parent_list']	= array_pluck(App\Course::getCourses(0), 'course_title', 'id');
    	$data['course_list']        = array();
    	$data['categories']			= array_pluck(App\Category::all(), 'category_name', 'id');
    	$settings = [];
    	$settings['discount_for'] 	= $record->discount_for;
    	$settings['discount_for_details']	= $record->discount_for_details;
    	$settings['academic_id']		= $record->academic_id;
    	$settings['course_parent_id']	= $record->course_parent_id;
    	$settings['course_id']		= $record->course_id;
    	$data['settings']			= json_encode($settings);
    	$data['title']              = getPhrase('edit_discount');
        $data['layout']              = getLayout();
    	return view('fee.feediscounts.add-edit', $data);
    }

    /**
     * Update record based on slug and reuqest
     * @param  Request $request [Request Object]
     * @param  [type]  $slug    [Unique Slug]
     * @return void
     */
    public function update(Request $request, $slug)
    {

        $record                 = FeeDiscount::where('slug', $slug)->get()->first();
        
          $this->validate($request, [
       	  'feecategory_id'          => 'bail|required|integer',
         'discount_name'          	   => 'bail|required|max:30',
         ]);

        $name 					        = $request->discount_name;
       
       /**
        * Check if the title of the record is changed, 
        * if changed update the slug value based on the new title
        */
        if($name != $record->discount_name)
            $record->slug = $record->makeSlug($name);
    	
      	 $record->discount_name 		= $name;
        $record->slug 			    = $record->makeSlug($name);
        $record->feecategory_id		= $request->feecategory_id;
        $record->description		= $request->description;
        $record->save();


    	flash('success','record_updated_successfully', 'success');
    	return redirect('fee/feediscounts');
    }

    /**
     * This method adds record to DB
     * @param  Request $request [Request Object]
     * @return void
     */
    public function store(Request $request)
    {
	    ////////////////////////////////////////////////////
    	// Split the validation rules as per the request  //
	    ////////////////////////////////////////////////////
    	$rules = [
         'feecategory_id'          => 'bail|required|integer',
         'discount_name'           => 'bail|required|max:30',
         'discount_for'            => 'bail|required',
         'discount_for_details'    => 'bail|required',
            ];

       
       $discount_for 		  = $request->discount_for;
       $discount_for_details  = $request->discount_for_details;
       $academic_id 		  = 0;
       $course_parent_id 	  = 0;
       $course_id 			  = 0;
       if($discount_for == 'batch')
       {
       		$discount_for_details 	= $discount_for;
       		$academic_id 			= $request->academic_id;
			$course_parent_id		= $request->course_parent_id;
			$course_id 				= $request->course_id;
			$rules['academic_id'] 	= 'bail|required|integer';
			$rules['course_parent_id'] = 'bail|required|integer';
			$rules['course_id'] 	= 'bail|required|integer';
       }

       //Validate the overall request
       $this->validate($request, $rules);

      
    	$record = new FeeDiscount();
        $name 					    = $request->discount_name;
        $record->discount_name 		= $name;
        $record->slug 			    = $record->makeSlug($name);
        $record->feecategory_id		= $request->feecategory_id;
        $record->description		= $request->description;
        $record->discount_for       = $discount_for;	
        $record->discount_for_details = $discount_for_details;	
        $record->academic_id 		= $academic_id;
        $record->course_parent_id 	= $course_parent_id;
        $record->course_id 			= $course_id;
        $record->save();
 

        flash('success','record_added_successfully', 'success');
    	return redirect('fee/feediscounts');
    }
 
    
    /**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function delete($slug)
    {
        FeeDiscount::where('slug', $slug)->delete();
        return 1;
    }
}
