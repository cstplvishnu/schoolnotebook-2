		 				
					<div class="row">	
						 <fieldset class="form-group col-md-6">
						
						{{ Form::label('title', getphrase('title')) }}
						<span class="text-danger">*</span>
						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('Eg : exam_title'),
							'ng-model'=>'title', 
							 'ng-pattern' => getRegexPattern('name1'),
							'required'=> 'true', 
							'ng-class'=>'{"has-error": formQuiz.title.$touched && formQuiz.title.$invalid}',
							'ng-minlength' => '4',
							'ng-maxlength' => '30',
							)) }}
						<div class="validation-error" ng-messages="formQuiz.title.$error" >
	    					{!! getValidationMessage()!!}
	    				 
	    					{!! getValidationMessage('minlength',4,30)!!}

	    					{!! getValidationMessage('maxlength',4,30)!!}

	    					{!! getValidationMessage('pattern')!!}
						</div>
					</fieldset> 
 					 
					<fieldset class="form-group col-md-6">

						 

						{{ Form::label('subject_id', getphrase('subject')) }}
						<span class="text-danger">*</span>
						{{ Form::select('subject_id',$subjects ,null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('select_subject'),
							'ng-model'=>'subject', 
							 
							'required'=> 'true', 
							'ng-class'=>'{"has-error": formQuiz.subject_id.$touched && formQuiz.subject_id.$invalid}',
							
							)) }}
						<div class="validation-error" ng-messages="formQuiz.title.$error" >
	    					{!! getValidationMessage()!!}
	    					 
	    					
						</div>
					</fieldset>	
					</div>
     				<div class="row">
 				
					<fieldset class="form-group col-md-6">

						<?php $quiz_types = array('online' => getPhrase('online'), 'offline' => getPhrase('offline'), );?>

						{{ Form::label('type', getphrase('quiz_type')) }}
						<span class="text-danger">*</span>
						{{ Form::select('type',$quiz_types ,null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('select_type'),
							'ng-model'=>'quiz_type', 
							  
							'required'=> 'true', 
							'ng-class'=>'{"has-error": formQuiz.type.$touched && formQuiz.type.$invalid}',
							
							)) }}
						<div class="validation-error" ng-messages="formQuiz.title.$error" >
	    					{!! getValidationMessage()!!}
	    					
						</div>
					</fieldset>	

					<fieldset class="form-group col-md-6" ng-show="quiz_type=='offline'">
						
						{{ Form::label('offline_quiz_category_id', getphrase('offline_category')) }}
						<span class="text-danger">*</span>
						{{Form::select('offline_quiz_category_id', $offline_categories, null, ['class'=>'form-control'])}}
						
					</fieldset>


					<fieldset class="form-group col-md-6" ng-if="quiz_type!='offline'">
						
						{{ Form::label('category_id', getphrase('category')) }}
						<span class="text-danger">*</span>
						{{Form::select('category_id', $categories, null, ['class'=>'form-control'])}}
						
					</fieldset>
  
				    </div>

				<div class="row">
	  				 <fieldset class="form-group col-md-6">
							
							{{ Form::label('dueration', getphrase('duration')) }}
							<span class="text-danger">*</span>
							{{ Form::number('dueration', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('enter_value_in_minutes'),
							'string-to-number',
							'ng-model'=>'dueration', 

							'required'=> 'true', 
							'ng-class'=>'{"has-error": formQuiz.dueration.$touched && formQuiz.dueration.$invalid}',
							 
							)) }}
						<div class="validation-error" ng-messages="formQuiz.dueration.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('number')!!}
						</div>
					</fieldset>	
	  				 <fieldset class="form-group col-md-3" ng-if="quiz_type!='offline'">
							
							{{ Form::label('total_marks', getphrase('total_marks')) }}
							<span class="text-danger">*</span>
							{{ Form::text('total_marks', $value = null , $attributes = array('class'=>'form-control','readonly'=>'true' ,'placeholder' => getPhrase('It will be updated by adding the questions'))) }}
					</fieldset>
					<fieldset class="form-group col-md-3" ng-show="quiz_type=='offline'">
							
							{{ Form::label('total_marks', getphrase('total_marks')) }}
							<span class="text-danger">*</span>
							{{ Form::text('total_marks', $value = null , $attributes = array('class'=>'form-control' ,'placeholder' => getPhrase('100'))) }}
					</fieldset>		
					 <fieldset class="form-group col-md-3">
						
						{{ Form::label('pass_percentage', getphrase('pass_percentage')) }}
						<span class="text-danger">*</span>
						{{ Form::number('pass_percentage', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : 40',
							'ng-minlength' => '1',
							'ng-maxlength' => '3',
							'min'=>0,
						'ng-model'=>'pass_percentage', 
						'required'=> 'true', 
						'ng-class'=>'{"has-error": formQuiz.pass_percentage.$touched && formQuiz.pass_percentage.$invalid}',
							 
							)) }}
						<div class="validation-error" ng-messages="formQuiz.pass_percentage.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('number')!!}
	    					{!! getValidationMessage('minlength',1,3)!!}

                            {!! getValidationMessage('maxlength',1,3)!!}
						</div>
				</fieldset>
				</div>
				 
				<div class="row" ng-if="quiz_type!='offline'">
				 
  				 <fieldset   class="form-group col-md-6">
						
						{{ Form::label('negative_mark', getphrase('negative_mark')) }}
						<span class="text-danger">*</span>
						{{ Form::number('negative_mark', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : 1',
							'ng-minlength' => '1',
							'ng-maxlength' => '3',
							'min'=>0,
						'ng-model'=>'negative_mark', 
						'required'=> 'true', 
						'ng-class'=>'{"has-error": formQuiz.negative_mark.$touched && formQuiz.negative_mark.$invalid}',
							 
							)) }}
						<div class="validation-error" ng-messages="formQuiz.negative_mark.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('number')!!}
	    					{!! getValidationMessage('minlength',1,3)!!}

                            {!! getValidationMessage('maxlength',1,3)!!}
						</div>
				</fieldset>
					<fieldset class="form-group col-md-6">
						
						{{ Form::label('instructions_page_id', getphrase('instructions_page')) }}
						<span class="text-danger">*</span>
						{{Form::select('instructions_page_id', $instructions, null, ['class'=>'form-control'])}}
						
					</fieldset>
  				 
				</div>

				<div class="row" >
		 	<?php 
		 	$date_from = date('Y-m-d');
		 	$date_to = date('Y-m-d');
		 	if($record)
		 	{
		 		$date_from = $record->start_date;
		 		$date_to = $record->end_date;

		 	}
		 	 ?>
		 	 <fieldset class="form-group col-md-6">
				{{ Form::label('start_date', getphrase('start_date')) }}
				{{ Form::text('start_date', $date_from , $attributes = array('class'=>'input-sm  datepicker-input form-control', 'placeholder' => '2015/7/17', 
				'id' => 'dpd1','readonly'=>'true')) }}
			</fieldset>

			<fieldset class="form-group col-md-6">
				{{ Form::label('end_date', getphrase('end_date')) }}
				{{ Form::text('end_date', $date_to , $attributes = array('class'=>'input-sm  datepicker-input form-control', 'placeholder' => '2015/7/17', 'id' => 'dpd2','readonly'=>'true')) }}
 			</fieldset>

			</div>

				<div  class="row" ng-if="quiz_type!='offline'">

				<?php $payment_options = array('1'=>'Paid', '0'=>'Free');?>
					 <fieldset class="form-group col-md-6" >
						{{ Form::label('is_paid', getphrase('is_paid')) }}
						<span class="text-danger">*</span>
						{{Form::select('is_paid', $payment_options, null, ['placeholder' => getPhrase('select'),'class'=>'form-control', 
						     'ng-model'=>'is_paid',
							'required'=> 'true', 
							'ng-class'=>'{"has-error": formQuiz.is_paid.$touched && formQuiz.is_paid.$invalid}',

						]) }}
						<div class="validation-error" ng-messages="formQuiz.is_paid.$error" >
	    					{!! getValidationMessage()!!}
						</div>

					</fieldset>
				 
					<div ng-if="is_paid==1">
	  				 <fieldset class="form-group col-md-3">
							
							{{ Form::label('validity', getphrase('validity')) }}
							<span class="text-danger">*</span>
							{{ Form::number('validity', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('validity_in_days'),
							'ng-model'=>'validity',
							'required'=> 'true',
							'min'=>'0',
						'string-to-number',
							 
							'ng-class'=>'{"has-error": formQuiz.validity.$touched && formQuiz.validity.$invalid}',
							 
							)) }}
						<div class="validation-error" ng-messages="formQuiz.validity.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('number')!!}
						</div>
					</fieldset>	
	  				 <fieldset class="form-group col-md-3">
						
						{{ Form::label('cost', getphrase('cost')) }}
						<span class="text-danger">*</span>
						{{ Form::number('cost', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '40',
							'min'=>'0',
						'string-to-number',	 
						'ng-model'=>'cost', 
						'required'=> 'true', 
						'ng-class'=>'{"has-error": formQuiz.cost.$touched && formQuiz.cost.$invalid}',
							 
							)) }}
						<div class="validation-error" ng-messages="formQuiz.cost.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('number')!!}
						</div>
				</fieldset>
				</div>
				</div>

				@include('exams.quiz.form_elements_academic_selection', 
				array(	'academic_years' => $academic_years,
					))
					
					<fieldset class="form-group">
						
						{{ Form::label('description', getphrase('description')) }}
						
						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => getPhrase('Eg :_description'))) }}
					</fieldset>


						<div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_QUIZZES}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formQuiz.$valid'>{{ getPhrase('save') }}</button>
                              </div>
                            </div>
                        </div>