 					

 				

					<div class="row">

 					 <fieldset class="form-group col-md-6">

						

						{{ Form::label('title', getphrase('title')) }}

						<span class="text-danger">*</span>

						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('Eg :_quiz_title'),

							'ng-model'=>'title', 

							'ng-pattern'=>getRegexPattern('name1'), 
							'id'=>'title',

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formInstructions.title.$touched && formInstructions.title.$invalid}',

							'ng-minlength' => '4',

							'ng-maxlength' => '30',

							)) }}

						<div class="validation-error" ng-messages="formInstructions.title.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

	    					{!! getValidationMessage('minlength',4,30)!!}

	    					{!! getValidationMessage('maxlength',4,30)!!}

						</div>

					</fieldset>

				    </div>



					<fieldset class="form-group helper_step1">

						{{ Form::label('content', getphrase('content')) }}

						

						{{ Form::textarea('content', $value = null , $attributes = array('class'=>'form-control ckeditor', 'id'=>'ckeditor', 'rows'=>'5', 'placeholder' => getPhrase('content'))) }}

					</fieldset>





					

						<div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_INSTRUCTIONS}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formInstructions.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>
            
              

		 