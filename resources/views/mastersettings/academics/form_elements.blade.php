 			<fieldset class="form-group">
				
				{{ Form::label('academic_year_title', getphrase('academic_title')) }}
				<span class="text-danger">*</span>
				
				{{ Form::text('academic_year_title', $value = null , $attributes = array('class'=>'form-control', 

				             'placeholder' => 'Eg : 2016-2017 CSE',

					         'ng-model'=>'academic_year_title', 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formAcademics.academic_year_title.$touched && formAcademics.academic_year_title.$invalid}',

							'ng-minlength' => '4',

							'ng-maxlength' => '40',

							)) }}

						<div class="validation-error" ng-messages="formAcademics.academic_year_title.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('minlength')!!}

	    					{!! getValidationMessage('maxlength')!!}
           
						</div>
			</fieldset>

			<div class="row">
				 <fieldset class="form-group col-md-6">
				
					{{ Form::label('academic_start_date', getphrase('start_date')) }}

						<span class="text-danger">*</span>
				 
                   {{ Form::text('academic_start_date', null , $attributes = array('class'=>'input-sm  datepicker-input form-control', 'placeholder' => 'Eg : 2015-06-12', 'id'=>'dpd1',

                   	          'ng-model'=>'academic_start_date','readonly'=>true,

							)) }}
 

			</fieldset>

			 					 <fieldset class="form-group col-md-6">
				
				{{ Form::label('academic_end_date', getphrase('end_date')) }}
				
				<span class="text-danger">*</span>
					 
				{{ Form::text('academic_end_date', null , $attributes = array('class'=>'input-sm  datepicker-input form-control', 'placeholder' => 'Eg : 2015-06-12', 'id'=>'dpd2',

					          'ng-model'=>'academic_end_date','readonly'=>true,

							
							)) }}

                       </fieldset>

			
                      
                       @if($record)
                        <?php


                        if($record->show_in_list== 1){
                        	$active  = 'active';
                        	$activee  = '';
                        }
                        elseif ($record->show_in_list== 0) {
                        	$activee  = 'active';
                        	$active  = '';
                        }


                        ?>
                       
                       @else

                       <?php  $active  = 'active';
                        $activee  = '';
                        
                        ?>

                      @endif

                    <fieldset class='form-group col-md-6'>
						{{ Form::label('show_in_list', getphrase('show_in_list')) }}
						<span class="text-danger">*</span>
						
                          <div class="m-b-sm">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-sm btn-info {{$active}} " for="free">

                                            {{ Form::radio('show_in_list', '1', true, array('id'=>'free', 'ng-model' => 'fine_eligiblity' )) }}<i class="fa fa-check text-active"></i> Yes </label>
                                        <label class="btn btn-sm btn-success {{$activee}}" for="paid">
                                          {{ Form::radio('show_in_list', '0', false, array('id'=>'paid', 
                                            'ng-model' => 'fine_eligiblity')) }}<i class="fa fa-check text-active"></i> No
                                             </label>     
                                           </div>
                                        </div>
                                    </fieldset>
                                </div>
				 
				<div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_MASTERSETTINGS_ACADEMICS}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formAcademics.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>