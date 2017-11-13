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
				<header class="panel-heading clear">{{$title}}</header>

					<div class="table-responsive" style="overflow-x:initial;">
						 
						<table class="table table-striped b-t b-light ss-tb datatable">
							<thead>
								<tr>
									<th>{{ getPhrase('question_type')}}</th>

									<th>{{ getPhrase('question')}}</th>

									<th>{{ getPhrase('marks')}}</th>

									<th>{{ getPhrase('action')}}</th>
								  
								</tr>
							</thead>
							 
						</table>

					</div>
			<!-- /.container-fluid -->
		</section>
@endsection
 

@section('footer_scripts')
  
 @include('common.datatables', array('route'=>URL_BOOKMARK_AJAXLIST.$user->slug, 'route_as_url'=>TRUE))

 @include('common.deletescript', array('route'=>URL_BOOKMARK_DELETE_BY_ID))

@stop
