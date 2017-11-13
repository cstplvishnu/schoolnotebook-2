 <?php $settings = getSettings('lms');?>
 			
				<div class="row">
 					 <fieldset class="form-group col-md-6">

						{{ Form::label('title', getphrase('title')) }}
						<span class="text-danger">*</span>
						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : C Programming',
						'ng-model'=>'title',
							'required'=> 'true', 
							'ng-pattern' => getRegexPattern("name1"),
							'ng-minlength' => '2',
							'id'=>'title',
							'ng-maxlength' => '40',
							'ng-class'=>'{"has-error": formLms.title.$touched && formLms.title.$invalid}',

						)) }}
						<div class="validation-error" ng-messages="formLms.title.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('minlength',2,40)!!}
	    					{!! getValidationMessage('maxlength',2,40)!!}
	    					{!! getValidationMessage('pattern')!!}
						</div>
					</fieldset>

					 <fieldset class="form-group col-md-6">

						{{ Form::label('code', getphrase('code')) }}
						<span class="text-danger">*</span>
						{{ Form::text('code', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : CNT100',
							'ng-model'=>'code',
							'required'=> 'true',
							'id'=>'code', 
							'ng-pattern' => getRegexPattern("name"),
							'ng-minlength' => '2',
							'ng-maxlength' => '20',
							'ng-class'=>'{"has-error": formLms.code.$touched && formLms.code.$invalid}',

						)) }}
						<div class="validation-error" ng-messages="formLms.code.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('minlength',2,20)!!}
	    					{!! getValidationMessage('maxlength',2,20)!!}
	    					{!! getValidationMessage('pattern')!!}
						</div>
					</fieldset>
					
				</div>

 			<div class="row">
 					<fieldset class="form-group col-md-6">
						{{ Form::label('subject_id', getphrase('subject')) }}
						<span class="text-danger">*</span>
						{{Form::select('subject_id', $subjects, null, [ 'class'=>'form-control','id'=>'subject_id'])}}
					</fieldset>

					 <fieldset class="form-group  col-md-6"   >
				   {{ Form::label('image', getphrase('image')) }}
				         <input type="file" class="form-control" name="image"
				          accept=".png,.jpg,.jpeg" id="image_input">

				    </fieldset>

					 <fieldset class="form-group col-md-6"   >
					@if($record)
				   		@if($record->image)
				         <img src="{{ IMAGE_PATH_UPLOAD_LMS_CONTENTS.$record->image }}" height="100" width="100">
				         @endif
				     @endif
				    </fieldset>
					
			</div>

 
					<div  class="row">
				 	 <fieldset class="form-group col-md-6" >
						{{ Form::label('content_type', getphrase('content_type')) }}
						<span class="text-danger">*</span>
						{{Form::select('content_type', $settings->content_types, null, ['placeholder' => getPhrase('select'),'class'=>'form-control', 
						'ng-model'=>'content_type',
							'required'=> 'true',
							 'id'=>'content_type', 
							'ng-pattern' => getRegexPattern("name"),
							'ng-minlength' => '2',
							'ng-maxlength' => '20',
							'ng-class'=>'{"has-error": formLms.content_type.$touched && formLms.content_type.$invalid}',

						]) }}
						<div class="validation-error" ng-messages="formLms.content_type.$error" >
	    					{!! getValidationMessage()!!}
						</div>


					</fieldset>

					 <fieldset ng-if="content_type=='url' || content_type=='iframe' || content_type=='video_url'|| content_type=='audio_url'" class="form-group col-md-6">
							{{ Form::label('file_path', getphrase('resource_link')) }}
							<span class="text-danger">*</span>
							{{ Form::text('file_path', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : www.google.com',
								'ng-model'=>'file_path',
								'required'=> 'true', 
								'ng-class'=>'{"has-error": formLms.file_path.$touched && formLms.file_path.$invalid}',

						)) }}
						<div class="validation-error" ng-messages="formLms.file_path.$error" >
	    					{!! getValidationMessage()!!}
						</div>
						</fieldset>



					<fieldset ng-if="content_type=='file' || content_type=='video' || content_type=='audio'" class="form-group col-md-6">
							{{ Form::label('lms_file', 'LMS file') }}
							<span class="text-danger">*</span>
							 <input type="file" 
							 class="form-control" 
							 name="lms_file"  >
					</fieldset>

					 
					@if($record)
						@if($record->resource_link!='')
						<fieldset class="form-group col-md-6">
							<label>   &nbsp;</label>
						 {{link_to_asset(IMAGE_PATH_UPLOAD_LMS_CONTENTS.$record->resource_link, getPhrase('download'))}} 
						 </fieldset>
						@endif
					@endif

					</div>

					<fieldset class="form-group">

						{{ Form::label('description', getphrase('description')) }}

						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'5', 'placeholder' => 'Eg : Fine description','id'=>'description', )) }}
					</fieldset>

 


					<div class="row">
                                <div class="col-sm-12">
                                   
                                        <div class="form-group">
                                            <div class="col-md-12 clear">
                                                <div class="doc-buttons pull-right"> 
                                                <a href="{{URL_LMS_CONTENT}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                                        <button class="btn btn-success" ng-disabled='!formLms.$valid'>{{ $button_name }}</button>

                                              </div>
                                            </div>
                                        </div>
                                </div>
                              </div>

                            
                              