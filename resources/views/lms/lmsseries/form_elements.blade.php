 					<div class="row">

 					 <fieldset class="form-group col-md-6">

						

						{{ Form::label('title', getphrase('title')) }}

						<span class="text-danger">*</span>

						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('Eg :_verbal'),

							'ng-model'=>'title',
							'id'=>'title' ,

							'ng-pattern'=>getRegexPattern('name1'), 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formLms.title.$touched && formLms.title.$invalid}',

							'ng-minlength' => '2',

							'ng-maxlength' => '40',

							)) }}

						<div class="validation-error" ng-messages="formLms.title.$error">

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

	    					{!! getValidationMessage('minlength',2,40)!!}

	    					{!! getValidationMessage('maxlength',2,40)!!}

						</div>

					</fieldset>

					<fieldset class="form-group col-md-6" >

						{{ Form::label('lms_category_id', 'LMS Category') }}

						<span class="text-danger">*</span>

						{{Form::select('lms_category_id', $categories, null, ['placeholder' => getPhrase('select'),'class'=>'form-control', 

						       'ng-model'=>'lms_category_id',

						       'id'=>'lms_category_id' ,
  
							   'required'=> 'true', 

							   'ng-class'=>'{"has-error": formLms.lms_category_id.$touched && formLms.lms_category_id.$invalid}',
                           ]) }}

						<div class="validation-error" ng-messages="formLms.lms_category_id.$error" >

	    					{!! getValidationMessage()!!}

						</div>
                     </fieldset>
                   </div>
             
             <div  class="row">

                  <?php $payment_options = array('1'=>'Paid', '0'=>'Free');?>

					 <fieldset class="form-group col-md-6" >

						{{ Form::label('is_paid', getphrase('is_paid')) }}

						<span class="text-danger">*</span>

						{{Form::select('is_paid', $payment_options, null, ['class'=>'form-control', 

						    'ng-model'=>'is_paid',

                            'id'=>'is_paid' ,

							'required'=> 'true', 

							 'ng-class'=>'{"has-error": formLms.is_paid.$touched && formLms.is_paid.$invalid}',
                            ]) }}

						<div class="validation-error" ng-messages="formLms.is_paid.$error" >

	    					{!! getValidationMessage()!!}

						</div>
                  </fieldset>
                   <div ng-if="is_paid==1">

	  				 <fieldset class="form-group col-md-3">

							

							{{ Form::label('validity', getphrase('validity')) }}

							<span class="text-danger">*</span>

							{{ Form::number('validity', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('Eg : 10'),

							'ng-model'=>'validity',

							'min'     =>'-1',
                            'required'=> 'true',
                            'id'=>'validity' , 

							'ng-class'=>'{"has-error": formLms.validity.$touched && formLms.validity.$invalid}',

							 

							)) }}

						<div class="validation-error" ng-messages="formLms.validity.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('number')!!}

						</div>

					</fieldset>	

	  				 <fieldset class="form-group col-md-3">

						

						{{ Form::label('cost', getphrase('cost')) }}

						<span class="text-danger">*</span>

						{{ Form::number('cost', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : 40',

							'min'=>'0',

						'ng-model'=>'cost',

						'id'=>'cost' , 

						'required'=> 'true', 

						'ng-class'=>'{"has-error": formLms.cost.$touched && formLms.cost.$invalid}',

							 

							)) }}

						<div class="validation-error" ng-messages="formLms.cost.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('number')!!}

						</div>

				</fieldset>

				</div>

				</div>

				<div class="row">

				 <fieldset class="form-group col-md-6">

							{{ Form::label('total_items', getphrase('total_items')) }}

							<span class="text-danger">*</span>

							{{ Form::text('total_items', $value = null , $attributes = array('class'=>'form-control','readonly'=>'true' ,'placeholder' => getPhrase('It will be updated by adding the LMS items'))) }}

					</fieldset>

                <fieldset class="form-group col-md-4" >

				   {{ Form::label('image', getphrase('image')) }}

				         <input type="file" class="form-control" name="image" 
				          accept=".png,.jpg,.jpeg" id="image_input">

				          

				         <div class="validation-error" ng-messages="formCategories.image.$error" >

	    					{!! getValidationMessage('image')!!}

    				 </div>

				    </fieldset>

                    <fieldset class="form-group col-md-2" >

					@if($record)

				   		@if($record->image)

				         <?php $examSettings = getExamSettings(); ?>

				         <img src="{{ IMAGE_PATH_UPLOAD_LMS_SERIES.$record->image }}" height="100" width="100" >

                       @endif

				     @endif

				    </fieldset>

			    </div>

             <div class="row">
				
				 <fieldset class="form-group col-md-6">
					{{ Form::label('start_date', getphrase('start_date')) }}
					{{ Form::text('start_date', null , $attributes = array('class'=>'input-sm  datepicker-input form-control', 'placeholder' => 'Eg : 2016-06-12','readonly'=>true,'id'=>'dpd1')) }}
				</fieldset>

				<fieldset class="form-group col-md-6">
					{{ Form::label('end_date', getphrase('end_date')) }}
					{{ Form::text('end_date', null , $attributes = array('class'=>'input-sm  datepicker-input form-control', 'placeholder' => 'Eg : 2016-06-12','readonly'=>true,'id'=>'dpd2')) }}
				</fieldset>
			</div>

 					<div class="row">

					<fieldset class="form-group  col-md-6 helper_step1">

						

						{{ Form::label('short_description', getphrase('short_description')) }}

						

						{{ Form::textarea('short_description', $value = null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'5', 'placeholder' => getPhrase('short_description'))) }}

					</fieldset>

					<fieldset class="form-group  col-md-6 helper_step2">

						

						{{ Form::label('description', getphrase('description')) }}

						

						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'5', 'placeholder' => getPhrase('description'))) }}

					</fieldset>
                      </div>
                     <div class="row">
                                     <div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_LMS_SERIES}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formLms.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>
                                </div>

		 