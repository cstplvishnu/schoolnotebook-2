@extends($layout)


@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li>{{getphrase('attendance')}}</li>
  </ul>


    <div class="row" ng-controller="academicAttendance">
                  <div class="col-sm-9 col-sm-offset-1">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body instruction">

              <div class="col-md-6">
                <h3>{{ getPhrase('general_instructions') }}</h3>
                        <ul class="guide">
                            <li>
                                <span class="answer">
                                    <i class="fa fa-check">
                                    </i>
                                </span>
                                {{getPhrase('present')}}
                            </li>
                            <li>
                                <span class="notanswer">
                                    <i class="fa fa-close">
                                    </i>
                                </span>
                                {{getPhrase('absent')}}
                            </li>
                            <li>
                                <span class="marked">
                                    <i class="fa fa-eye">
                                    </i>
                                </span>
                                {{getPhrase('leave')}}
                            </li>
                            
                        </ul>
                    </div>
                     {!! Form::open(array('url' => URL_STUDENT_ATTENDENCE_ADD.$userdata->slug, 'method' => 'POST')) !!}


                     @if($role_name!='staff')

                    <div class="col-md-6">

                    @include('common.year-selection-view')

                 </div>

                 @else

                 <div class ="col-md-6">

                 <fieldset class="form-group col-md-12">
                        {{ Form::label('select_subject', getphrase('select_subject')) }}
                        
                        <span class="text-danger">*</span>

                        {{Form::select('course_subject_id',$subjects,  null, 
                        [   'class'     => 'form-control',
                            
                            'id'        =>'select_academic_year'
                           
                        ])}}
                        </fieldset>
                        
            

                    <?php 
                    $number_of_class=[];
                    $maximum_classes = 8;

                    for($class_number = 1; $class_number<=$maximum_classes; $class_number++)
                    $number_of_class[$class_number]=$class_number; ?>

            <fieldset  class="form-group col-md-12">
               {{ Form::label('class', getphrase('total_class')) }}
                     <span class="text-danger">*</span>               
                {{Form::select('total_class',$number_of_class,  null, 
                                    ['class'=>'form-control'])}}
                    </fieldset>

                        <fieldset class="form-group col-md-12">
                                     
                        {{ Form::label('attendance_date', getphrase('attendance_date')) }}
                        <div class="input-group date">
                        {{ Form::text('attendance_date', null , $attributes = array('class'=>'input-sm  datepicker-input form-control', 'placeholder' => '2016-06-12', 'id'=>'dp')) }}
                            <div class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </div>
                        </div>
                        </fieldset>
            
                </div>

                @endif

                <hr>
                       
                            
                                <div class="text-right">
                                    <button type="submit" class="btn btn-info">{{getPhrase('get_details')}}
                                    </button>
                                </div>
                            
                        
                        {!! Form::close() !!}
                    
                </hr>
            
@stop
 
 

@section('footer_scripts')
 
 
    @include('attendance.scripts.js-scripts')
    
@stop