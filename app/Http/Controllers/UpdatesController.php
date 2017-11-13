<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Schema;
use DB;
class UpdatesController extends Controller
{
     public function __construct()
    {
     
         $this->middleware('auth');
    
    }

    /**
     * This is the first patch which updates the currency code to
     * Site Settings module
     * This can be used by the existing users
     * To access this method, user need to type the following url
     * http://sitename/updates/patch1
     * @return [type] [description]
     */
    public function patch1()
    {

      if(!checkRole(getUserGrade(1)))
      {
        prepareBlockUserMessage();
        return back();
      }
     // For Bonafide Certificate
     
    	$bonafide        = App\Settings::where('slug', 'bonafide-settings')->first();
    	 
    	$uptained_data = (array) json_decode($bonafide->settings_data);
        
       unset($uptained_data['orientation'],$uptained_data['margin'],$uptained_data['format'],$uptained_data['printable_file']);

       $changed_data =  $uptained_data;

       $bonafide->settings_data = json_encode($changed_data);
     
       $bonafide->save();
       
       //For Id Card
      
       $idcard        = App\Settings::where('slug', 'id-card-settings')->first();
       
       $idcard_setting_data = (array) json_decode($idcard->settings_data);
        
       unset($idcard_setting_data['orientation'],$idcard_setting_data['margin'],$idcard_setting_data['format'],$idcard_setting_data['printable_file']);

       $final_id_data =  $idcard_setting_data;

       $idcard->settings_data = json_encode($final_id_data);
     
       $idcard->save();

       //For Transfer Certificate

        $tc_data        = App\Settings::where('slug', 'transfer-certificate-settings')->first();

       
       $tc_setting_data = (array) json_decode($tc_data->settings_data);
        
       unset($tc_setting_data['orientation'],$tc_setting_data['margin'],$tc_setting_data['format'],$tc_setting_data['printable_file']);

       $final_tc_data =  $tc_setting_data;

       $tc_data->settings_data = json_encode($tc_setting_data);
     
       $tc_data->save();

       //For Timetable
       
       $timetable_data  = App\Settings::where('slug', 'timetable-settings')->first();
       if($timetable_data!=''){
       $timetable_data->delete();
       }


       flash('success','system_upgraded_successfully', 'success');
       return redirect(URL_MASTERSETTINGS_SETTINGS);
    }


    public function patch2()
    {
       DB::beginTransaction();
      try{
           Schema::connection('mysql')->create('test_vishnu', function($table)
          {   
         
             $incremrnt = false;
             $unsigned = true;
           

            $table->bigIncrements('id',20);
            $table->string('title',255)->nullable(false);
            $table->string('slug',255)->nullable(false);
            $table->text('description')->nullable(false);
            $table->tinyInteger('status')->default('1');
            $table->bigInteger('academic_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('course_parent_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('course_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->integer('year')->default('1');
            $table->integer('semister')->default('0');
            $table->decimal('total_fee',10,2)->unsigned()->default(0);
            $table->integer('total_installments')->default(1);
            $table->decimal('installment_amount',10,2)->unsigned()->default(0);
            $table->decimal('other_amount',10,2)->unsigned()->default(0);
            $table->timestamp('created_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->index('academic_id');
            $table->index('course_parent_id');
            $table->index('course_id');
            $table->foreign('academic_id')->references('id')->on('academics');
            $table->foreign('course_id')->references('id')->on('courses');
             
           
       
       });


         Schema::connection('mysql')->create('test_vishnu1', function($table)
          {   
         
             $incremrnt = false;
             $unsigned = true;
           

            $table->bigIncrements('id',20);
            $table->string('title',255)->nullable(false);
            $table->string('slug',255)->nullable(false);
            $table->text('description')->nullable(false);
            $table->tinyInteger('status')->default('1');
            $table->tinyInteger('is_income')->default('1');
            $table->timestamp('created_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
             
       });   


       Schema::connection('mysql')->create('test_vishnu2', function($table)
          {   
         
             $incremrnt = false;
             $unsigned = true;
           

            $table->bigIncrements('id',20);
            $table->bigInteger('feecategory_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('particular_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->decimal('amount',10,2)->unsigned()->default(0);
            $table->tinyInteger('is_refundable')->default('1');
            $table->tinyInteger('is_term_applicable')->default('1');
            $table->timestamp('created_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->index('feecategory_id');
            $table->index('particular_id');
            $table->foreign('feecategory_id')->references('id')->on('feecategories');
            $table->foreign('particular_id')->references('id')->on('particulars');
             
       }); 


       //  Schema::connection('mysql')->create('fee_mypayments7', function($table)
       //    {   
         
       //       $incremrnt = false;
       //       $unsigned = true;
           

       //      $table->bigIncrements('id',20);
       //      $table->string('transaction_id',255)->nullable(false);
       //      $table->bigInteger('academic_id',$incremrnt,$unsigned,20)->nullable(false);
       //      $table->bigInteger('course_parent_id',$incremrnt,$unsigned,20)->nullable(false);
       //      $table->bigInteger('course_id',$incremrnt,$unsigned,20)->nullable(false);
       //      $table->integer('year')->default('1');
       //      $table->integer('semister')->default('0');
       //      $table->bigInteger('feecategory_id',$incremrnt,$unsigned,20)->nullable(false);
       //      $table->string('feecategory_title',255)->nullable(false);
       //      $table->bigInteger('student_id',$incremrnt,$unsigned,20)->nullable(false);
       //      $table->bigInteger('user_id',$incremrnt,$unsigned,20)->nullable(false);
       //      $table->bigInteger('payment_recevied_by',$incremrnt,$unsigned,20)->nullable(false);
       //      $table->tinyInteger('iseligible_for_discount')->default('1');
       //      $table->decimal('amount',10,2)->unsigned()->default(0);
       //      $table->decimal('balance',10,2)->unsigned()->default(0);
       //      $table->decimal('paid_amount',10,2)->unsigned()->default(0);
       //      $table->enum('payment_mode', array('cash', 'online', 'cheque', 'DD','other'))->default('cash');
       //      $table->string('payment_mode_name',255)->nullable();
       //      $table->integer('payment_refrenceno',50)->nullable(false);
       //      $table->text('payment_notes')->nullable();
       //      $table->tinyInteger('payment_status')->default('1');
       //      $table->tinyInteger('any_extra_particular_added')->default('0');
       //      $table->tinyInteger('any_extra_discount_added')->default('0');
       //      $table->tinyInteger('will_referto_other')->default('0');
       //      $table->timestamp('last_updated')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
       //      $table->timestamp('created_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
       //      $table->timestamp('updated_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
       //      $table->index('feecategory_id');
       //      $table->index('academic_id');
       //      $table->index('course_id');
       //      $table->index('student_id');
       //      $table->index('user_id');
       //      $table->index('payment_recevied_by');
       //      $table->foreign('feecategory_id')->references('id')->on('feecategories');
       //      $table->foreign('academic_id')->references('id')->on('academics');
       //      $table->foreign('course_id')->references('id')->on('courses');
       //      $table->foreign('student_id')->references('id')->on('students');
       //      $table->foreign('user_id')->references('id')->on('users');
       //      $table->foreign('payment_recevied_by')->references('id')->on('users');
             
       // });         


       Schema::connection('mysql')->create('test_vishnu3', function($table)
          {   
         
             $incremrnt = false;
             $unsigned = true;
           

            $table->bigIncrements('id',20);
            $table->bigInteger('feecategory_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->integer('total_installments')->default(1);
            $table->timestamp('created_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->index('feecategory_id');
            $table->foreign('feecategory_id')->references('id')->on('feecategories');
             
       });


            Schema::connection('mysql')->create('test_vishnu4', function($table)
          {   
         
             $incremrnt = false;
             $unsigned = true;
           

            $table->bigIncrements('id',20);
            $table->bigInteger('feecategory_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('feeschedule_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->integer('installment')->default(1);
            $table->integer('total_installments')->default(1);
            $table->text('start_date')->nullable(false);
            $table->text('end_date')->nullable(false);
            $table->timestamp('created_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->index('feecategory_id');
            $table->index('feeschedule_id');
            $table->foreign('feecategory_id')->references('id')->on('feecategories');
            $table->foreign('feeschedule_id')->references('id')->on('feeschedules');
             
       });


            Schema::connection('mysql')->create('test_vishnu5', function($table)
          {   
         
             $incremrnt = false;
             $unsigned = true;
           

            $table->bigIncrements('id',20);
            $table->bigInteger('feepayment_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('feecategory_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('feeschedule_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('feeschedule_particular_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('student_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('user_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('payment_recevied_by',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('academic_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('course_parent_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('course_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->integer('year')->default('1');
            $table->integer('semister')->default('0');
            $table->decimal('amount',10,2);
            $table->decimal('paid_amount',10,2)->unsigned()->default(0);
            $table->decimal('balance',10,2)->unsigned()->default(0);
            $table->decimal('net_balance',10,2)->unsigned()->default(0);
            $table->decimal('paid_percentage',10,2)->unsigned()->default(0);
            $table->integer('term_number')->nullable(false);
            $table->timestamp('received_on')->nullable(false);
            $table->timestamp('created_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->index('feepayment_id');
            $table->index('feecategory_id');
            $table->index('feeschedule_id');
            $table->index('feeschedule_particular_id');
            $table->index('student_id');
            $table->index('user_id');
            $table->index('payment_recevied_by');
            $table->index('academic_id');
            $table->index('course_id');
            // $table->foreign('feepayment_id')->references('id')->on('feepayments');
            $table->foreign('feecategory_id')->references('id')->on('feecategories');
            $table->foreign('feeschedule_id')->references('id')->on('feeschedules');
            $table->foreign('feeschedule_particular_id')->references('id')->on('feeschedule_particulars');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('payment_recevied_by')->references('id')->on('users');
            $table->foreign('academic_id')->references('id')->on('academics');
            $table->foreign('course_id')->references('id')->on('courses');
             
       });


            Schema::connection('mysql')->create('test_vishnu6', function($table)
          {   
         
             $incremrnt = false;
             $unsigned = true;
           

            $table->bigIncrements('id',20);
            $table->bigInteger('feepayment_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('feecategory_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('feeparticular_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('feecategory_particular_id',$incremrnt,$unsigned,20)->nullable();
            $table->bigInteger('feeschedule_id',$incremrnt,$unsigned,20)->nullable();
            $table->bigInteger('feeschedule_particular_id',$incremrnt,$unsigned,20)->nullable();
            $table->tinyInteger('is_schedule')->default('0');
            $table->bigInteger('student_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('user_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('payment_recevied_by',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('academic_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('course_parent_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->bigInteger('course_id',$incremrnt,$unsigned,20)->nullable(false);
            $table->integer('year')->default('1');
            $table->integer('semister')->default('0');
            $table->decimal('amount',10,2);
            $table->decimal('paid_amount',10,2)->unsigned()->default(0);
            $table->decimal('balance',10,2)->unsigned()->default(0);
            $table->decimal('net_balance',10,2)->unsigned()->default(0);
            $table->decimal('paid_percentage',10,2)->unsigned()->default(0);
            $table->integer('term_number')->nullable();
            $table->text('notes')->nullable();
            $table->text('comments')->nullable();
            $table->timestamp('received_on')->nullable(false);
            $table->timestamp('created_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->index('feepayment_id');
            $table->index('feecategory_id');
            $table->index('feeschedule_id');
            $table->index('feeschedule_particular_id');
            $table->index('student_id');
            $table->index('user_id');
            $table->index('payment_recevied_by');
            $table->index('academic_id');
            $table->index('course_id');
            // $table->foreign('feepayment_id')->references('id')->on('feepayments');
            $table->foreign('feecategory_id')->references('id')->on('feecategories');
            $table->foreign('feeschedule_id')->references('id')->on('feeschedules');
            $table->foreign('feeschedule_particular_id')->references('id')->on('feeschedule_particulars');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('payment_recevied_by')->references('id')->on('users');
            $table->foreign('academic_id')->references('id')->on('academics');
            $table->foreign('course_id')->references('id')->on('courses');
             
       });

           DB::commit();
           flash('success','system_upgraded_successfully', 'success');
     }
      catch(Exception $ex)
      {
           DB::rollBack();
           flash('oops...!',$e->errorInfo, 'error');
          
      }   
      
      return redirect(URL_MASTERSETTINGS_SETTINGS); 
     

    }
}
