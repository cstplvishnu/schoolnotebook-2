@extends($layout)
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')
 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li>{{$title}}</li>
    </ul>
<section class="panel panel-default">
				<!-- Page Heading -->
				<header class="panel-heading clear"><strong> {{$title}}</strong>
                  <label class="pull-right"><a href="{{URL_LMS_SERIES_ADD}}" class="btn btn-info">{{getPhrase('new')}}</a></label>
                </header>

					<div class="table-responsive" style="overflow-x:initial;">
						 
						<table class="table table-striped b-t b-light ss-tb datatable">
							<thead>
								<tr>
									<th class="no-sort"></th>
									<th id="helper_step3">{{ getPhrase('title')}}</th>
									<th>{{ getPhrase('is_paid')}}</th>
									<th>{{ getPhrase('cost')}}</th>
									<th>{{ getPhrase('validity')}} ({{getPhrase('days')}})</th>
									<th>{{ getPhrase('total_items')}}</th>
									<th id="helper_step2" class="no-sort">{{ getPhrase('action')}}</th>
								  
								</tr>

							</thead>
							 
						</table>

					</div>
			<!-- /.container-fluid -->
		</section>
@endsection
 

@section('footer_scripts')
  

@include('common.datatables', array('route'=>URL_LMS_SERIES_AJAXLIST, 'route_as_url' => TRUE))
 @include('common.deletescript', array('route'=>URL_LMS_SERIES_DELETE))

@stop
