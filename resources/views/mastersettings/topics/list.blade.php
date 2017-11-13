@extends('layouts.admin.adminlayout')
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
                  <label class="pull-right">
                  	<a href="{{URL_TOPICS_IMPORT}}" class="btn btn-dark">{{getPhrase('import')}}</a>
                  	<a href="{{URL_TOPICS_ADD}}" class="btn btn-info">{{getPhrase('new')}}</a>
                  </label>
                </header>

					<div class="table-responsive" style="overflow-x:initial;">
						 
						<table class="table table-striped b-t b-light ss-tb datatable">
							<thead>
								<tr>
									 
								 
									<th>{{ getPhrase('topic (id)')}}</th>
									<th id="helper_step2">{{ getPhrase('subject')}}</th>
									<th>{{ getPhrase('parent')}}</th>
									 
									<th id="helper_step3" class="no-sort">{{ getPhrase('action')}}</th>
								  
								</tr>
							</thead>
							 
						</table>

					</div>
			<!-- /.container-fluid -->
		</section>
@endsection
 

@section('footer_scripts')
  
@include('common.datatables', array('route'=>'topics.dataTable'))
 @include('common.deletescript', array('route'=>URL_TOPICS_DELETE))

@stop
