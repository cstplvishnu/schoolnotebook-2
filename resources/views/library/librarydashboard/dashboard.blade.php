@extends($layout)
@section('content')
 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
    <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
    <li class="active">{{getPhrase('dashboard')}}</li>
</ul>


 <section class="panel panel-default ss-panel-bg">
    <div class="row m-l-none m-r-none bg-light lter">
        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-users fa-stack-1x text-white"></i>
                     <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>
                     <?php $studentObject =  App\Student::where('academic_id','!=',0)
                                            ->where('course_parent_id','!=',0)
                                            ->where('course_id','!=',0)
                                            ->where('current_year','!=',-1)
                                            ->where('current_semister','!=',-1)->get()->count();
                               
               ?>
            <a class="clear" href="{{URL_LIBRARY_USERS}}student"> <span class="h3 block m-t-xs"><strong >{{ $studentObject }}</strong></span> <small class="text-muted text-uc">{{getPhrase('students')}}</small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-success"></i>
                      <i class="fa fa-male fa-stack-1x text-white"></i>
                     <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
            <a class="clear" href="{{URL_LIBRARY_USERS}}staff"> <span class="h3 block m-t-xs"><strong >
              {{ App\Staff::join('users','users.id','=','staff.user_id')
                                ->where('course_parent_id','!=','')
                                ->where('course_id','!=','')
                                ->where('users.status','!=',0)
                                ->get()->count() }}
            </strong></span> <small class="text-muted text-uc">{{getPhrase('staff')}}</small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-danger"></i>
                      <i class="fa fa-user fa-stack-1x text-white"></i>
                      <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span> </span>
                      <?php $libraryIssuesObject = new App\LibraryIssue();
            $count = $libraryIssuesObject->getIssuesCount('student');
            ?>
            <a class="clear" href="{{URL_LIBRARY_LIBRARYDASHBOARD_BOOKS}}"> <span class="h3 block m-t-xs"><strong >{{ $count }}</strong></span> <small class="text-muted text-uc">{{getPhrase('student_book_return')}}</small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-warning"></i>
                      <i class="fa fa-users fa-stack-1x text-white"></i>
                    <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>
                      <?php $libraryIssuesObject = new App\LibraryIssue();
            $count1 = $libraryIssuesObject->getIssuesStaffCount('staff');
            ?>
            
            <a class="clear" href="{{URL_LIBRARY_LIBRARYDASHBOARD_BOOKS_STAFF}}"> <span class="h3 block m-t-xs"><strong>{{$count1}}</strong></span> <small class="text-muted text-uc">{{getPhrase('staff_book_return')}}</small> </a>
        </div>
    </div>
    <!--Second Set-->
    @if(checkRole(getUserGrade(8)))
    <div class="row m-l-none m-r-none bg-light lter ss-dashboard-cover">
        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x icon-muted"></i>
          <i class="fa fa-database fa-stack-1x text-white"></i>
        <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>
            <a class="clear" href="{{URL_LIBRARY_ASSETS}}"> <span class="h3 block m-t-xs"><strong>{{ App\LibraryAssetType::get()->count()}}</strong></span> <small class="text-muted text-uc">{{getPhrase('asset_types')}}</small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
              <i class="fa fa-circle fa-stack-2x text-warning"></i>
              <i class="fa fa-book fa-stack-1x text-white"></i>
              <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
            <a class="clear" href="{{URL_LIBRARY_MASTERS}}"> <span class="h3 block m-t-xs"><strong>{{ App\LibraryMaster::get()->sum('total_assets_count')}}</strong></span> <small class="text-muted text-uc">{{getPhrase('library_books')}}</small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x text-info"></i>
          <i class="fa fa-paint-brush fa-stack-1x text-white"></i>
          <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update=""></span> </span>
            <a class="clear" href="{{URL_PUBLISHERS}}"> <span class="h3 block m-t-xs"><strong >{{ App\Publisher::get()->count()}}</strong></span> <small class="text-muted text-uc">{{getPhrase('publishers')}}</small> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x text-primary"></i>
          <i class="fa fa-mortar-board fa-stack-1x text-white"></i>
         <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>
            <a class="clear" href="{{URL_AUTHORS}}"> <span class="h3 block m-t-xs"><strong>{{App\Author::get()->count()}}</strong></span> <small class="text-muted text-uc">{{getPhrase('authors')}}</small> </a>
        </div>
        @endif
    </div>
</section>

					<div class="col-md-6">
						  {!! Charts::assets() !!}
				  {!! $asset_charts->render() !!}
					</div>




		<!-- /#page-wrapper -->
@stop

@section('footer_scripts')

@stop
