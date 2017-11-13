 @extends($layout)
 
@section('content')
    <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
     <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>
     @if(checkRole(getUserGrade(2)))
	<li><a href="{{URL_USERS_DASHBOARD}}">{{getPhrase('users_dashboard')}}</a></li>
      @endif
	@if(checkRole(getUserGrade(2)))
	<li><a href="{{URL_USERS."student"}}">{{ getPhrase('student_users') }}</a> </li>
	@endif
	
	@if(checkRole(getUserGrade(7)))
	<li><a href="{{URL_PARENT_CHILDREN}}">{{ getPhrase('children') }}</a> </li>
	@endif

	<li>{{ $title }} </li>
    </ul>
    <div class="row">
        <div class="col-sm-8">
            <section class="panel panel-default">
                <header class="panel-heading font-bold clear">{{$record->name }}</header>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel-body">
                            
                               
                                <div class="media m-t">
                    <div class="profile-details text-center m-t">
                      <div class="profile-img m-t">
                      	@if($record->image)
                      	<img src="{{ getProfilePath($record->image,'profile')}}" alt="" class="ss-img-cover-20 img-circle">
                      	@else
                      	<img src="{{IMAGE_PATH_PROFILE_DEFAULT}}" alt="" class="img-circle" height="18%" width="18%">
                      	@endif
                       </div>
                        <div class="aouther-school">
                            <h3><strong>{{ $record->name}}</strong></h3>
                            <p><span><strong>{{getPhrase('email')}} : </strong><font size="4px">{{$record->email}}</font></span></p>
                        </div>
                     </div>
                   </div>
   <section class="panel panel-default ss-panel-bg m-t-lg" data-target=".ss-super-admins">
    <div class="row m-l-none m-r-none bg-light lter">
        <div class="col-md-4 col-sm-12 col-xs-12  padder-v b-r b-light ss-super-admins"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-history fa-stack-1x text-white"></i>
                     <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>
            <a class="clear" href="{{URL_STUDENT_EXAM_ATTEMPTS.$record->slug}}"> <span class="h4 block m-t-xs"><strong>{{getPhrase('exam_history')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>

        <div class="col-md-4 col-sm-12 col-xs-12 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-success"></i>
                      <i class="fa fa-flag fa-stack-1x text-white"></i>
                      <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
            <a class="clear" href="{{URL_STUDENT_ANALYSIS_BY_EXAM.$record->slug}}"> <span class="h4 block m-t-xs"><strong>
            {{getphrase('by_exam')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>

        <div class="col-md-4 col-sm-12 col-xs-12 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-danger"></i>
                      <i class="fa fa-pencil-square-o fa-stack-1x text-white"></i>
                      <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span> </span>
            <a class="clear" href="{{URL_STUDENT_ANALYSIS_SUBJECT.$record->slug}}"> <span class="h4 block m-t-xs"><strong>{{ getPhrase('by_subject')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>
    </div>

    <!--Second Set-->
    <div class="row m-l-none m-r-none bg-light lter ss-dashboard-cover">
        <div class="col-md-4 col-sm-12 col-xs-12 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-warning"></i>
                      <i class="fa fa-credit-card fa-stack-1x text-white"></i>
                   <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span>  </span>
            <a class="clear" href="{{URL_PAYMENTS_LIST.$record->slug}}"> <span class="h4 block m-t-xs"><strong>{{ getPhrase('subscriptions')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>
        
        <div class="col-md-4 col-sm-12 col-xs-12 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x icon-muted"></i>
          <i class="fa fa-pencil fa-stack-1x text-white"></i>
         <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span></span>
            <a class="clear" href="{{URL_STUDENT_RESULTS.$record->slug}}"> <span class="h4 block m-t-xs"><strong>{{ getPhrase('marks')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>

        <div class="col-md-4 col-sm-12 col-xs-12 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
              <i class="fa fa-circle fa-stack-2x text-warning"></i>
              <i class="fa fa-calendar fa-stack-1x text-white"></i>
              <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
            <a class="clear" href="{{URL_STUDENT_ATTENDENCE_REPORT.'/'.$record->slug}}"> <span class="h4 block m-t-xs"><strong>{{ getPhrase('attendance')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>
        
    </div>
    <!--Third Set-->
    <div class="row m-l-none m-r-none bg-light lter ss-dashboard-cover">
       <div class="col-md-4 col-sm-12 col-xs-12 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x text-info"></i>
          <i class="fa fa-clock-o fa-stack-1x text-white"></i>
          <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span> </span>
            <a class="clear" href="{{URL_TIMETABLE_STAFF_STUDENT_PRINT.$record->slug}}" target="_blank"> <span class="h4 block m-t-xs"><strong>{{ getPhrase('timetable')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>

        <div class="col-md-4 col-sm-12 col-xs-12 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x text-primary"></i>
          <i class="fa fa-book fa-stack-1x text-white"></i>
          <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span> </span>
            <a class="clear" href="{{URL_USER_LIBRARY_DETAILS.$record->slug}}"> <span class="h4 block m-t-xs"><strong>{{ getPhrase('library_history')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>
        
        <div class="col-md-4 col-sm-12 col-xs-12 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x text-danger"></i>
          <i class="fa fa-exchange fa-stack-1x text-white"></i>
         <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span> </span>
            <a class="clear" href="{{URL_USER_TRANSFERS_DETAILS.$record->slug}}"> <span class="h4 block m-t-xs"><strong>{{ getPhrase('transfers_list')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>

        <div class="col-md-4 col-sm-12 col-xs-12 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-bars fa-stack-1x text-white"></i>
              <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
            <a class="clear" href="{{URL_USER_FEE_SCHEDULES.$student_details->id}}"> <span class="h4 block m-t-xs"><strong >{{ getPhrase('fee_schedules')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>

        <div class="col-md-4 col-sm-12 col-xs-12 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x icon-muted"></i>
          <i class="fa fa-money fa-stack-1x text-white"></i>
          <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span> </span>
            <a class="clear" href="{{URL_USER_FEE_PAID_HISTORY.$student_details->id}}"> <span class="h4 block m-t-xs"><strong>{{getPhrase('fee_history')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>

    </div>
   </section>
  </div>
 </div>
                    
                    
                </div>
            </section>
        </div>
        <div class="col-sm-4">
            <section class="panel panel-default clear">
                <header class="panel-heading font-bold">{{getPhrase('progress_report')}}</header>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel-body">
                            <?php $ids=[];?>
						@for($i=0; $i<count($chart_data); $i++)
						<?php 
						$newid = 'myChart'.$i;
						$ids[] = $newid; ?>

						<div class="panel-body">
						<canvas id="{{$newid}}" width="100" height="110"></canvas>
						</div>

						@endfor
	 
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
@endsection
 
@section('footer_scripts')
 
 @include('common.chart', array($chart_data,'ids' =>$ids))

@stop
