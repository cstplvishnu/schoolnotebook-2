@extends($layout)
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
       <li><a href="{{URL_OFFLINE_EXAMS}}"> {{getPhrase('offline_exmas')}}</a></li>
      <li>{{$title}}</li>
    </ul>

<section class="panel panel-default">
				<!-- Page Heading -->
				<header class="panel-heading clear"><strong> {{$quiz_name}}</strong></header>

             
					
					<?php 
					?>
			{!! Form::open(array('url' => URL_OFFLINE_EXAMS_UPDATE, 'method' => 'POST')) !!}
		
			<input type="hidden" name="course_parent_id" value="{{$submitted_data->course_record->parent_id}}">
			<input type="hidden" name="academic_id" value="{{$submitted_data->academic_id}}">
			<input type="hidden" name="course_id" value="{{$submitted_data->course_record->id}}">
			<input type="hidden" name="current_year" value="{{$submitted_data->current_year}}">
			<input type="hidden" name="current_semister" value="{{$submitted_data->current_semister}}">
			<input type="hidden" name="quiz_id" value="{{$submitted_data->quiz_id}}">
			<input type="hidden" name="quiz_applicability_id" value="{{$submitted_data->quiz_applicable_id}}">
			
			<div class="panel-body packages" id="myForm">
				<div class="table-responsive" style="overflow-x:initial;"> 
				<table class="table table-striped b-t b-light ss-tb datatable">
					<thead>
						<tr>
							<th>{{ getPhrase('sno')}}</th>
							<th></th>
							<th>{{ getPhrase('name')}}</th>
							<th>{{ getPhrase('roll_no')}}</th>
							<th id="helper_step1">{{ getPhrase('total_marks')}}</th>
							<th id="helper_step2">{{ getPhrase('marks_obtained')}}</th>
							<th id="helper_step3">{{ getPhrase('exam_status')}}</th>
						</tr>
					</thead>
					<?php $sno = 1; ?>

					@foreach($students as $student)
					<?php $user = $student->user()->first(); ?>
					
                        <tr>
						<td>{{ $sno++ }}</td>
						<td><img src="{{getProfilePath($user->image)}}" class="img-circle"> </td>
						<td><strong>{{ $student->first_name  }}</strong></td>
						<td>{{ $student->roll_no }}</td>
						 <?php 
									$obtained = 0;
									$statuss ='';

									if($marks_entered)
									 { 
										foreach($entered_marks as $marks)
										{
											if($user->id == $marks->user_id)
											{
                                                $obtained = $marks->marks_obtained;
                                                $statuss  = $marks->exam_status;
											}
										}
									 }

									  ?>
						
						<td>

							<fieldset class="form-group">
							 {{ Form::text('total_marks', $value = $max_marks , $attributes = array('class'=>'form-control', 'readonly'=>true, 'name'=>'total_marks['.$user->id.']')) }}
                               

							</fieldset>
						</td>
						<td>
							<fieldset class="form-group">
							 {{ Form::text('marks_obtained', $value = $obtained , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('marks_obtained'), 'name'=>'marks_obtained['.$user->id.']')) }}
								 
							</fieldset>
						</td>
						<td>

						<?php $status=array('pass'=>getPhrase('pass'),'fail'=>getPhrase('fail')) ?>

							<fieldset class="form-group">
							 {{ Form::select('exam_status', $status ,$statuss, $attributes = array('class'=>'form-control', 'name'=>'exam_status['.$user->id.']')) }}
								 
							</fieldset>
						</td>
					</tr>

					@endforeach
				</table>
				</div>

				 <div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                        <button class="btn btn-success" >{{ getPhrase('save') }}</button>
                              </div>
                            </div>
                        </div>

			</div>
		</div>

	</section>
@endsection


@section('footer_scripts')


@stop
