@extends($layout)
@section('header_scripts')
{!! Charts::assets() !!}
@stop
@section('content')

<div id="page-wrapper">
			<div class="container-fluid">
			<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							 
							<li><i class="fa fa-home"></i> {{ $title}}</li>
						</ol>
					</div>
				</div>

				 <div class="row">
				   <div class="col-md-3">
						<div class="card card-green text-xs-center helper_step5">
							<div class="card-block">
								<h4 class="card-title">
									<i class="fa fa-users" aria-hidden="true"></i>

								</h4>
								<p class="card-text">{{ getPhrase('users')}}</p>
							</div>
							<a class="card-footer text-muted" href="{{URL_USERS_DASHBOARD}}">
								{{ getPhrase('view_all')}}
							</a>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="card card-blue text-xs-center helper_step2">
							<div class="card-block">
								<h4 class="card-title">
									<i class="fa fa-university" aria-hidden="true"></i>
								</h4>
								<p class="card-text">{{ getPhrase('academics')}}</p>
							</div>
							<a class="card-footer text-muted" href="{{URL_ACADEMICOPERATIONS_DASHBOARD}}">
								{{ getPhrase('view_all')}}
							</a>
						</div>
					</div>

					<div class="col-md-3">
						<div class="card card-red text-xs-center helper_step3">
							<div class="card-block">
								<h4 class="card-title">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</h4>
								<p class="card-text">{{ getPhrase('exams')}}</p>
							</div>
							<a class="card-footer text-muted" href="{{URL_EXAMS_DASHBOARD}}">
								{{ getPhrase('view_all')}}
							</a>
						</div>
					</div>

					<div class="col-md-3">
						<div class="card card-yellow text-xs-center helper_step4">
							<div class="card-block">
								<h4 class="card-title">
									<i class="fa fa-leanpub" aria-hidden="true"></i>
								</h4>
								<p class="card-text">{{ 'LMS'}}</p>
							</div>
							<a class="card-footer text-muted" href="{{URL_LMS_DASHBOARD}}">
								{{ getPhrase('view_all')}}
							</a>
						</div>
					</div>
					
					
					<div class="col-md-3">
						<div class="card card-black text-xs-center helper_step6">
							<div class="card-block">
								<h4 class="card-title">
									<i class="fa fa-book" aria-hidden="true"></i>
								</h4>
								<p class="card-text">{{ getPhrase('library')}}</p>
							</div>
							<a class="card-footer text-muted" href="{{URL_LIBRARY_LIBRARYDASHBOARD}}">
								{{ getPhrase('view_all')}}
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card card-yellow text-xs-center helper_step7">
							<div class="card-block">
								<h4 class="card-title">
									<i class="fa fa-language" aria-hidden="true"></i>
								</h4>
								<p class="card-text">{{ getPhrase('languages')}}</p>
							</div>
							<a class="card-footer text-muted" href="{{URL_LANGUAGES_LIST}}">
								{{ getPhrase('view_all')}}
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card card-green text-xs-center helper_step8">
							<div class="card-block">
								<h4 class="card-title">
									<i class="fa fa-cog" aria-hidden="true"></i>
								</h4>
								<p class="card-text">{{ getPhrase('settings')}}</p>
							</div>
							<a class="card-footer text-muted" href="{{URL_SETTINGS_DASHBOARD}}">
								{{ getPhrase('view_all')}}
							</a>
						</div>
					</div>
					 <div class="col-md-3">
						<div class="card card-blue text-xs-center helper_step1">
							<div class="card-block">
								<h4 class="card-title">
									<i class="fa fa-cogs" aria-hidden="true"></i>
								</h4>
								<p class="card-text">{{ getPhrase('master_setup')}}</p>
							</div>
							<a class="card-footer text-muted" href="{{URL_COURSES_DASHBOARD}}">
								{{ getPhrase('view_all')}}
							</a>
						</div>
					</div>
					


                  </div>
		 
 
</div>
		<!-- /#page-wrapper -->

@stop

@section('footer_scripts')
 @include('common.chart', array($chart_data,'ids' =>$ids))
@stop
