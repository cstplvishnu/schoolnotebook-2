 @extends($layout)
 
@section('content')
    <ul class="breadcrumb no-border no-radius b-b b-light pull-in">

     <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>

    @if(checkRole(getUserGrade(2)))
    <li><a href="{{URL_USERS_DASHBOARD}}">{{getPhrase('users_dashboard')}}</a></li>
    <li><a href="{{URL_USERS."staff"}}">{{ getPhrase('staff_users') }}</a> </li>
    @endif
    
  <li>{{ $title }} </li>
</ul>

    <div class="row">
        <div class="col-sm-12">
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
                      	<img src="{{IMAGE_PATH_PROFILE_DEFAULT}}" alt="" class="img-circle" height="10%" width="10%">
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

        <div class="col-sm-6 col-md-3 padder-v b-r b-light ss-super-admins"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-paper-plane-o fa-stack-1x text-white"></i>
                     <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>
            <a class="clear" href="{{URL_LESSION_PLANS_DASHBOARD.$record->slug}}"> <span class="h4 block m-t-xs"><strong>{{getPhrase('lesson_plans')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>

        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-success"></i>
                      <i class="fa fa-book fa-stack-1x text-white"></i>
                      <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
            <a class="clear" href="{{URL_USER_LIBRARY_DETAILS.$record->slug}}"> <span class="h4 block m-t-xs"><strong>
            {{getphrase('library_history')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>

        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-danger"></i>
                      <i class="fa fa-calendar fa-stack-1x text-white"></i>
                      <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span> </span>
            <a class="clear" href="{{URL_TIMETABLE_STAFF_STUDENT_PRINT.$record->slug}}" target="_blank"> <span class="h4 block m-t-xs"><strong>{{ getPhrase('timetable')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>

                             </div>
                          </section>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        

    </div>
    
@stop
 

