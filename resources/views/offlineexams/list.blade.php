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
                  <label class="pull-right"><a href="{{URL_OFFLINE_EXAMS_IMPORT_MARKS}}" class="btn btn-info">{{getPhrase('import_excel')}}</a></label>
                </header>

					<div class="table-responsive" style="overflow-x:initial;">
						 
						<table class="table table-striped b-t b-light ss-tb datatable">
							<thead>
								<tr >
									<th id="helper_step2">{{ getPhrase('exam')}} (ID)</th>
									<th>{{ getPhrase('category')}}</th>
									<th>{{ getPhrase('subject')}}</th>
									<th>{{ getPhrase('marks')}}</th>
									<th>{{ getPhrase('pass_percentage')}}</th>
									
									<th id="helper_step3" class="no-sort">{{ getPhrase('action')}}</th>
									
									
								</tr>
							</thead>
							 
						</table>

					</div>
			<!-- /.container-fluid -->
		</section>
@endsection
 

@section('footer_scripts')
  
@include('common.datatables', 
 array('route'=>'offlineexams.dataTable' ))
 @include('common.deletescript',
  array('route'=>URL_OFFLINE_EXAMS_DELETE))

@stop
