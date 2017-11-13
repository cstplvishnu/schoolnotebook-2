 					 
 					<div class="form-group">
 						<fieldset>
                           <label class="col-lg-12"> Publisher Name <span class="text-danger">*</span></label>
                            <div class="col-lg-12">
                             
						
						{{ Form::text('publisher', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg: Jack',

							'ng-model'=>'publisher', 

							'ng-pattern'=>getRegexPattern('name1'), 

							'required'=> 'true',
							'id'=>'publisher', 

							'ng-class'=>'{"has-error": formpublishers.publisher.$touched && formpublishers.publisher.$invalid}',

							'ng-minlength' => '2',

							'ng-maxlength' => '40',

							)) }}

						<div class="validation-error" ng-messages="formpublishers.publisher.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

	    					{!! getValidationMessage('minlength',2,40)!!}

	    					{!! getValidationMessage('maxlength',2,40)!!}
           
						</div>
                    </div>
                    </fieldset>
 			   </div>		
					<?php 
					 $countries = DB::table('countries')->pluck('country_name', 'country_code');
					 ?>
 					
			
			 <div class="form-group">
			 	<fieldset>
                            <label class="col-lg-12"> Country <span class="text-danger">*</span></label>
                            <div class="col-lg-12">
					
				{{Form::select('country', $countries, null, ['placeholder' => getPhrase('select'),'class'=>'form-control'])}}
			         </div>
			         </fieldset>
			  </div>
                 
                 <div class="col-sm-12">
			  	<fieldset class="form-group">
						
						{{ Form::label('description', getphrase('description')) }}
						
						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => 'Eg: Description')) }}
					</fieldset>
					</div>
						
					  <div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_PUBLISHERS}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formpublishers.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>
            