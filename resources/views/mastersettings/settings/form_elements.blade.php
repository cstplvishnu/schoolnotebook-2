 					<fieldset class="form-group">

						{{ Form::label('title', getphrase('title')) }}

						<span class="text-danger">*</span>

						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg :'.getPhrase(' title'),'readonly'=>true

							)) }}

					</fieldset>

                   <fieldset class="form-group">

						{{ Form::label('key', getphrase('key')) }}

						<span class="text-danger">*</span>

						{{ Form::text('key', $value = null , $attributes = array('class'=>'form-control', 'placeholder' =>  getPhrase('Introduction'),'readonly'=>true

							
						 ))}}


					</fieldset>

                       <fieldset class='form-group'>

						{{ Form::label('image', getphrase('image')) }}

						<div class="form-group row">

							<div class="col-md-6">

					{!! Form::file('image', null, array('class'=>'form-control')) !!}

							</div>

							<?php if(isset($record) && $record) { 

								  if($record->image!='') {

								?>

							<div class="col-md-6">

								<img src="{{ IMAGE_PATH_SETTINGS.$record->image }}" height="100" width="100" />

                           </div>

							<?php } } ?>

						</div>

					</fieldset>


                        <fieldset class="form-group">

						{{ Form::label('description', getphrase('description')) }}

						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => getphrase('description_of_the_topic'))) }}

					</fieldset>
                 

						<div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_SETTINGS_LIST}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-info">{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>