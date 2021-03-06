@extends('layouts.admin.adminlayout')
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')
 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li><a href="{{URL_QUIZ_QUESTIONBANK}}">{{ getPhrase('question_subjects') }}</a></li>
      <li>{{$title}}</li>
    </ul>
<section class="panel panel-default">
				<!-- Page Heading -->
				<header class="panel-heading clear"><strong> {{$title}}</strong>
                  
                  <label class="pull-right">
                  	<a href="{{URL_QUESTIONBAMK_IMPORT}}" class="btn btn-dark">{{getPhrase('import_questions')}}</a>
                  	<a href="{{URL_QUESTIONBANK_ADD_QUESTION.$subject->slug}}" class="btn btn-info">{{getPhrase('new')}}</a>
               </label>

                </header>

					<div class="table-responsive" style="overflow-x:initial;">
						 
						<table class="table table-striped b-t b-light ss-tb datatable">
							<thead>
								<tr>
								 
									<th>{{ getPhrase('subject')}}</th>
									<th>{{ getPhrase('topic')}}</th>
									<th>{{ getPhrase('type')}}</th>
									<th>{{ getPhrase('question')}}</th>
									<th>{{ getPhrase('marks')}}</th>
									<th>{{ getPhrase('difficulty')}}</th>
									<th class="no-sort">{{ getPhrase('action')}}</th>
								  
								</tr>
							</thead>
							 
						</table>

					</div>
			<!-- /.container-fluid -->
		</section>
@endsection
 

@section('footer_scripts')
  
 @include('common.datatables', array('route'=>URL_QUESTIONBANK_GETQUESTION_LIST.$subject->slug, 'route_as_url' => 'TRUE'))
 @include('common.deletescript', array('route'=>URL_QUESTIONBANK_DELETE))

@stop
