<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Charts;
class FeeCategory extends Model
{
    protected $table = 'feecategories';



     /**
     * Get the list of fee categories related to this course
     * @return [type] [return list of fee categories]
     */
    public function academicCourses()
    {
        // if($courseId)
        //     return DB::table('feecategories_academiccourses')->where('')
        return $this->belongsToMany('App\FeeCategory','feecategories_academiccourses');
    }

    /**
     *This fee category has many  Fee Particulars
     * @return [type] [description]
     */
     public function feeParticulars()
    {
    	return $this::join('feecategory_particulars','feecategory_particulars.feecategory_id','=','feecategories.id')
                            ->join('particulars','particulars.id', '=' ,'feecategory_particulars.particular_id')
                            ->where('feecategory_id','=',$this->id)
                            ->select('feecategory_particulars.id as feecategory_particular_id', 'particulars.title as title', 'feecategories.title as category_title', 'feecategory_id','particular_id  as id','amount','is_refundable','is_term_applicable');
        
    }

    

    /**
     * Inserts the Fee Category ID and Academic course ID to feecategories_academic course
     * @param [type] $feeCategoryId [description]
     * @param [type] $academicId    [description]
     */
    public function addFeeCategoryToAcademicCourse($feeCategoryId, $academicId)
    {

    	return DB::table('feecategories_academiccourses')->insert(
							    ['fee_category_id' 		=> $feeCategoryId,
							    'academic_course_id' 	=> $academicId
							    ]
							);

    }

    /**
     * returns the count of rows which have the sent categoryID and Academic ID 
     * It is used to check the specific availability of course and fee category before inserting
     * @param  [integer] $feeCategoryId [description]
     * @param  [integer] $academicId    [description]
     * @return [integer]                [description]
     */
    public function compareFeeCategoriesToAcademicCourse($feeCategoryId, $academicId)
    {
    	$recs = DB::table('feecategories_academiccourses')
    	->where('fee_category_id', '=', $feeCategoryId)
    	->where('academic_course_id', '=', $academicId)
    	->get();
    	return count($recs);
    }


     /**
     * returns the count of rows which have the sent categoryID and Academic ID 
     * It is used to check the specific availability of course and fee category before inserting
     * @param  [integer] $feeCategoryId [description]
     * @param  [integer] $academicId    [description]
     * @return [integer]                [description]
     */
    public function getFeeCategoryAcademicCourse($feeCategoryId)
    {
        $recs = DB::table('feecategories_academiccourses')
        ->where('fee_category_id', '=', $feeCategoryId)
        ->get();
        return $recs;
    }

    public function getFeeScheduledCourses($fee_scheduled_id, $academic_id, $course_parent_id)
    {
         $recs = DB::table('feeschedules_academiccourses')
        ->where('feeschedule_id', '=', $fee_scheduled_id)
        ->where('academic_id',  '=', $academic_id)
        ->where('course_parent_id',  '=', $course_parent_id)
        ->get();
        return $recs;
    }

   
    /**
     * This method will calculate and returns the graph data to the calling function 
     * @return [type] [description]
     */
    public function getOverallPayments($fee_cat_id)
    {
        $total = FeeCategory::getCategoryPayments($fee_cat_id,'amount');

        $paid = FeeCategory::getCategoryPayments($fee_cat_id,'paid_amount');
        // dd($paid);
        // $balance = FeeCategory::getCategoryPayments('balance');
    if($total!=0){
  
         $chart2 = Charts::create('progressbar', 'progressbarjs')
                                    ->title($this->title)
                                    ->values([$paid,0,$total])
                                    ->responsive(false)
                                    ->height(50)
                                    ->width(0);
        return $chart2->render();
     }
     else{
        $chart2 = Charts::create('progressbar', 'progressbarjs')
                                    ->title($this->title)
                                    ->responsive(false)
                                    ->height(50)
                                    ->width(0);
        return $chart2->render();
       }
    }

    public static function getCategoryPayments($fee_cat_id,$type='amount')
    {
        return round(FeeParticularPayment::getCategoryAmount($fee_cat_id,$type));
    }


     public static function getCategory($student)
     {
        // dd($student);
         $feecategories  = FeeParticularPayment::where('student_id','=',$student->id)
                                               ->groupBy('feecategory_id')
                                               ->get();

           if(count($feecategories)){
            foreach ($feecategories as $feecategory) {
                
                $latest_category   = $feecategory->feecategory_id;

            }
              $fee_category  = FeeCategory::where('id','=',$latest_category)->first();
              return $fee_category;
           }
           else{
            $fee_category  = null;
            return $fee_category;

            }


     }


     public static function getStudentLatestFeeCategory($student_id){
         
            $feecategories  = FeeParticularPayment::where('student_id','=',$student_id)
                                               ->groupBy('feecategory_id')
                                               ->get();

           if(count($feecategories)){
            foreach ($feecategories as $feecategory) {
                
                $latest_category   = $feecategory->feecategory_id;

            }

            return $latest_category;
           }
          
          return 0;
     }

     


}
