<?php $new_tab_active = '';
	if($tab_active=='contact')
		$new_tab_active = ' in active';
 ?>
<div id="contact_details" class="tab-pane fade {{$new_tab_active}}">
								{{ Form::model($record, 
						array('url' => ['staff/profile/edit/contact', $record->id], 
						'method'=>'patch')) }}
									<h3>{{getPhrase('contact_details')}}</h3>
									<div class="row">
										<fieldset class="form-group col-md-6">
											{{ Form::label('address_lane1', getphrase('address_lane1')) }}
											<span class="text-danger">*</span>
											{{ Form::textarea('address_lane1', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => '123-Colony, ABC Road')) }}
										</fieldset>

										<fieldset class="form-group col-md-6">
											{{ Form::label('address_lane2', getphrase('address_lane2')) }}
											<span class="text-danger">*</span>
											{{ Form::textarea('address_lane2', $value = null , $attributes = array('class'=>'form-control','rows'=>'5', 'placeholder' => '123-Colony, ABC Road')) }}
										</fieldset>

										<fieldset class="form-group col-md-6">
										{{ Form::label('city', getphrase('city')) }}
										<span class="text-danger">*</span>
											{{ Form::text('city', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Aberdeen City')) }}
										</fieldset>
										<fieldset class="form-group col-md-6">
											{{ Form::label('state', getphrase('state')) }}
											<span class="text-danger">*</span>
											{{ Form::text('state', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'United Kingdom')) }}
										</fieldset>
										<fieldset class="form-group col-md-6">
												{{ Form::label('country', getphrase('country')) }}
											<span class="text-danger">*</span>
											{{Form::select('country', $countries, null, ['placeholder' => getPhrase('select'),'class'=>'form-control'])}}
										</fieldset>

										<fieldset class="form-group col-md-6">
											{{ Form::label('zipcode', getphrase('zipcode')) }}
											<span class="text-danger">*</span>
											{{ Form::text('zipcode', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'AB11')) }}
										</fieldset>
										
										

										<fieldset class="form-group col-md-6">
											{{ Form::label('mobile', getphrase('mobile')) }}
											<span class="text-danger">*</span>
											{{ Form::number('mobile', $ph_no , $attributes = array('class'=>'form-control', 'placeholder' => '1234567891')) }}
										</fieldset>
										
										<fieldset class="form-group col-md-6">
											{{ Form::label('home_phone', getphrase('home_phone')) }}
											<span class="text-danger">*</span>
											{{ Form::number('home_phone', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '1234567891')) }}
										</fieldset>
										 

									</div>
									<div class="buttons text-right">
		<button type="submit" class="btn btn-success">{{getPhrase('save')}}</button>
	</div>
								{!! Form::close() !!}
							</div>