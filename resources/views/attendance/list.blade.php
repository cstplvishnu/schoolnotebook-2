@extends($layout)
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')


<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
  <li><a href="{{PREFIX}}"><i class="fa fa-home"></i>{{getPhrase('home')}}</a></li>
   
     <li><a href="{{URL_STUDENT_ATTENDENCE.Auth::user()->slug}}">{{getphrase('select_class')}}</a></li>
      <li>{{$title}}</li>
</ul>


         <div class="row" ng-controller="attendanceController" ng-init="initAngData('{{count($students)}}');">
                  <div class="col-sm-12">


				   <section class="panel panel-default">
					<div class="panel-heading">
					<div class="row">
						<div class="col-sm-8">
						<?php 
						$title = $submitted_data->course_record->course_title;

						?>

						<p class="font-bold">{{ getPhrase('attendance_for').' '.$submitted_data->academic_title->academic_year_title.' '.$title }}</p>
						
						<p><strong>{{ getPhrase('date').' '.$submitted_data->attendance_date }}</strong></p>

						</div>
						 
						<div class="col-sm-4 text-right">
						<ul class="list-unstyled attendance_summary">
							<li class="clearfix">
								<p class="pull-left"><strong>Total:</strong> @{{total}}</p>
								<p class="pull-right"><strong>Present:</strong> @{{present}}</p>
							</li>
							<li class="clearfix">
								<p class="pull-left text-danger"><strong>Absent:</strong> @{{absent}}</p>
								<p class="pull-right"><strong>Leave:</strong> @{{leave}}</p>
							</li>
						</ul>
							<span >
							
						</span>		
						</div>
					</div>
						
					</div>
					<?php 
					?>
					{!! Form::open(array('url' => URL_STUDENT_ATTENDENCE_UPDATE.$userdata->slug, 'method' => 'POST')) !!}
					
					<input type="hidden" name="academic_id" value="{{$submitted_data->academic_id}}">
					<input type="hidden" name="course_id" value="{{$submitted_data->course_record->id}}">

					<input type="hidden" name="subject_id" value="{{$submitted_data->subject_id}}">
					<input type="hidden" name="total_class" value="{{$submitted_data->total_class}}">
					<input type="hidden" name="record_updated_by" value="{{$submitted_data->updated_by}}">

					<input type="hidden" name="current_year" value="{{$submitted_data->current_year}}">
					<input type="hidden" name="current_semister" value="{{$submitted_data->current_semister}}">
					<input type="hidden" name="attendance_date" value="{{$submitted_data->attendance_date}}">
					<input type="hidden" name="attendance_taken" value="{{$attendance_taken}}">

					<div class="panel-body packages" id="myForm">
						<div class="table-responsive vertical-scroll"> 
						<table class="table table-striped table-bordered student-attendance-table datatable" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>{{ getPhrase('sno')}}</th>
									<th></th>
									<th>{{ getPhrase('roll_no')}}</th>
									<th>{{ getPhrase('name')}}</th>
									<th width="350px">{{ getPhrase('attendance')}}</th>
									<th>{{ getPhrase('remarks')}}</th>
									<th>{{ getPhrase('notes')}}</th>
								</tr>
							</thead>
							<?php $sno = 1; ?>
							@foreach($students as $student)
							<?php $user = $student->user()->first(); ?>
							<tr>
								<td>{{ $sno++ }}</td>
								<td><img src="{{getProfilePath($user->image)}}" class="img-circle"> </td>
								<td><strong>{{ $student->roll_no }}</strong></td>
								<td>{{ $student->first_name }}</td>
								<td>
									<div class="col-md-4">

									<?php 
									$present = true;
									$absent = false;
									$leave = false;
									$remarks = '';
									$notes = '';
									if($attendance_taken) { 
										foreach($attendance_records as $atr)
										{	

											if($student->id == $atr->student_id)
											{
												$present 	= false;
												$absent 	= false;
												$leave 		= false;
												$notes = $atr->notes;
												$remarks = $atr->remarks;
												switch ($atr->attendance_code) {
													case 'P':
															$present = true;
														break;
													case 'A':
															$absent = true;
														break;
													case 'L':
															$leave = true;
														break;
													
													default:
														$present = true;
														break;
												}
												break;
											}
										}
									 } ?>

							{{ Form::radio('attendance_code', 'P', $present, array(
								'id'=>'present'.$student->id,
								'name'=>'attendance_code['.$student->id.']',
								'ng-click' => 'updateCount()',
								'class' => 'attendance_code'
							)) }}
								
                                        <label for="present{{$student->id}}"> <span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span> <label class="m-l-n-md">{{getPhrase('present')}}</label></label> 
							</div>
							<div class="col-md-4">
							{{ Form::radio('attendance_code', 'A', $absent, array('id'=>'absent'.$student->id, 'name'=>'attendance_code['.$student->id.']',
								'ng-click' => 'updateCount()'
							)) }}
                                <label for="absent{{$student->id}}"> <span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span> <label class="m-l-n-md">{{getPhrase('absent')}} </label></label>
							</div>
							<div class="col-md-4">
							{{ Form::radio('attendance_code', 'L', $leave, array('id'=>'leave'.$student->id, 'name'=>'attendance_code['.$student->id.']',
							'ng-click' => 'updateCount()'
							)) }}
                                <label for="leave{{$student->id}}"> <span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span><label class="m-l-n-md"> {{getPhrase('leave')}} </label></label>
							</div>
								</td>
								<td>
									<fieldset class="form-group">
									 {{ Form::textarea('remarks', $remarks , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('remarks'), 'rows'=>1, 'cols'=>15, 'name'=>'remarks['.$student->id.']')) }}										 
									</fieldset>
								</td>
								<td>
									<fieldset class="form-group">
									 {{ Form::textarea('notes', $notes , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('notes'), 'rows'=>1, 'cols'=>15, 'name'=>'notes['.$student->id.']')) }}
										 
									</fieldset>
								</td>
							</tr>

							@endforeach
						</table>
						</div>
						<div class="buttons text-right">
							<a class="btn btn-defualt" href="{{URL_STUDENT_ATTENDENCE.Auth::user()->slug}}">{{ getPhrase('cancel') }}</a>
							<button class="btn btn-success">{{ getPhrase('save') }}</button>
						</div>
					</div>
			       </section>
			</div>
			<!-- /.container-fluid -->
		</div>
@endsection
 

@section('footer_scripts')
  
@include('attendance.scripts.attendance-script') 

@stop
