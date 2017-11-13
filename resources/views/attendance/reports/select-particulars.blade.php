@extends($layout)

@section('header_scripts')
 
<link href="{{CSS}}bootstrap-datepicker.css" rel="stylesheet">
<link href="{{CSS}}fullcalendar.min.css" rel="stylesheet">
<link href='{{CSS}}fullcalendar.print.css' rel='stylesheet' media='print' />
<style>
.calendar{display:none;}
</style>
@stop

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      @if(checkRole(getUserGrade(2)))
       <li><a href="{{URL_USERS_DASHBOARD}}">{{ getPhrase('users_dashboard') }}</a> </li>
       

    <li><a href="{{URL_USERS."student"}}">{{ getPhrase('student_users') }}</a> </li>
    @endif

        @if(checkRole(getUserGrade(7)))
   <li><a href="{{URL_PARENT_CHILDREN}}">{{ getPhrase('children') }}</a> </li>
   @endif
   <li><a href="{{URL_USER_DETAILS.$userrecord->slug}}">{{ $userrecord->name }} {{getPhrase('details') }}</a> </li> 
     
   <li>{{ getPhrase('attendance') }} </li>
    </ul>

<section class="panel panel-default" ng-controller="TabController">
                <!-- Page Heading -->
                <header class="panel-heading clear"><strong> {{ getPhrase('attendance') }} </strong></header>


       
        <!-- /.row -->
        <?php 
                $loggedInUser     = Auth::user();
                $loggedInUserRole = getRoleData($loggedInUser->role_id);

        ?>
        <div class="panel panel-custom">
           
            <div class="panel-body instruction">
                 <div class="col-md-offset-3">
                 @include('common.year-selection-view',array('user_slug'=>$user->slug, 'class'=>'custom-row-6'))
             </div>
                <hr>
                       
  

    <div class="row">
        <div class="col-md-12">
            <div id='calendar' class="attendance-event-calender" ></div>
            <br>
           <a ng-show="total_classes>0" href="javascript:void(0);"  onclick = "viewSummary()" class="btn btn-info pull-right" >{{getPhrase('view_summary')}}</a>

        </div>

    </div>

    <div class="popover" id="attendance_summary">
<div class="row">
 <div class="col-md-12">
   <section class="panel-heading panel-default">
 <header class=" text-center"></header>
 
 <!--Total class-->
 <div class="row">
  <div class="col-md-12">
   <div class="row">
    <header class="panel-heading font-bold m-b-n-md ">{{getPhrase('attendance_summary')}}</header>
    <hr>
     <div class="col-sm-6 m-b">
       <label class="ss-fontf text-info ">{{getPhrase('total_classes')}}</label>
     </div>
     <div class="col-sm-6" style="margin: 0px -20px;padding: 0px;">
       :<span> @{{total_classes}}</span>
     </div>
   </div>
  </div>
 </div>
 
 <!--Total class Present-->
 <div class="row">
  <div class="col-md-12">
    <div class="row">
     <div class="col-sm-4 m-b">
       <label class=" text-success">{{getPhrase('present')}}</label>
     </div>
     <div class="col-sm-8">
       :<span> @{{present}}</span>
     </div>
   </div>
    
  </div>
 </div>
 
 <!--Total class Absent-->
 <div class="row">
  <div class="col-md-12">
    <div class="row">
     <div class="col-sm-4 m-b">
       <label class=" text-danger">{{getPhrase('absent')}}</label>
     </div>
     <div class="col-sm-8">
       :<span> @{{absent}}</span>
     </div>
   </div>
   
  </div>
 </div>
 
 <!--Total class Leave-->
 <div class="row">
  <div class="col-md-12">
   <div class="row">
     <div class="col-sm-4 m-b">
       <label class=" text-warning">{{getPhrase('leave')}}</label>
     </div>
     <div class="col-sm-8">
       :<span> @{{leave}}</span>
     </div>
   </div>
    
  </div>
 </div>
 
</section>
 </div>
</div>
</div>




    <div class="modal fade" id="lessionplan_summary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header text-center ss-border-no">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title font-bold" id="myModalLabel">{{getPhrase('topics_completed')}}</h4>
                </div>
                <div class="modal-body attendance-calendar-report">

                    <div class="row" ng-if="year_selected">
<div class="col-md-12">   
 
  
   
     
         <div class="col-md-5">
             <div class="">
                <a href="#">
                  <img ng-if="topics_completed.user.image!=''" class="img-circle" 
                  src="{{IMAGE_PATH_PROFILE}}@{{topics_completed.user.image}}" 
                  alt="@{{topics_completed.user.name}}">
                  
                  <img ng-if="topics_completed.user.image==''" class="img-circle" 
                  src="{{IMAGE_PATH_PROFILE_DEFAULT_THUMBNAIL}}" 
                  alt="@{{topics_completed.user.name}}">

                </a>
              

                <h4 class="media-heading">@{{topics_completed.user.name}}</h4>
                <p class="">@{{ topics_completed.user.job_title}} | @{{topics_completed.user.qualification}} </p>
                <p><a href="mailto:@{{topics_completed.user.email}}">@{{topics_completed.user.email}}</a></p>
                </div>

         </div>
      
     <div class="col-md-7">
       <ul class="list-unstyled text-left attendance-calendar-report">
            <li class="title"><strong>@{{selected_subject_name}}</strong></li>

           <li ng-if="topics_completed.topic_data.length>0" ng-repeat="topic in topics_completed.topic_data"> <i class="fa color-gray fa-check" aria-hidden="true"></i> @{{topic.topic_name}} - @{{topic.completed_on}} </li>

           <li ng-if="topics_completed.topic_data.length==0"> {{getPhrase('no_data_available')}} </li>

       </ul>
     </div>
      
 
 
         </div>
        </div>
                    
                </div>
                <div class="modal-footer text-center ss-border-no">
                    <button type="button" class="btn btn-success" data-dismiss="modal">{{getPhrase('its_okay')}}</button>
                </div>
            </div>
        </div>
    </div>


        </div>
   </div>
</section>

@stop
 
 <?php
 $student_id = $student->id; ?>

@section('footer_scripts')
    @include('attendance.reports.scripts.js-scripts', array('student_id'=>$student_id, 'user'=>$user))

    <script >

      jQuery(window).load(function () {

    

    setTimeout(function () {
        $(function(){
            PNotify.removeAll();
            new PNotify({
                title: $('#attendance_summary').html(),
                text: "",
                type: "default",
                delay: 1500,
                shadow: true,
                
                animate: {
                            animate: true,
                            in_class: 'fadeInLeft',
                            out_class: 'fadeOutRight'
                        }
                });
        });   
    }, 1000);

});

     
      function viewSummary(){

     $(function(){
            PNotify.removeAll();
            new PNotify({
                title: $('#attendance_summary').html(),
                text: "",
                type: "default",
                delay: 1500,
                shadow: true,
                
                animate: {
                            animate: true,
                            in_class: 'fadeInLeft',
                            out_class: 'fadeOutRight'
                        }
                });
        });
        

}
    </script>
    
@stop
