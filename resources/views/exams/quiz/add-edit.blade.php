@extends('layouts.admin.adminlayout')

@section('content')

	<!-- Page Heading -->
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i>{{getPhrase('home')}}</a></li>
			      <li><a href="{{URL_QUIZZES}}">{{getPhrase('exams')}} </a></li>
			      <li>{{$title}}</li>
			    </ul>

			@include('errors.errors')


         <div class="row" ng-controller="QuizController" ng-init="initAngData({{$items}})">
                  <div class="col-sm-10 col-sm-offset-1">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">			    
                    
                    <?php $button_name = getPhrase('create'); ?>

					@if ($record)

					 <?php $button_name = getPhrase('update'); ?>

						{{ Form::model($record, 

						array('url' => URL_QUIZ_EDIT.'/'.$record->slug, 

						'method'=>'patch', 'files' => true, 'name'=>'formQuiz ', 'novalidate'=>'')) }}

					@else

						{!! Form::open(array('url' => URL_QUIZ_ADD, 'method' => 'POST', 'files' => true, 'name'=>'formQuiz ', 'novalidate'=>'')) !!}

					@endif

					



					 @include('exams.quiz.form_elements', 

					 array('button_name'=> $button_name),

					 array(	'categories' 		=> $categories,
					 		'instructions' 		=> $instructions,
					 		'subjects' 			=> $subjects,
					 		'academic_years' 	=> $academic_years,
					 		'offline_categories' => $offline_categories,
					 		'record'			=> $record
					 		))

					 		

					{!! Form::close() !!}

					

			            </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@stop

@section('footer_scripts')
@include('exams.quiz.scripts.quiz-scripts', array('quiz_record'=>$record))
 @include('common.validations', array('isLoaded'=>FALSE))
@include('common.alertify')
 <script src="{{JS}}moment.min.js"></script>

 <script>
  var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
 
var checkin = $('#dpd1').datepicker({
  onRender: function(date) {
    return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  if (ev.date.valueOf() > checkout.date.valueOf()) {
    var newDate = new Date(ev.date)
    newDate.setDate(newDate.getDate() + 1);
    checkout.setValue(newDate);
  }
  checkin.hide();
  $('#dpd2')[0].focus();
}).data('datepicker');
var checkout = $('#dpd2').datepicker({
  onRender: function(date) {
    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  checkout.hide();
}).data('datepicker');
 </script>

@stop

 

 