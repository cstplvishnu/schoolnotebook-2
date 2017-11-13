@extends($layout)
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')
 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>
							
		@if(checkRole(getUserGrade(2)))
   <li><a href="{{URL_USERS_DASHBOARD}}">{{ getPhrase('users_dashboard') }}</a> </li>
   @endif

@if(checkRole(getUserGrade(2)))
<li><a href="{{URL_USERS."student"}}">{{ getPhrase('student_users') }}</a> </li>
@endif

 @if(checkRole(getUserGrade(7)))
<li><a href="{{URL_PARENT_CHILDREN}}">{{ getPhrase('children') }}</a> </li>
@endif

   <li>{{ $title }}</li>
</ul>

    @include('errors.errors')
<section class="panel panel-default">
				<!-- Page Heading -->
				<header class="panel-heading clear"><strong> {{$title}}</strong> </header>

					<div class="table-responsive" style="overflow-x:initial;">
						 
						<table class="table table-striped b-t b-light ss-tb datatable">
							<thead>
								<tr>
								@if($is_parent)
								 <th></th>
                                    <th>{{ getPhrase('user_name')}}</th>
                                @endif

									<th>{{ getPhrase('name')}}</th>

									<th>{{ getPhrase('plan_type')}}</th>

									<th>{{ getPhrase('start_date')}}</th>

									<th>{{ getPhrase('end_date')}}</th>

									<th>{{ getPhrase('paid_from')}}</th>

									<th>{{ getPhrase('date_time')}}</th>

									<th class="no-sort">{{ getPhrase('status')}}</th>

                                     </tr>
							</thead>
							 
						</table>

					</div>
			<!-- /.container-fluid -->
		</section>
@endsection
 

@section('footer_scripts')
  
@include('common.datatables', array('route'=>URL_PAYPAL_PAYMENTS_AJAXLIST.$user->slug, 'route_as_url' => TRUE))


@stop
