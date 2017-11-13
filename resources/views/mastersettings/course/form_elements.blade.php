 					<div class="col-md-12">
                        <div class="form-group">
                            <fieldset>
                             <label class="col-lg-12">{{getPhrase('select_parent')}}
                                <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">

						
						{{Form::select('parent_id', $course_parent_list, null, ['class'=>'form-control select2','placeholder'=>'select',
						    
						    'ng-model'=>'parent_id', 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formCourses.parent_id.$touched && formCourses.parent_id.$invalid}',

							 ])}}

						<div class="validation-error" ng-messages="formCourses.parent_id.$error" >

	    					{!! getValidationMessage()!!}

	    				  </div>
                       </div>
                   </fieldset>
               </div>
          </div>      

					<div class="col-md-12">
                        <div class="form-group">
                            <fieldset>
                             <label class="col-lg-12">{{getPhrase('course_title')}}
                                <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">


						{{ Form::text('course_title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : MBA',

							'ng-model'=>'course_title', 

							'ng-pattern'=>getRegexPattern('name1'), 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formCourses.course_title.$touched && formCourses.course_title.$invalid}',

							'ng-minlength' => '2',

							'ng-maxlength' => '30',

							)) }}

						<div class="validation-error" ng-messages="formCourses.course_title.$error" >

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
                             <label class="col-lg-12">{{getPhrase('course_code')}}
                                <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
						{{ Form::text('course_code', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : MBA',

							'ng-model'=>'course_code', 

							'ng-pattern'=>getRegexPattern('name'), 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formCourses.course_code.$touched && formCourses.course_code.$invalid}',

							'ng-minlength' => '2',

							'ng-maxlength' => '20',

							)) }}

						<div class="validation-error" ng-messages="formCourses.course_code.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

	    					{!! getValidationMessage('minlength',2,20)!!}

	    					{!! getValidationMessage('maxlength',2,20)!!}
           
						</div>

					</div>
                    </fieldset>
               </div>
          </div>      
					<div class="col-md-12" ng-if="parent_id!=0">
                        <div class="form-group">
					        <fieldset >
						     <label class="col-lg-12">{{getPhrase('course_duration')}}
                                <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">

						{{Form::select('course_dueration', 
						array('1'=>1, '2'=>2, '3'=>3, '4',4, '5'=>5,6=>'6','7'=>7,'8'=>8, '9'=>9, '10'=>10), 
						null, ['class'=>'form-control select2',
						'placeholder'=>'select',

						    'ng-model'=>'course_dueration', 
                              'id'    => 'course_duration', 
							
							'required'=> 'true', 

							'ng-class'=>'{"has-error": formCourses.course_dueration.$touched && formCourses.course_dueration.$invalid}'])}}

						<div class="validation-error" ng-messages="formCourses.course_dueration.$error" >

	    					{!! getValidationMessage()!!}
                      </div>
                          </div>
				      </fieldset>
                    </div>
               </div>

                     <div class="col-md-12" ng-if="parent_id!=0">
                        <div class="form-group">
                            <fieldset >
                             <label class="col-lg-12">{{getPhrase('grade_system')}}
                                <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">


				
						{{Form::select('grade_system', 
						array('percentage'=> 'Percentage', 'gpa'=>'GPA'), 
						null, ['class'=>'form-control select2' ,
						'placeholder'=>'select',

						    'ng-model'=>'grade_system', 

							
							'required'=> 'true', 

							'ng-class'=>'{"has-error": formCourses.grade_system.$touched && formCourses.grade_system.$invalid}'])}}

						<div class="validation-error" ng-messages="formCourses.grade_system.$error" >

	    					{!! getValidationMessage()!!}

	    				</div>
					  </div>
                      </fieldset>
                    </div>
               </div>
                   
                   @if($record)
                        <?php


                        if($record->is_having_semister== 1){
                            $active  = 'active';
                            $activee  = '';
                        }
                        elseif ($record->is_having_semister== 0) {
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
                             <label class="col-lg-12">{{getPhrase('is_having_semister')}}
                                </label>
                                    <div class="col-lg-12">

					
                                  <div class="m-b-sm">
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-sm btn-info {{$active}} " for="free">
                                                   
                            {{ Form::radio('is_having_semister', 1, true, array('id'=>'free' )) }}<i class="fa fa-check text-active"></i> Yes </label>

                                <label class="btn btn-sm btn-success {{$activee}}" for="paid">

                            {{ Form::radio('is_having_semister', 0, false, array('id'=>'paid'
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


                        if($record->is_having_elective_subjects == 1){
                            $active1  = 'active';
                            $activee1  = '';
                        }
                        elseif ($record->is_having_elective_subjects == 0) {
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
                             <label class="col-lg-12">{{getPhrase('is_having_elective_subjects')}}
                                </label>
                                    <div class="col-lg-12">
 					   
                                  <div class="m-b-sm">
                                            <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-sm btn-info {{$active1}} " for="free1">
                                                   
                                {{ Form::radio('is_having_elective_subjects', 1, true, array('id'=>'free1' )) }}<i class="fa fa-check text-active"></i> Yes </label>

                                <label class="btn btn-sm btn-success {{$activee1}}" for="paid1">
                                 {{ Form::radio('is_having_elective_subjects', 0, false, array('id'=>'paid1'
                          )) }}<i class="fa fa-check text-active"></i> No
                             </label>
                                                
                                            </div>
                                        </div>

						   </div>
                      </fieldset>
                    </div>
               </div>   
					
                     
                    
                    <div class="col-md-12" ng-if="parent_id!=0">
                        <div class="form-group">
                            <fieldset >
                             <label class="col-lg-12">{{getPhrase('description')}}
                                </label>
                                    <div class="col-lg-12">

                   
						
						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : Description', 'rows'=>'5')) }}

                     </div>
                      </fieldset>
                    </div>
               </div>   
					
						<div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_MASTERSETTINGS_COURSE}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formCourses.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>

		 