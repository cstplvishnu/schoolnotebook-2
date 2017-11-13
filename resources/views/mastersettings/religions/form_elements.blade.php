                   	 <fieldset class="form-group">
						
						  <label class="col-lg-12">{{getPhrase('religion')}}<span class="text-danger">*</span></label>

						<div class="col-lg-12">

						
						{{ Form::text('religion_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg: Christian',
							'ng-model'=>'religion_name', 

							'ng-pattern'=>getRegexPattern('name1'), 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formReligion.religion_name.$touched && formReligion.religion_name.$invalid}',

							'ng-minlength' => '2',

							'ng-maxlength' => '40',

							)) }}

						<div class="validation-error" ng-messages="formReligion.religion_name.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

	    					{!! getValidationMessage('minlength',2,40)!!}

	    					{!! getValidationMessage('maxlength',2,40)!!}
           
						</div>
					</div>
					</fieldset>

 					 
					 <div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_MASTERSETTINGS_RELIGIONS}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formReligion.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>

		 