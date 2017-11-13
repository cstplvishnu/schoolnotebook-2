@extends($layout)
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li><a href="{{URL_STUDENT_EXAM_CATEGORIES}}">{{getPhrase('exam_categories')}}</a></li>
      <li>{{$title}}</li>
    </ul>


				
		<section class="panel panel-default">
						
				<header class="panel-heading clear"><strong> {{$title}}</strong> </header>		
				<!-- /.row -->
				
						<div class="table-responsive" style="overflow-x:initial;">
						 
						<table class="table table-striped b-t b-light ss-tb datatable">
							<thead>
								<tr>
									<th>{{ getPhrase('title')}}</th>
									<th>{{ getPhrase('duration')}}</th>
									<th>{{ getPhrase('category')}}</th>
									<th>{{ getPhrase('type')}}</th>
									<th>{{ getPhrase('total_marks')}}</th>
									<th class="no-sort">{{ getPhrase('action')}}</th>
								  
								</tr>
							</thead>
							 
						</table>
						</div>

			</section>
@endsection
 

@section('footer_scripts')
  @if(isset($category))
 @include('common.datatables', array('route'=>URL_STUDENT_QUIZ_GETLIST.$category->slug, 'route_as_url' => TRUE))
 @elseif(isset($user) && $user)
 @include('common.datatables', array('route'=>URL_QUIZ_LOAD_SCHEDULED_EXAMS.$user->slug, 'route_as_url' => TRUE))
 @else
 @include('common.datatables', array('route'=>URL_STUDENT_QUIZ_GETLIST_ALL, 'route_as_url' => TRUE))
 @endif
 @include('common.deletescript', array('route'=>URL_QUIZ_DELETE))
<script >
function showInstructions(url) {
	window.open(url,'_blank',"width=1200,height=800,directories=no,titlebar=no,toolbar=no,location=no,scrollbars=yes");
	runner();
}

function runner()
{
	url = localStorage.getItem('redirect_url');
    if(url) {
      localStorage.clear();
       window.location = url;
    }
    setTimeout(function() {
          runner();
    }, 500);

}
</script>
@stop
