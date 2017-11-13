<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class FeeParticularPayment extends Model
{
    protected $table = 'feeparticular_paymets';

    
    
    /**
    This Method View The Fee Scheles For A Selected  
    Student
    **/
    public static function getStudentSchedules($student_id,$feecategory_id)
    {
      return FeeParticularPayment::join('particulars','particulars.id','=','feeparticular_paymets.feeparticular_id')
                ->join('feecategory_particulars','feecategory_particulars.id','=','feeparticular_paymets.feecategory_particular_id')
                                   ->where('feeparticular_paymets.student_id','=',$student_id)
                                   ->where('feeparticular_paymets.feecategory_id','=',$feecategory_id)
                                   ->where('carry_forward','=',1)
                                   ->groupby('feeparticular_paymets.feeparticular_id')
                                   ->get();
    }

    /**
     * This method will prepare overall payment details that student need to pay
     * based on student id and fee category id
     * @param  [type] $student_id      [description]
     * @param  [type] $fee_category_id [description]
     * @return [type]                  [description]
     */
    public static function getFeePaymentParticulars($student_id, $fee_category_id)
    {
        $student_details  = Student::where('id','=',$student_id)->first();
        $course_parent_title = Course::where('id','=',$student_details->course_parent_id)->first()->course_title; 
        $academic_title = Academic::where('id','=',$student_details->academic_id)->first()->academic_year_title; 
        $course_title = Course::where('id','=',$student_details->course_id)->first()->course_title;
        $user_details =  User::where('id','=',$student_details->user_id)->first(); 
         
        $finaldata['student']    = $student_details; 

        /**
         * 1) Find the schedule fee to pay
         * 2) Find the other amounts to pay from fee categories particulars which are not term type
         * 3) Prepare overall summary and net amount to pay varables
         */

        $date = date("Y-m-d");
        
    //Get the schedule fee records
    $particulars = FeeCategory::join('feeschedule_particulars','feeschedule_particulars.feecategory_id','=','feecategories.id')
                      // ->join('feecategory_particulars','feecategory_particulars.feecategory_id','=','feecategories.id')

                      ->where('feeschedule_particulars.start_date','<=',$date)
                      ->where('feeschedule_particulars.feecategory_id','=',$fee_category_id)
                      ->get();

    //Get fee category particulars which are non term type                      
    $other_particulars = FeeCategory::join('feecategory_particulars','feecategory_particulars.feecategory_id','=','feecategories.id')
                                                ->where('feecategory_id','=',$fee_category_id)
                                                ->where('is_term_applicable','!=',1)
                                                ->get();

   //Get The Previous Fee Particulars If student did not pay the fee to that particular
    $previous_particulars = FeeParticularPayment::where('student_id','=',$student_id)
                                                ->where('feecategory_id','=',$fee_category_id) 
                                                ->where('paid_percentage','=',0)
                                                ->where('carry_forward','=',0);
                                                
    

    $payment_details = [];
    $previous_details = [];
    
    $net_amount_to_pay = 0;
    $total_amount_paid = 0;
    $discount_sum      = 0;
    $total_discount    = 0;
    foreach ($particulars as $particular) {
      $temp['particular_id']      = $particular->id;
      $temp['installment']        = $particular->installment;
      $temp['installment_amount'] = round($particular->installment_amount);
      $temp['is_term']            = 1;
      $temp['total_amount']       = round($particular->installment_amount);
      $temp['academic_id']        = $particular->academic_id;
      $temp['course_id']          = $particular->course_id;
      $temp['course_parent_id']   = $particular->course_parent_id;
      $temp['year']               = $particular->year;
      $temp['semister']           = $particular->semister;
      $temp['feeschedule_id']     = $particular->feeschedule_id;
      // $temp['particular_id'] = 0;
      $temp['feeschedule_praticular_id'] = $particular->id;

      $payment_records = FeeParticularPayment::where('student_id','=',$student_id)
                                            ->where('feecategory_id','=',$fee_category_id)
                                            ->where('feeschedule_particular_id','=',$particular->id)
                                            ->get(); 
      $paid_amount = 0;
      $discount_data = 0;                                      
      
      foreach($payment_records as $payment_record) {
        $payment_record = (object)$payment_record;
      $isPaid = 0;
      $current_amount = 0;
      if($payment_record)
      {
        //Check if payment is done or not
        if($payment_record->feecategory_id!=0) {
           $isPaid = 1;
          $current_amount = $payment_record->amount - ($payment_record->paid_amount + $payment_record->discount);
          $net_amount_to_pay += round($current_amount);
          $paid_amount += $payment_record->paid_amount;
          $discount_data += $payment_record->discount;
          // $total_amount_paid += $paid_amount;
        }
         
         $total_amount_paid += $payment_record->paid_amount;
         $discount_sum      += $payment_record->discount;

      }
      $temp['current_amount']    = $current_amount;
      $temp['payment_record'][]  = $payment_record;
     }
     $temp['is_paid']     = round($isPaid);
     $temp['paid_amount'] = round($paid_amount);
     $temp['discount_data'] = round($discount_data);

      // $temp['paid_amount'] = $paid_amount;
      $payment_details[] = $temp;
      
    }


    foreach($other_particulars as $particular)
    {
      $temp['particular_id']      = $particular->id;
      $temp['installment']        = 0;
      $temp['installment_amount'] = 0;
      $temp['is_term']            = 0;
      $temp['total_amount']       = round($particular->amount);
      $temp['academic_id']        = $particular->academic_id;
      $temp['course_id']          = $particular->course_id;
      $temp['course_parent_id']   = $particular->course_parent_id;
      $temp['year']               = $particular->year;
      $temp['semister']           = $particular->semister;
      $temp['feeschedule_id']     = 0;
      $temp['particular_id']      = $particular->particular_id;
      $temp['feeschedule_praticular_id'] = 0;

      $payment_records = FeeParticularPayment::where('student_id','=',$student_id)
                                            ->where('feecategory_id','=',$fee_category_id)
                                            ->where('feecategory_particular_id','=',$particular->id)
                                            ->get(); 
       $total_discount  = FeeParticularPayment::where('student_id','=',$student_id)
                                            ->where('feecategory_id','=',$fee_category_id)
                                            ->where('previous_feecategory_id','=',0)
                                            ->sum('discount'); 
                                            
      $paid_amount = 0; 
      $discount_data  = 0;
      foreach($payment_records as $payment_record) {
        $payment_record = (object)$payment_record;
      $isPaid = 0;
      $current_amount = 0;
      if($payment_record)
      {
        //Check if payment is done or not
       if($payment_record->feecategory_id!=0) {
         $isPaid = 1;
          $current_amount     = $payment_record->amount - ($payment_record->paid_amount+ $payment_record->discount);
          $net_amount_to_pay += $current_amount;
          $paid_amount       += $payment_record->paid_amount;
          $discount_data     += $payment_record->discount;
        }
        
         $total_amount_paid += $payment_record->paid_amount;
         $discount_sum      += $payment_record->discount;       
      }
      
      
      $temp['payment_record'][] = $payment_record;
    }
      $temp['is_paid']     = round($isPaid);
      $temp['paid_amount'] = round($paid_amount);
      $temp['discount_data'] = round($discount_data);
      $payment_details[]   = $temp;
      
    }  

        $previous_fee_particulars  =  $previous_particulars->get();

        if(count($previous_fee_particulars)){
          foreach ($previous_fee_particulars as $previous_particular) {

            $category_title  =  FeeCategory::where('id','=',$previous_particular->previous_feecategory_id)->first()->title;
            $particular_name =  Feeparticulars::where('id','=',$previous_particular->feeparticular_id)->first()->title;
            $temp1['title']              = $category_title; 
            $temp1['particular_title']   = $particular_name; 
            $temp1['term_number']        = $previous_particular->term_number; 
            $temp1['is_schedule']        = $previous_particular->is_schedule; 
            $temp1['amonut']             = $previous_particular->amount; 
            $previous_details[]          = $temp1;

          }

        $previous_amount = $previous_particulars->sum('amount');
        $finaldata['previous_particulars'] = $previous_fee_particulars;
        $finaldata['previous_details']     = $previous_details;
        $finaldata['previous_amount']      = round($previous_amount);
        }
        else{
          $finaldata['previous_particulars'] = null;
          $finaldata['previous_amount']      = 0;
        }

 
        $finaldata['payment_details']      = $payment_details; 
        $finaldata['particulars']          = $particulars; 
        $finaldata['course_parent_title']  = $course_parent_title; 
        $finaldata['academic_title']       = $academic_title; 
        $finaldata['course_title']         = $course_title; 
        $finaldata['user_details']         = $user_details; 
        $finaldata['total_discount']       = round($total_discount); 
        
        $finaldata['net_amount_to_pay']    = round($net_amount_to_pay); 

        $finaldata['total_amount_paid']    = round($total_amount_paid);
        $finaldata['discount_sum']         = round($discount_sum);

        
        return $finaldata;
    }



    public static function monthlyRecords($table='feeparticular_paymets', $total_days=31)
    {
      $query = "SELECT SUM(AMOUNT) AS amount, SUM(round(paid_amount)) as paid_amount, day(received_on) as day, MONTH(received_on) AS month, MONTHNAME(received_on) as month_name FROM `feeparticular_paymets`   WHERE received_on BETWEEN DATE_SUB(NOW(), INTERVAL 31 DAY) AND NOW() and feepayment_id!=0  group by received_on order BY received_on";

        $records = DB::select($query);
         
        $dates_list = getMonthDates();
        $amount = [];
        $paid = [];
        foreach($dates_list as $l) 
        {
          $month = (int)date('m', strtotime($l));
      $day = (int)date('d', strtotime($l));
      $month_name = date('M', strtotime($l));

      $recs = (object)FeeParticularPayment::findRecord($records, $day, $month);
     
      $amount[] = $recs->amount;
      $paid[] = $recs->paid;
       
        }
        
        
      return array('amount'=>$amount, 'paid'=>$paid);
    }


    public static function findRecord($records, $day, $month)
  {
    $result = null;
    foreach($records as $record)
    {
      if($record->day==$day && $record->month==$month)
      {
        $result = $record;
        break;
      }
    }
    if($result)
      return array('amount'=>$result->amount,'paid'=>$result->paid_amount);
    
    return array('amount'=>0,'paid'=>0);
    
  }


  /**
    This Method return the total payiable amount for
    particular term based on student id
    **/
     public function getScheduleTotalAmount($term_id,$student_id)
     {
         $schedule_amount = FeeParticularPayment::where('feeschedule_particular_id','=',$term_id)
                                          ->where('student_id','=',$student_id)
                                          ->where('is_schedule','=',1)
                                          ->sum('amount');
        
         
        return $schedule_amount;
     }


     /**
    This Method return the total paid amount and discount for
    particular term based on student id
    **/
     public function getScheduleTotalPaidAmount($feecat_id,$term_id,$student_id)
     {
         $paid_amount = FeeParticularPayment::where('feecategory_id','=',$feecat_id)
                                          ->where('feeschedule_particular_id','=',$term_id)
                                          ->where('student_id','=',$student_id)
                                          ->where('is_schedule','=',1)
                                          ->sum('paid_amount');
          
         $discount_amount  = FeeParticularPayment::where('feecategory_id','=',$feecat_id)
                                                  ->where('student_id','=',$student_id)
                                                  ->where('feeschedule_particular_id','=',$term_id)
                                                  ->where('is_schedule','=',1)
                                                  ->sum('discount'); 
         $final_amount = round($paid_amount+$discount_amount);
         return $final_amount;

     }


     public function getNonTermsPaidAmount($feecat_id,$student_id)
     {
        $other_paid_amount  =  FeeParticularPayment::where('feecategory_id','=',$feecat_id)
                                          ->where('student_id','=',$student_id)
                                          ->where('is_schedule','=',0)
                                          ->where('carry_forward','=',1)
                                          ->sum('paid_amount');
        $other_paid_discount_amount  =  FeeParticularPayment::where('feecategory_id','=',$feecat_id)
                                          ->where('student_id','=',$student_id)
                                          ->where('is_schedule','=',0)
                                          ->where('carry_forward','=',1)
                                          ->sum('discount');                                                                                           
         $final_amount = round($other_paid_amount + $other_paid_discount_amount);
         return $final_amount;
     }

    
        /**
    This Method return the total payiable amount for
    particular term based on student id
    **/
     public function getScheduleTotalOtherAmount($feecat_id,$student_id)
     {
         $other_amount = FeeParticularPayment::where('feecategory_id','=',$feecat_id)
                                          ->where('student_id','=',$student_id)
                                          ->where('is_schedule','!=',1)
                                          ->where('carry_forward','=',1)
                                          ->sum('amount');                          
         
         return round($other_amount);

     }

          /**
    This Method return the total previous amount for
    particular category based on student id and feecategory id
    **/
     public function getSchedulePreviousAmount($feecat_id,$student_id)
     {
         $other_amount = FeeParticularPayment::where('feecategory_id','=',$feecat_id)
                                          ->where('student_id','=',$student_id)
                                          ->where('carry_forward','=',0)
                                          ->where('paid_percentage','=',0)
                                          ->sum('amount');                          
         $amount   = round($other_amount);
         return $amount;

     }




          /**
    This Method return the total payiable amount for
    particular term based on student id
    **/
     public function getTerms($term_id,$student_id)
     {
         $term_numebr = FeeParticularPayment::join('feeschedule_particulars','feeschedule_particulars.id','=','feeparticular_paymets.feeschedule_particular_id')
                                              ->where('feeschedule_particular_id','=',$term_id)
                                              ->where('student_id','=',$student_id)
                                              ->first();                  
         
         return $term_numebr;

     }

     public static function getOverallPayments()
     {
       // return FeeParticularPayment::where('feepayment_id','!=',0)
       $query = "SELECT SUM(AMOUNT) AS amount, SUM(round(paid_amount)) as paid_amount FROM `feeparticular_paymets`   WHERE received_on BETWEEN DATE_SUB(NOW(), INTERVAL 31 DAY) AND NOW() and feepayment_id!=0  ";
                  $records = DB::select($query);
        $result['amount'] = 0;
        $result['paid'] =0;
        if(count($records))
        {
          $records = $records[0];

          $result['amount'] = $records->amount;
          $result['paid'] = $records->paid_amount;
        }
        return $result;
     }

    public static function getCategoryAmount($fee_cat_id,$type){
        
        if($type == 'amount'){

          $amount  =  FeeParticularPayment::where('feecategory_id','=',$fee_cat_id)
                                            ->where('carry_forward','=',1)
                                            ->sum('amount');
          return $amount;  
        }
        else{
          
          $amount  = FeeParticularPayment::where('feecategory_id','=',$fee_cat_id)
                                          ->where('carry_forward','=',1)
                                          ->sum('paid_amount');

          $discount1  = FeeParticularPayment::where('feecategory_id','=',$fee_cat_id)
                                          ->where('carry_forward','=',1)
                                          ->sum('discount');                                

          $amount1  = FeeParticularPayment::where('previous_feecategory_id','=',$fee_cat_id)
                                          ->where('carry_forward','=',0)
                                          ->sum('paid_amount');

          $discount2  = FeeParticularPayment::where('previous_feecategory_id','=',$fee_cat_id)
                                          ->where('carry_forward','=',0)
                                          ->sum('discount');                                                                
          return ($amount+$amount1 + $discount1 + $discount2);                                 

        }

    }
}