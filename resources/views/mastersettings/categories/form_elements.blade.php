                   <fieldset class="form-group">
						
						  <label class="col-lg-12">{{getPhrase('category_name')}}<span class="text-danger">*</span></label>

						<div class="col-lg-12">
						
						{{ Form::text('category_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg: EBC',
							'ng-model'=>'category_name', 

							'ng-pattern'=>getRegexPattern('name1'), 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formReligion.category_name.$touched && formReligion.category_name.$invalid}',

							'ng-minlength' => '2',

							'ng-maxlength' => '30',

							)) }}

						<div class="validation-error" ng-messages="formReligion.category_name.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

	    					{!! getValidationMessage('minlength',2,30)!!}

	    					{!! getValidationMessage('maxlength',2,30)!!}
           
						</div>
					</div>
 					 </fieldset>
 					 
						<div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_MASTERSETTINGS_CATEGORIES}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formReligion.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>

		 