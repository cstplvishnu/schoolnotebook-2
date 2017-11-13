@extends($layout)
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      @if(checkRole(getUserGrade(2)))
       <li><a href="{{URL_USERS_DASHBOARD}}">{{ getPhrase('users_dashboard') }}</a> </li>
       

    <li><a href="{{URL_USERS."student"}}">{{ getPhrase('student_users') }}</a> </li>
    @endif

        @if(checkRole(getUserGrade(7)))
   <li><a href="{{URL_PARENT_CHILDREN}}">{{ getPhrase('children') }}</a> </li>
   @endif
   <li><a href="{{URL_USER_DETAILS.$record->slug}}">{{ $record->name }} {{getPhrase('details') }}</a> </li> 
   <li>{{$title}}</li>

 </ul>


<section class="panel panel-default">
				<!-- Page Heading -->
				<header class="panel-heading clear"> {{$record->name}} {{getPhrase('transfers')}}</header>

<div class="table-responsive" style="overflow-x:initial;">
						 
						<table class="table table-striped b-t b-light ss-tb datatable">

							<thead>
								<tr>
									<th>{{ getPhrase('sno')}}</th>
									<th>{{ getPhrase('type')}}</th>
									@if($course_time>1 && $having_semisters->is_having_semister!=0)
									<th>{{ getPhrase('from (_admission_year-_course-_year-_semester)')}}</th>
									<th>{{ getPhrase('to (_admission_year-_course-_year-_semester)')}}</th>
									@elseif($course_time>1 && $having_semisters->is_having_semister==0)
									<th>{{ getPhrase('from (_admission_year-_course-_year)')}}</th>
									<th>{{ getPhrase('to (_admission_year-_course-_year)')}}</th>
									@endif
									@if($course_time<=1)
									<th>{{ getPhrase('from (_admission_year-_course)')}}</th>
									<th>{{ getPhrase('to (_admission_year-_course)')}}</th>
									@endif
									<th>{{ getPhrase('remarks')}}</th>
									<th>{{ getPhrase('date')}}</th>
									
								</tr>
							</thead>
							<?php $sno = 1; ?>
							@foreach($student_data as $data)
							<tr>
								<td>{{$sno++}}</td>
								<td><strong>{{ucfirst($data->type)}}</strong></td>
								
								<td>{{getacademictitle($data->from_academic_id)}} - {{getcoursetitle($data->from_course_id, $data->from_year, $data->from_semister,$having_semisters->is_having_semister)}}</td>
								<td>{{gettransferacademictitle($data->type,$data->to_academic_id , $data->to_year, $data->to_semister)}} - {{gettransfercoursetitle($data->type,$data->to_course_id, $data->to_year, $data->to_semister)}}</td>
								@if($data->remarks!='')
								<td>{{ucfirst($data->remarks)}}</td>
								@else
								<td> - </td>
								@endif
                                <td>{{$data->created_at}}</td>
							</tr>
							@endforeach
						</table>

					</div>
			<!-- /.container-fluid -->
		</section>

@endsection

