<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use App\FeeCategory;
use App\FeeCategoryParticular;
use App\FeeSchedulePayment;
use App\FeeParticularPayment;
use App\FeeScheduleParticular;
use App\FeeSchedules;
use App\FeePayment;
use Yajra\Datatables\Datatables;
use DB;
class FeeCategoryParticularsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

     /**
     * Load view for category and academic courses mapping
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function categoryAllotment($category_slug)
    {

      if(!checkRole(getUserGrade(17)))
      {
        prepareBlockUserMessage();
        return back();
      }
    	// dd($category_slug);
        $data['active_class']       = 'fee';
        $data['sub_active_class']   = 'fee_category';
        $record = FeeCategory::where('slug','=',$category_slug)->first();
        if(!$record)
        {
        	flash('Ooops..!','category_not_exists','error');
        	return back();
        }
        $data['record']             = $record;
        $data['items']             = null;

        $data['fee_categories']     = App\FeeCategory::leftJoin('feecategory_particulars','feecategory_particulars.feecategory_id','=','feecategories.id')->where('feecategory_particulars.feecategory_id','=',null)->where('feecategories.id','!=',$record->id)->pluck('title', 'feecategories.id');
        
        $data['academic_years']     = addSelectToList(\App\Academic::pluck('academic_year_title', 'id'));
        $list                       = App\Course::getCourses(0);
        $data['courses_parent_list']= addSelectToList(array_pluck($list, 'course_title', 'id'));
        $data['courses_list']       = addSelectToList(array_pluck(App\Course::getCourses($list[0]->id), 'course_title','id'));

        $data['layout']             = getLayout();
        $particulars                = App\Feeparticulars::get();
        $target_items               = $record->feeParticulars()->get();

        // $data['right_bar']          = TRUE;
        // $data['right_bar_path']     = 'fee.feecategoryallotment.item-view-right-bar';
        // $data['right_bar_data']     = array(
        //                                     'item' => $particulars,

        //                                     );
        
        $data['items']              = json_encode(
                            array('source_items'  => $particulars,'target_items'=>$target_items));
        $data['title']              = getPhrase('manage_fee_particulars_for_').' '.$record->title;
        return view('fee.feecategoryallotment.add-edit', $data);
    }
   
   /**
   This Method update the particulars to the selected fee category
   at the time of updating if schedules are created than you need
   to delete the all records in  schedule related tables and re-insert
   the data again
   **/
    public function updateParticulars(Request $request)
    { 
      // dd($request);  

      $feecategory_id  = $request->feecategory;
      $any_paymentdone  = App\FeePayment::where('feecategory_id','=',$feecategory_id)->get();
      DB::beginTransaction();
      try{

          //if any payment is done for the feecategory you can not update and delete the fee particlar details
           //if have only option to insert a new records(non particular) records only

           if(!count($any_paymentdone)){
            $feeparticular_payments  = FeeParticularPayment::where('feecategory_id','=',$feecategory_id);
        
           $count3 = $feeparticular_payments->count();
          if($count3)
          {
            //Previous records exists  
            $feeparticular_payments->delete();
          }

           $feeschule_payments  = FeeSchedulePayment::where('feecategory_id','=',$feecategory_id);
        
        $count2 = $feeschule_payments->count();
          if($count2)
          {
            //Previous records exists  
            $feeschule_payments->delete();
          }



           $model = FeeCategoryParticular::where('feecategory_id','=',$feecategory_id);
           $count = $model->count();
          if($count)
          {
            //Previous records exists  
            $model->delete();
          }
           
           $added_categories   = $request->feecategories;//selected categories include $request->category also
// dd($added_categories);
          if($request->has('selected_list')){

              foreach($added_categories as $category){

                 $selected_list      = $request->selected_list;//particulars
                 $count              = count($selected_list); 
                 $amount             = $request->amount;//particulars amount
                 $is_term            = $request->is_term;// term applicablew

                 for($i=1; $i<=$count; $i++){
                $newRecord                    = new FeeCategoryParticular();
                $newRecord->feecategory_id    = $category;
                $newRecord->particular_id     = $selected_list[$i-1];
                $newRecord->amount            = round($amount[$i-1]);
                $value                        = $selected_list[$i-1];
                if($is_term!=null){  
                   if(in_array($value,$is_term))
                      {
                        $newRecord->is_term_applicable= 1;
                      }
                      else
                      {
                        $newRecord->is_term_applicable= 0;
                      }
                 }
                 else{
                       $newRecord->is_term_applicable= 0;
                 }
                $newRecord->save();

              }
             
            

              }


          $feeschedule_data      = FeeSchedules::where('feecategory_id','=',$feecategory_id)->first();

           $term_applicable_amount = FeeCategoryParticular::where('feecategory_id','=',$feecategory_id)
                                                    ->where('is_term_applicable','=',1)
                                                    ->sum('amount');

          $term_not_applicable_amount = FeeCategoryParticular::where('feecategory_id','=',$feecategory_id)
                                                    ->where('is_term_applicable','=',0)
                                                    ->sum('amount'); 
              

             $record                     = FeeCategory::find($feecategory_id);
             $record->total_fee          = round($term_applicable_amount);
             $record->other_amount       = round($term_not_applicable_amount);
             if($feeschedule_data!=null){
             $total_installments         = $feeschedule_data->total_installments; 
             $record->total_installments = $total_installments;
             $installment_amount         = $term_applicable_amount/$total_installments;
             $record->installment_amount = round($installment_amount);
            }  
             $record->save();

           
             

          if($feeschedule_data!=null){
          $particulars_available = FeeCategoryParticular::where('feecategory_id','=',$feecategory_id)
                                                         ->where('is_term_applicable','=',1)->get();
          
          $ohter_particulars     = FeeCategoryParticular::where('feecategory_id','=',$feecategory_id)
                                                         ->where('is_term_applicable','=',0)->get();


          $shedule_parti         = FeeScheduleParticular::where('feecategory_id','=',$feecategory_id)->get();
          // dd($feeschedule_data);
          
          $total_installments   = $feeschedule_data->total_installments;
          $count                = count($particulars_available);
          $count1               = count($shedule_parti);
          $count2               = count($ohter_particulars);

          $total_payments       = $count*$total_installments;//feeparticulars * total schedules
          $feeCategoryDetails   = FeeCategory::where('id','=',$feecategory_id)->first();
          $students = App\Student::where('academic_id','=',$feeCategoryDetails->academic_id)
                                  ->where('course_parent_id','=',$feeCategoryDetails->course_parent_id)
                                  ->where('course_id','=',$feeCategoryDetails->course_id)
                                  ->where('current_year','=',$feeCategoryDetails->year)
                                  ->where('current_semister','=',$feeCategoryDetails->semister)
                                  ->get();
           $total_students  = count($students);
            
            $particular  = 0;
            $shedule     = 0;
            $term_number  = 1;
           

            foreach ($students as $student) {
                
               for ($i=1; $i<=$count1; $i++) { 
                    
                   
                   $newRecord                            = new FeeSchedulePayment();
                   $newRecord->feecategory_id            = $feecategory_id;
                   $newRecord->feeschedule_id            = $feeschedule_data->id;
                   $newRecord->feeschedule_particular_id = $shedule_parti[$shedule]['id'];
                   $newRecord->amount                    = round($feeCategoryDetails->installment_amount);
                   $newRecord->user_id                   = $student->user_id;
                   $newRecord->student_id                = $student->id;
                   $newRecord->academic_id               = $feeCategoryDetails->academic_id;   
                   $newRecord->course_parent_id          = $feeCategoryDetails->course_parent_id;
                   $newRecord->course_id                 = $feeCategoryDetails->course_id;
                   $newRecord->year                      = $feeCategoryDetails->year;
                   $newRecord->semister                  = $feeCategoryDetails->semister;
                   $newRecord->term_number               = $term_number;
                   $newRecord->save();

                   $shedule++;
                   $term_number++;
                   if($shedule==$count1){
                     $term_number=1;
                     $shedule = 0;
                   }

                 }
                                  
            }
           
            foreach ($students as $student) {

                   //student previous category id
              $previous_id = FeeParticularPayment::where('student_id','=',$student->id)
                                                   ->groupBy('feecategory_id')
                                                   ->get();
           if(count($previous_id)){       
             foreach ($previous_id as $feecat_data) {
               
               $pre_feecat_id = $feecat_data->feecategory_id;

             }
           
             
              //any previous fee exsits
                $previous_feeparticulars =  FeeParticularPayment::where('student_id','=',$student->id)
                                                       ->where('feecategory_id','=',$pre_feecat_id)
                                                       ->where('paid_percentage','=',0)
                                                       ->get();
             if(count($previous_feeparticulars)){

              foreach ($previous_feeparticulars as $data) {
                
                 $newrecord  = new FeeParticularPayment();
                 $newrecord->feecategory_id            = $feecategory_id;
                 $newrecord->feeparticular_id          = $data->feeparticular_id;
                 $newrecord->feecategory_particular_id = $data->feecategory_particular_id;
                 $newrecord->is_schedule               = $data->is_schedule;
                 $newrecord->feeschedule_particular_id = $data->feeschedule_particular_id;
                 $newrecord->feeschedule_id            = $data->feeschedule_id;
                 $newrecord->amount                    = round($data->amount);
                 $newrecord->carry_forward             = 0;
                 $newrecord->previous_feecategory_id   = $data->feecategory_id;
                 $newrecord->user_id                   = $data->user_id;
                 $newrecord->student_id                = $data->student_id;
                 $newrecord->academic_id               = $data->academic_id;   
                 $newrecord->course_parent_id          = $data->course_parent_id;
                 $newrecord->course_id                 = $data->course_id;
                 $newrecord->year                      = $data->year;
                 $newrecord->semister                  = $data->semister;
                 $newrecord->term_number               = $data->term_number;
                 $newrecord->save();

                  }
                }
             }
                $shedule_id = 0;
                $term_number = 1;

               for ($i=1; $i<=$total_payments; $i++) { 
                    
                   
                   $newRecord                            = new FeeParticularPayment();
                   $newRecord->feecategory_id            = $feecategory_id;
                   $newRecord->feeparticular_id          = $particulars_available[$particular]['particular_id'];
                   $newRecord->feecategory_particular_id = $particulars_available[$particular]['id'];
                   $newRecord->is_schedule               = $particulars_available[$particular]['is_term_applicable'];
                   $newRecord->feeschedule_id            = $feeschedule_data->id;
                   $newRecord->feeschedule_particular_id = $shedule_parti[$shedule_id]['id'];
                   $term_amount                          = round($particulars_available[$particular]['amount']);
                   $newRecord->amount                    = round($term_amount/$count1);
                   $newRecord->user_id                   = $student->user_id;
                   $newRecord->student_id                = $student->id;
                   $newRecord->academic_id               = $feeCategoryDetails->academic_id;   
                   $newRecord->course_parent_id          = $feeCategoryDetails->course_parent_id;
                   $newRecord->course_id                 = $feeCategoryDetails->course_id;
                   $newRecord->year                      = $feeCategoryDetails->year;
                   $newRecord->semister                  = $feeCategoryDetails->semister;
                   $newRecord->term_number               = $term_number;
                   $newRecord->save();
                   
                   $particular++;
                   if($particular==$count){
                    $particular = 0;
                    $term_number++;
                    $shedule_id++;
                    }



                  

                 }

                 for ($i=0; $i<$count2; $i++) { 
                     
                   $particularPayment                            = new FeeParticularPayment();
                   $particularPayment->feecategory_id            = $feecategory_id;
                   $particularPayment->feeparticular_id          = $ohter_particulars[$i]['particular_id'];
                   $particularPayment->feecategory_particular_id = $ohter_particulars[$i]['id'];
                   $particularPayment->is_schedule               = 0;
                   $particularPayment->amount                    = round($ohter_particulars[$i]['amount']);
                   $particularPayment->user_id                   = $student->user_id;
                   $particularPayment->student_id                = $student->id;
                   $particularPayment->academic_id               = $feeCategoryDetails->academic_id;   
                   $particularPayment->course_parent_id          = $feeCategoryDetails->course_parent_id;
                   $particularPayment->course_id                 = $feeCategoryDetails->course_id;
                   $particularPayment->year                      = $feeCategoryDetails->year;
                   $particularPayment->semister                  = $feeCategoryDetails->semister;
                   $particularPayment->save();
                  
                      }
                                  
                    
                    }

                
                }
            
            }

        
        }
       
       /*if any payment is done for a particular feecategory then you have only chance to 
       add the particulars(not tern applicable) to the feecategorty
       */

        else{
// dd('herer');
          $particulars     = FeeCategoryParticular::where('feecategory_id','=',$feecategory_id)->get();
          $new_particulars   = $request->selected_list;
          $amount            = $request->amount;
          $data = [];
          foreach ($particulars as $particular) {
            $data[] = $particular->particular_id;
            if(!in_array($particular->particular_id,$new_particulars)){

               flash('Oops','payment_existed_for_this_category_so_you_can_not_update','warning');
               return redirect(URL_FEE_CATEGORIES);
            }
          }
          
          $added_particulars = array_diff($new_particulars, $data);
          $count2            = count($added_particulars);

          if($count2==0){
            flash('Oops','payment_existed_for_this_category_so_you_can_not_update','warning');
            return redirect(URL_FEE_CATEGORIES);
          }
          $feeCategoryDetails   = FeeCategory::where('id','=',$feecategory_id)->first();
          $students = App\Student::where('academic_id','=',$feeCategoryDetails->academic_id)
                                  ->where('course_parent_id','=',$feeCategoryDetails->course_parent_id)
                                  ->where('course_id','=',$feeCategoryDetails->course_id)
                                  ->where('current_year','=',$feeCategoryDetails->year)
                                  ->where('current_semister','=',$feeCategoryDetails->semister)
                                  ->get();

       for ($i=0; $i<$count2; $i++) { 

         $feecategory_particular                  = new FeeCategoryParticular;
         $feecategory_particular->feecategory_id  = $feecategory_id; 
         $feecategory_particular->particular_id   = $added_particulars[$i]; 
         $feecategory_particular->amount          = round($amount[$i]); 
         $feecategory_particular->is_term_applicable  = 0; 
         $feecategory_particular->is_refundable   = 0;
         $feecategory_particular->save();

       }

       //total non term particulars amount is updated in fee categories table
       $final_amount  = FeeCategoryParticular::where('feecategory_id','=',$feecategory_id)
                                               ->where('is_term_applicable','=',0)
                                               ->sum('amount');

        $feeCategoryDetails->other_amount     = round($final_amount);
        $feeCategoryDetails->save();

        foreach ($students as $student)  {
          
          for ($i=0; $i<$count2; $i++) { 

                   
                   $particularPayment                            = new FeeParticularPayment();
                   $particularPayment->feecategory_id            = $feecategory_id;
                   $particularPayment->feeparticular_id          = $added_particulars[$i];
                   $particularPayment->feecategory_particular_id = $feecategory_particular->id;
                   $particularPayment->is_schedule               = 0;
                   $particularPayment->amount                    = round($amount[$i]);
                   $particularPayment->user_id                   = $student->user_id;
                   $particularPayment->student_id                = $student->id;
                   $particularPayment->academic_id               = $feeCategoryDetails->academic_id;   
                   $particularPayment->course_parent_id          = $feeCategoryDetails->course_parent_id;
                   $particularPayment->course_id                 = $feeCategoryDetails->course_id;
                   $particularPayment->year                      = $feeCategoryDetails->year;
                   $particularPayment->semister                  = $feeCategoryDetails->semister;
                   $particularPayment->save();
                  
                  }



                }

        }

           DB::commit();
            flash('success...!','records_updated_successfully', 'success');
        }
      catch(Exception $ex)
      {
       DB::rollBack();
       if(getSetting('show_foreign_key_constraint','module'))
       {

          flash('oops...!',$e->errorInfo, 'error');
       }
       else {
          flash('oops...!','improper_data', 'error');
       }
      }

      return redirect(URL_FEE_CATEGORIES);

    }
}
