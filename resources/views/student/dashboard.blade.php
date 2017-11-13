@extends($layout)
@section('content')

 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
    <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ul>



<?php
 $date    = date("Y-m-d");
 $user_id = $user->id;
 $student_data        = App\Student::where('user_id','=',$user_id)->first();
 $latest_fee_category = App\FeeCategory::getStudentLatestFeeCategory($student_data->id);
 
 if($latest_fee_category!=0){
 $feeschules          = App\FeeScheduleParticular::where('feecategory_id','=',$latest_fee_category)
                                          			->where('start_date','<=',$date)
                                          			->get();

   
   $data         = new App\FeeParticularPayment();                                       			
   $amount       = 0;
   $paid_amount  = 0;
   $balance      = 0;                                       			
   $other_amount = 0;
   $previous_amount = 0;
   $term_number = array();
   $other_amount +=  $data->getScheduleTotalOtherAmount($latest_fee_category,$student_data->id);
// dd($other_amount);
   $previous_amount +=  $data->getSchedulePreviousAmount($latest_fee_category,$student_data->id);


 foreach ($feeschules as $feeschedule)
  {  
  	
  	  
      $amount      += $data->getScheduleTotalAmount($feeschedule->id,$student_data->id);
      $paid_amount += $data->getScheduleTotalPaidAmount($latest_fee_category,$feeschedule->id,$student_data->id);
      $term_number[]  = $data->getTerms($feeschedule->id,$student_data->id);

  }
  $other_paid_amount = $data->getNonTermsPaidAmount($latest_fee_category,$student_data->id);
  $final_balance     = round($amount + $other_amount ) - round($paid_amount+$other_paid_amount);
}

?>

@if($latest_fee_category!=0)

@if($previous_amount>0)
	
	<div class="alert alert-warning">
	   <strong>{{getPhrase('Note:')}}</strong>You Have Previous Term Balance <strong>{{ getCurrencyCode() }} {{$previous_amount}}</strong>
	 </div>	
	
@endif

@endif

{!! Form::open(array('url' => URL_FEE_PAY_ONLINE, 'method' => 'POST','name'=>'formFeePay ', 'novalidate'=>'')) !!}

@if($latest_fee_category!=0)
	@foreach($term_number as $term)
	   @if($term->end_date >= $date)
	<div class="alert alert-warning">
	   <strong>{{getPhrase('Note:')}}</strong> Fee Term - {{$term->term_number}} is Enabled  <strong>({{$term->start_date}} - {{$term->end_date}})</strong> You Have Balnace To Pay&nbsp;&nbsp; <strong>{{ getCurrencyCode() }} {{$final_balance}}</strong>&nbsp;&nbsp;&nbsp;&nbsp;
	   @if((int)$final_balance > 0)
	   <span><button class="btn btn-sm btn-primary button">{{getPhrase('paynow')}}</button></span>
	   @endif
	   <input type="hidden" name="pay_amount" value="{{$final_balance}}">

	 </div>	

	  @endif
	@endforeach
@endif
 <input type="hidden" name="current_feecategory_id" value="{{$latest_fee_category}}">
{!! Form::close() !!}

<!-- Dashboard Lables -->
<section class="panel panel-default ss-panel-bg">
    <div class="row m-l-none m-r-none bg-light lter">
        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                       <i class="fa fa-random fa-stack-1x text-white"></i>
                     <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>
            <a class="clear" href="{{URL_STUDENT_EXAM_CATEGORIES}}"> <span class="h4 block m-t-xs"><strong >{{getPhrase('exam_categories')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-success"></i>
                      <i class="fa fa-clock-o fa-stack-1x text-white"></i>
                     <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
            <a class="clear" href="{{URL_QUIZ_GET_SCHEDULED_EXAMS.Auth::user()->slug}}"> <span class="h4 block m-t-xs"><strong >{{getPhrase('scheduled_exams')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-danger"></i>
                      <i class="fa fa-flag fa-stack-1x text-white"></i>
                      <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span> </span>
            <a class="clear" href="{{URL_STUDENT_ANALYSIS_SUBJECT.Auth::user()->slug}}"> <span class="h4 block m-t-xs"><strong >{{getPhrase('subjects_reports')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-warning"></i>
                      <i class="fa fa-check fa-stack-1x text-white"></i>
                    <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>
            <a class="clear" href="{{URL_STUDENT_ATTENDENCE_REPORT.'/'.Auth::user()->slug}}"> <span class="h4 block m-t-xs"><strong>{{ getPhrase('attendance_report')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>
    </div>
    <!--Second Set-->
    <div class="row m-l-none m-r-none bg-light lter ss-dashboard-cover">
        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x icon-muted"></i>
          <i class="fa fa-calendar fa-stack-1x text-white"></i>
        <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>
            <a class="clear" href="{{URL_TIMETABLE_STAFF_STUDENT_PRINT.Auth::user()->slug}}" target="_blank"> <span class="h4 block m-t-xs"><strong>{{getPhrase('timetable')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
              <i class="fa fa-circle fa-stack-2x text-warning"></i>
              <i class="fa fa-building-o fa-stack-1x text-white"></i>
              <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
            <a class="clear" href="{{URL_STUDENT_RESULTS.Auth::user()->slug}}"> <span class="h4 block m-t-xs"><strong>{{getPhrase('marks')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x text-info"></i>
         <i class="fa fa-book fa-stack-1x text-white"></i>
          <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span> </span>
            <a class="clear" href="{{URL_USER_LIBRARY_DETAILS.Auth::user()->slug}}"> <span class="h4 block m-t-xs"><strong >{{getPhrase('library_history')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x text-primary"></i>
          <i class="fa fa-money fa-stack-1x text-white"></i>
         <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>
            <a class="clear" href="{{URL_USER_FEE_SCHEDULES.$student_data->id}}"> <span class="h4 block m-t-xs"><strong>{{ getPhrase('fee_reports')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>
    </div>
</section> 

<!-- End Dashboard Lables       -->

<!-- Library and Classes Information -->
<div class="row">
				<div class="col-md-6">
  				 <section class="panel panel-default">
				    <div class="panel-heading font-bold"><i class="fa fa-book"></i> {{getPhrase('library_history')}}</div>
				    <div class="panel-body table-responsive" >
				    	<?php 
				    	$records = App\LibraryIssue::issueHistory('',5);
				    	?>

				    	<table class="table ">
				    		<thead>
				    			<tr>
				    				<th>
				    				<strong>{{getPhrase('sno')}}</strong></th>
				    				<th><strong>{{getPhrase('title')}}
				    				</strong></th>
				    				<th><strong>{{getPhrase('number')}}</th>
				    				<th><strong>{{getPhrase('issued')}}
				    				</strong></th>
				    				<th><strong>{{getPhrase('status')}}
				    				</strong></th>
				    			</tr>

				    		</thead>
				    		<tbody>
				    		<?php $sno=1;?>
				    		@if(count($records))
				    		@foreach($records as $record)
				    		<?php $class = 'label label-success';
				    		if($record->issue_type=='issue' || $record->issue_type=='renewal')
				    			$class = 'label label-danger';
				    		if($record->issue_type=='lost')
				    			$class = 'label label-warning';
				    		?>
				    			<tr>
				    				<td>{{$sno++}}</td>
				    				<td>{{$record->title}}</td>
				    				<td>{{$record->library_asset_no}}</td>
				    				<td>{{date('Y-m-d',strtotime($record->issued_on))}}</td>
				    				<td><span class='{{$class}}' >{{ ucfirst($record->issue_type)}}</span></td>
				    			</tr>
				    		@endforeach
				    		@else
				    		<tr>
				    				<td>{{getPhrase('no_data_available')}}</td>
				    		</tr>
				    		@endif
				    		</tbody>
				    	</table>
				    </div>
				</section>
				</div>

				<div class="col-md-6">
  				   <section class="panel panel-default">
				    <div class="panel-heading font-bold"><i class="fa  fa-bell"></i> {{getPhrase("today's_classes")}}</div>
				    <div class="panel-body table-responsive" >
				    	<?php 
				    	$records = App\Timetable::getStudentDayClasses();
				    	 ?>
				    	 <table class="table">
				    		<thead>
				    			<tr>
				    				<th>
				    				<strong>{{getPhrase('sno')}}</strong></th>
				    				<th><strong>{{getPhrase('subject')}}
				    				</strong></th>
				    				<th><strong>{{getPhrase('class')}}</th>
				    				<th><strong>{{getPhrase('from')}}
				    				</strong></th>
				    				<th><strong>{{getPhrase('to')}}
				    				</strong></th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    		<?php $sno=1;?>
				    		@if(count($records))
				    		@foreach($records as $record)
		 
				    			<tr>
				    				<td>{{$sno++}}</td>
				    				<td>{{$record->subject_title}}</td>
				    				<td>{{$record->course_title}}</td>
				    				<td>{{$record->start_time}}</td>
				    				<td>{{ $record->end_time}}</td>
				    			</tr>
				    		@endforeach
				    		@else
				    		<tr>
				    				<td>{{getPhrase('no_data_available')}}</td>
				    		</tr>
				    		@endif
				    		</tbody>
				    	</table>

				    </div>
				  </section>
				</div>
			 
	</div>
	
<div class="row"><?php $ids=[];?>
@for($i=0; $i<count($chart_data); $i++)
<?php 
$newid = 'myChart'.$i;
$ids[] = $newid; ?>
<div class="col-md-6">  				 
 <div class="panel panel-default dsPanel">				   			
 	    <div class="panel-body" >
          <canvas id="{{$newid}}" width="100" height="60"></canvas>					
		   </div>				 
		    </div>		
		   		</div>

@endfor	
 			


@stop

@section('footer_scripts')
@include('common.chart', array($chart_data,'ids' =>$ids))
@stop