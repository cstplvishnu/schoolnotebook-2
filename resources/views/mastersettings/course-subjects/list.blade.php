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
				<header class="panel-heading clear"><strong> {{$title}}</strong>
                  <label class="pull-right"><a href="{{URL_MASTERSETTINGS_COURSE_SUBJECTS_ADD}}" class="btn btn-info">{{getPhrase('add_or_edit_course_subjects')}}</a></label>
                </header>

				
						<div class="table-responsive" style="overflow-x:initial;">
						 
						<table class="table table-striped b-t b-light ss-tb datatable">
							<thead>
								<tr>
									 
									<th id="helper_step2">{{ getPhrase('academic_year')}}</th>
									<th>{{ getPhrase('branch')}}</th>
									<th>{{ getPhrase('course')}}</th>
									<th id="helper_step3" class="no-sort">{{ getPhrase('action')}}</th>
								</tr>
							</thead>
							 
						</table>
						{{csrf_field()}}
						</div>

					
			
@endsection
 

@section('footer_scripts')
	<script src="{{JS}}scripts/courseSubjects.js"></script>

 @include('common.datatables', array('route'=> URL_MASTERSETTINGS_COURSE_SUBJECTS_AJAXLIST.$slug, 'route_as_url' => 1))

@stop
