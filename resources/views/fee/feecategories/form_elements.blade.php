                      <div class="row">
					 <fieldset class="form-group col-md-6">
						
						{{ Form::label('title', getphrase('title')) }}

						<span class="text-danger">*</span>
						
						{{ Form::text('title', $value = null , $attributes = array(
						'class'=>'form-control', 
						'placeholder' => 'Eg: 	2015-2016-CSE-1st Year-1st Semister',
						'ng-model'     =>'title', 
						'ng-pattern'   => getRegexPattern('name1'),
                        'ng-minlength' => '2',
                        'ng-maxlength' => '60',
                        'required'     => 'true', 
						'ng-class'     =>'{"has-error": FromFeeCategories.title.$touched && FromFeeCategories.title.$invalid}'
						)) }}
						<div class="validation-error" ng-messages="FromFeeCategories.title.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('pattern')!!}
			                {!! getValidationMessage('minlength',2,60)!!}
			                {!! getValidationMessage('maxlength',2,60)!!}
						</div>
					</fieldset>

					<fieldset class="form-group col-md-6">

						<?php $status = array('1' =>'Active', '0' => 'Inactive', );?>

						{{ Form::label('status', getphrase('status')) }}

						<span class="text-danger">*</span>

						{{Form::select('status', $status, null, ['class'=>'form-control'])}}
						

					</fieldset> 

					</div>
 

					 <fieldset class="form-group">
						
						{{ Form::label('description', getphrase('description')) }}
						
						{{ Form::textarea('description', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'Eg: I Year Inter 2016-2017', 'rows'=>'5')) }}
					</fieldset>

					    
						 
						 @include('fee.feecategories.year-selection')
					
						<!-- </div> -->
					
						<div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_FEE_CATEGORIES}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-info">{{ getPhrase('update') }}</button>
                              </div>
                            </div>
                        </div>