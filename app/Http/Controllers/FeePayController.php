<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use App\FeeCategory;
use App\FeeSchedules;
use App\FeeScheduleParticular;
use App\FeeParticularPayment;
use App\FeeCategoryParticular;
use App\FeeSchedulePayment;
use App\FeePayment;
use App\FeePaymentTransaction;
use App\Student;
use App\User;
use App\FeePaymentsOnline;
use Yajra\Datatables\Datatables;
use DB;
use Auth;
use Exception;
use Softon\Indipay\Facades\Indipay;  
use Carbon;
use App\Paypal;
use Input;

class FeePayController extends Controller
{
  public $remaining_amount = 0;
  public $paid_percentage = 0;

	public function index()
	{
		if(!checkRole(getUserGrade(17)))
        {
          prepareBlockUserMessage();
          return back();
        }
        
        if(checkRole(getUserGrade(16))){

         $data['active_class']       = 'pay_fee';  
        }
        else{
        $data['active_class']       = 'fee';
       }
        $data['sub_active_class']   = 'fee_pay';
        $feeCategories              = addSelectToList(FeeCategory::where('status','=',1)->pluck('title','id'));
        $payment_ways               = array(
        	                            'cash'=>getPhrase('cash'),
        	                            'online'=>getPhrase('online'),
        	                            'cheque'=>getPhrase('cheque'),
        	                            'DD'=>'DD',
        	                            'other'=>getPhrase('other_payment_way') );
                                      
        $data['feeCategories']      = $feeCategories;
        $data['payment_ways']       = $payment_ways;
        $data['title']              = getPhrase('pay_fee');
        $data['layout']             = getLayout();
    	return view('fee.payfee.select-particulars', $data);

        
	}

    /**
    This Method is get The students based on  selected Fee Category
    **/
	public function getFeeCategoryStudents(Request $request)
	{
		$students = FeeParticularPayment::join('students','students.id','=','feeparticular_paymets.student_id')
		                                ->where('feecategory_id','=',$request->feecategory_id)
		                                ->select('students.id','students.roll_no','students.admission_no','students.first_name','students.middle_name','students.last_name')
		                                ->groupby('students.id')
		                                ->get();
      //if selected category as recorded any previous fee category in database
      
      $any_where  = FeeParticularPayment::where('previous_feecategory_id','=',$request->feecategory_id)
                                          ->groupBy('previous_feecategory_id')
                                          ->get();                              
      if(count($any_where)){
       $total_number  = count($any_where);
       }
      else{
        $total_number = 0;
      } 
      
      $finaldata['students']      = $students;
      $finaldata['total_number']  = $total_number;
		   return json_encode($finaldata);                             
	}
     
    /**
    This Method return student term fee payment details 
    or pay the fee for the particulars
    **/ 
	public function getStudentPayFee(Request $request)
	{ 
     
        $finaldata = array(); 
        
        $student_id = $request->student_id;
        $fee_category_id = $request->feecategory_id;
       
        $finaldata = App\FeeParticularPayment::getFeePaymentParticulars($student_id, $fee_category_id);

		   return $finaldata; 
	}

  /**
  This method is show payment gateways to student 
  to pay the fee
  **/
  public function feeCheckout(Request $request)
  {
    
   
        $amount_to_pay = $request->pay_amount;
        $current_feecategory_id = $request->current_feecategory_id;
        $user = Auth::user();
        $student = Student::where('user_id','=',$user->id)->first();

        $data['layout']        = getLayout();
        $data['user']          = $user;
        $data['student']       = $student;
        $data['amount_to_pay'] = $amount_to_pay;
        $data['current_feecategory_id'] = $current_feecategory_id;
        $data['title']         = getPhrase('fee_checkout');
        $data['active_class']  = 'users';
        $data['sub_active_class']  = 'users';

        if(checkRole(getUserGrade(7)))
        {
          $data['parent_user'] = TRUE;
          $data['children'] = App\User::where('parent_id', '=', $user->id)->get();
        }

       return view('fee.payments.checkout', $data);
  }

/**
This method is accept the amount from the student and
redirect to selected payment gateway API
**/
  public function payNow(Request $request)
  {
    

     $payment_gateway = $request->gateway;
     $amount          = $request->amount_to_pay;
     $user_id         = $request->user_id;
     $student_id      = $request->student_id;
     $current_feecategory_id      = $request->current_feecategory_id;
     $other_details   = '';
     if($request->has('other_details')){
      $other_details    = $request->other_details;
     }
      if($payment_gateway == 'payu')
      {

        if(!getSetting('payu', 'module'))
        {
            flash('Ooops...!', 'this_payment_gateway_is_not_available', 'error');          
            return back();
        }

        $token = $this->preserveBeforeSave($payment_gateway, $amount,$user_id,$student_id,$current_feecategory_id,$other_details);
        
        $config = config();
        $payumoney = $config['indipay']['payumoney'];

        $payumoney['successUrl'] = URL_PAYU_FEE_PAYMENT_SUCCESS.'?token='.$token;
        $payumoney['failureUrl'] = URL_PAYU_FEE_PAYMENT_CANCEL.'?token='.$token;

        $user = Auth::user();
         $parameters = [  
                          'key' => getSetting('payu_merchant_key','payu'),
                          'txnid'       => $token,
                          'order_id'  => '',
                          'firstname' => $user->username,
                          'purpose'    => 'fee',
                          'email'     =>$user->email,
                          'phone'     => ($user->phone)? $user->phone : '4561234567',
                          'amount'    => $amount,
                          'productinfo' => 'Fee',
                          'service_provider'  => 'payu_paisa',    
                          'surl'      => URL_PAYU_FEE_PAYMENT_SUCCESS.'?token='.$token,
                          'furl'      => URL_PAYU_FEE_PAYMENT_CANCEL.'?token='.$token,
                       ];
      
      return Indipay::purchase($parameters);

        // URL_PAYU_PAYMENT_SUCCESS
        // URL_PAYU_PAYMENT_CANCEL
      }
       else if($payment_gateway=='paypal') 
      {

        if(!getSetting('paypal', 'module'))
        {
            flash('Ooops...!', 'this_payment_gateway_is_not_available', 'error');          
            return back();
        }

        $token = $this->preserveBeforeSave($payment_gateway, $amount,$user_id,$student_id,$current_feecategory_id,$other_details);

        $paypal = new Paypal();
        $paypal->config['return']         = URL_PAYPAL_FEE_PAYMENT_SUCCESS.'?token='.$token;
        $paypal->config['cancel_return']  = URL_PAYPAL_FEE_PAYMENT_CANCEL.'?token='.$token;
        $paypal->invoice = $token;
        $paypal->add('Fee', $amount); //ADD  item
        $paypal->pay(); //Proccess the payment
      }
      else if($payment_gateway=='offline') 
      {
        
        if(!getSetting('offline_payment', 'module'))
        {
            flash('Ooops...!', 'this_payment_gateway_is_not_available', 'error');          
            return back();
        }

        $payment_data = [];
        foreach(Input::all() as $key => $value)
        {
          if($key=='_token')
            continue;
          $payment_data[$key] = $value;
        }

        $data['active_class'] = 'feedback';
        $data['sub_active_class'] = '';
        $data['payment_data'] = json_encode($payment_data);
        $data['layout']       = getLayout();
        $data['title']        = getPhrase('offline_payment');
        return view('fee.payments.offline-payment', $data);
 
      }
  }
  
  /**
  This method save fee pay data in feepayments_online table
  with pending status
  **/
  public function preserveBeforeSave($gateway, $amount, $user_id, $student_id , $fee_cat_id,$other_details)
  {
    $record  = new FeePaymentsOnline();
    $record->slug            = $record->makeSlug(getHashCode());
    $record->user_id         = $user_id;
    $record->feecategory_id  = $fee_cat_id;
    $record->plan_type       = 'fee';
    $record->payment_gateway = $gateway;
    $record->paid_by         = $user_id;
    $record->paid_amount     = $amount;
    $record->payment_status  = PAYMENT_STATUS_PENDING;
    $record->other_details   = $other_details;

    $record->save();
    return $record->slug;

  }
  

   public function paypalCancel()
    {

      if($this->paymentFailed())
      {
        //FAILED PAYMENT RECORD UPDATED SUCCESSFULLY
        //PREPARE SUCCESS MESSAGE
          flash('Ooops...!', 'your_payment_was cancelled', 'warning');
      }
      else {
      //PAYMENT RECORD IS NOT VALID
      //PREPARE METHOD FOR FAILED CASE
        pageNotFound();
      }

      //REDIRECT THE USER BY LOADING A VIEW
      $user = Auth::user();
      return redirect(URL_PAYMENTS_LIST.$user->slug);
       
    }


    public function paypalSuccess(Request $request)
    {

       
        $user = Auth::user();
         $response = $request->all();



      if($this->paymentSuccess($request))
      {
        //PAYMENT RECORD UPDATED SUCCESSFULLY
        //PREPARE SUCCESS MESSAGE
          flash('success', 'fee_paid_successfull', 'success');
           $email_template = 'subscription_success';
          sendEmail($email_template, array('username'=>$user->name, 
          
          'to_email' => $user->email));

      }
      else {
      //PAYMENT RECORD IS NOT VALID
      //PREPARE METHOD FOR FAILED CASE
        pageNotFound();
      }
    //REDIRECT THE USER BY LOADING A VIEW
  
      return redirect(URL_PAYMENTS_LIST.$user->slug);
      
    }

  public function payuSuccess(Request $request)
  {
       $response = $request->all();
 
         $user = Auth::user();
        if($this->paymentSuccess($request))
      {
        //PAYMENT RECORD UPDATED SUCCESSFULLY
        //PREPARE SUCCESS MESSAGE
        
        $email_template = 'subscription_success';
          sendEmail($email_template, array('username'=>$user->name, 
          
          'to_email' => $user->email));
          flash('success', 'your_fee_payment_was_successfull', 'success');
      }
        else {
      //PAYMENT RECORD IS NOT VALID
      //PREPARE METHOD FOR FAILED CASE
        pageNotFound();
      }
    //REDIRECT THE USER BY LOADING A VIEW
     
      return redirect(URL_PAYMENTS_LIST.$user->slug);
  }
  
   public function payuCancel(Request $request)
  {
     if($this->paymentFailed())
      {
        //FAILED PAYMENT RECORD UPDATED SUCCESSFULLY
        //PREPARE SUCCESS MESSAGE
          flash('Ooops...!', 'your_payment_was cancelled', 'warning');
      }
      else {
      //PAYMENT RECORD IS NOT VALID
      //PREPARE METHOD FOR FAILED CASE
        pageNotFound();
      }

      //REDIRECT THE USER BY LOADING A VIEW
      $user = Auth::user();
      return redirect(URL_PAYMENTS_LIST.$user->slug);
  }



  /**
   * This method will update the fee payment details in 4 talbles with the below order
   * 1) feepayments                  --Stores the general information about the payment
   * 2) feepayments_transactions     --Stores the transaction information for this payment
   * 3) feeparticular_paymets        --Stores/Updates each particular payment details (schedule payments and other payments)
   * 4) feeschedule_payments         --Stores/Updates each schedule payment details
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function payFeeToParticular(Request $request)
  {

    if(!checkRole(getUserGrade(17)))
        {
          prepareBlockUserMessage();
          return back();
        }
    /**
     * 1) Get All information
     * 2) Saperate other payments and schedule payments
     * 3) Make schedule payment records in asc order
     * 4) First update other payments and then schedule payments
     *
     * Notations
     * PA ==> Paid Amount
     * OA ==> Other Amount
     * BA ==> Balance Amount
     * TA ==> Total Amount      --> Total current need to pay
     * RA ==> Remaining Amount  --> Remaining amount after paying to other particulars; Initially RA = PA
     * 
     * Cases 
     * 
     * Case 1:    If PA is 100%, then directly update all the records
     * Case 2:    If PA < 100%
     * Case 2.1.1: If PA >= OA
     *             -> Update OA as paid for each particular (feeparticular_paymets table)
     *             -> Calculate RA after paid to OA
     *             -> If no terms available, generate receipt and stop
     *             -> Else Go to 2.2.1
     *      2.1.2: Else (PA < OA)
     *             -> Update the payments tables with PA and BA
     *             -> Generate Recept and stop   
     * 
     *      2.2.1:  If RA >= Term Amount
     *              -> Update particulars of term amount (feeparticular_paymets + feeschedule_payments)
     *              -> Calculare RA after paid to term
     *              -> If no terms available Generate receipt ans stop
     *              -> Else Go to 2.2.1
     *      2.2.2:  Else (RA < Term Amount)        
     *              -> Calculate the % of RA with TA
     *              -> For each term particulars update the remaining % of amount (feeparticular_paymets + feeschedule_payments)
     *              -> Generate Recept and stop
     */
      
        
        $academic_id      = $request->academic_id[0];
        $course_id        = $request->course_id[0];
        $course_parent_id = $request->course_parent_id[0];
        $year             = $request->year[0];
        $semister         = $request->semister[0];


        $student_id       = $request->student_id;
        $category_id      = $request->feeCategories;
        $paid_amount      = $request->pay_amount;
        if($request->discount==''){
          $discount_amount  = 0;
        }
        else{
        $discount_amount  = $request->discount;
       }
        $payment_mode     = $request->payment_mode;
        $notes            = $request->notes;

        $total_amount     = $paid_amount+$discount_amount;//afterdiscount amount + discount amount
        // dd($total_amount);

        $this->remaining_amount = $paid_amount;
        $this->paid_percentage  = $request->paid_percentage;
        $other_payments   = [];
        $schedule_payments= [];
        $feepayment = null;

        //Get information
        $payment_details = (object)FeeParticularPayment::getFeePaymentParticulars($student_id, $category_id);

        //Access the last record in the payment details which contains all payments need to be paid
        $payment_records = (object)end($payment_details->payment_details);
        $payment_records = $payment_records->payment_record;
        // dd($payment_records);
        
        foreach ($payment_records as $record) {
          if($record->is_schedule)
            $schedule_payments[] = $record;
          else
            $other_payments[] = $record;
        }

        //Access The Previous Unpaid Fee particulars
        if($payment_details->previous_particulars!=null){
        $previous_fee_particulars = $payment_details->previous_particulars;  
        foreach ($previous_fee_particulars as $mydata) {
          $previous_fee[]  = $mydata;
        }
      }
        // $feepayment_id = 0;
         DB::beginTransaction();
        try{

          $feepayment = $this->insertFeePaymentRecord($student_id, $category_id, $paid_amount,$payment_mode,$notes,$discount_amount);
          $feepayment_id = $feepayment->id;
          if($payment_details->previous_particulars!=null){
          $this->updatePaymentRecords($previous_fee, $feepayment_id,$total_amount,$discount_amount);
          }//previous fee

          $this->updatePaymentRecords($other_payments, $feepayment_id,$total_amount,$discount_amount);//current non-term fee
          $this->updatePaymentRecords($schedule_payments, $feepayment_id,$total_amount,$discount_amount);// current term-fee
          
          DB::commit();
          flash('success','fee_paid_successfully','success');
          return redirect(URL_FEE_ACCEPT);

          }
        catch(Exception $ex)
        {
          DB::rollBack();
          // dd($ex->getMessage());
           if(getSetting('show_foreign_key_constraint','module'))
           {

              flash('oops...!',$ex->getMessage(), 'error');
           }
           else {
            flash('oops...!',$ex->getMessage(), 'error');
              // flash('oops...!','improper_data', 'error');
            }
          return back();
        }
        if($feepayment)
        return redirect(URL_PRINT_FEE_RECEIPT.$feepayment->transaction_id);

      return back();
        
  }


  public function insertFeePaymentRecord($student_id, $feecategory_id, $paid_amount, $payment_mode="cash", $payment_notes,$discount_amount,$payment_slug='',$payment_mode_name='')
  {
        $category_record = FeeCategory::where('id','=',$feecategory_id)->first(); 
        $student_record = App\Student::where('id','=',$student_id)->first();

          $feePayment                       = new FeePayment();
          if($payment_slug==''){
          $feePayment->transaction_id       = getHashCode();
          }
          else{
            $feePayment->transaction_id       = $payment_slug;
          }
          $feePayment->academic_id          = $category_record->academic_id;
          $feePayment->course_parent_id     = $category_record->course_parent_id;
          $feePayment->course_id            = $category_record->course_id;
          $feePayment->year                 = $category_record->year;
          $feePayment->semister             = $category_record->semister;

          $feePayment->feecategory_id       = $category_record->id;
          $feePayment->feecategory_title    = $category_record->title;
          
          $feePayment->student_id           = $student_record->id;
          $feePayment->user_id              = $student_record->user_id;
          $feePayment->amount               = FeeCategoryParticular::getTotalFee($feecategory_id);
          
          
          $any_paidamount                   = FeeParticularPayment::where('student_id','=',$student_id)
                                                         ->where('feecategory_id','=',$feecategory_id)
                                                         ->sum('paid_amount');

          $any_discount_paid               = FeeParticularPayment::where('student_id','=',$student_id)
                                                         ->where('feecategory_id','=',$feecategory_id)
                                                         ->sum('discount');                                                   
          
          $any_previous_balance      = FeeParticularPayment::where('student_id','=',$student_id)
                                                         ->where('feecategory_id','=',$feecategory_id)
                                                         ->where('previous_feecategory_id','>',0)
                                                         ->where('paid_percentage','=',0)
                                                         ->sum('amount');
         
         $any_previous_balance_paid      = FeeParticularPayment::where('student_id','=',$student_id)
                                                         ->where('feecategory_id','=',$feecategory_id)
                                                         ->where('previous_feecategory_id','>',0)
                                                         ->where('paid_percentage','=',100)
                                                         ->sum('amount');
                                                         
// dd($any_previous_balance_paid);
          $feePayment->total_amount       =   $feePayment->amount + $any_previous_balance;         
          $feePayment->previous_balance   =   $any_previous_balance;                                             
          $feePayment->paid_amount          = $paid_amount;
          $feePayment->discount_amount      = $discount_amount;
          
          $feePayment->balance              = ($feePayment->amount + $any_previous_balance + $any_previous_balance_paid) - ($feePayment->paid_amount+$any_paidamount+$discount_amount+$any_discount_paid);

          $feePayment->payment_mode         = $payment_mode;
          if($payment_mode_name!=''){
            $feePayment->payment_mode_name  = $payment_mode_name;
          }
          $feePayment->payment_notes        = $payment_notes;
          $today   = date('Y-m-d');
          $feePayment->recevied_on          = $today;

          // if($request->has('other_payment_mode')){
           
          //  $feePayment->payment_mode_name         = $request->other_payment_mode;

          // }

          $feePayment->payment_recevied_by = Auth::user()->id;
          $feePayment->save();
          return $feePayment;
  }


  /**
   * This method will update all the other amount records
   * @param  [type] $other_payments [description]
   * @return [type]                 [description]
   */
  public function updatePaymentRecords($payment_records, $feepayment_id,$total_amount = 0,$discount_amount = 0)
  {
    
    //Amount pending is the sum of amount of payment records
    //Each time after amount is being paid, we decrease the amount pending with the paid amount
    //This can be used for distribution of amount for remaining records if remaining amount 
    //is not sufficient
    $amount_pending = $this->getTotalPendingAmount($payment_records);
    $total_records = count($payment_records);
    $percentage = 0;
    $amount_needed = 0;
    foreach($payment_records as $payment)
    {
      
      if($payment->paid_percentage==100)
        continue;
      if($this->isPaymentCompleted($payment) <= 0)
        continue;

      if($this->remaining_amount > 0 )
      {
          $amount_needed = $payment->amount;
          if($payment->paid_percentage>0 && $payment->paid_percentage<100)
          {

          
            $amount_needed = $this->isPaymentCompleted($payment);
            // dd($amount_needed);
            $newPaymentRecord = $this->getNewPaymentRecord($payment);
            $payment = $newPaymentRecord;
          }

          if($amount_needed <= ($this->remaining_amount+$discount_amount))
          { 
            if($total_amount==0){
            $payment->paid_amount = round($amount_needed);
            $payment->balance = $payment->amount - $payment->paid_amount;
            $payment->paid_percentage = 100;
           
            $amount_pending -= $payment->paid_amount;
            $total_records--;

            }
            else{
            $paid_amount         =  round($amount_needed);
            $discount_percentage = getPercentage($paid_amount,$total_amount);
            $discount_value      = calculatePercentage($discount_amount,$discount_percentage);
            
            $payment->paid_amount = $paid_amount-$discount_value;
            $payment->discount    = $discount_value;
            $payment->balance     = $payment->amount - $paid_amount;
            $payment->paid_percentage = 100;
           
            $amount_pending -= $payment->paid_amount;
            $total_records--;

            }
          }
          else {
            //Remaining amount is not sufficient for current payment
            //And check if there are more than 1 records available
            //If only single record exists, simply allocate all the amount to available record and update it
            if(!$percentage)
            {
              $percentage = getPercentage($this->remaining_amount, $amount_pending);
            }
            
            if($total_records>1)
            {
              $amount_to_pay = calculatePercentage($amount_needed, $percentage);

              $payment->paid_amount = $amount_to_pay;
              $payment->balance = $payment->amount - $payment->paid_amount;
              $payment->paid_percentage = $percentage;
              
            }
            else {
              //Only one record exist, so directly update the available amount 
               if($total_amount==0){

              $payment->paid_amount = $this->remaining_amount;
              $payment->balance     = $payment->amount - $payment->paid_amount;
              $payment->paid_percentage = getPercentage($payment->paid_amount, $amount_needed);

              }
              else{
              
              $paid_amount         =  round($amount_needed);
              $discount_percentage = getPercentage($paid_amount,$total_amount);
              $discount_value      = calculatePercentage($discount_amount,$discount_percentage); 
              
              $payment->paid_amount = $this->remaining_amount;
              $payment->balance     = $payment->amount - $payment->paid_amount;
              $payment->discount    = $discount_value;
              $payment->paid_percentage = getPercentage($payment->paid_amount, $paid_amount);

              }
              
            }
   
          }
           $this->updateRemainingAmount($payment);

           $payment->received_on         = currentDateTime();
           $payment->payment_received_by = Auth::user()->id;
           $payment->feepayment_id       = $feepayment_id;
           // if($payment->is_schedule) {
           //    $this->updateScheduleRecord($payment);
           // }


          $payment->save();
        
      }

    }
    // if($percentage){
    //   echo $this->remaining_amount;
    //   dd($payment_records);
    // }
    return 1;
  }

  public function isPaymentCompleted($payment)
  {
    $amount_paid = FeeParticularPayment::where('feecategory_id', '=', $payment->feecategory_id)
                                          ->where('feeparticular_id', '=', $payment->feeparticular_id)
                                          ->where('feeschedule_particular_id', '=', $payment->feeschedule_particular_id)
                                          ->where('feeschedule_id','=',$payment->feeschedule_id)
                                          ->where('student_id','=',$payment->student_id)
                                          ->sum('paid_amount');
    $total_amount = FeeParticularPayment::where('feecategory_id', '=', $payment->feecategory_id)
                                          ->where('feeparticular_id', '=', $payment->feeparticular_id)
                                          ->where('feeschedule_particular_id', '=', $payment->feeschedule_particular_id)
                                          ->where('feeschedule_id','=',$payment->feeschedule_id)
                                          ->where('student_id','=',$payment->student_id)
                                          ->sum('amount');
    // echo 'Paid: '.$amount_paid;
    
    // dd($amount_paid);
    // if($amount_paid >= $total_amount)
    //   return 1;
    // return 0;
    return $total_amount - $amount_paid;
  }

  public function getNewPaymentRecord($payment)
  {
      $newPaymentRecord               = new FeeParticularPayment();
      $newPaymentRecord->amount       = 0;
      $newPaymentRecord->paid_amount  = 0;
      $newPaymentRecord->balance      = 0;
      $newPaymentRecord->net_balance  = 0;
      $newPaymentRecord->paid_percentage  = 0;
      $newPaymentRecord->feepayment_id    = $payment->feepayment_id;
      $newPaymentRecord->feecategory_id   = $payment->feecategory_id;
      $newPaymentRecord->feeparticular_id = $payment->feeparticular_id;
      $newPaymentRecord->feecategory_particular_id = $payment->feecategory_particular_id;
      $newPaymentRecord->is_schedule      = $payment->is_schedule;
      $newPaymentRecord->feeschedule_particular_id = $payment->feeschedule_particular_id;
      $newPaymentRecord->feeschedule_id   = $payment->feeschedule_id;
      $newPaymentRecord->term_number      = $payment->term_number;
      $newPaymentRecord->user_id          = $payment->user_id;
      $newPaymentRecord->student_id       = $payment->student_id;
      $newPaymentRecord->academic_id      = $payment->academic_id;
      $newPaymentRecord->course_parent_id = $payment->course_parent_id;
      $newPaymentRecord->course_id        = $payment->course_id;
      $newPaymentRecord->year             = $payment->year;
      $newPaymentRecord->semister         = $payment->semister;
      return $newPaymentRecord;

  }

  // public function updateScheduleRecord($payment)
  // {
  //   $schedule_record = FeeSchedulePayment::where('student_id','=',$payment->student_id)
  //                                          ->where('feeschedule_particular_id','=',$payment->feeschedule_particular_id)
  //                                          ->first();
  //   if(!$schedule_record)
  //     return;
  //   $schedule_record->feepayment_id       = $payment->feepayment_id;
  //   $schedule_record->payment_recevied_by = Auth::user()->id;
  //   $schedule_record->paid_amount         = $payment->paid_amount;
  //   $schedule_record->balance             = $payment->balance;
  //   $schedule_record->paid_percentage     = $payment->paid_percentage;
  //   $schedule_record->received_on         = currentDateTime();
  //     $schedule_record->save();

  // }

  public function updateRemainingAmount($payment)
  {
     $this->remaining_amount = round($this->remaining_amount) - round($payment->paid_amount);
  }


  public function getTotalPendingAmount($payment_records)
  {
    $sum = 0;
    foreach($payment_records as $payment)
      $sum += $payment->amount;
    return $sum;
  }


    
    /**
    This Method accept the Fee from the studnet for current schedule
    **/
	public function payFeeToParticular11(Request $request)
	{
        dd($request);

		 DB::beginTransaction();
         try{
           
           $feeCategory = FeeCategory::where('id','=',$request->feeCategories)->first();

          if($isValid = $this->isValidRecord($feeCategory))
               return redirect($isValid);

           $feeSchedule = FeeSchedules::where('id','=',$request->feeschedule_id)->first();
           
               if($isValid = $this->isValidRecord($feeSchedule))
                return redirect($isValid);

           $studentdata = App\Student::where('id','=',$request->student_id)->first();
               
                      if($isValid = $this->isValidRecord($studentdata))
                        return redirect($isValid);

           // dd($feeSchedule);
            // dd($feeCategory);

          $feePayment     = new FeePayment();
          $feePayment->transaction_id       = getHashCode();
          $feePayment->academic_id          = $request->academic_id;
          $feePayment->course_parent_id     = $request->course_parent_id;
          $feePayment->course_id            = $request->course_id;
          $feePayment->year                 = $request->year;
          $feePayment->semister             = $request->semister;
          $feePayment->feecategory_id       = $request->feeCategories;
          $feePayment->feecategory_title    = $feeCategory->title;
          $feePayment->feeschedule_id       = $request->feeschedule_id;
          $feePayment->feeschedule_name     = $feeSchedule->title;
          $feePayment->feeschedule_particular_id  = $request->feeschedule_praticular_id;
          $feePayment->student_id           = $request->student_id;
          $feePayment->user_id              = $studentdata->user_id;
          $feePayment->amount               = $feeCategory->total_fee + $feeCategory->other_amount;
          $feePayment->paid_amount          = $request->pay_amount;
          $feePayment->balance              = $feePayment->amount - $request->pay_amount;
          $feePayment->payment_mode         = $request->payment_mode;

          if($request->has('other_payment_mode')){
           
           $feePayment->payment_mode_name         = $request->other_payment_mode;

          }

          $feePayment->payment_recevied_by         = Auth::user()->id;
          $feePayment->save();


          $feePaymentTransaction        = new FeePaymentTransaction();
          $feePaymentTransaction->feepayment_id   =  $feePayment->id; 
          $feePaymentTransaction->receipt_no      =  1; 
          $feePaymentTransaction->amount          =  $feeCategory->total_fee + $feeCategory->other_amount;
          $feePaymentTransaction->paid_amount     = $request->pay_amount;
          $feePaymentTransaction->transaction_no  = getHashCode();
          $feePaymentTransaction->payment_mode    = $request->payment_mode;

          if($request->has('other_payment_mode')){
           
           $feePaymentTransaction->payment_mode_name         = $request->other_payment_mode;

          } 

          $feePaymentTransaction->payment_refrenceno  = 1;
          $feePaymentTransaction->payment_recevied_by = Auth::user()->id;
          $feePaymentTransaction->save();
         



        $schedule_payment =  FeeSchedulePayment::where('feecategory_id','=',$request->feeCategories)
                                            ->where('feeschedule_id','=',$request->feeschedule_id)
                                            ->where('feeschedule_particular_id','=',$request->feeschedule_praticular_id)
                                            ->where('student_id','=',$request->student_id)
                                            ->where('academic_id','=',$request->academic_id)
                                            ->where('course_parent_id','=',$request->course_parent_id)
                                            ->where('course_id','=',$request->course_id)
                                            ->where('year','=',$request->year)
                                            ->where('semister','=',$request->semister)
                                            ->first();

          $total_balnce  = $schedule_payment->getBalance($request);
          // dd($total_balnce);
          $bal = 0;
          foreach ($total_balnce as $balance)
           { 
              $bal += $balance->balance;
           }   

        $net_balnce_amount = ($schedule_payment->amount+$bal) - $request->pay_amount;
        $balance_amount    = $schedule_payment->amount - $request->pay_amount;
        $schedule_payment->paid_amount           = $request->pay_amount;
        $schedule_payment->balance               = $request->balance_amount;
        $schedule_payment->net_balance           = $net_balnce_amount;
        $schedule_payment->feepayment_id         = $feePayment->id;
        $schedule_payment->payement_recevied_by  = Auth::user()->id;
        $schedule_payment->save();


         $particular_payment = FeeParticularPayment::where('feecategory_id','=',$request->feeCategories)
                                            ->where('feeschedule_id','=',$request->feeschedule_id)
                                            ->where('feeschedule_particular_id','=',$request->feeschedule_praticular_id)
                                            ->where('student_id','=',$request->student_id)
                                            ->where('is_schedule','=',1)
                                            ->where('academic_id','=',$request->academic_id)
                                            ->where('course_parent_id','=',$request->course_parent_id)
                                            ->where('course_id','=',$request->course_id)
                                            ->where('year','=',$request->year)
                                            ->where('semister','=',$request->semister)
                                            ->get();
           $amount_to_pay = 0;
           foreach ($particular_payment as $data) {
                  
                  $amount_to_pay += $data->amount;                         
              }
              // dd($amount_to_pay);                              

         $non_particular_payment =  FeeParticularPayment::where('feecategory_id','=',$request->feeCategories)
                                            ->where('student_id','=',$request->student_id)
                                            ->where('is_schedule','=',0)
                                            ->where('academic_id','=',$request->academic_id)
                                            ->where('course_parent_id','=',$request->course_parent_id)
                                            ->where('course_id','=',$request->course_id)
                                            ->where('year','=',$request->year)
                                            ->where('semister','=',$request->semister)
                                            ->get();

                                             
             
             foreach ($non_particular_payment as $data) {
               
               if($data->amount <= $request->pay_amount){
                  
                  

               }


               $amount_to_pay  += $data->amount;
             }
            
            dd(floor($amount_to_pay));   

        DB::commit();
        flash('success','fee_paid_successfully','success');
        return redirect(URL_FEE_ACCEPT);

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
     * This method will checks if the record is valid
     * @param  [type]  $record [description]
     * @return boolean         [description]
     */
    public function isValidRecord($record)
    {
      if ($record === null) {

        flash('Ooops...!', getPhrase("page_not_found"), 'error');
        return $this->getRedirectUrl();
    }

    return FALSE;
    }

    /**
     * This method will send the default URL to send the user to back
     * @return [type] [description]
     */
    public function getReturnUrl()
    {
      return URL_FEE_ACCEPT;
    }

    public function generateReceipt($transaction_id)
    {
      
      $payment_record = FeePayment::where('transaction_id','=', $transaction_id)->first();

      if(!$payment_record)
        return back();

      $data['payment_record'] = $payment_record;
      $data['student_record'] = App\Student::where('id','=',$payment_record->student_id)->first();

       return view('fee.payfee.fee-receipt', $data);

    }

      /**
     * Common method to handle payment failed records
     * @return [type] [description]
     */
    protected function paymentFailed()
    {

      $params = explode('?token=',$_SERVER['REQUEST_URI']) ;
    
     if(!count($params))
      return FALSE;
    
      $slug = $params[1];
      $payment_record = FeePaymentsOnline::where('slug', '=', $slug)->first();
     
      if(!$this->processPaymentRecord($payment_record))
      {
        return FALSE;
      }
  
    $payment_record->payment_status = PAYMENT_STATUS_CANCELLED;
    $payment_record->save();
      
      return TRUE;
       
    }

     /**
     * This method Process the payment record by validating through 
     * the payment status and the age of the record and returns boolen value
     * @param  Payment $payment_record [description]
     * @return [type]                  [description]
     */
    protected  function processPaymentRecord(FeePaymentsOnline $payment_record)
    {
      if(!$this->isValidPaymentRecord($payment_record))
      {
        flash('Oops','invalid_record', 'error');
        return FALSE;
      }

      if($this->isExpired($payment_record))
      {
        flash('Oops','time_out', 'error');
        return FALSE;
      }

      return TRUE;
    }


    /**
     * This method validates the FeePaymentsOnline record before update the FeePaymentsOnline status
     * @param  [type]  $payment_record [description]
     * @return boolean                 [description]
     */
    protected function isValidPaymentRecord(FeePaymentsOnline $payment_record)
    {
      $valid = FALSE;
      if($payment_record)
      {
        if($payment_record->payment_status == PAYMENT_STATUS_PENDING || $payment_record->payment_gateway=='offline')
          $valid = TRUE;
      }
      return $valid;
    }

     /**
     * This method checks the age of the FeePaymentsOnline record
     * If the age is > than MAX TIME SPECIFIED (30 MINS), it will update the record to aborted state
     * @param  FeePaymentsOnline $payment_record [description]
     * @return boolean                 [description]
     */
    protected function isExpired(FeePaymentsOnline $payment_record)
    {

      $is_expired = FALSE;
      $to_time = strtotime(Carbon\Carbon::now());
    $from_time = strtotime($payment_record->updated_at);
    $difference_time = round(abs($to_time - $from_time) / 60,2);

    if($difference_time > PAYMENT_RECORD_MAXTIME)
    {
      $payment_record->payment_status = PAYMENT_STATUS_CANCELLED;
      $payment_record->save();
      return $is_expired =  TRUE;
    }
    return $is_expired;
    }


    /**
     * Common method to handle success payments and updates in feepaymets_online 
     table and insert a new record in feepayments table after that update
     the records in feeparticular_paymets table
     * @return [type] [description]
     */
    protected function paymentSuccess(Request $request)
    {

      $params = explode('?token=',$_SERVER['REQUEST_URI']) ;
    
     if(!count($params))
      return FALSE;
    
      $slug = $params[1];

      $payment_record = FeePaymentsOnline::where('slug', '=', $slug)->first();

      if($this->processPaymentRecord($payment_record))
      {
        $payment_record->payment_status = PAYMENT_STATUS_SUCCESS;
        $payment_record->save();
        $my_paymentlug   = $payment_record->slug;

        $user_id          = $payment_record->user_id;
        $studentdata      = Student::where('user_id','=',$user_id)->first();
        $student_id       = $studentdata->id;
        $category_id      = $payment_record->feecategory_id;
        $paid_amount      = $payment_record->paid_amount;
        $discount_amount  = 0;
        $payment_mode_name   = $payment_record->payment_gateway;
      
       
        if($payment_record->payment_gateway=='payu' || $payment_record->payment_gateway=='paypal' ){
          $payment_mode     = 'online';
        }
        else{
          $payment_mode     = 'offline';
        }
        $notes            = $payment_record->notes;

        $total_amount     = $paid_amount+$discount_amount;//afterdiscount amount + discount amount
        // dd($total_amount);

        $this->remaining_amount = $paid_amount;
        $this->paid_percentage  = 100;
        $other_payments   = [];
        $schedule_payments= [];
        $feepayment = null;
         //Get information
        $payment_details = (object)FeeParticularPayment::getFeePaymentParticulars($student_id, $category_id);

        //Access the last record in the payment details which contains all payments need to be paid
        $payment_records = (object)end($payment_details->payment_details);
        $payment_records = $payment_records->payment_record;
        // dd($payment_records);
        
        foreach ($payment_records as $record) {
          if($record->is_schedule)
            $schedule_payments[] = $record;
          else
            $other_payments[] = $record;
        }

        //Access The Previous Unpaid Fee particulars
        if($payment_details->previous_particulars!=null){
        $previous_fee_particulars = $payment_details->previous_particulars;  
        foreach ($previous_fee_particulars as $mydata) {
          $previous_fee[]  = $mydata;
        }
      }
        // $feepayment_id = 0;
         DB::beginTransaction();
        try{

          $feepayment = $this->insertFeePaymentRecord($student_id, $category_id, $paid_amount,$payment_mode,$notes,$discount_amount, $my_paymentlug,$payment_mode_name);
          $feepayment_id = $feepayment->id;
          if($payment_details->previous_particulars!=null){
          $this->updatePaymentRecords($previous_fee, $feepayment_id,$total_amount,$discount_amount);
          }//previous fee

          $this->updatePaymentRecords($other_payments, $feepayment_id,$total_amount,$discount_amount);//current non-term fee
          $this->updatePaymentRecords($schedule_payments, $feepayment_id,$total_amount,$discount_amount);// current term-fee
          
          DB::commit();
          

          }
        catch(Exception $ex)
        {
          DB::rollBack();
          // dd($ex->getMessage());
           if(getSetting('show_foreign_key_constraint','module'))
           {

              flash('oops...!',$ex->getMessage(), 'error');
           }
           else {
            flash('oops...!',$ex->getMessage(), 'error');
              // flash('oops...!','improper_data', 'error');
            }
          return back();
        }
       

       
        if($payment_record->payment_gateway=='paypal') {
          $payment_record->paid_amount    = $request->mc_gross;
          $payment_record->transaction_id = $request->txn_id;
          $payment_record->paid_by        = $request->payer_email;
        }

        //Capcture all the response from the payment.
        //In case want to view total details, we can fetch this record
        $payment_record->transaction_record = json_encode($request->request->all());
        
        $payment_record->save();

       


        return TRUE;
      }
      return FALSE;
    }
  
  /**
  This method insert the record in feepayments_online table
  if the selected payment gateway is offline payment gateway
  **/
   public function offlinePayment(Request $request)
   {
     $data              = json_decode($request->payment_data);
     $payment_details   = $request->payment_details;
    
    $record  = new FeePaymentsOnline();
    $record->slug            = $record->makeSlug(getHashCode());
    $record->user_id         = $data->user_id;
    $record->feecategory_id  = $data->current_feecategory_id;
    $record->plan_type       = 'fee';
    $record->payment_gateway = $data->gateway;
    $record->paid_by         = $data->user_id;
    $record->paid_amount     = $data->amount_to_pay;
    $record->payment_status  = PAYMENT_STATUS_PENDING;
    $record->other_details   = $payment_details;

    $record->save();

    flash('success', 'your_request_was_submitted_to_admin', 'success');          
    return redirect(PREFIX);
   }

   /**
   This method view the all offline feepayments records
   form feepayments_online table where their status is pending
   **/
   public function adminOfflineFeePayment()
   {
     if(!checkRole(getUserGrade(17)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $data['active_class']       = 'fee';
        $data['sub_active_class']   = 'fee_payoffline';
        $data['layout']             = getLayout();
        $data['title']              = getPhrase('offline_fee_payments');
        return view('fee.payments.offline-payments-list', $data);
   }

   /**
   This method get all records from the offlinepaymets_online table
   where status is pending
   **/
   public function getOfflientPaymetnsList()
   {
     if(!checkRole(getUserGrade(17)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $records = array();
 
             

            $records = FeePaymentsOnline::select(['id','slug','feecategory_id','user_id','paid_amount','other_details','payment_status','created_at'])
            ->where('payment_gateway','=','offline')
            ->where('payment_status','=','pending')
            ->orderBy('updated_at', 'desc');
             

        return Datatables::of($records)
        ->addColumn('action', function ($records) {
         
          $link_data = '<div>
                       <button class="btn btn-primary btn-sm" onclick="viewFeePaymentDetails('.$records->id.');">'.getPhrase('view_details').'</button></div>';

            return $link_data;
            })
        ->editColumn('feecategory_id', function($records)
        {
            $title   = FeeCategory::where('id','=',$records->feecategory_id)->first()->title;
            return '<strong>'.$title.'</strong>';
        })
          ->editColumn('user_id', function($records)
        {
            $user_data = User::where('id','=',$records->user_id)->first();
            $student_data  = Student::where('user_id','=',$user_data->id)->first();
            return '<p>'.getPhrase('name : ').'<strong>'.$user_data->username.'</strong>
            </p><p>'.getPhrase('roll_no : ').'<strong>'.$student_data->roll_no.'</strong>';
        })

        ->editColumn('payment_status', function($records)
        {
            if($records->payment_status=='pending'){
                return $rec = '<span class="label label-danger">'.getPhrase('pending').'</span>';
            }
           
        })

         ->editColumn('paid_amount', function($records)
        {
           $currency  = getCurrencyCode();
           return  $currency.' '.round($records->paid_amount);
           
        })
        
        
        
        ->removeColumn('id')
        ->removeColumn('slug')
        ->make();
   }



   public function getOfflinePaymentRecord(Request $request)
   { 
      $finaldata = [];
     $payment_id     = $request->record_id;
     $record         = FeePaymentsOnline::where('id','=',$payment_id)->first();
     $feecat_title   = FeeCategory::where('id','=',$record->feecategory_id)->first()->title;
     $user_data      = User::where('id','=',$record->user_id)->first();
     
     $finaldata['paymetn_record'] = $record;
     $finaldata['title'] = $feecat_title;
     $finaldata['user']  = $user_data;
     return $finaldata;

   }

   public function approveOfflinePaymentRecord(Request $request)
   {
     // dd($request);
     $approve_status = $request->submit;
     $admin_comment  = $request->admin_comment;
     $payment_slug   = $request->payment_slug;
     $record  = FeePaymentsOnline::where('slug','=',$payment_slug)->first();
     $record->admin_comments = $admin_comment;
     if($approve_status == 'reject'){
        $record->payment_status = 'cancelled';
        $record->save();
        flash('success','payment_record_status_updated_successfully','success');
        return redirect(URL_FEE_REPORTS_OFFLINE);
     }

     if($this->processPaymentRecord($record))
      {
        $record->payment_status = PAYMENT_STATUS_SUCCESS;
        $record->save();
        $my_paymentlug   = $record->slug;

        $user_id          = $record->user_id;
        $studentdata      = Student::where('user_id','=',$user_id)->first();
        $student_id       = $studentdata->id;
        $category_id      = $record->feecategory_id;
        $paid_amount      = $record->paid_amount;
        $discount_amount  = 0;
        $payment_mode_name = $record->payment_gateway;
        $payment_mode  = 'offline';
        $notes            = $record->notes;
      
        $total_amount     = $paid_amount+$discount_amount;//afterdiscount amount + discount amount
        // dd($total_amount);

        $this->remaining_amount = $paid_amount;
        $this->paid_percentage  = 100;
        $other_payments   = [];
        $schedule_payments= [];
        $feepayment = null;
         //Get information
        $payment_details = (object)FeeParticularPayment::getFeePaymentParticulars($student_id, $category_id);

        //Access the last record in the payment details which contains all payments need to be paid
        $payment_records = (object)end($payment_details->payment_details);
        $payment_records = $payment_records->payment_record;
        // dd($payment_records);
        
        foreach ($payment_records as $record) {
          if($record->is_schedule)
            $schedule_payments[] = $record;
          else
            $other_payments[] = $record;
        }

        //Access The Previous Unpaid Fee particulars
        if($payment_details->previous_particulars!=null){
        $previous_fee_particulars = $payment_details->previous_particulars;  
        foreach ($previous_fee_particulars as $mydata) {
          $previous_fee[]  = $mydata;
        }
      }
        // $feepayment_id = 0;
         DB::beginTransaction();
        try{

          $feepayment = $this->insertFeePaymentRecord($student_id, $category_id, $paid_amount,$payment_mode,$notes,$discount_amount, $my_paymentlug,$payment_mode_name);
          $feepayment_id = $feepayment->id;
          if($payment_details->previous_particulars!=null){
          $this->updatePaymentRecords($previous_fee, $feepayment_id,$total_amount,$discount_amount);
          }//previous fee

          $this->updatePaymentRecords($other_payments, $feepayment_id,$total_amount,$discount_amount);//current non-term fee
          $this->updatePaymentRecords($schedule_payments, $feepayment_id,$total_amount,$discount_amount);// current term-fee
          
          DB::commit();
          

          }
        catch(Exception $ex)
        {
          DB::rollBack();
          // dd($ex->getMessage());
           if(getSetting('show_foreign_key_constraint','module'))
           {

              flash('oops...!',$ex->getMessage(), 'error');
           }
           else {
            flash('oops...!',$ex->getMessage(), 'error');
              // flash('oops...!','improper_data', 'error');
            }
          return back();
        }

     }
    
       flash('success','payment_record_status_updated_successfully','success');
        return redirect(URL_FEE_REPORTS_OFFLINE);

   }

}