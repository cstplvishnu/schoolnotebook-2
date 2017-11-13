<?php

namespace App;
use App\User;
use App\Staff;
use App\GeneralSettings;
use Illuminate\Database\Eloquent\Model;
use DB;
class Student extends Model
{

    

    protected $table = 'students';
    
    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * This method is used to generate the student ID
     * @param  [type] $userid [description]
     * @return [type]         [description]
     */
    public function prepareStudentID($userid)
    {
        $settings = new GeneralSettings();

        $count = $this->getStudentCount();

        $length = $settings->getAdmissionNoLength();
        $user_id = $userid.$length;


        if(strlen($count) < $length)
        {
            $user_id = $userid. makeNumber($count, $length);
        }

        return $settings->getStudentIDPrefix().$userid;
    }


    public function prepareRollNo($userid, $academic_id, $course_parent_id, $course_id, $current_year, $current_semister,$student_belongsto=null)
    {
        $studentSettings    = new StudentSettings();
        $settings           = (object) $studentSettings->getSettings();
        $length             = $settings->roll_no_length;
        $academic_record        = Academic::where('id','=',$academic_id)->first();
        $course_parent_record   = Course::where('id','=',$course_parent_id)->first();
        $course_record          = Course::where('id','=',$course_id)->first();
        
        $year                   = date('y', strtotime($academic_record->academic_start_date)); 

        $parent_course_code     = $course_parent_record->course_code;
        
        $course_code            = $course_record->course_code;
        $serial_no              = makeNumber($this->getStudentSerialNo($academic_id,$course_parent_id, $course_id, $current_year, $current_semister, $length)+1, $length);

        $system_mode    = getSetting('education_system_in_spring_and_fall_mode','site_settings');

        if($system_mode=='yes'){

        $roll_no = $year.$student_belongsto.$parent_course_code.$course_code.$serial_no; 
        
        }

        else{
         
         $roll_no = $year.$parent_course_code.$course_code.$serial_no;
           
        }
        return  $roll_no;
        

    }

    public function getStudentCount()
    {
        return Student::all()->count();
    }

    public function getStudentSerialNo($academic_id, $course_parent_id,$course_id, $current_year, $current_semister, $length = 4)
    {
       $record = DB::table('students')->select([DB::raw('max(RIGHT(roll_no,'.$length.')) as roll_no')])
                                        ->where('academic_id' , '=', $academic_id)
                                        ->where('course_parent_id' , '=', $course_parent_id)
                                        ->where('course_id', '=', $course_id)   
                                        ->first();
         $count = 0;
         if(isset($record->roll_no)){               
             if($record->roll_no)
        $count = (int)$record->roll_no;
         } 


        return $count;


    }

    /**
     * this method returns the student list it is not necessary course_parent_id
     */

    public function getStudents($academic_id,  $course_id, $year, $semester)
    {
        return Student::where('academic_id', '=', $academic_id)
                        ->where('course_id', '=', $course_id)
                        ->where('current_year', '=', $year)
                        ->where('current_semister', '=', $semester)
                        ->get();
    }

    public function getStudentslist($academic_id,$course_parent_id,  $course_id, $year, $semister)
    {
        return Student::where('academic_id', '=', $academic_id)
                        ->where('course_parent_id', '=', $course_parent_id)
                        ->where('course_id', '=', $course_id)
                        ->where('current_year', '=', $year)
                        ->where('current_semister', '=', $semister)
                        ->get();
    }


    public function getStudentRecordWithRollNo($roll_no)
    {
        return Student::where('roll_no', '=', $roll_no)->first();
    }

    public function getTotalAmount($feecat_id,$student_id)
    {
       return $amount = FeeParticularPayment::where('feecategory_id','=',$feecat_id)
                                            ->where('student_id','=',$student_id)
                                            ->where('carry_forward','=',1)
                                            ->sum('amount');             
    }

    public function getTotalDiscount($feecat_id,$student_id)
    {
        $amount = FeeParticularPayment::where('feecategory_id','=',$feecat_id)
                                            ->where('student_id','=',$student_id)
                                            ->where('carry_forward','=',1)
                                            ->sum('discount');

         $previous_amount = FeeParticularPayment::where('previous_feecategory_id','=',$feecat_id)
                                            ->where('student_id','=',$student_id)
                                            ->where('carry_forward','=',0)
                                            ->sum('discount');
         if(count($previous_amount)){
            
           $amount1 =  $previous_amount;
         }
         else{
           $amount1 =  0;
         }                                                                         
                  
          return round($amount+$amount1);                                      
    }


    public function getTotalPaidAmount($feecat_id,$student_id)
    {
         $amount = FeeParticularPayment::where('feecategory_id','=',$feecat_id)
                                            ->where('student_id','=',$student_id)
                                            ->where('carry_forward','=',1)
                                            ->sum('paid_amount');

         $previous_amount = FeeParticularPayment::where('previous_feecategory_id','=',$feecat_id)
                                            ->where('student_id','=',$student_id)
                                            ->where('carry_forward','=',0)
                                            ->sum('paid_amount');
         if(count($previous_amount)){
            
           $amount1 =  $previous_amount;
         }
         else{
           $amount1 =  0;
         }                                                                         
                  
          return round($amount+$amount1);                                  
    }

    public function getTotalBalance($feecat_id,$student_id)
    {
        return $amount = FeeParticularPayment::where('feecategory_id','=',$feecat_id)
                                            ->where('student_id','=',$student_id)
                                            ->where('carry_forward','=',1)
                                            ->sum('balance');
                                           
    }

    public function getName()
    {
        return ucfirst($this->first_name).' '.ucfirst($this->middle_name).' '.ucfirst($this->last_name);
    }

    public function getFatherName()
    {
        return ucfirst($this->fathers_name);
    }
    public function getPhoneNo()
    {
        return $this->mobile;
    }
    

}
