              
               <fieldset class="form-group">
                  <label class="col-lg-12">Category Name <span class="text-danger">*</span></label>
                  <div class="col-lg-12">
                     {{ Form::text('category', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('Eg :_enter_category_name'),
        							'ng-model'=>'category', 
        							'ng-pattern' => getRegexPattern('name1'),
                      'ng-minlength' => '2',
                      'ng-maxlength' => '20',
        							'required'=> 'true', 
        							'ng-class'=>'{"has-error": formCategories.category.$touched && formCategories.category.$invalid}',
        							 
        							)) }}
							<div class="validation-error" ng-messages="formCategories.category.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('pattern')!!}
                {!! getValidationMessage('minlength',2,20)!!}
                {!! getValidationMessage('maxlength',2,20)!!}
						</div>
                  </div>
                </fieldset>

                <fieldset class="form-group col-lg-6" >

           {{ Form::label('image', getphrase('image')) }}

                 <input type="file" class="form-control" name="catimage" 
                  accept=".png,.jpg,.jpeg" id="image_input">

                  

                 <div class="validation-error" ng-messages="formLms.image.$error" >

                {!! getValidationMessage('image')!!}

             </div>

            </fieldset>

                     <fieldset class="form-group col-lg-6" >
					@if($record)	
				   		@if($record->image)
				         <?php $examSettings = getExamSettings(); ?>
				         <img src="{{ PREFIX.$examSettings->categoryImagepath.$record->image }}" height="100" width="100" class="img-circle" >

				         @endif
				     @endif
					

				    </fieldset>
                
              <fieldset class="form-group col-lg-12">
                  <label>Description</label>
                  <div>
                    {{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => 'Eg : Description')) }}
                  </div>
                </fieldset>

                 <div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_QUIZ_CATEGORIES}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formCategories.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>
            
              