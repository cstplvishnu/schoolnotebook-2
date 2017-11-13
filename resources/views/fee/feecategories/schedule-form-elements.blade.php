         <div class="row">
					 <fieldset class="form-group col-md-6">
						
						{{ Form::label('title', getphrase('schedule_title')) }}

						<span class="text-danger">*</span>
						
						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '1st Term')) }}
					</fieldset>

					<fieldset class="form-group col-md-6">

						<?php
                         $schedule_number;
                         $max_schedules = getSetting('fee_terms','fee_settings');

                          for($schedule_number=1; $schedule_number<=$max_schedules; $schedule_number++){

                          	$total_schedules[$schedule_number] = $schedule_number;
                          }


						?>

						{{ Form::label('total_schedules', getphrase('total_schedules')) }}

						<span class="text-danger">*</span>

						{{ Form::select('total_schedules', $total_schedules, null, 
						['class'=>'form-control',
						"id"=>"total_schedules", 
						'placeholder'=>getPhrase('select'),
						"ng-model"=>"total_schedules", 
						"ng-change" => "schedulesChanged(total_schedules)",
                        'required'=> 'true', 
                         'ng-class'=>'{"has-error": formSchedule.total_schedules.$touched && formSchedule.total_schedules.$invalid}',
                     ])}}
                    <div class="validation-error" ng-messages="formSchedule.total_schedules.$error" >
                         {!! getValidationMessage()!!}
                     </div>
						

					</fieldset> 

			</div>
        
        <div class="row" ng-repeat = "item in total_schedules">
        <?php $date_from = date('d/m/Y');
		 	$date_to = date('d/m/Y');
		 	?>
        <fieldset class="form-group col-md-4" >
               <label>{{getPhrase('start_date_for_term')}} @{{$index+1}}</label>
		      <input type="date" name="start_date[]" value="{{$date_from}}" id="start_date_@{{$index}}">
         </fieldset>
         <fieldset class="form-group col-md-4" >
		       <label>{{getPhrase('end_date_for_term')}} @{{$index+1}}</label>
		      <input type="date" name="end_date[]" value="{{$date_to}}" id="start_date_@{{$index}}">     
		  </fieldset>
        </div>
	<input type="hidden" name="number_of_schedules" value="@{{total_schedule}}">
	<input type="hidden" name="feecategory_id" value="{{$feecategory->id}}">
      
	
	

					<div class="buttons text-center">
			<button class="btn btn-lg btn-success button"
			ng-disabled='!formSchedule.$valid'>{{ $button_name }}</button>
		</div>