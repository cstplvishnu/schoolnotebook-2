@extends($layout)
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')
 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
    <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}} </a></li>
         @if(checkRole(getUserGrade(2)))
       <li><a href="{{URL_USERS_DASHBOARD}}">{{ getPhrase('users_dashboard') }}</a> </li>
       
      @if($record->role_id==5)
    <li><a href="{{URL_USERS."student"}}">{{ getPhrase('student_users') }}</a> </li>
    <li><a href="{{URL_USER_DETAILS.$record->slug}}">{{ $record->name }} {{getPhrase('details') }}</a> </li> 
    @endif
     @if($record->role_id==3)
    <li><a href="{{URL_USERS."staff"}}">{{ getPhrase('staff_users') }}</a> </li>
    <li><a href="{{URL_STAFF_DETAILS.$record->slug}}">{{ $record->name }} {{getPhrase('details') }}</a> </li> 
    @endif

    @endif

        @if(checkRole(getUserGrade(7)))
   <li><a href="{{URL_PARENT_CHILDREN}}">{{ getPhrase('children') }}</a> </li>
   @endif
  
			
     <li>{{$title}}</li>
    </ul>

    @include('errors.errors')
<section class="panel panel-default">
				<!-- Page Heading -->
				<header class="panel-heading clear"><strong> {{$title}}</strong>

                </header>

					<div class="table-responsive" style="overflow-x:initial;">
						 
						<table class="table table-striped b-t b-light ss-tb datatable">
							<thead>
								<tr>
									 <th>{{ getPhrase('asset_no')}}</th>
									<th>{{ getPhrase('master_asset_name')}}</th>
								 	<th>{{ getPhrase('issue_on')}}</th>
								 	<th>{{ getPhrase('due_date')}}</th>
								 	<th>{{ getPhrase('status')}}</th>
									<th >{{ getPhrase('return_on')}}</th>
								  
								</tr>
							</thead>
							 
						</table>

					</div>
			<!-- /.container-fluid -->
		</section>
@endsection
 

@section('footer_scripts')
  
 @include('common.datatables', array('route'=>URL_USER_LIBRARY_DETAILS_GETLIST.$record->id, 'route_as_url'=>true))

@stop
