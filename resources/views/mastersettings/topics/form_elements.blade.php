 					<div class="col-md-12">
                        <div class="form-group">
                            <fieldset>
                             <label class="col-lg-12">{{getPhrase('subject')}}
                                <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">

					{{Form::select('subject_id', $subjects, null, ['class'=>'form-control','onChange'=>'getSubjectParents()', 'id'=>'subject',
							'ng-model'=>'subject_id',
							'required'=> 'true', 
							'ng-class'=>'{"has-error": formTopics.subject_id.$touched && formTopics.subject_id.$invalid}'
						])}}
						 <div class="validation-error" ng-messages="formTopics.subject_id.$error" >
	    					{!! getValidationMessage()!!}
						</div>
                       </div>
                   </fieldset>
               </div>
          </div>      

					<div class="col-md-12">
                        <div class="form-group">
                            <fieldset>
                             <label class="col-lg-12">{{getPhrase('select_parent')}}
                                <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">


						{{Form::select('parent_id', $parent_topics, null, ['class'=>'form-control', 'id'=>'parent' ])}}

				       </div>
                        </fieldset>
                   </div>
                  
               </div>

					<div class="col-md-12">
                        <div class="form-group">
                             <fieldset>
                             <label class="col-lg-12">{{getPhrase('topic_name')}}
                                <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
						{{ Form::text('topic_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg : Introduction',
							'ng-model'=>'topic_name',
							'required'=> 'true', 
							'ng-class'=>'{"has-error": formTopics.topic_name.$touched && formTopics.topic_name.$invalid}',
						 ))}}
						  <div class="validation-error" ng-messages="formTopics.topic_name.$error" >
	    					{!! getValidationMessage()!!}
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
                                <a href="{{URL_TOPICS}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formTopics.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>

		 