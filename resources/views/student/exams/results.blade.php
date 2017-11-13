@extends('layouts.student.studentlayout')
@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i>{{getPhrase('home')}}</a></li>
			     <li> <a href="{{URL_STUDENT_EXAM_CATEGORIES}}"> {{ getPhrase('exams') }} </a></li>
                 <li class="active"> {{$title}} </li>
			    </ul>
<div class="row">
                  <div class="col-sm-9 col-sm-offset-1">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{getPhrase('result_for'). ' '.$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
							<div class="profile-details text-center">

							<div class="profile-img"><img src="{{ getProfilePath($user->image,'profile')}}" alt="" class="img-circle"></div>

							<div class="aouther-school">

								<h4 class="font-bold">{{ $user->name}}</h4>

								<p><span>{{$user->email}}</span></p>



							</div>



						</div>

						<hr>
 

						<div class="panel-body">

						<ul class="library-statistic">

							<li class="total-books font-bold">

								{{getPhrase('score') }} <span><?php echo sprintf('%0.2f', $record->marks_obtained, 2, '.', '');?> / {{$record->total_marks}}</span>

							</li>

							<li class="total-journals font-bold">

								{{getPhrase('percentage')}} <span><?php echo sprintf('%0.2f', $record->percentage); ?></span>

							</li>

							<li class="digital-items font-bold">

							<?php $grade_system = getSettings('general')->gradeSystem; ?>

								{{ getPhrase('result')}} <span>{{  ucfirst($record->exam_status) }}</span>

							</li>

						</ul>

				 

					<div class="row" >

					<div class="col-md-6">

					 
						 @if(isset($marks_data))

	 						<div class="row">

						

							<?php $ids=[];?>

							@for($i=0; $i<count($marks_data); $i++)

							<?php 

							$newid = 'myMarksChart'.$i;

							$mark_ids[] = $newid; ?>

							

							 

								<canvas id="{{$newid}}" width="100" height="60"></canvas>

							 



							@endfor

							</div>

						@endif



					</div>

					<div class="col-md-6">

						

					@if(isset($time_data))

	 						<div class="row">

						

							<?php $ids=[];?>

							@for($i=0; $i<count($time_data); $i++)

							<?php 

							$newid = 'myTimeChart'.$i;

							$time_ids[] = $newid; ?>

								<canvas id="{{$newid}}" width="100" height="60"></canvas>

							@endfor

							</div>

						@endif



					</div>

					</div>

					<br/>

					<div class="row">

						<div class="col-lg-12 text-center">

							<a onClick="setLocalItem('{{URL_RESULTS_VIEW_ANSWERS.$quiz->slug.'/'.$record->slug}}')" href="javascript:void(0);" class="btn btn-info">{{ getPhrase('view_key') }}</a>

						</div>

					</div>	


					</div>





					</div>


                          </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

	 

@stop



@section('footer_scripts')

   <script src="{{JS}}chart-vue.js"></script>



@if(isset($marks_data))

	@include('common.chart', array('chart_data'=>$marks_data,'ids' => $mark_ids))

@endif

@if(isset($time_data))

	@include('common.chart', array('chart_data'=>$time_data,'ids' => $time_ids))

@endif


<script>
function setLocalItem(url) {
	localStorage.setItem('redirect_url',url);
	window.close();
}
</script>

@stop