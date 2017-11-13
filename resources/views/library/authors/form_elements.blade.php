 					
 					 <fieldset class="form-group">
						
						 <label class="col-lg-12">Author<span class="text-danger">*</span></label>
						 <div class="col-lg-12">
						{{ Form::text('author', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg: Jack',

							'ng-model'=>'author', 

							'ng-pattern'=>getRegexPattern('name1'), 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formauthors.author.$touched && formauthors.author.$invalid}',

							'ng-minlength' => '2',

							'ng-maxlength' => '20',

							)) }}

						<div class="validation-error" ng-messages="formauthors.author.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

	    					{!! getValidationMessage('minlength',2,20)!!}

	    					{!! getValidationMessage('maxlength',2,20)!!}
           
						</div>
					</div>

					</fieldset>

 					 <div class="row helper_step1">
                      
                      @if($record)
                        <?php


                        if($record->gender=='male'){
                        	$active  = 'active';
                        	$activee  = '';
                        }
                        elseif ($record->gender=='female') {
                        	$activee  = 'active';
                        	$active  = '';
                        }


                        ?>
                       
                       @else

                       <?php  $active  = 'active';
                        $activee  = '';
                        
                        ?>

                      @endif
 					 	
 					<fieldset class='form-group'>
						<label class="col-lg-12">Gender<span class="text-danger">*</span></label>
						
						          <div class="m-b-sm col-lg-12">
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-sm btn-info {{$active}} " for="free">
                                                   
                                                    {{ Form::radio('gender', 'male', true, array('id'=>'free', 'ng-model' => 'fine_eligiblity' )) }}<i class="fa fa-check text-active"></i> Male </label>
                                                <label class="btn btn-sm btn-success {{$activee}}" for="paid">
                                                   {{ Form::radio('gender', 'female', false, array('id'=>'paid', 
							'ng-model' => 'fine_eligiblity')) }}<i class="fa fa-check text-active"></i> Female
							 </label>
                                                
                                            </div>
                                        </div>
					</fieldset>
				</div>
					<fieldset class="form-group">
						<label class="col-lg-12">Description</label>
						 <div class="col-lg-12">
						
						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => 'Eg: Fine description')) }}
					</div>
					</fieldset>
						
					</fieldset>
						
						   <div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_AUTHORS}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formauthors.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>