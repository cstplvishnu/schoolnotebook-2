@extends($layout)

@section('header_scripts')
<link href="{{CSS}}animate.css" rel="stylesheet"> 

@stop

@section('content')

<style>
    .calendar{display:none;}
</style>
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
       <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>
       <li class="active">{{isset($title) ? $title : ''}}</li>
    </ul>
    
<div class="row" ng-controller="TimetableController" ng-init="ingAngData()">

    <div class="col-sm-8">  
        <section class="panel panel-default">

            {!! Form::open(array('url' => URL_UPDATE_TIMETABLE, 'method' => 'POST', 'name'=>'idCards ', 'novalidate'=>'')) !!}
                <header class="panel-heading clear">
            <div class="clear">
                 
           
                <div class="pull-right">
                     <a  href="{{URL_TIMETABLE_VIEW}}" 
                class="btn btn-default"
                ng-click="toggleCalender()"
                ng-show = "showCalender"> {{getPhrase('cancel')}} </a>
                     <a href="javascript:void(0);" class="btn btn-info" type="button"  data-toggle="modal" data-target="#author_profile" ng-show = "showCalender" >{{getPhrase('print')}}</a>
                <button class="btn btn-success" type="submit" ng-show = "showCalender">{{getPhrase('save')}}</button> &nbsp;

                
                </div>
                
            </div>
            <strong>{{$title}}</strong></header>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel-body ss-custom-scroll"> 

 

    <div class="panel panel-custom">
            
    <div class="panel-body instruction vertical-scroll" id="window_auto_height" >
          
                
               
    @include('timetable.timetable-allotment.selection-view')

    @include('timetable.timetable-allotment.calender-view')


  </div>

</div>

   {!! Form::close() !!}                         
                       
    <hr>

 {!! Form::open(array('url' => URL_TIMETABLE_PRINT, 'method' => 'POST', 'name'=>'idCards ', 'novalidate'=>'','target'=>'_blank')) !!}

<div class="modal fade" id="author_profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center ss-border-no">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="panel-heading font-bold" id="myModalLabel">{{getPhrase('print_timetable')}}</h4>
                </div>
                <div class="modal-body">
                {{ Form::label('notes', getphrase('enter_notes')) }} : ({{getPhrase('this_will_be_displayed_bottom_of_the_timetable')}}) 
                    <textarea class="form-control ckeditor" name="notes" id="notes" ></textarea>
                    <input type="hidden" name="academic_id" value="@{{selected_academic_id}}">
                    <input type="hidden" name="course_id" value="@{{selected_course_id}}">
                    <input type="hidden" name="year" value="@{{selected_year}}">
                    <input type="hidden" name="semister" value="@{{selected_semister}}">
                    
                </div>
                <div class="modal-footer text-center ss-border-no">
                    <button  type="submit" class="btn btn-success">{{getPhrase('give_a_print')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                           </div>
                        </div>
                  </div>

                   {!! Form::close() !!}  
              </section>
         </div>
      
      <div class="col-sm-4">
            <section class="panel panel-default clear">
                <header class="panel-heading font-bold">{{getPhrase('staff')}}</header>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        
                                       <div class="m-t-xs m-b-xs">
                                          <div class="input-group search datagrid-search">

                                            <input type="text" class="input-sm form-control" name="search" ng-model="search" placeholder="{{getPhrase('search')}}" />

                                            <div class="input-group-btn">
                                              <button class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
                                            </div>
                                          </div>
                                        </div>
                                        
                        <section class="ss-custom-scroll-1">

                              <div class="m-t m-b-xs" id="source">

            <div ng-hide="showCalender" >
                Please select academic year and course
                </div>

                <div ng-show="showCalender" class="" id="source">
                     
                    <ul class="list-replay list-sidebar ss-over-scroll">
                    <li ng-repeat="item in source_items | filter:search " ng-drag="true" ng-drag-data="item.staff_record" ng-drag-success="onDragComplete($data,$event)" >
                            <a href="">
                                <img ng-if="item.staff_record.image==null || item.staff_record.image==''" src="{{IMAGE_PATH_USERS_DEFAULT_THUMB}}" alt="">
                                <img ng-if="item.staff_record.image!=null && item.staff_record.image!=''" src="{{IMAGE_PATH_USERS_THUMB}}@{{item.staff_record.image}}" alt="">
                                <h4>@{{item.staff_record.name | uppercase}} <span class="time"><i class="fa fa-mars-stroke"></i> @{{item.staff_record.gender | uppercase}}</span></h4>
                                <p>
                                    <strong>Subject:</strong> @{{item.staff_record.subject_title+' ('+item.staff_record.subject_code+')'}} 
                                     <i ng-if="item.staff_record.is_lab" class="fa fa-flask text-primary"></i>
                                     <i ng-if="item.staff_record.is_elective" class="fa fa-hand-pointer-o text-primary"></i>
                                    <br>
                                    <strong>Designation:</strong> @{{item.staff_record.job_title}} <br>
                                    <strong>Qualification:</strong> @{{item.staff_record.qualification}}
                                </p>
                                <i class="mdi arrow-link mdi-chevron-right"></i>
                                
                                <ul class="hover-fab-list list-unstyled ss-over-scroll">
                                    <li class="heading">@{{item.staff_record.name}} {{getPhrase('schedule_table')}}</li>
         
                                    <div class="table-responsive horizontal-scroll">
                                    <table class="table slot-booking-information table-responsive">
                                    <thead >
                                        <th>Day</th>
                                        <th ng-repeat="period in maximum_periods_set" 
                                            ng-if="period.is_break==0" >
                                            @{{period.period_name}}
                                        </th>
                                        
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="timemap in timings_map track by $index">
                                            <th>@{{days[$index+1].day}}</th>
                                            
                                            <td                                         ng-repeat="sub_item in item.schedule_record.timemaps[$index+1].periods" 
                                            ng-class="{'slot-book': sub_item.is_assigned == 0,'slot-booked': sub_item.is_assigned == 1} "
                                            ng-if="maximum_periods_set[$index].is_break==0"
                                            >
                                            

                                            </td>
                                             
                                        </tr>
                                         
                                        </tbody>        
                                    </table>    
                                    </div>
                                </ul>
                            </a>
                            </li>

                    </ul>
                     
                </div>

                                
                                    </div>
                                         
                                        </section>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
       
      

    </div>
           
  

@stop
 
@section('footer_scripts')

  
    @include('timetable.timetable-allotment.scripts.js-scripts')
    @include('common.alertify')
    @include('common.editor')
@stop

