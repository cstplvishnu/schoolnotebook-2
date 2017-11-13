<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App;
use Auth;
use App\User;
use App\FeePayment;
use SMS;
use DB;
use Charts;
use Artisan;

class FeeRreportsController extends Controller
{
     public function __construct()
    {
      $this->middleware('auth');
    }

     public function index()
    {
 
		
        $data['active_class']   = 'fee';
        $data['sub_active_class']   = 'fee_reports';
 
        $data['layout']         = getLayout();
        $data['title']          = getPhrase('dashboard');
        $view_page = 'fee.reports.dashboard';

     	 $month_dates = getMonthDates();

       $dta = (object)App\FeeParticularPayment::monthlyRecords();
       $data['report_data'] = $dta;
    
      	$data['chart'] = Charts::multi('line', 'highcharts')
                        ->title('Monthly Analysis')
                        
                        ->labels($month_dates)
                        ->dataset('Actual Payments', $dta->amount)
                        
                        ->dataset('Received Payments', $dta->paid);



        return view($view_page, $data);
         
    }

    /**
    This Method return the daily,weekly,monthly reports
    **/
    public function getReports()
    {
        
         if(checkRole(getUserGrade(16))){

         $data['active_class']       = 'fee_reports';  
        }
        else{
        $data['active_class']       = 'fee';
       }
        $data['sub_active_class']   = 'fee_reports';
        $data['layout']         = getLayout();
        $data['title']          = getPhrase('fee_paid_reports');
        
        return view('fee.reports.dailyreports',$data);
    }
    
/**
This Get the Daily daily,weekly,monthly reports
**/
    public function getDatatable()
    {
        if(!checkRole(getUserGrade(17)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $records = array();
        $today_date  = date('Y-m-d');
        $records = FeePayment::select(['id','feecategory_title','student_id','paid_amount','balance'])
                               ->where('recevied_on','=',$today_date)
                               ->orderBy('updated_at', 'desc');
        return Datatables::of($records)
        
        ->removeColumn('id')
        ->make();
    }
    
    /**
    This Method Returns The Payments Of The CurrentDay
    **/
    public function getPayments(Request $request)
    {    
        $final_data  = [];
        $today   = date('Y-m-d');
        $records = FeePayment::join('users','users.id','=','feepayments.user_id')
                               ->join('students','students.id','=','feepayments.student_id')
                               ->where('recevied_on','=',$today)
                               ->get();
        $final_data['records']   = $records;                       
        $final_data['start_date']   = date("Y/m/d");                       
        $final_data['end_date']     = date("Y/m/d");                       
       
       return $final_data;
    }
    /**
    This Method Return Fee Payment Records Based On The
    Selected Dates
    **/
    public function getDatePayments(Request $request)
    {
        $date1   = date_create($request->starting_date);
        $date2   = date_create($request->ending_date);
        
        $start_date   = date_format($date1,"Y-m-d");
        $end_date     = date_format($date2,"Y-m-d");
        
       $records = FeePayment::join('users','users.id','=','feepayments.user_id')
                               ->join('students','students.id','=','feepayments.student_id')
                               ->where('recevied_on','>=',$start_date)
                               ->where('recevied_on','<=',$end_date)
                               ->get();
         
       return $records;
    }
   
   /**
   This Method Return Last 7 days Payment Records From The Current Date
   **/
    public function getLastWeekPayments(Request $request)
    {  
       $final_data  = []; 
       $query =   "SELECT *
                    FROM ((feepayments
                    INNER JOIN students ON feepayments.student_id = students.id)
                    INNER JOIN users ON feepayments.user_id = users.id)
                    WHERE recevied_on BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";

        $records  = DB::select($query);
        $final_data['records']       = $records;
        $mystartdate                 = date("Y/m/d");
        $final_data['start_date']    = $mystartdate;
        $start_date                  = date_create($mystartdate);
        date_sub($start_date,date_interval_create_from_date_string("7 days"));
        $final_data['end_date']      = date_format($start_date,"Y/m/d");
        return $final_data;
    }


    /**
   This Method Return Last 7 days Payment Records From The Current Date
   **/
    public function getLastMonthPayments(Request $request)
    {  
       $final_data =[]; 
       $query =   "SELECT *
                    FROM ((feepayments
                    INNER JOIN students ON feepayments.student_id = students.id)
                    INNER JOIN users ON feepayments.user_id = users.id)
                    WHERE recevied_on BETWEEN DATE_SUB(NOW(), INTERVAL 31 DAY) AND NOW()";

        $records  = DB::select($query);
        $final_data['records']       = $records;
        $mystartdate                 = date("Y/m/d");
        $final_data['start_date']    = $mystartdate;
        $start_date                  = date_create($mystartdate);
        date_sub($start_date,date_interval_create_from_date_string("30 days"));
        $final_data['end_date']      = date_format($start_date,"Y/m/d");
        return $final_data;
    }
    
}
