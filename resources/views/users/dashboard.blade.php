@extends($layout)
@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
    <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
    <li class="active">Users Dashboard</li>
</ul>

<!--<div class="m-b-md">
                <h3 class="m-b-none">Workset</h3>
                <small>Welcome back, Noteman</small>
              </div>-->
<section class="panel panel-default ss-panel-bg" data-target=".ss-super-admins">
    <div class="row m-l-none m-r-none bg-light lter">
        <div class="col-sm-6 col-md-3 padder-v b-r b-light ss-super-admins"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-user-o fa-stack-1x text-white"></i>
                   <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
                     <?php $ownerCount =  App\User::where('role_id','=',1)->get()->count(); ?>
                               
							 
            <a class="clear" href="{{URL_USERS."owner"}}"> <span class="h3 block m-t-xs"><strong>{{$ownerCount}}</strong></span> <small class="text-muted text-uc">{{getPhrase('super_admins')}}</small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-success"></i>
                      <i class="fa fa-user fa-stack-1x text-white"></i>
                      <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>

                      <?php $admincount =  App\User::where('role_id','=',2)->get()->count(); ?>

            <a class="clear" href="{{URL_USERS."admin"}}"> <span class="h3 block m-t-xs"><strong>{{$admincount}}</strong></span> <small class="text-muted text-uc">{{getPhrase('admins')}}</small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-danger"></i>
                      <i class="fa fa-address-card-o fa-stack-1x text-white"></i>
                      <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span> </span>
            <a class="clear" href="{{URL_USERS."student"}}"> <span class="h3 block m-t-xs"><strong> 
            	{{ App\Student::where('academic_id','!=','')
                       	->where('course_parent_id','!=','')
					  ->where('course_id','!=','')
					  ->get()->count()
					}}
					</strong></span> <small class="text-muted text-uc">{{getPhrase('students')}}</small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-warning"></i>
                      <i class="fa fa-address-card fa-stack-1x text-white"></i>
                    <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>
                    <?php $staffcount =  App\User::join('staff','staff.user_id','=','users.id')->where('staff.course_id','!=','')
							->where('role_id','=',3)
							->where('status','!=',0)->get()->count();
                               
							 ?>
            <a class="clear" href="{{URL_USERS."staff"}}"> <span class="h3 block m-t-xs"><strong>{{$staffcount}}</strong></span> <small class="text-muted text-uc">{{getPhrase('faculty_resources')}}</small> </a>
        </div>
    </div>
    <!--Second Set-->
    <div class="row m-l-none m-r-none bg-light lter ss-dashboard-cover">
        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x icon-muted"></i>
          <i class="fa fa-book fa-stack-1x text-white"></i>
        <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>

        <?php $librariancount =  App\User::where('role_id','=',7)->get()->count(); ?>

            <a class="clear" href="{{URL_USERS."librarian"}}"> <span class="h3 block m-t-xs"><strong>{{$librariancount}}</strong></span> <small class="text-muted text-uc">{{getPhrase('librarians')}}</small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
              <i class="fa fa-circle fa-stack-2x text-warning"></i>
              <i class="fa fa-language fa-stack-1x text-white"></i>
              <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
              <?php $assistantlibrarianObject =  App\User::where('role_id','=',8)->get()->count();
                               
							 ?>
						   
            <a class="clear" href="{{URL_USERS."assistant_librarian"}}"> <span class="h3 block m-t-xs"><strong >{{$assistantlibrarianObject}}</strong></span> <small class="text-muted text-uc">{{getPhrase('assistant_librarians')}}</small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x text-info"></i>
          <i class="fa fa-male fa-stack-1x text-white"></i>
          <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span> </span>
          <?php $parentObject =  App\User::where('role_id','=',6)->get()->count();
                               
							 ?>
						  
            <a class="clear" href="{{URL_USERS."parent"}}"> <span class="h3 block m-t-xs"><strong> {{$parentObject}}</strong></span> <small class="text-muted text-uc">{{getPhrase('parents')}}</small> </a>
        </div>

        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x text-primary"></i>
          <i class="fa fa-user-circle-o fa-stack-1x text-white"></i>
        <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> 
      </span>
       <?php $clerkObject =  App\User::where('role_id','=',9)->get()->count();
                               
               ?>
            <a class="clear" href="{{URL_USERS."clerk"}}"> <span class="h3 block m-t-xs"><strong>{{$clerkObject}}</strong></span> <small class="text-muted text-uc">{{getPhrase('clerks')}}</small> </a>
        </div>
    </div>
    <!--Third Set-->
    <div class="row m-l-none m-r-none bg-light lter ss-dashboard-cover">
        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x text-danger"></i>
          <i class="fa fa-users fa-stack-1x text-white"></i>
       <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
            <a class="clear" href="{{URL_USERS."users"}}"> <span class="h3 block m-t-xs"><strong>{{ App\User::get()->count()}}</strong></span> <small class="text-muted text-uc">{{getPhrase('all_users')}}</small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-street-view fa-stack-1x text-white"></i>
              <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
              <?php $staff_inactive_listobject = App\User::where('status','=',0)
								->where('role_id','=',3)->get()->count();
								  ?>

								
            <a class="clear" href="{{URL_USERS_STAFF_INACTIVE."staff"}}"> <span class="h3 block m-t-xs"><strong>{{$staff_inactive_listobject}}</strong></span> <small class="text-muted text-uc">{{getPhrase('faculty_resources_inactive_list')}}</small> </a>
        </div>

@if(count($academic_details)&&count($course_details))
        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x icon-muted"></i>
          <i class="fa fa-user-plus fa-stack-1x text-white"></i>
          <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span> </span>
            <a class="clear" href="{{URL_USERS_ADD}}"> <span class="h3 block m-t-xs"></span> <small><font size="3px"><strong>{{getPhrase('create_user')}}</font>
</strong></font></small> </a>
        </div>
@endif

   @if(!count($academic_details)||!count($course_details))
     
      <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x icon-muted"></i>
          <i class="fa fa-cog fa-stack-1x text-white"></i>
          <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span> </span>
            <a class="clear" href="javascript:void(0);"  onclick="showMessage()"> <span class="h3 block m-t-xs"><strong></strong></span> <small><font size="3px"><strong>{{getPhrase('create_user')}}</strong><font></small> </a>
        </div>

    @endif

    </div>
</section>
 
 <!--user stastics-->
 



 @section('footer_scripts')
<script >
 	 function showMessage(){

 			new PNotify({
                title: "sorry",
                text: "{{getPhrase('please_update_master_setup_details')}}",
                type: "info",
                delay: 1500,
                shadow: true,
                
                animate: {
                            animate: true,
                            in_class: 'fadeInLeft',
                            out_class: 'fadeOutRight'
                        }
                });
 		}
  
 </script>

@stop

@stop