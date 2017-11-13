<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Timetable;
use App\Subject;
use App\StudentAttendance;
use App\StudentPromotion;
use App\Course;
use App\Academic;
use App\Student;
use Yajra\Datatables\Datatables;
use DB;
use \Auth;
use Exception;
class StudentListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     
     /**
      * This Method View student lisr according to the classwise
      * @return [type] [description]
      */
    public function index()
    {
        $data['active_class']       = 'academic';
        $data['active_class1']       = '';
        $data['sub_active_class']   = 'student_list';
        $data['title']              = getPhrase('student_list');
        
        $data['academic_years']     = addSelectToList(getAcademicYears());
        $list                       = App\Course::getCourses(0);
        
        $data['layout']             = getLayout();
        $data['module_helper']      = getModuleHelper('student-list');

      return view('student.list', $data); 
    }
     /**
      * This method print the student list according to classwise
      * @param  Request $request [description]
      * @return [type]           [description]
      */
     public function printStudentList(Request $request)
     {
        
        $academic_id        = $request->academic_id;
        $course_parent_id   = $request->course_parent_id;
        $course_id          = $request->course_id;
            $year        = 1;
            if($request->year){
              $year = $request->current_year;
            }
            $semister = 0;
            if($request->current_semister){ 
            $semister    = $request->current_semister;
          }
          
        $academic_details  =  App\Academic::where('id',$request->academic_id)->first();
        $course_details    =  App\Course::where('id',$request->course_id)->first();
        $records = User::join('students', 'users.id' ,'=', 'students.user_id')  
        ->join('academics','academics.id','=','students.academic_id') 
        ->join('courses','courses.id','=','students.course_id')
        ->where('academic_id','=',$academic_id)
        // ->where('course_parent_id','=',$course_parent_id)
        ->where('course_id','=',$course_id)
        ->where('current_year','=',$year)
        ->where('current_semister','=',$semister)
        ->select(['users.name','students.roll_no','courses.course_title','users.slug'])
        ->get();
         if($course_details->course_dueration>1 && $course_details->is_having_semister==1){
         $data['title']     = $academic_details->academic_year_title.' '.$course_details->course_title.' '.$year.' '.'year'.' '.$semister.' '.'semester '.' '.getPhrase('list');
         }
        elseif ($course_details->course_dueration>1 && $course_details->is_having_semister==0) {
         $data['title']     = $academic_details->academic_year_title.' '.$course_details->course_title.' '.$year.' '.'year'.' '.getPhrase('list');
        }
        else{
          $data['title']     = $academic_details->academic_year_title.' '.$course_details->course_title.' '.getPhrase('list');
        }
        $data['records']   = $records;
        $data['extracols']   = $request->extracols;

         $view     = \View::make('student.class-list-print-file',$data);
        $contents = $view->render();

        return $contents;
     }
    /**
     * This Method show the course completed list according to the
     * selection list
     * @return [type] [description]
     */
    public function courseCompltedStudentsList()
    {
        $data['active_class']       = 'academic';
        $data['sub_active_class']   = 'student_clist';
        $data['active_class1']       = '';
        $data['title']              = getPhrase('course_completed_student_list');
        
        $data['academic_years']     = addSelectToList(getAcademicYears());
        $list                       = App\Course::getCourses(0);
        
        $data['layout']             = getLayout();
        $data['module_helper']      = getModuleHelper('course-completed-student-list');

      return view('student.completed-list', $data); 
    }
    /**
     * This method print the course completed students list
     * @param Request $request [description]
     */
    public function printCourseCompltedStudentsList(Request $request)
    {   
        
        $academic_id        = $request->academic_id;
        $course_parent_id   = $request->parent_course_id;
        $course_id          = $request->course_id;
        $year        = 1;
            if($request->year){
              $year = $request->current_year;
            }
            $semister = 0;
            if($request->current_semister){ 
            $semister    = $request->current_semister;
          }
        $academic_details  =  App\Academic::where('id',$request->academic_id)->first();
        $course_details    =  App\Course::where('id',$request->course_id)->first();
        
         $records = StudentPromotion::join('users','users.id','=','studentpromotions.user_id')
            ->join('students','students.id','=','studentpromotions.student_id')
            ->join('courses','courses.id','=','students.course_id')
            ->where('from_academic_id','=',$academic_id)
            // ->where('from_course_parent_id','=',$course_parent_id)
            ->where('from_course_id','=',$course_id)
            ->where('from_year','=',$year)
            ->where('from_semister','=',$semister)
            ->where('type','=','completed')
            ->select(['users.name','students.roll_no','courses.course_title','users.slug'])
            ->get();
             if($course_details->course_dueration>1 && $course_details->is_having_semister==1){
         $data['title']     = $academic_details->academic_year_title.' '.$course_details->course_title.' '.$year.' '.'year'.' '.$semister.' '.'semester '.' '.getPhrase('course_completed_list');
         }
        elseif ($course_details->course_dueration>1 && $course_details->is_having_semister==0) {
         $data['title']     = $academic_details->academic_year_title.' '.$course_details->course_title.' '.$year.' '.'year'.' '.getPhrase('course_completed_list');
        }
        else{
          $data['title']     = $academic_details->academic_year_title.' '.$course_details->course_title.' '.getPhrase('course_completed_list');
        }
        $data['records']   = $records;

         $view     = \View::make('student.cousrse-completd-list-print-file',$data);
        $contents = $view->render();

        return $contents;

            
    }
    /**
     * This Method show the course detained list according to the
     * selection list
     * @return [type] [description]
     */
     public function courseDetainedStudentsList()
    {
        $data['active_class']       = 'academic';
        $data['sub_active_class']   = 'student_dlist';
        $data['active_class1']       = '';
        $data['title']              = getPhrase('detained_student_list');
        
        $data['academic_years']     = addSelectToList(getAcademicYears());
        $list                       = App\Course::getCourses(0);
        
        $data['layout']             = getLayout();
        $data['module_helper']      = getModuleHelper('detained-student-list');

      return view('student.detained-list', $data); 
    }
    /**
     * This method print the detained students list
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function printCourseDetainedStudentsList(Request $request)
    {
         
        $academic_id        = $request->academic_id;
        $course_parent_id   = $request->parent_course_id;
        $course_id          = $request->course_id;
        $year        = 1;
            if($request->year){
              $year = $request->current_year;
            }
            $semister = 0;
            if($request->current_semister){ 
            $semister    = $request->current_semister;
          }
        $academic_details  =  App\Academic::where('id',$request->academic_id)->first();
        $course_details    =  App\Course::where('id',$request->course_id)->first();

         $records = StudentPromotion::join('users','users.id','=','studentpromotions.user_id')
            ->join('students','students.id','=','studentpromotions.student_id')
            ->join('courses','courses.id','=','students.course_id')
            ->where('from_academic_id','=',$academic_id)
            // ->where('from_course_parent_id','=',$course_parent_id)
            ->where('from_course_id','=',$course_id)
            ->where('from_year','=',$year)
            ->where('from_semister','=',$semister)
            ->where('type','=','detained')
            ->select(['users.name','students.roll_no','courses.course_title','users.slug'])
            ->get();

             if($course_details->course_dueration>1 && $course_details->is_having_semister==1){
         $data['title']     = $academic_details->academic_year_title.' '.$course_details->course_title.' '.$year.' '.'year'.' '.$semister.' '.'semester '.' '.getPhrase('course_detained_list');
         }
        elseif ($course_details->course_dueration>1 && $course_details->is_having_semister==0) {
         $data['title']     = $academic_details->academic_year_title.' '.$course_details->course_title.' '.$year.' '.'year'.' '.getPhrase('course_detained_list');
        }
        else{
          $data['title']     = $academic_details->academic_year_title.' '.$course_details->course_title.' '.getPhrase('course_detained_list');
        }
        $data['records']   = $records;
         $view     = \View::make('student.cousrse-detained-list-print-file',$data);
        $contents = $view->render();

        return $contents;

    }


    /**
    This Method display the feepaid details of particular class
    **/
    public function feePaidHistory()
    {

        $data['active_class']       = 'academic';
        $data['active_class1']      = '';
        $data['sub_active_class']   = 'fee_paid_histroy';
        $data['title']              = getPhrase('class_fee_paid_history');
        $data['feecategories']      = addSelectToList(getFeeCategories());
        $data['layout']             = getLayout();
        $data['module_helper']      = getModuleHelper('student-list');

      return view('student.fee.class-feepaid-details', $data); 
        
    }

    /**
    This Mehtod Print Fee Paid Details of selected Class
    **/
    public function printFeePaidHistory(Request $request)
    {
        $feecategory_id     = $request->feecategories;

        $feecategory = App\FeeCategory::where('id','=',$feecategory_id)
                                        ->where('status','=',1)
                                        ->first();
        
        $academic_id        = $feecategory->academic_id;
        $course_parent_id   = $feecategory->course_parent_id;
        $course_id          = $feecategory->course_id;
        $year               = $feecategory->year;
        $semister           = $feecategory->semister;

         $students = Student::join('feeparticular_paymets','feeparticular_paymets.student_id','=','students.id')
        ->join('users', 'users.id' ,'=', 'students.user_id')  
        ->join('academics','academics.id','=','students.academic_id') 
        ->join('courses','courses.id','=','students.course_id')
        ->where('feeparticular_paymets.academic_id','=',$academic_id)
        ->where('feeparticular_paymets.course_parent_id','=',$course_parent_id)
        ->where('feeparticular_paymets.course_id','=',$course_id)
        ->where('feeparticular_paymets.year','=',$year)
        ->where('feeparticular_paymets.semister','=',$semister)
        ->select(['students.id as id','users.name', 'students.roll_no','students.admission_no', 'course_title','academic_year_title', 'email', 'current_year', 'current_semister','course_dueration','students.academic_id as academic_id', 'students.course_id as course_id', 'students.user_id as user_id','users.slug'])
        ->groupBy('students.id')
        ->get();
        
         $academic_details  =  App\Academic::where('id',$academic_id)->first();
        $course_details    =  App\Course::where('id',$course_id)->first();

        if($course_details->course_dueration>1 && $course_details->is_having_semister==1){
         $data['title']     = $academic_details->academic_year_title.' '.$course_details->course_title.' '.$year.' '.'year'.' '.$semister.' '.'semester '.' '.getPhrase('fee_paid_list');
         }
        elseif ($course_details->course_dueration>1 && $course_details->is_having_semister==0) {
         $data['title']     = $academic_details->academic_year_title.' '.$course_details->course_title.' '.$year.' '.'year'.' '.getPhrase('fee_paid_list');
        }
        else{
          $data['title']     = $academic_details->academic_year_title.' '.$course_details->course_title.' '.getPhrase('fee_paid_list');
        }
        
        $records = array();
        foreach ($students as $student)
         {
          // return $student;
          $temp['student_id']          = $student->id; 
          $temp['roll_no']             = $student->roll_no; 
          $temp['user_id']             = $student->user_id; 
          $temp['name']                = $student->name;
          $temp['slug']                = $student->slug;
          $temp['amount']              = $total_amount = $student->getTotalAmount($feecategory_id,$student->id);
          $temp['paid_amount']         = $paid_amount  = $student->getTotalPaidAmount($feecategory_id,$student->id);
          $temp['discount_amount']     = $discount     = $student->getTotalDiscount($feecategory_id,$student->id);
          $temp['balance']             = $total_amount - ($paid_amount+$discount);
          

          if($total_amount!=0){
         $paid_percentage              = getPercentage(($paid_amount+$discount),$total_amount); 
         $temp['paid_percentage']      = $paid_percentage; 
         }
         else{
             $temp['paid_percentage']      = 0; 
         }


          $records[]                   = $temp;

         }
        $data['records']     = $records;
        $data['extracols']   = $request->extracols;

         $view     = \View::make('student.fee.feepaid-history-print',$data);
        $contents = $view->render();

        return $contents;

        

    }
    
    
}
