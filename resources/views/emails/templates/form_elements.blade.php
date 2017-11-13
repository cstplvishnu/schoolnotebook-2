 				<?php 
 				$readonly = '';
 				$disabled = '';
					if($record) {
						$readonly = 'readonly="TRUE"';
						$disabled = 'disabled="TRUE"';					}
				?>

 					 <fieldset class="form-group col-md-6">
						
						{{ Form::label('key', getphrase('key')) }}
						<span class="text-danger">*</span>
						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('Eg:_key'),
							'ng-model'=>'title',
							'ng-pattern' => getRegexPattern("name1"),
							'ng-minlength' => '2',

							'ng-maxlength' => '40',
							'required'=> 'true', 
							 $readonly,
							'ng-class'=>'{"has-error": formEmails.title.$touched && formEmails.title.$invalid}'
						)) }}
						<div class="validation-error" ng-messages="formEmails.title.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('pattern')!!}
	    					{!! getValidationMessage('minlength',2,40)!!}

	    					{!! getValidationMessage('maxlength',2,40)!!}
           
	    					</div>
					</fieldset>

					 <fieldset class="form-group col-md-6">
						<?php $settings = getSettings('email'); 
							
						 	$email_types = (array) $settings->record_type; ?>
						 	
						{{ Form::label('type', getphrase('type')) }}
						<span class="text-danger">*</span>
						{{Form::select('type',$email_types , null, [
						'class'=>'form-control','placeholder'=>'select',
						$disabled,
						 ])}}
					</fieldset>
 					  
 					 <fieldset class="form-group col-md-12">
						{{ Form::label('subject', getphrase('subject')) }}
						<span class="text-danger">*</span>
						{{ Form::text('subject', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('Eg:_welcome'),
							'ng-model'=>'subject',
							'ng-pattern' => getRegexPattern("name1"),
							'required'=> 'true', 
							'ng-minlength' => '2',

							'ng-maxlength' => '40',
							'ng-class'=>'{"has-error": formEmails.subject.$touched && formEmails.subject.$invalid}'
						)) }}
						<div class="validation-error" ng-messages="formEmails.subject.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('pattern')!!}
	    					{!! getValidationMessage('minlength',2,40)!!}

	    					{!! getValidationMessage('maxlength',2,40)!!}
	    					</div>
					</fieldset>

					<fieldset class="form-group col-md-12">
						{{ Form::label('from_email', getphrase('from_email')) }}
						<span class="text-danger">*</span>
						{{ Form::email('from_email', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg: name@domain.com',
							'ng-model'=>'from_email',
							'ng-pattern' => getRegexPattern("email"),
							'required'=> 'true', 
							'ng-class'=>'{"has-error": formEmails.from_email.$touched && formEmails.from_email.$invalid}'
						)) }}
						<div class="validation-error" ng-messages="formEmails.from_email.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('pattern')!!}
	    					</div>
					</fieldset>

					<fieldset class="form-group col-md-12">
						{{ Form::label('from_name', getphrase('from_name')) }}
						<span class="text-danger">*</span>
						{{ Form::text('from_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg: Jack',
							'ng-model'=>'from_name',
							'ng-pattern' => getRegexPattern("name1"),
							'required'=> 'true', 
							'ng-minlength' => '2',

							'ng-maxlength' => '40',
							'ng-class'=>'{"has-error": formEmails.from_name.$touched && formEmails.from_name.$invalid}'
						)) }}
						<div class="validation-error" ng-messages="formEmails.from_name.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('pattern')!!}
	    					{!! getValidationMessage('minlength',2,40)!!}

	    					{!! getValidationMessage('maxlength',2,40)!!}
	    					</div>
					</fieldset>


					<fieldset class="form-group col-md-12">
						
						{{ Form::label('content', getphrase('content')) }}
						<span class="text-danger">*</span>
						{{ Form::textarea('content', $value = null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'5', 'placeholder' => getPhrase('Eg:_email_content'),'id'=>'description'
							
						)) }}
						
					</fieldset>
					
					<div class="row">
                                <div class="col-sm-12">
                                   
                                        <div class="form-group">
                                            <div class="col-md-12 clear">
                                                <div class="doc-buttons pull-right"> 
                                                <a href="{{URL_EMAIL_TEMPLATES}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                                        <button class="btn btn-success" ng-disabled='!formEmails.$valid'>{{ $button_name }}</button>
                                              </div>
                                            </div>
                                        </div>
                                </div>
                              </div>