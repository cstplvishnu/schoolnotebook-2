 				
					<div class="row">

 					 <fieldset class="form-group col-md-12">

						{{ Form::label('title', getphrase('title')) }}

						<span class="text-danger">*</span>

						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg :'.getPhrase('_bus_fee'),

							'ng-model'=>'title', 

							'ng-pattern'=>getRegexPattern('name1'), 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formQuiz.title.$touched && formQuiz.title.$invalid}',

							'ng-minlength' => '4',

							'ng-maxlength' => '40',

							)) }}

						<div class="validation-error" ng-messages="formQuiz.title.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

	    					{!! getValidationMessage('minlength',4,40)!!}

	    					{!! getValidationMessage('maxlength',4,40)!!}

						</div>

					</fieldset>	

					<fieldset class="form-group col-md-6">

						<?php $status = array('1' =>'Active', '0' => 'Inactive', );?>

						{{ Form::label('status', getphrase('status')) }}

						<span class="text-danger">*</span>

						{{Form::select('status', $status, null, ['class'=>'form-control'])}}
						

					</fieldset> 

					<fieldset class="form-group col-md-6">

						<?php $is_income = array('1' =>'Yes', '0' => 'No', );?>

						{{ Form::label('is_income', getphrase('is_income')) }}

						<span class="text-danger">*</span>

						{{Form::select('is_income', $is_income, null, ['class'=>'form-control'])}}
						

					</fieldset> 

					<fieldset class="form-group col-md-12">
						
						{{ Form::label('description', getphrase('description')) }}
						
						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => 'Eg : Description','id'=>'description')) }}
					</fieldset>					

					</div>


						<div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_FEE_PARTICULARS}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formQuiz.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>

		 