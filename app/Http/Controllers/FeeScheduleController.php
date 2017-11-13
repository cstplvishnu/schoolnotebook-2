<?php
namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\FeeCategory;
use App\FeeSchedules;
use App\FeePayment;
use App\FeeScheduleParticular;
use App\FeeParticularPayment;
use App\FeeCategoryParticular;
use App\FeeSchedulePayment;
use Yajra\Datatables\Datatables;
use Auth;
use DB;

class FeeScheduleController extends Controller
{


//This Method is used to create shedules for a selected feecategory

    public function createSchedules($slug)
    {
        
       $feeCategory  = FeeCategory::where('slug','=',$slug)->first();

       if($feeCategory==null){
        flash('Oops','no_fee_category_is_available','warning');
        return back();
       }
       
       $is_particulars_assigned = FeeCategoryParticular::where('feecategory_id','=',$feeCategory->id)->first();
       if(!count($is_particulars_assigned)){
           flash('Oops','first_assign_particulars_to '.$feeCategory->title.'_category','warning');
           return back(); 
       }
        
       $schedules_avilable   = FeeScheduleParticular::where('feecategory_id','=',$feeCategory->id)->get();
       
       if(count($schedules_avilable)) {

        $data['records']   = $schedules_avilable;
       }

       else{
         
       $data['records']    = FALSE;

       }
       

       $data['layout']        = getLayout();
       $data['title']         = getPhrase('fee_schedules_for').' '.$feeCategory->title;
       $data['active_class']  = 'fee';
       $data['sub_active_class']   = 'fee_category';
       $data['feeCategory']   = $feeCategory;

       return view('fee.schedules.add-edit-schedules', $data);

    }
    
    /**
    This Method is used to store the shedules details in database
    **/
    public function storeSchedules(Request $request)
    {
      
     DB::beginTransaction();
     try{

        $mystart_dates = $request->start_date;
        $myend_dates   = $request->end_date;

        $is_available = '';
        if(in_array($is_available, $mystart_dates) || in_array($is_available, $myend_dates) ){
          flash('Oops','please_select_the_date_checkit_once','warning');
            return back();
        }

        // foreach ($myend_dates as $each_end_date) {
        //    foreach ($mystart_dates as $each_start_date) {
        //        if($each_end_date < $each_start_date){
        //         flash('Oops','end_date_must_be_gretar_than_start_date_check_it_once','warning');
        //         return back();
        //        }
        //    }
        // }
        // dd('herere');
        foreach ($myend_dates as $each_date) {

          if(array_search($each_date, $mystart_dates)){
            flash('Oops','start_date_must_not_equals_to_end_date_checkit_once','warning');
            return back();
          }
        }
        $feecategory_id                  = $request->feecategory_id;
        $total_installments              = $request->number_of_schedules;
        $feeschedule                     =  new FeeSchedules();
        $feeschedule->feecategory_id     = $feecategory_id;
        $feeschedule->total_installments = $total_installments;
        $feeschedule->save();

         //update total_fee column and installment amount column in feecategories table

              $term_applicable_amount = FeeCategoryParticular::where('feecategory_id','=',$feecategory_id)
                                                    ->where('is_term_applicable','=',1)
                                                    ->sum('amount');

              $term_not_applicable_amount = FeeCategoryParticular::where('feecategory_id','=',$feecategory_id)
                                                    ->where('is_term_applicable','=',0)
                                                    ->sum('amount'); 
              

             $record                     = FeeCategory::find($feecategory_id);
             $record->total_fee          = round($term_applicable_amount);
             $record->other_amount       = round($term_not_applicable_amount);
             $record->total_installments = $total_installments;
             $installment_amount         = $term_applicable_amount/$total_installments;
             $record->installment_amount = round($installment_amount);  
             $record->save();
        
        $start_dates = $request->start_date;
        $end_dates   = $request->end_date;
        
        for($i=1; $i<=$total_installments; $i++)
            {
                $record                          = new FeeScheduleParticular();
                $record->feecategory_id          = $feecategory_id;
                $record->feeschedule_id          = $feeschedule->id;
                $record->installment             = $i;
                $record->total_installments      = $total_installments;
                $record->start_date              = $start_dates[$i-1];
                $record->end_date                = $end_dates[$i-1];
                $record->save();

            }
           
          $particulars_available = FeeCategoryParticular::where('feecategory_id','=',$feecategory_id)
                                                         ->where('is_term_applicable','=',1)->get();
          
          $ohter_particulars     = FeeCategoryParticular::where('feecategory_id','=',$feecategory_id)
                                                         ->where('is_term_applicable','=',0)->get();

          $shedule_parti         = FeeScheduleParticular::where('feecategory_id','=',$feecategory_id)->get();
          // dd($shedule_parti);
          
         
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
                   $newRecord->feeschedule_id            = $feeschedule->id;
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
           // dd($students);
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
                   $newRecord->feeschedule_id            = $feeschedule->id;
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


           
        DB::commit();
        flash('Success','record_added_successfully','success');
        return redirect(URL_FEE_CATEGORIES);
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
        
    }

    /**
    This Method return the student fee schedule details
    based on studentid and feecategory_id
    **/
    public function getStudentScheduleDetails(Request $request)
    {

       $finaldata      = array();
       $feecategory_id = $request->feecategory_id;
       $student_id     = $request->student_id;


      $particulars = App\FeeParticularPayment::getStudentSchedules($student_id,$feecategory_id);
      $feeshedules  = App\FeeScheduleParticular::getStudentSchedules($feecategory_id,$student_id);
      $feecategory_details =  App\FeeCategory::where('id','=',$feecategory_id)->first();
      
      $academic_id        = $feecategory_details->academic_id;
      $course_parent_id   = $feecategory_details->course_parent_id;
      $course_id          = $feecategory_details->course_id;
      $year               = $feecategory_details->year;
      $semister           = $feecategory_details->semister;

      $finaldata['particulars']   = $particulars;
      $finaldata['feeshedules']   = $feeshedules;
      $finaldata['feecategory_details']   = $feecategory_details;

       $student_data = App\Student::join('feeparticular_paymets','feeparticular_paymets.student_id','=','students.id')
        ->join('users', 'users.id' ,'=', 'students.user_id')  
        ->join('academics','academics.id','=','students.academic_id') 
        ->join('courses','courses.id','=','students.course_id')
        ->where('feeparticular_paymets.academic_id','=',$academic_id)
        ->where('feeparticular_paymets.course_parent_id','=',$course_parent_id)
        ->where('feeparticular_paymets.course_id','=',$course_id)
        ->where('feeparticular_paymets.year','=',$year)
        ->where('feeparticular_paymets.semister','=',$semister)
        ->where('feeparticular_paymets.student_id','=',$student_id)
        ->select(['students.id as id','users.name', 'students.roll_no','students.admission_no', 'course_title','academic_year_title', 'email', 'current_year', 'current_semister','course_dueration','students.academic_id as academic_id', 'students.course_id as course_id', 'students.user_id as user_id','users.slug'])
        ->groupBy('students.id')
        ->get();
       
       $finaldata['student']   = $student_data;

      return $finaldata;


    }

    

     /**
    This Method return the student fee paid history details
    based on studentid and feecategory_id
    **/
    public function getStudentFeePaidDetails(Request $request)
    {

      // return $request;
       $finaldata = array();
       $feecategory_id = $request->feecategory_id;
       $student_id     = $request->student_id;
       $previous_details = [];

      $paid_data   = App\FeePayment::where('feecategory_id','=',$feecategory_id)
                                 ->where('student_id','=',$student_id)
                                 ->get();

      $feecategory_details =  App\FeeCategory::where('id','=',$feecategory_id)->first();
      
       $academic_id        = $feecategory_details->academic_id;
      $course_parent_id   = $feecategory_details->course_parent_id;
      $course_id          = $feecategory_details->course_id;
      $year               = $feecategory_details->year;
      $semister           = $feecategory_details->semister;
   
     $student_data = App\Student::join('feeparticular_paymets','feeparticular_paymets.student_id','=','students.id')
        ->join('users', 'users.id' ,'=', 'students.user_id')  
        ->join('academics','academics.id','=','students.academic_id') 
        ->join('courses','courses.id','=','students.course_id')
        ->where('feeparticular_paymets.academic_id','=',$academic_id)
        ->where('feeparticular_paymets.course_parent_id','=',$course_parent_id)
        ->where('feeparticular_paymets.course_id','=',$course_id)
        ->where('feeparticular_paymets.year','=',$year)
        ->where('feeparticular_paymets.semister','=',$semister)
        ->where('feeparticular_paymets.student_id','=',$student_id)
        ->select(['students.id as id','users.name', 'students.roll_no','students.admission_no', 'course_title','academic_year_title', 'email', 'current_year', 'current_semister','course_dueration','students.academic_id as academic_id', 'students.course_id as course_id', 'students.user_id as user_id','users.slug'])
        ->groupBy('students.id')
        ->get();
      
      $finaldata['feecategory_details'] = $feecategory_details;
      $finaldata['paid_data']           = $paid_data;
      $finaldata['student']             = $student_data;

      $previous_particulars = App\FeeParticularPayment::where('student_id','=',$student_id)
                                                ->where('feecategory_id','=',$feecategory_id) 
                                                ->where('carry_forward','=',0);

      $previous_fee_particulars  =  $previous_particulars->get();

        if(count($previous_fee_particulars)){

          foreach ($previous_fee_particulars as $previous_particular) {

        $category_title  =  App\FeeCategory::where('id','=',$previous_particular->previous_feecategory_id)->first()->title;
        $particular_name =  App\Feeparticulars::where('id','=',$previous_particular->feeparticular_id)->first()->title;
            $temp1['title']              = $category_title; 
            $temp1['particular_title']   = $particular_name; 
            $temp1['term_number']        = $previous_particular->term_number; 
            $temp1['is_schedule']        = $previous_particular->is_schedule; 
            $temp1['amonut']             = $previous_particular->amount; 
            $previous_details[]          = $temp1;

          }

        $previous_amount = $previous_particulars->sum('amount');
        $finaldata['previous_details']     = $previous_details;
        $finaldata['previous_amount']      = round($previous_amount);
        }
        else{
          $finaldata['previous_details'] = null;
          $finaldata['previous_amount']      = 0;
        }                                           

      return $finaldata;
      


    }


    /**
    This Method Delete the schedules, before any payment is done
    **/
    public function deleteSchedules(Request $request)
    {
      $feecategory_id  = $request->feecategory_id;
      $payment_done = FeePayment::where('feecategory_id','=',$feecategory_id)->get();
      if(count($payment_done)){
        flash('Oops','you_do_not_delete_this_schedules','warning');
        return redirect(URL_FEE_CATEGORIES);
      }
        
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

            $feeschedule_particulars = FeeScheduleParticular::where('feecategory_id','=',$feecategory_id);
      
           $count1 = $feeschedule_particulars->count();
          if($count1)
          {
            //Previous records exists  
            $feeschedule_particulars->delete();
          }


         $feescheules = FeeSchedules::where('feecategory_id','=',$feecategory_id);
         $count = $feescheules->count();
          if($count)
          {
            //Previous records exists  
            $feescheules->delete();
          }

          $feecate   = FeeCategory::where('id','=',$feecategory_id)->first();
          $feecate->total_installments = 0;
          $feecate->installment_amount = 0;
          $feecate->save();

       flash('success','schedules_deleted_successfully','success');
         return redirect(URL_FEE_CATEGORIES);

    }

}
