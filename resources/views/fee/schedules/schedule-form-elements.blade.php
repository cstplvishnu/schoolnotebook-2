     
         <div class="row">
           
                  
                  @if($records)
                      <?php $count = count($records);?>

                      <fieldset class="form-group col-md-12">
                         {{ Form::label('total_schedules', getphrase('total_schedules')) }}
              <span class="text-red">*</span>
              {{ Form::text('total_schedules', $value = $count  , $attributes = array('class'=>'form-control','readonly'=>'true')) }}
            
          </fieldset> 


                  @else

          <fieldset class="form-group col-md-6">

            <?php
                         $schedule_number;
                         $max_schedules = getSetting('fee_terms','fee_settings');

                          for($schedule_number=1; $schedule_number<=$max_schedules; $schedule_number++){

                            $total_schedules[$schedule_number] = $schedule_number;
                          }


            ?>

            {{ Form::label('total_schedules', getphrase('total_schedules')) }}

            <span class="text-red">*</span>

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
        @endif

        @if($records)
           
           @foreach($records as $record)
             <h5>{{getPhrase('term')}} - {{$record->installment}}</h5>
          <div class="row">
             
                 <fieldset class="form-group col-md-6">
                         {{ Form::label('start_date', getphrase('start_date')) }}
              <span class="text-red">*</span>
              {{ Form::text('start_date', $value = $record->start_date , $attributes = array('class'=>'form-control','readonly'=>'true')) }}
            
          </fieldset> 

           <fieldset class="form-group col-md-6">
                         {{ Form::label('end_date', getphrase('end_date')) }}
              <span class="text-red">*</span>
              {{ Form::text('end_date', $value = $record->end_date , $attributes = array('class'=>'form-control','readonly'=>'true')) }}
            
          </fieldset> 

            
          </div>

          @endforeach

          <?php $any_payments = App\FeePayment::where('feecategory_id','=',$feecategory->id)->get(); 

          ?>
      @if(!count($any_payments))
     <fieldset class="form-group">
        <a class="btn btn-primary" href="#" onclick="deleteSchedule('<?php echo $feecategory->id;?>')" >{{getPhrase('delete_schedules')}}</a>
      
    </fieldset>
      @endif

        @else
        <div class="row" ng-repeat = "item in final_schedules">
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
      
  
  

         <div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                       <button class="btn btn-success" ng-disabled='!formSchedule.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>
    @endif