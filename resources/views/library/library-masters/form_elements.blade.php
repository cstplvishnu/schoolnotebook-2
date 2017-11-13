 					
 					<div class="row">

					<fieldset class="form-group col-md-6" >

						{{ Form::label('asset_type_id',  getphrase('asset_type')) }}

						<span class="text-danger">*</span>

						{{Form::select('asset_type_id', $asset_types, null, ['placeholder' => getPhrase('select'),'class'=>'form-control', 

						       'ng-model'=>'asset_type_id',

						       'id'=>'asset_type_id' ,
  
							   'required'=> 'true', 

							   'ng-class'=>'{"has-error": formLibraryMaster.asset_type_id.$touched && formLibraryMaster.asset_type_id.$invalid}',
                           ]) }}

						<div class="validation-error" ng-messages="formLibraryMaster.asset_type_id.$error" >

	    					{!! getValidationMessage()!!}

						</div>
                     </fieldset>

 					<fieldset class="form-group col-md-6">

						

						{{ Form::label('title', getphrase('title')) }}

						<span class="text-danger">*</span>

						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('Eg : C++'),

							'ng-model'=>'title',
							'id'=>'title' ,

							'ng-pattern'=>getRegexPattern('name1'), 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formLibraryMaster.title.$touched && formLibraryMaster.title.$invalid}',

							'ng-minlength' => '2',

							'ng-maxlength' => '40',

							)) }}

						<div class="validation-error" ng-messages="formLibraryMaster.title.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

	    					{!! getValidationMessage('minlength',2,40)!!}

	    					{!! getValidationMessage('maxlength',2,40)!!}

						</div>

					</fieldset>

                 </div>
                  
                  <div class="row">
					 <fieldset class="form-group col-md-6" >
				   {{ Form::label('image', getphrase('image')) }}
				         <input type="file" class="form-control" name="image" id="image">
				         
				    </fieldset>
					 <fieldset class="form-group col-md-6" >
					@if($record)	
				   		@if($record->image)
				         <?php 
				         $image_path = IMAGE_PATH_UPLOAD_LIBRARY_DEFAULT_THUMB;
				         if($record->image)
				         	$image_path = IMAGE_PATH_UPLOAD_LIBRARY.$record->image;
				          ?>
				         <img src="{{$image_path}}" height="100" width="100">
				         @endif
				     @endif
				    </fieldset>
                   </div>
 				 
				<div class="row">
					

					 <fieldset class="form-group col-md-6" >

						{{ Form::label('author_id',  getphrase('author')) }}

						<span class="text-danger">*</span>

						{{Form::select('author_id', $authors, null, ['placeholder' => getPhrase('select'),'class'=>'form-control', 

						       'ng-model'=>'author_id',

						       'id'=>'author_id' ,
  
							   'required'=> 'true', 

							   'ng-class'=>'{"has-error": formLibraryMaster.author_id.$touched && formLibraryMaster.author_id.$invalid}',
                           ]) }}

						<div class="validation-error" ng-messages="formLibraryMaster.author_id.$error" >

	    					{!! getValidationMessage()!!}

						</div>
                     </fieldset>	

					

                      <fieldset class="form-group col-md-6" >

						{{ Form::label('publisher_id',  getphrase('publisher')) }}

						<span class="text-danger">*</span>

						{{Form::select('publisher_id', $publishers, null, ['placeholder' => getPhrase('select'),'class'=>'form-control', 

						       'ng-model'=>'publisher_id',

						       'id'=>'publisher_id' ,
  
							   'required'=> 'true', 

							   'ng-class'=>'{"has-error": formLibraryMaster.publisher_id.$touched && formLibraryMaster.publisher_id.$invalid}',
                           ]) }}

						<div class="validation-error" ng-messages="formLibraryMaster.publisher_id.$error" >

	    					{!! getValidationMessage()!!}

						</div>
                     </fieldset>	


				</div>
				<div class="row">
	  				 
                     
                     <fieldset class="form-group col-md-6">

						{{ Form::label('isbn', getphrase('ISBN_number')) }}

						<span class="text-danger">*</span>

						{{ Form::number('isbn', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : 10022441',

							'ng-model'=>'isbn',
							'id'=>'isbn' ,
                             
                             'required'=> 'true', 

							'ng-class'=>'{"has-error": formLibraryMaster.isbn.$touched && formLibraryMaster.isbn.$invalid}',

							

							)) }}

						<div class="validation-error" ng-messages="formLibraryMaster.isbn.$error" >

	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('number')!!}

                            

						</div>

					</fieldset>

	  				
                     <fieldset class="form-group col-md-6">

						{{ Form::label('edition', getphrase('edition')) }}

						<span class="text-danger">*</span>

						{{ Form::text('edition', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : 2017',

							'ng-model'=>'edition',
							'id'=>'edition' ,
                             
                             'required'=> 'true', 

							'ng-class'=>'{"has-error": formLibraryMaster.edition.$touched && formLibraryMaster.edition.$invalid}',

							

							)) }}

						<div class="validation-error" ng-messages="formLibraryMaster.edition.$error" >

	    					{!! getValidationMessage()!!}

                            

						</div>

					</fieldset>

				</div>
				<div class="row">
  				
                 
                 <fieldset class="form-group col-md-6">

						{{ Form::label('actual_price', getphrase('actual_price')) }}

						<span class="text-danger">*</span>

						{{ Form::number('actual_price', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : 200',

							'ng-model'=>'actual_price',
							'id'=>'actual_price' ,
                             'required'=> 'true', 

							'ng-class'=>'{"has-error": formLibraryMaster.actual_price.$touched && formLibraryMaster.actual_price.$invalid}',

							

							)) }}

						<div class="validation-error" ng-messages="formLibraryMaster.actual_price.$error" >

	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('number')!!}

                           

						</div>

					</fieldset>


                 
                 <fieldset class="form-group col-md-6">

						{{ Form::label('chargible_price_if_lost', getphrase('chargeable_price_if_lost')) }}

						<span class="text-danger">*</span>

						{{ Form::number('chargible_price_if_lost', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : 500',

							'ng-model'=>'chargible_price_if_lost',
							'id'=>'chargible_price_if_lost' ,
                             'required'=> 'true', 

							'ng-class'=>'{"has-error": formLibraryMaster.chargible_price_if_lost.$touched && formLibraryMaster.chargible_price_if_lost.$invalid}',

							

							)) }}

						<div class="validation-error" ng-messages="formLibraryMaster.chargible_price_if_lost.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('number')!!}

                       

						</div>

					</fieldset>

				</div>
					<fieldset class="form-group">
						
						{{ Form::label('description', getphrase('description')) }}
						
						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => 'Eg : Fine description')) }}
					</fieldset>

					 <div class="row">
                         <div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_LIBRARY_MASTERS}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formLibraryMaster.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>
                    </div>

		 