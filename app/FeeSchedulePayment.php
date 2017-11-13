<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class FeeSchedulePayment extends Model
{
    protected $table = 'feeschedule_payments';

     /**
     This Method return student  total balance amount for the previous feeschedules.
     **/
    public function getBalance($request)
    { 
        
        return $this::where('feecategory_id','=',$request->feeCategories)
                        ->where('feeschedule_id','=',$request->feeschedule_id)
                        ->where('student_id','=',$request->student_id)
                        ->where('academic_id','=',$request->academic_id)
                        ->where('course_parent_id','=',$request->course_parent_id)
                        ->where('course_id','=',$request->course_id)
                        ->where('year','=',$request->year)
                        ->where('semister','=',$request->semister)
                        ->where('term_number','=',($request->term_number-1))
                        ->select('balance')
                        ->get();	
    }

}