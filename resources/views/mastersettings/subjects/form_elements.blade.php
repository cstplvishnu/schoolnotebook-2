	<div class="col-md-12">
                        <div class="form-group">
                            <fieldset>
                             <label class="col-lg-12">{{getPhrase('subject_title')}}
                                <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">


						{{ Form::text('subject_title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : MBA',

							'ng-model'=>'subject_title', 

							'ng-pattern'=>getRegexPattern('name1'), 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formSubjects.subject_title.$touched && formSubjects.subject_title.$invalid}',

							'ng-minlength' => '2',

							'ng-maxlength' => '30',

							)) }}

						<div class="validation-error" ng-messages="formSubjects.subject_title.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

	    					{!! getValidationMessage('minlength',2,30)!!}

	    					{!! getValidationMessage('maxlength',2,30)!!}
           
						</div>

				       </div>
                        </fieldset>
                   </div>
                  
               </div>

					<div class="col-md-12">
                        <div class="form-group">
                             <fieldset>
                             <label class="col-lg-12">{{getPhrase('subject_code')}}
                                <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
						{{ Form::text('subject_code', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : MBA',

							'ng-model'=>'subject_code', 

							'ng-pattern'=>getRegexPattern('name'), 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formSubjects.subject_code.$touched && formSubjects.subject_code.$invalid}',

							'ng-minlength' => '2',

							'ng-maxlength' => '20',

							)) }}

						<div class="validation-error" ng-messages="formSubjects.subject_code.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

	    					{!! getValidationMessage('minlength',2,20)!!}

	    					{!! getValidationMessage('maxlength',2,20)!!}
           
						</div>

					</div>
                    </fieldset>
               </div>
          </div>      


           @if($record)
                        <?php


                        if($record->is_lab== 1){
                            $active  = 'active';
                            $activee  = '';
                        }
                        elseif ($record->is_lab== 0) {
                            $activee  = 'active';
                            $active  = '';
                        }

                       ?>
                       
                       @else

                       <?php  $active  = 'active';
                        $activee  = '';
                        
                        ?>

                      @endif

                        

                 <div class="col-md-6" ng-if="parent_id!=0">
                        <div class="form-group">
                            <fieldset >
                             <label class="col-lg-12">{{getPhrase('is_lab')}}
                                </label>
                                    <div class="col-lg-12">

					
                                  <div class="m-b-sm">
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-sm btn-info {{$active}} " for="free">
                                                   
                            {{ Form::radio('is_lab', 1, true, array('id'=>'free' )) }}<i class="fa fa-check text-active"></i> Yes </label>

                                <label class="btn btn-sm btn-success {{$activee}}" for="paid">

                            {{ Form::radio('is_lab', 0, false, array('id'=>'paid'
                          )) }}<i class="fa fa-check text-active"></i> No
                             </label>
                                                
                                            </div>
                                        </div>
                              </div>
                      </fieldset>
                    </div>
               </div>   
 					 
                     @if($record)
                        <?php


                        if($record->is_elective_type == 1){
                            $active1  = 'active';
                            $activee1  = '';
                        }
                        elseif ($record->is_elective_type == 0) {
                            $activee1  = 'active';
                            $active1  = '';
                        }

                       ?>
                       
                       @else

                       <?php  $active1  = 'active';
                        $activee1  = '';
                        
                        ?>

                      @endif  

                <div class="col-md-6" ng-if="parent_id!=0">
                        <div class="form-group">
                            <fieldset >
                             <label class="col-lg-12">{{getPhrase('is_elective')}}
                                </label>
                                    <div class="col-lg-12">
 					   
                                  <div class="m-b-sm">
                                            <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-sm btn-info {{$active1}} " for="free1">
                                                   
                                {{ Form::radio('is_elective_type', 1, true, array('id'=>'free1' )) }}<i class="fa fa-check text-active"></i> Yes </label>

                                <label class="btn btn-sm btn-success {{$activee1}}" for="paid1">
                                 {{ Form::radio('is_elective_type', 0, false, array('id'=>'paid1'
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
                                <a href="{{URL_SUBJECTS}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formSubjects.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>