@extends($layout)

@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop

@section('content')
 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li><a href="{{URL_LESSION_PLANS_STUDENTLIST_DASHBOARD.Auth::user()->slug}}">{{getPhrase('students_dashboard')}}</a></li>
      <li>{{$title}}</li>
    </ul>

    @include('errors.errors')
<section class="panel panel-default">
				<!-- Page Heading -->
				
				<header class="panel-heading clear">{{$title}}</header>

					<div class="table-responsive" style="overflow-x:initial;">
						 
						<table class="table table-striped b-t b-light ss-tb datatable">
							<thead>
								<tr>
									<th></th>
									<th>{{ getPhrase('name')}}</th>
								 	<th>{{ getPhrase('roll_no')}}</th>
								 	<th>{{ getPhrase('course')}}</th>
								 	
									<th>{{ getPhrase('email')}}</th>
								  
								</tr>
							</thead>
							 
						</table>

					</div>
			<!-- /.container-fluid -->
		</section>
@endsection
 

@section('footer_scripts')

 @include('common.datatables', array('route'=>URL_LESSION_PLANS_VIEW_STUDENTS_GETLIST.$academic_id.'/'.$course_parent_id.'/'.$course_id.'/'.$year.'/'.$semister , 'route_as_url'=>true))
 
 @stop

