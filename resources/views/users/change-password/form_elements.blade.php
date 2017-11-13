	<div class="col-md-12">
                        <div class="form-group">
                            <fieldset>
                             <label class="col-lg-12">{{getPhrase('old_password')}}
                                <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">


							{{ Form::password('old_password', $attributes = array('class'=>'form-control', 'placeholder' => getphrase('old_password'),

							'ng-model'=>'old_password',

							'required'=> 'true', 

							'ng-class'=>'{"has-error": changePassword.old_password.$touched && changePassword.old_password.$invalid}',

							'ng-minlength' => 5

						)) }}

						<div class="validation-error" ng-messages="changePassword.old_password.$error" >

							{!! getValidationMessage()!!}

							{!! getValidationMessage('password')!!}

						</div>

				       </div>
                        </fieldset>
                   </div>
                  
               </div>

					<div class="col-md-12">
                        <div class="form-group">
                             <fieldset>
                             <label class="col-lg-12">{{getPhrase('password')}}
                                <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
							{{ Form::password('password', $attributes = array('class'=>'form-control', 'placeholder' => getphrase('new_password'),

						'ng-model'=>'password',

							'required'=> 'true', 

							'ng-class'=>'{"has-error": changePassword.password.$touched && changePassword.password.$invalid}',

							'ng-minlength' => 5

						)) }}

					<div class="validation-error" ng-messages="changePassword.password.$error" >

						{!! getValidationMessage()!!}

						{!! getValidationMessage('password')!!}

					</div>

					</div>
                    </fieldset>
               </div>
          </div>      


          <div class="col-md-12">
                        <div class="form-group">
                             <fieldset>
                             <label class="col-lg-12">{{getPhrase('password_confirmation')}}
                                <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
							{{ Form::password('password_confirmation', $attributes = array('class'=>'form-control', 'placeholder' => getphrase('retype_password'),

						'ng-model'=>'password_confirmation',

							'required'=> 'true', 

							'ng-class'=>'{"has-error": changePassword.password_confirmation.$touched && changePassword.password_confirmation.$invalid}',

							'compare-to' =>"password",

							'ng-minlength' => 5

						)) }}

						<div class="validation-error" ng-messages="changePassword.password_confirmation.$error" >

							{!! getValidationMessage()!!}

							{!! getValidationMessage('password')!!}

							{!! getValidationMessage('confirmPassword')!!}

						</div>

					</div>
                    </fieldset>
               </div>
          </div>      



					

          <div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                        <button class="btn btn-success" ng-disabled='!changePassword.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>