@extends('layouts.admin.adminlayout')

<link href="{{CSS}}plugins/datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">	
@section('content')

	<!-- Page Heading -->
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i>{{getPhrase('home')}}</a></li>
			      <li><a href="{{URL_QUIZZES}}">{{getPhrase('exmas')}} </a></li>
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

  <script src="{{JS}}plugins/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

 <script>
 
 	      $(function () {
        $('#datetimepicker6').datetimepicker({
        	@if($record)
        	   defaultDate: "{{$record->end_date}}",
        	   format: 'YYYY-MM-DD H:mm',
        	  @endif    
        	  
        	  
        });
        $('#datetimepicker7').datetimepicker({
        	@if($record)
        	   defaultDate: "{{$record->end_date}}",
        	    format: 'YYYY-MM-DD H:mm',
        	  @endif  
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });
 </script>

@stop

 

 