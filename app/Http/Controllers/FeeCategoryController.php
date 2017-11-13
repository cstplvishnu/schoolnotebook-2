<?php
namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\FeeCategory;
use App\FeeSchedules;
use App\FeeScheduleParticular;
use App\FeeParticularPayment;
use App\FeeCategoryParticular;
use App\FeeSchedulePayment;
use Yajra\Datatables\Datatables;
use Auth;
use DB;

class FeeCategoryController extends Controller
{
    
    public function __construct()
    {
    	$this->middleware('auth');
    }


     /**
     This Method Display Fee Dashboard
     **/
    public function feeDashboard()
    {   
         if(!checkRole(getUserGrade(17)))
      {
        prepareBlockUserMessage();
        return back();
      }
        $data['activesub_class']    = 'fee';
        $data['sub_active_class']   = 'fee_category';
        $data['title']              = getPhrase('fee_dashboard');
        $data['layout']             = getLayout();
        return view('fee.dashboard', $data);
    }

    /**
     * Fee categories listing method
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
         if(!checkRole(getUserGrade(17)))
      {
        prepareBlockUserMessage();
        return back();
      }
        $data['active_class']       = 'fee';
        $data['sub_active_class']   = 'fee_category';
        $data['title']              = getPhrase('fee_categories');
        $data['layout']             = getLayout();
    	return view('fee.feecategories.list-feecategories', $data);
    }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatable()
    {
         if(!checkRole(getUserGrade(17)))
      {
        prepareBlockUserMessage();
        return back();
      }

         $records = FeeCategory::select(['id','title', 'slug','total_installments','installment_amount','other_amount','status',])->orderby('updated_at','desc');
        
        return Datatables::of($records)
        ->addColumn('action', function ($records) {

               $link_data = '<p id="social-buttons">

                      <a href="'.URL_FEE_CATEGORIES_EDIT.$records->slug.'" data-toggle="tooltip" data-placement="auto" title="'.getPhrase("edit").'"  class="btn btn-sm btn-icon btn-info"><i class="fa fa-pencil"></i></a>

                      <a href="'.URL_FEE_CATEGORY_PARTICULARS.$records->slug.'" data-toggle="tooltip" data-placement="auto" title="'.getPhrase("manage_particulars").'"  class="btn btn-sm btn-icon btn-success"><i class="fa fa-refresh"></i></a>

                      <a href="'.URL_FEE_CATEGORY_SCHEDULES.$records->slug.'" data-toggle="tooltip" data-placement="auto" title="'.getPhrase("manage_schedules").'"  class="btn btn-sm btn-icon btn-default"><i class="fa fa-calendar"></i></a>';

                            $temp = '';

                            if(checkRole(getUserGrade(17))) {

                            $particulars_created = FeeCategoryParticular::where('feecategory_id','=',$records->id)->get();

                            $available  = count($particulars_created);

                              if($available == 0){

                                $temp = '&nbsp;<a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');" data-toggle="tooltip" data-placement="auto" title="'.getPhrase("delete").'"  class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></a>';
                            }
                        }

                            $temp .='</p>';

                            $link_data .= $temp;
                            
                    return $link_data;
           })
        
        ->editColumn('status',function($records){
            if($records->status==1){
                return $rec = '<span class = "label label-success">'.getPhrase('active').'</span>';
            }
            else{
                return $rec = '<span class = "label label-warning">'.getPhrase('in_active').'</span>';
            }
        })
        ->editColumn('installment_amount',function($records){
           
           $currency = getCurrencyCode();
           return '<p><strong>'.getPhrase('total_installments').'</strong> : '.$records->total_installments.'</p><p><strong>'.getPhrase('installment_amount').'</strong> : '.$currency.' '.$records->installment_amount;

        })
        ->editColumn('other_amount',function($records){
           
           $currency = getCurrencyCode();
           return $currency.' '.$records->other_amount;

        })
        ->editColumn('title',function($records){
             
             return '<strong>'.$records->title.'</strong>';
   
        })
        ->removeColumn('slug')
        ->removeColumn('id')
        ->removeColumn('total_installments')
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
    	$data['record']             = FALSE;
        $data['active_class']       = 'fee';
        $data['sub_active_class']   = 'fee_category';
    	$data['layout']             = getLayout();
        $data['title']              = getPhrase('create_fee_category');
        $data['academic_years']     = addSelectToList(getAcademicYears());
        $list                       = App\Course::getCourses(0);
        
    	return view('fee.feecategories.add-edit-feecategory', $data);
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
    	$record                     = FeeCategory::where('slug', $slug)->first();
    	$data['record']       		= $record;
    	$data['active_class']       = 'fee';
        $data['sub_active_class']   = 'fee_category';
        $data['layout']             = getLayout();
        $data['academic_years']     = addSelectToList(getAcademicYears());
        $list                       = App\Course::getCourses(0);
        $data['title']              = getPhrase('edit_fee_category');
    	return view('fee.feecategories.add-edit-feecategory', $data);
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
        // dd($request);
        $record = FeeCategory::where('slug', $slug)->get()->first();
            $this->validate($request, [
            'title'          => 'bail|required|max:100',
            ]);

        	$name  = $request->title;
       
       /**
        * Check if the title of the record is changed, 
        * if changed update the slug value based on the new title
        */
        if($name != $record->title)
            $record->slug = $record->makeSlug($name);
    	
        $record->title = $name;
        $record->description    = $request->description;
        $record->status 	    = $request->status;
    	$record->save();
    	flash('success','record_updated_successfully', 'success');
    	return redirect('fee/categories');
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
    	$this->validate($request, [
        'title'                 => 'bail|required|max:100',
        'academic_id'           => 'bail|required',
        'course_parent_id'      => 'bail|required',
        'course_id'             => 'bail|required',
        ]);
        
           $year = 1;
        if($request->has('current_year'))
        {
        $year = $request->current_year;
        }

         $semister = 0;
        if($request->has('current_semister'))
        {
        $semister    = $request->current_semister;
        }

        $is_categoeyAvilable    = FeeCategory::where('academic_id','=',$request->academic_id)
                                               ->where('course_parent_id','=',$request->course_parent_id)
                                               ->where('course_id','=',$request->course_id)
                                               ->where('year','=',$year)
                                               ->where('semister','=',$semister)
                                               ->get();
         if(count($is_categoeyAvilable)){
            flash('Oops','fee_category_is_already_created_with_this_academic_details','warning');
            return back();
         }                                      

    	$record                 = new FeeCategory();
        $name 					= $request->title;
        $record->title 	        = $name;
        $record->slug 			= $record->makeSlug($name);
        $record->status         = $request->status;
        $record->description    = $request->description;
        $record->academic_id    = $request->academic_id;
        $record->course_parent_id    = $request->course_parent_id;
        $record->course_id      = $request->course_id;
        $record->year           = $year;
        $record->semister       = $semister;

       
        $record->save();

        flash('success','record_added_successfully', 'success');

    	return redirect(URL_FEE_CATEGORIES);
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
        FeeCategory::where('slug', $slug)->delete();
        return 1;
    }

    /**
     * Load view for category and academic courses mapping
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function categoryAllotment()
    { 
        if(!checkRole(getUserGrade(17)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $data['active_class']       = 'fee';
        $data['sub_active_class']       = 'fee_category';
        $data['record']             = FALSE;

        $data['fee_categories']     = App\FeeCategory::pluck('title', 'id');
        
        $data['academic_years']     = addSelectToList(\App\Academic::pluck('academic_year_title', 'id'));
        // $data['academic_years']  = array(''=>'Select')+$data['academic_years'];
        // dd(\App\Academic::pluck('academic_year_title', 'id'));
        // dd(($data['academic_years']));
        $list                       = App\Course::getCourses(0);
        $data['courses_parent_list']= addSelectToList(array_pluck($list, 'course_title', 'id'));
        $data['courses_list']       = addSelectToList(array_pluck(App\Course::getCourses($list[0]->id), 'course_title','id'));

        // $data['courses_list']       = array();
        $data['layout']             = getLayout();

        // $data['courses']            = (new App\Academic())->getCourseList(FALSE);
        $data['title']              = getPhrase('add_categories_to_courses');
        return view('fee.feecategoryallotment.feecategories-allotmemt', $data);
    }

    /**
     * Allots the Fee Category to feecategories_academics table
     *
     * Check if the feecategory and academic course exists
     *
     * If not exists inserts into the table
     * 
     * @return [type] [description]
     */
    public function allotFeeCategory(Request $request)
    {
          if(!checkRole(getUserGrade(17)))
      {
        prepareBlockUserMessage();
        return back();
      }
        
            $this->validate($request, [
            'academic_id'     => 'required',
            'course_id'       => 'required',
            'fee_categories'  => 'required',
            ]);        
            $academic_id      = $request->academic_id;
            $course_id        = $request->course_id;
            $fee_categories   = $request->fee_categories;

            /**
             * Delete the existing fee categories before inserting new
             * for the selected course id and academic id
             */
            DB::table('feecategories_academiccourses')
            ->where('academic_id',  '=', $academic_id)
            ->where('course_id',    '=', $course_id)
            ->delete();

            /**
             * Insert the new batch of fee categories 
             * for selected course id and academic id
             */
            foreach($fee_categories as $category)
            {
                DB::table('feecategories_academiccourses')->insert(
                    [   'academic_id'   => $academic_id, 
                        'course_id'     => $course_id, 
                        'fee_category_id'=>$category
                    ]
                );    
            }
            flash('success', 'record_updated_successfully', 'success');
            return redirect('fee/categories/allot-category');
    }

    /**
     * Get the list of alloted fee categories to specific academic id and course id from 
     * feecategories_academiccourses table
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getAllotedCategories(Request $request)
    {

         if(!checkRole(getUserGrade(17)))
      {
        prepareBlockUserMessage();
        return back();
      }
        $academic_id    = $request->academic_id;
        $course_id      = $request->course_id;

        $list = DB::table('feecategories_academiccourses')
        ->where('academic_id', '=', $academic_id)
        ->where('course_id', '=', $course_id)
        ->get();

        $selected_list = array_pluck($list, 'fee_category_id');
        return json_encode($selected_list);
    }

    

}
