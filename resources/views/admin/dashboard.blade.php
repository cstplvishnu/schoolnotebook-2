@extends($layout)
  @section('content')
    
    <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
    <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ul>

<section class="panel panel-default ss-panel-bg">
    <div class="row m-l-none m-r-none bg-light lter">
        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-users fa-stack-1x text-white"></i>
                     <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>
            <a class="clear" href="{{URL_USERS_DASHBOARD}}"> <span class="h3 block m-t-xs"><strong >{{ App\User::get()->count()}}</strong></span> <small class="text-muted text-uc">{{getPhrase('users')}}</small> </a>
        </div>

       

        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-success"></i>
                      <i class="fa fa-university fa-stack-1x text-white"></i>
                     <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
            <a class="clear" href="{{URL_MASTERSETTINGS_ACADEMICS}}"> <span class="h3 block m-t-xs"><strong >{{ App\Academic::get()->count()}}</strong></span> <small class="text-muted text-uc">{{getPhrase('academics')}}</small> </a>
        </div>
         <div class="col-sm-6 col-md-3 padder-v b-r b-light "> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x text-default"></i>
          <i class="fa fa-list-alt fa-stack-1x text-white"></i>
         <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>
            <a class="clear" href="{{URL_MASTERSETTINGS_COURSE}}"> <span class="h3 block m-t-xs"><strong>{{ App\Course::get()->count()}}</strong></span> <small class="text-muted text-uc">{{getPhrase('courses')}}</small> </a>
        </div>


        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-warning"></i>
                      <i class="fa fa-laptop fa-stack-1x text-white"></i>
                    <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>
            <a class="clear" href="{{URL_LMS_CONTENT}}"> <span class="h3 block m-t-xs"><strong>{{ App\LmsContent::get()->count()}}</strong></span> <small class="text-muted text-uc">LMS</small> </a>
        </div>
    </div>
    <!--Second Set-->
    <div class="row m-l-none m-r-none bg-light lter ss-dashboard-cover">
        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x icon-muted"></i>
          <i class="fa fa-book fa-stack-1x text-white"></i>
        <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>
            <a class="clear" href="{{URL_LIBRARY_MASTERS}}"> <span class="h3 block m-t-xs"><strong>{{ App\LibraryMaster::get()->sum('total_assets_count')}}</strong></span> <small class="text-muted text-uc">{{getPhrase('central_library')}}</small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
              <i class="fa fa-circle fa-stack-2x text-warning"></i>
              <i class="fa fa-language fa-stack-1x text-white"></i>
              <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
            <a class="clear" href="{{URL_LANGUAGES_LIST}}"> <span class="h3 block m-t-xs"><strong>{{ App\Language::get()->count()}}</strong></span> <small class="text-muted text-uc">Languages</small> </a>
        </div>

         <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-danger"></i>
                      <i class="fa fa-pencil-square-o fa-stack-1x text-white"></i>
                      <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span> </span>
            <a class="clear" href="{{URL_QUIZZES}}"> <span class="h3 block m-t-xs"><strong >{{ App\Quiz::get()->count()}}</strong></span> <small class="text-muted text-uc">{{getPhrase('exams')}}</small> </a>
        </div>
        

        
        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x text-info"></i>
          <i class="fa fa-cog fa-stack-1x text-white"></i>
          <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span> </span>
            <a class="clear" href="{{URL_SETTINGS_LIST}}"> <span class="h3 block m-t-xs"><strong >{{ App\Settings::get()->count()}}</strong></span> <small class="text-muted text-uc">{{getPhrase('settings')}}</small> </a>
        </div>
        
    </div>
</section>

<div class="row">
    <div class="col-md-9 col-sm-9 col-xs-12">
        <section class="scrollable">
            <div class="row">
                <div class="col-sm-6 portlet ui-sortable">
                    <section class="panel panel-success portlet-item">
                        <?php $latest_staff = App\User::getLatestUsersDashboard('staff',4);?> 
                        <header class="panel-heading"> <strong>{{getPhrase('latest_faculty')}}</strong> </header>
                        <ul class="list-group alt">
                            @if(count($latest_staff))
                            @foreach($latest_staff as $user)
                            <li class="list-group-item">
                                <div class=""> 
                                    <span class="pull-left thumb-sm">
                                        <a href="{{URL_STAFF_DETAILS.$user->slug}}" class="pull-left thumb-sm avatar">
                                        <img src= "{{ getProfilePath($user->image)}}" alt="User Image" class="img-circle">
                                    </a>
                                </span>
                                    <div class="pull-right {{getColorPad()}} m-t-sm"> 
                                        <i class="fa fa-circle"></i>
                                    </div>
                                    <div class="media-body ss-right">
                                        <div>
                                            <a href="{{URL_STAFF_DETAILS.$user->slug}}">{{ucfirst($user->name)}}</a>
                                        </div> 
                                        <small class="text-muted">{{humanizeDate($user->created_at)}}</small>
                                         </div>
                                </div>
                            </li>
                         @endforeach
                         @else
                         <li class="list-group-item">{{getPhrase('no_data_available')}}</li>
                         @endif
                         </ul>
                    </section>
                </div>
                <div class="col-sm-6 portlet ui-sortable">
                    <section class="panel panel-info portlet-item">
                        <header class="panel-heading">  
                        <strong>{{getPhrase('latest_students')}}</strong>
                         </header>
                        <?php $latest_students = App\User::getLatestUsersDashboard('student',4);?>  
                        <ul class="list-group alt">
                             @if(count($latest_students))    
                              @foreach($latest_students as $user)

                            <li class="list-group-item">
                                <div class=""> 
                                    <span class="pull-left thumb-sm">
                                        <a href="{{URL_USER_DETAILS.$user->slug}}" class="pull-left thumb-sm avatar">
                                            <img src="{{ getProfilePath($user->image)}}" alt="User Image" class="img-circle">
                                        </a>
                                    </span>
                                    <div class="pull-right {{getColorPad()}} m-t-sm"> 
                                        <i class="fa fa-circle"></i>
                                    </div>
                                    <div class="media-body ss-right">
                                        <div>
                                            <a href="{{URL_USER_DETAILS.$user->slug}}">{{ucfirst($user->name)}}
                                            </a>
                                        </div> 
                                        <small class="text-muted">{{humanizeDate($user->created_at)}}</small>
                                    </div>
                                </div>
                            </li>

                           @endforeach

                            @else
                         <li class="list-group-item">{{getPhrase('no_data_available')}}</li>
                         @endif
                        </ul>
                    </section>
                </div>
            </div>
        </section>

        <!--Table Section-->
        <section class="panel panel-default">

            <header class="panel-heading "><strong>{{getPhrase('recent_online_payments')}}</strong> </header>
          

            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                           <th class="th-sortable" data-toggle="class">{{getPhrase('name')}}</th>
                            <th>{{getPhrase('item')}}</th>
                            <th>{{getPhrase('gate_way')}}</th>
                            <th>{{getPhrase('paid')}}</th>
                            <th width="30">{{getPhrase('status')}}</th>
                        </tr>
                    </thead>
                    <tbody>

                     <?php  $online_payments = App\Payment::latestPayments('online',5); ?>
       
                     @if(count($online_payments))
                            @foreach($online_payments as $record)

                            <?php 
                            $class = '';

                                if($record->payment_status == 'success')
                                    {
                                        $class='fa fa-check text-success text-active';
                                    }
                             
                                else if($record->payment_status == 'cancelled' ||  $record->payment_status == 'pending')
                                    {
                                        $class='fa fa-times text-danger text-active';
                                    }

                                ?>

                        <tr>
                            <!--<td><input type="checkbox" name="post[]" value="2"></td>-->
                            <td><strong>{{ucfirst($record->name)}}</strong></td>
                            <td>{{ucfirst($record->item_name)}}</td>
                            <td>{{ucfirst($record->payment_gateway)}}</td>
                            <td>{{getCurrencyCode()}} {{ucfirst($record->paid_amount)}}</td>
                            <td class="active" ><i class="{{$class}}"></i></td>
                        </tr>


                        @endforeach

                        @else
                        <tr>
                            <td>{{getPhrase('no_data_available')}}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
           
        </section>
        <!--Offline Payments-->
        <section class="panel panel-default">

            <header class="panel-heading "><strong>{{getPhrase('recent_offline_payments')}}</strong> </header>
          

            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                           <th class="th-sortable" data-toggle="class">{{getPhrase('name')}}</th>
                            <th>{{getPhrase('item')}}</th>
                            <th>{{getPhrase('gate_way')}}</th>
                            <th>{{getPhrase('paid')}}</th>
                            <th width="30">{{getPhrase('status')}}</th>
                        </tr>
                    </thead>
                    <tbody>

                     <?php  $online_payments = App\Payment::latestPayments('offline',5); ?>
       
                        @if(count($online_payments))
                            @foreach($online_payments as $record)

                            <?php 
                            $class = '';

                                if($record->payment_status == 'success')
                                    {
                                        $class='fa fa-check text-success text-active';
                                    }
                             
                                else if($record->payment_status == 'cancelled' || $record->payment_status == 'pending' )
                                    {
                                        $class='fa fa-times text-danger text-active';
                                    }

                                ?>

                        <tr>
                            <!--<td><input type="checkbox" name="post[]" value="2"></td>-->
                            <td><strong>{{ucfirst($record->name)}}</strong></td>
                            <td>{{ucfirst($record->item_name)}}</td>
                            <td>{{ucfirst($record->payment_gateway)}}</td>
                            <td>{{getCurrencyCode()}} {{ucfirst($record->paid_amount)}}</td>
                            <td class="active"><i class="{{$class}}"></i></td>
                        </tr>
                        @endforeach

                         @else
                        <tr>
                            <td>{{getPhrase('no_data_available')}}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
           
        </section>
    </div>
    <!--charts section-->
    <div class="col-md-3 col-sm-3 col-xs-12">
        <section class="panel panel-default">
            <header class="panel-heading font-bold">{{getPhrase('user_statistics')}}</header>
            <div class="panel-body">
                @include('common.right-bar-chart',array('chart_data' => $chart_data))
            </div>
        </section>
        
         <!--Recent Exam Takers-->
        <section class="panel panel-success portlet-item">
            <header class="panel-heading"><strong> {{getPhrase('recent_exam_takers')}}</strong> </header>
            <ul class="list-group alt">
      <?php $records = App\QuizResult::latestQuizAttempts(4); ?>
            @if(count($records))
             @foreach($records as $user)
                <li class="list-group-item">
                    <div class=""> <span class="pull-left thumb-sm">
                        <a href="#" class="pull-left thumb-sm avatar">
                            <img src="{{ getProfilePath($user->image)}}" class="img-circle">
                        </a>
                    </span>
                        <div class="pull-right text-success m-t-sm">
                           </div>
                        <div class="media-body ss-right">
                            <div>
                                <a href="{{URL_STUDENT_ANALYSIS_BY_EXAM.$user->slug}}"><strong>{{$user->name}}</strong> </a>
                            </div> 
                         <small class="text-muted"><strong>{{getPhrase('quiz_name')}} </strong>: {{$user->title}} </small> 
                         <small class="text-muted"><strong>{{getPhrase('percentage')}} </strong>: {{$user->percentage}} % </small> 
                        </div>
                    </div>
                </li>
               @endforeach

                 @else
                         <li class="list-group-item">{{getPhrase('no_data_available')}}</li>
                         @endif
            </ul>
        </section>
        
    </div>
</div>

 

		<!-- /#page-wrapper -->

@stop


@section('footer_scripts')
 @include('common.chart', array($chart_data,'ids' =>$ids))
@stop



