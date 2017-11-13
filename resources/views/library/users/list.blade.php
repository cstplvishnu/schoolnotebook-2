@extends($layout)
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')



				<!-- Page Heading -->
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
			      <li>{{$title}}</li>
			    </ul>
								
		<section class="panel panel-default">		<!-- /.row -->
				<header class="panel-heading clear"><strong> {{$title}}</strong>
                  
                </header>

					<div class="table-responsive" style="overflow-x:initial;">
						<table class="table table-striped b-t b-light ss-tb datatable"  id="users-table">
							<thead>
								<tr>
								    <th></th>
									@if($user_type=='student') 
									<th id="helper_step1">{{ getPhrase('roll_no')}}</th>
									@else
									<th id="helper_step1">{{ getPhrase('faculty_id')}}</th>
									@endif
								
									<th>{{ getPhrase('first_name')}}</th>
									<th>{{ getPhrase('last_name')}}</th>
									<th>{{ getPhrase('email')}}</th>

								</tr>
							</thead>
							 
						</table>
						</div>
		
</section>

@endsection
  

@section('footer_scripts')
  
 @include('common.datatables', array('route'=>URL_LIBRARY_USERS_GETLIST.$user_type, 'route_as_url'=>'TRUE','extra_var'=>1,'user_type'=>$user_type))
 
@stop
