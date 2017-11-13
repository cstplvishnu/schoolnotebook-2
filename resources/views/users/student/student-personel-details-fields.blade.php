<?php $new_tab_active = '';
	if($tab_active=='personal')
		$new_tab_active = ' in active';
 ?>
<div id="personal_details" class="tab-pane fade {{$new_tab_active}}">
						{{ Form::model($record, 
						array('url' => ['student/profile/edit/personal', $userRecord->slug], 
						'method'=>'patch')) }}
									<h3>{{getPhrase('personal_details')}}</h3>
									<div class="row">
										<fieldset class="form-group col-md-6">
										{{ Form::label('first_name', getphrase('first_name')) }}
										<span class="text-danger" >*</span>
											{{ Form::text('first_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Jack')) }}
										</fieldset>
										<fieldset class="form-group col-md-6">
										{{ Form::label('middle_name', getphrase('middle_name')) }}
											{{ Form::text('middle_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Jarvis')) }}
										</fieldset>
										<fieldset class="form-group col-md-6">
											{{ Form::label('last_name', getphrase('last_name')) }}
											{{ Form::text('last_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Magi')) }}
										</fieldset>
                                     
                                    <div class='col-sm-6'>
												{{ Form::label('date_of_birth', getphrase('date_of_birth')) }}
										<span class="text-danger">*</span>

											{{ Form::text('date_of_birth', null , $attributes = array('class'=>'input-sm  datepicker-input form-control', 'placeholder' => '2016-06-12','readonly'=>true)) }}
										</div>


										<div class="col-md-12 clearfix"></div>
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
                        else{
                        	$active  = 'active';
                        	$activee  = '';
                        }


                        ?>
                       
                       @else

                       <?php  $active  = 'active';
                        $activee  = '';
                        
                        ?>

                      @endif
 					 	
 					<fieldset class='form-group col-md-6'>
						{{ Form::label('gender', getphrase('gender')) }}
						<span class="text-danger">*</span>
						
						          <div>
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
										<fieldset class="form-group col-md-6">
											{{ Form::label('blood_group', getphrase('blood_group')) }}
											{{Form::select('blood_group', getBloodGroups(), null, ['placeholder' => getPhrase('select'),'class'=>'form-control'])}}
										</fieldset>

										<fieldset class="form-group col-md-6">
											{{ Form::label('fathers_name', getphrase('fathers_name')) }}
											<span class="text-danger" >*</span>
											{{ Form::text('fathers_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Jim')) }}
										</fieldset>
										<fieldset class="form-group col-md-6">
											{{ Form::label('mothers_name', getphrase('mothers_name')) }}
											<span class="text-danger" >*</span>
											{{ Form::text('mothers_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Arlo')) }}
										</fieldset>
										<fieldset class="form-group col-md-6">
											{{ Form::label('nationality', getphrase('nationality')) }}
											
											{{Form::select('nationality', $countries, null, ['placeholder' => getPhrase('select'),'class'=>'form-control select1'])}}

										</fieldset>
										<fieldset class="form-group col-md-6">
											{{ Form::label('mother_tongue', getphrase('mother_tongue')) }}
											{{ Form::text('mother_tongue', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'English')) }}
										</fieldset>

										<fieldset class="form-group col-md-6">
											{{ Form::label('religion_id', getphrase('religion')) }}
											<span class="text-danger" >*</span>
											{{Form::select('religion_id', $religions, null, ['placeholder' => getPhrase('select'),'class'=>'form-control select1'])}}

										</fieldset>

										<fieldset class="form-group col-md-6">
											{{ Form::label('category_id', getphrase('category')) }}
											<span class="text-danger" >*</span>
											{{Form::select('category_id', $categories, null, ['placeholder' => getPhrase('select'),'class'=>'form-control select1'])}}

										</fieldset>
										 
									</div>
									<div class="buttons text-right">
						<button type="submit" class="btn btn-success">{{getPhrase('save')}}</button>
					</div>
								{!! Form::close() !!}
							</div>