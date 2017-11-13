				 <fieldset class="form-group">
                  <label class="col-lg-12">{{getPhrase('category_name ')}}<span class="text-danger">*</span></label>
                  <div class="col-lg-12">
						
						
						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : Test-1',
							'ng-model'=>'title',
							'id'=>'title', 

							'ng-pattern'=>getRegexPattern('name1'), 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formOfflineQuizCategory.title.$touched && formOfflineQuizCategory.title.$invalid}',

							'ng-minlength' => '1',

							'ng-maxlength' => '30',

							)) }}

						<div class="validation-error" ng-messages="formOfflineQuizCategory.title.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

	    					{!! getValidationMessage('minlength',1,30)!!}

	    					{!! getValidationMessage('maxlength',1,30)!!}
           
						</div>
					</div>
 					 </fieldset>
						

						  <div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_OFFLINEEXMAS_QUIZ_CATEGORIES}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formOfflineQuizCategory.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>

		 