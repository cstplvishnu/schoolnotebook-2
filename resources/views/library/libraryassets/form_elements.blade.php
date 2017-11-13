 					
 					 <fieldset class="form-group">
						
						  <label class="col-lg-12">Item Type<span class="text-danger">*</span></label>

						<div class="col-lg-12">

						{{ Form::text('asset_type', $value = null , $attributes = array('class'=>'form-control', 
						'placeholder'  => 'Books/Magazines,CD etc',
						'ng-model'     =>'asset_type', 
						'ng-pattern'   => getRegexPattern('name1'),
                        'ng-minlength' => '2',
                        'ng-maxlength' => '30',
                        'required'     => 'true', 
						'ng-class'     =>'{"has-error": formAssets.asset_type.$touched && formAssets.asset_type.$invalid}'

						 ))}}

						<div class="validation-error" ng-messages="formAssets.asset_type.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('pattern')!!}
			                {!! getValidationMessage('minlength',2,30)!!}
			                {!! getValidationMessage('maxlength',2,30)!!}
						</div>
		                  </div>
					</fieldset>
 					

				<fieldset class="form-group">
						
						 <label class="col-lg-12">Description<span class="text-danger">*</span></label>
						 <div class="col-lg-12">
						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => 'Fine description')) }}
					</div>
					</fieldset>

				 <div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_LIBRARY_ASSETS}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formAssets.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>
		 