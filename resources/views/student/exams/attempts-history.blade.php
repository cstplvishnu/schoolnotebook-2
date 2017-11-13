@extends($layout)
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')
 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
     <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>

    @if(checkRole(getUserGrade(2)))
       <li><a href="{{URL_USERS_DASHBOARD}}">{{ getPhrase('users_dashboard') }}</a> </li>
       

	<li><a href="{{URL_USERS."student"}}">{{ getPhrase('student_users') }}</a> </li>
	@endif

       @if(checkRole(getUserGrade(12)))
   <li><a href="{{URL_USER_DETAILS.$user->slug}}">{{ $user->name }} {{getPhrase('details') }}</a> </li> 
   @endif

   @if(checkRole(getUserGrade(7)))
   <li><a href="{{URL_PARENT_CHILDREN}}">{{ getPhrase('children') }}</a> </li>
			
   <li><a href="{{URL_USER_DETAILS.$user->slug}}">{{ $user->name }} {{getPhrase('details') }}</a> </li> 
	@endif		 

			<li>{{ $title}}</li>
    </ul>

    @include('errors.errors')
<section class="panel panel-default">
				<!-- Page Heading -->
				<header class="panel-heading clear"> {{ $title.' '.getPhrase('of').' '.$user->name }}</header>

					<div class="table-responsive" style="overflow-x:initial;">
						 
						<table class="table table-striped b-t b-light ss-tb datatable">
							<thead>
								<tr>
								    <th>{{ getPhrase('title')}}</th>
                                    <th>{{ getPhrase('type')}}</th>
                                    <th>{{ getPhrase('marks')}}</th>
                                    <th>{{ getPhrase('result')}}</th>
                                    <th class="no-sort">{{ getPhrase('action')}}</th>
								  
								</tr>
							</thead>
							 
						</table>

					</div>
			<!-- /.container-fluid -->
		</section>
@endsection
 

@section('footer_scripts')
  
@if(!$exam_record)

 @include('common.datatables', array('route'=>URL_STUDENT_EXAM_GETATTEMPTS.$user->slug, 'route_as_url' => 'TRUE'))

 @else

 @include('common.datatables', array('route'=>URL_STUDENT_EXAM_GETATTEMPTS.$user->slug.'/'.$exam_record->slug, 'route_as_url' => 'TRUE'))

 @endif

 @include('common.chart', array($chart_data,'ids' => array('myChart1')));

@stop
