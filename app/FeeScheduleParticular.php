<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class FeeScheduleParticular extends Model
{
    protected $table = 'feeschedule_particulars';

    /**
    This Method return the schedules of selected
    feecategory id and student id
    **/
    public static function getStudentSchedules($feecat_id,$student_id)
    {
    	
    	return FeeScheduleParticular::join('feeschedule_payments','feeschedule_payments.feeschedule_particular_id','=','feeschedule_particulars.id')
    	                             ->where('feeschedule_particulars.feecategory_id','=',$feecat_id)
    	                             ->where('feeschedule_payments.student_id','=',$student_id)
    	                             ->get();

    }

    /**
     This Method return all fee categories available for
     student id
     **/
     public static function getAllCategories($student_id)
     {

   return FeeScheduleParticular::join('feeschedule_payments','feeschedule_payments.feeschedule_particular_id','=','feeschedule_particulars.id')
                                 ->join('feecategories','feecategories.id','=','feeschedule_particulars.feecategory_id')
                                 ->where('feeschedule_payments.student_id','=',$student_id)
                                 ->groupby('feeschedule_particulars.feecategory_id')
                                 ->get();
         
     }
    
    

}