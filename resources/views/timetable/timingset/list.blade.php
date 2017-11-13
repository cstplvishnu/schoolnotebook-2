@extends('layouts.admin.adminlayout')
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
									 
									<th id="helper_step1">{{ getPhrase('name')}}</th>
									<th>{{ getPhrase('description')}}</th>
									<th id="helper_step2">{{ getPhrase('action')}}</th>
								  
								</tr>
							</thead>
							 
						</table>
						</div>

	</section>
	
@endsection
 

@section('footer_scripts')
  
 @include('common.datatables', array('route'=>'timingset.dataTable'))
 @include('common.deletescript', array('route'=>URL_TIMINGSET_DELETE))

@stop
