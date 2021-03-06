@extends($layout)
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')
 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li>{{$title}}</li>
    </ul>

    @include('errors.errors')
<section class="panel panel-default">
				<!-- Page Heading -->
				<header class="panel-heading clear"><strong> {{$title}}</strong></header>

					<div class="table-responsive" style="overflow-x:initial;">
						 
						<table class="table table-striped b-t b-light ss-tb datatable">
							<thead>
								<tr>
									<th class="no-sort"></th>
								 	<th>{{ getPhrase('name')}}</th>
									<th>{{ getPhrase('email')}}</th>
									<th class="no-sort">{{ getPhrase('action')}}</th>
								</tr>
							</thead>
							 
						</table>

					</div>
			<!-- /.container-fluid -->
		</section>
@endsection
 

 <?php $url = URL_PARENT_CHILDREN_GETLIST.$user->slug;
 
  ?>
@section('footer_scripts')
  @include('common.datatables', array('route'=>$url, 'route_as_url' => TRUE))
 
@stop
