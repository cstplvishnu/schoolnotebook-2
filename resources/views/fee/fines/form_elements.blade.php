 					
 					<fieldset class="form-group">
						{{ Form::label('feecategory_id', getphrase('fee_category')) }}
						
						{{Form::select('feecategory_id', $fee_categories, null, ['class'=>'form-control','id'=>'fine_category'])}}

					</fieldset>
 


					 <fieldset class="form-group">
						
						{{ Form::label('fine_name', getphrase('fine_name')) }}
						
						{{ Form::text('fine_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Introduction')) }}
					</fieldset>

					<fieldset class="form-group">
						
						{{ Form::label('description', getphrase('description')) }}
						
						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => 'Fine description')) }}
					</fieldset>
					
					 
 					
 				 
					</div>	

				 

					</fieldset>
						<div class="buttons text-center">
							<button class="btn btn-lg btn-success button">{{ $button_name }}</button>
						</div>
		 