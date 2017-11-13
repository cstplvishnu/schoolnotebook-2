@extends($layout)

@section('header_scripts')
<link href="{{CSS}}animate.css" rel="stylesheet">
@stop



@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
			      <li>{{$title}}</li> 
			    </ul>

				<!-- Page Heading -->
				
					@include('errors.errors')
				<!-- /.row -->
				
			 <div class="row" ng-controller="courseSubjectsController" ng-init="ingAngData({{$items}})">
                  <div class="col-sm-9 col-sm-offset-1">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">

                       {{$title}}</header>

                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body" ng-controller="courseSubjectsController">	



				
					<?php $button_name = getPhrase('update'); ?>
				 
						{!! Form::open(array('url' => URL_MASTERSETTINGS_COURSE_SUBJECTS_LOAD, 'method' => 'POST')) !!}
				 

					 @include('mastersettings.course-subjects.form_elements', 
					 array('button_name'=> $button_name),
					 array(
							'academic_years'		=> $academic_years,
					))
					 
					{!! Form::close() !!}


					@if($loadYears)
					{!! Form::open(array('url' => URL_MASTERSETTINGS_COURSE_SUBJECTS_ADD, 'method' => 'POST')) !!}
				 

					 @include('mastersettings.course-subjects.form_elements', 
					 array('button_name'=> $button_name),
					 array(
							'academic_years'		=> $academic_years,
					))
					 
					{!! Form::close() !!}

					@endif
					 

				         </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
			
@stop

 
@section('footer_scripts')
	@include('mastersettings.course-subjects.scripts.js-scripts')
@stop

