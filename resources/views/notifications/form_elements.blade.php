 					<div class="row">

 					 <fieldset class="form-group col-md-6">

						{{ Form::label('title', getphrase('title')) }}

						<span class="text-danger">*</span>

						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg :'.getPhrase('english'),

							'ng-model'=>'title', 

							'ng-pattern'=>getRegexPattern('name1'), 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formNotifications.title.$touched && formNotifications.title.$invalid}',

							'ng-minlength' => '4',

							'ng-maxlength' => '50',

							)) }}

						<div class="validation-error" ng-messages="formNotifications.title.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

	    					{!! getValidationMessage('minlength',4,50)!!}

	    					{!! getValidationMessage('maxlength',4,50)!!}

						</div>

					</fieldset>

					<fieldset class="form-group col-md-6">

						

						{{ Form::label('url', getphrase('url')) }}

						 

						{{ Form::text('url', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg: www.sitename.com',

							)) }}
 

					</fieldset>

				 </div>
     <div class="row">

              

                <fieldset class="form-group col-md-6">

               {{ Form::label('valid_from', getphrase('valid_from')) }}

              {{ Form::text('valid_from', null , $attributes = array('class'=>'input-sm  datepicker-input form-control', 'placeholder' => 'Eg: 2015-06-12','readonly'=>true)) }}
                </fieldset>

                  <fieldset class="form-group col-md-6">
                    {{ Form::label('valid_to', getphrase('valid_to')) }}

               {{ Form::text('valid_to', null , $attributes = array('class'=>'input-sm  datepicker-input form-control', 'placeholder' => 'Eg: 2015-06-12','readonly'=>true)) }}

                  </fieldset>
           </div>

 		            <div class="row">

					<fieldset class="form-group  col-md-12">

						{{ Form::label('short_description', getphrase('short_description')) }}

						{{ Form::textarea('short_description', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => getPhrase('Eg:_start_from_tomorrow'))) }}

					</fieldset>

					<fieldset class="form-group  col-md-12">

						{{ Form::label('description', getphrase('description')) }}

						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'5', 'placeholder' => getPhrase('description'))) }}

					</fieldset>

                      </div>

                      


						<div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_ADMIN_NOTIFICATIONS}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formNotifications.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>

		 