 

					 <fieldset class="form-group col-sm-12">
					

						{{ Form::label('name', getphrase('name')) }}

						<span class="text-danger">*</span>

						{{ Form::text('name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : Jack',

							'ng-model'=>'name',

							'required'=> 'true', 

							 'ng-minlength' => '2',

							 'ng-maxlength' => '20',

							'ng-pattern' => getRegexPattern('name1'),

                            'ng-class'=>'{"has-error": formUsers.name.$touched && formUsers.name.$invalid}',

                          )) }}

						<div class="validation-error" ng-messages="formUsers.name.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

	    					{!! getValidationMessage('minlength',2,20)!!}

	    					{!! getValidationMessage('maxlength',2,20)!!}

						</div>

					</fieldset>



					<?php 

					$readonly = '';

					$username_value = null;

					if($record){

						$readonly = 'readonly="true"';

						// $username_value = $record->username;

					}



					?>

					 <fieldset class="form-group col-sm-12">

						

						{{ Form::label('username', getphrase('username')) }}

						<span class="text-danger">*</span>

						{{ Form::text('username', $value = $username_value , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : Jack',

							'ng-model'=>'username',

							'required'=> 'true', 

							 $readonly,
                            
                            'ng-minlength' => '2',

							'ng-maxlength' => '20',

							'ng-class'=>'{"has-error": formUsers.username.$touched && formUsers.username.$invalid}',



						)) }}

						<div class="validation-error" ng-messages="formUsers.username.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('minlength',2,20)!!}

	    					{!! getValidationMessage('maxlength',2,20)!!}

	    					{!! getValidationMessage('pattern')!!}

						</div>

					</fieldset>



					 <fieldset class="form-group col-sm-12">

						<?php 

						$readonly = '';

							if(!checkRole(getUserGrade(4)))

							$readonly = 'readonly="true"';

						if($record)

						{

							$readonly = 'readonly="true"';

						}



						?>

						{{ Form::label('email', getphrase('email')) }}

						<span class="text-danger">*</span>

						{{ Form::email('email', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : jack@jarvis.com',

							'ng-model'=>'email',

							'required'=> 'true', 

							'ng-pattern' => getRegexPattern('email'),

							'ng-class'=>'{"has-error": formUsers.email.$touched && formUsers.email.$invalid}',

						 $readonly)) }}

						 <div class="validation-error" ng-messages="formUsers.email.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('email')!!}

	    					{!! getValidationMessage('pattern')!!}

						</div>

					</fieldset>
                          
                          @if(!checkRole(['parent']))

					   <fieldset class="form-group col-sm-12">



						{{ Form::label('role', getphrase('role')) }}

						<span class="text-danger">*</span>

						<?php 
						$disabled = (checkRole(getUserGrade(2))) ? '' :'disabled'; 

						$selected = getPhrase(getRoleData('student'));

						if($record){

							$selected = $record->role_id;

						}

						?>

						@if($disabled=='disabled')
						<input type="hidden" name="role_id" value="{{$record->role_id}}">
						@endif

						{{Form::select('role_id', $roles, $selected, ['placeholder' => getPhrase('select_role'),'class'=>'form-control', $disabled,

							'ng-model'=>'role_id',
							'id'=>'role_id',

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formUsers.role_id.$touched && formUsers.role_id.$invalid}'

						 ])}}

						  <div class="validation-error" ng-messages="formUsers.role_id.$error" >

	    					{!! getValidationMessage()!!}

	    					 

						</div>

						  

					</fieldset>

					@endif



					<fieldset class="form-group col-sm-12">

						

						{{ Form::label('phone', getphrase('phone')) }}

						<span class="text-danger">*</span>

						{{ Form::number('phone', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 
						getPhrase('please_enter_10-13_digit_mobile_number'),

							'ng-model'=>'phone',

							'required'=> 'true', 
                            
                            'ng-maxlength' => '13',

                            'ng-minlength' => '10',
							
							'ng-pattern' => getRegexPattern("phone"),

							'ng-class'=>'{"has-error": formUsers.phone.$touched && formUsers.phone.$invalid}',


						)) }}

						 

						<div class="validation-error" ng-messages="formUsers.phone.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('phone')!!}

	    					{!! getValidationMessage('maxlength',10,13)!!}

	    					{!! getValidationMessage('minlength',10,13)!!}

						</div>

					</fieldset>


						<fieldset class="form-group col-sm-6">

						

						{{ Form::label('address', getphrase('billing_address')) }}

					 

						{{ Form::textarea('address', $value = null , $attributes = array('class'=>'form-control','rows'=>3, 'cols'=>'15', 'placeholder' => getPhrase('please_enter_your_address'),

							'ng-model'=>'address',

							)) }}

					</fieldset>



					<fieldset class='col-sm-6'>

						{{ Form::label('image', getphrase('image')) }}

						<div class="form-group row">

							<div class="col-md-6">

						

					{!! Form::file('image', array('id'=>'image_input', 'accept'=>'.png,.jpg,.jpeg')) !!}

							</div>

							<?php if(isset($record) && $record) { 

								  if($record->image!='') {

								?>

							<div class="col-md-6">

								<img src="{{ getProfilePath($record->image) }}"  class="img-circle" />



							</div>

							<?php } } ?>

						</div>

					</fieldset>


					
                  <div class="row">
                                <div class="col-sm-12">
                                   
                                        <div class="form-group">
                                            <div class="col-md-12 control-label">
                                                <div class="doc-buttons pull-right"> 

                                             @if($record && $record->role_id!=2)   	
                                          <a href="{{URL_USERS.$present_user}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                                          @else
                                          @if($present_user != null)
                                          <a href="{{URL_USERS.$present_user}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                                          @else
                                           
                                             <a href="{{URL_USERS_DASHBOARD}}" class="btn btn-default">{{getPhrase('cancel')}}</a>

                                          @endif
                                          @endif
                                        <button class="btn btn-success" ng-disabled='!formUsers.$valid'>{{ getPhrase('save') }}</button>
                                              </div>
                                            </div>
                                        </div>
                                </div>
                              </div>

