 					
 					<div class="col-md-12">
                        <div class="form-group">
                            <fieldset>
                             <label class="col-lg-12">{{getPhrase('language')}}
                                <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">


						{{ Form::text('language', $value = null , $attributes = array('class'=>'form-control','name'=>'language', 
							'placeholder' => getPhrase('Eg:_spanish'), 
							'ng-model'=>'language', 
							'required'=> 'true', 
              'ng-pattern' => getRegexPattern('name1'),
							'id'=>'language',
							'ng-class'=>'{"has-error": formLanguage.language.$touched && formLanguage.language.$invalid}',
							'ng-minlength' => '4',
							'ng-maxlength' => '40',
							)) }}
						<div class="validation-error" ng-messages="formLanguage.language.$error" >
	    					{!! getValidationMessage()!!}
                {!! getValidationMessage('pattern')!!}
	    					{!! getValidationMessage('minlength',4,40)!!}
	    					{!! getValidationMessage('maxlength',4,40)!!}
						</div>

				       </div>
                        </fieldset>
                   </div>
                  
               </div>

					<div class="col-md-12">
                        <div class="form-group">
                             <fieldset>
                             <label class="col-lg-12">{{getPhrase('language_code')}}
                                <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
						{{ Form::text('code', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('Eg:_sp'),
							'name'=>'code',
							'ng-model'=>'code',
							'id'=>'code', 
							'required'=> 'true', 
              'ng-pattern' => getRegexPattern('name1'),
							'ng-minlength' => '2',
							'ng-maxlength' => '4',
							'ng-class'=>'{"has-error": formLanguage.code.$touched && formLanguage.code.$invalid}',
						 		
						)) }}
						
						<div class="validation-error" ng-messages="formLanguage.code.$error" >
	    					{!! getValidationMessage()!!}
                {!! getValidationMessage('pattern')!!}
	    					{!! getValidationMessage('minlength',2,4)!!}
	    					{!! getValidationMessage('maxlength',2,4)!!}
						</div>

					</div>
                    </fieldset>
               </div>
          </div>


						<a class="pull-right btn btn-success helper_step2" style="margin-top:10px;" href="https://www.loc.gov/standards/iso639-2/php/code_list.php" target="_blank">
						{{getPhrase('supported_language_codes')}}
						</a>
					    



                @if($record)
                        <?php


                        if($record->is_rtl== 1){
                            $active  = 'active';
                            $activee  = '';
                        }
                        elseif ($record->is_rtl== 0) {
                            $activee  = 'active';
                            $active  = '';
                        }

                       ?>
                       
                       @else

                       <?php  $active  = '';
                        $activee  = 'active';
                        
                        ?>

                      @endif

                        

                 <div class="col-md-6" ng-if="parent_id!=0">
                        <div class="form-group">
                            <fieldset >
                             <label class="col-lg-12">{{getPhrase('is_rtl')}}
                                </label>
                                    <div class="col-lg-12">

					
                                  <div class="m-b-sm">
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-sm btn-info {{$active}} " for="free">
                                                   
                            {{ Form::radio('is_rtl', 1, true, array('id'=>'free' )) }}<i class="fa fa-check text-active"></i> Yes </label>

                                <label class="btn btn-sm btn-success {{$activee}}" for="paid">

                            {{ Form::radio('is_rtl', 0, false, array('id'=>'paid'
                          )) }}<i class="fa fa-check text-active"></i> No
                             </label>
                                                
                                            </div>
                                        </div>
                              </div>
                      </fieldset>
                    </div>
               </div>   

					
					  <div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_LANGUAGES_LIST}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formLanguage.$valid'>{{getPhrase('save') }}</button>
                              </div>
                            </div>
                        </div>
		 