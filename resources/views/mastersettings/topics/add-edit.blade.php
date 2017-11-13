@extends('layouts.admin.adminlayout')
@section('content')
      
				<!-- Page Heading -->
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
			      <li><a href="{{URL_TOPICS}}">{{getPhrase('topics')}} </a></li>
			      <li>{{$title}}</li>
			    </ul>
					@include('errors.errors')
				<!-- /.row -->
				
				<div class="row">
                  <div class="col-sm-6 col-sm-offset-3">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
					<?php $button_name = getPhrase('save'); ?>
					@if ($record)
					 <?php $button_name = getPhrase('save'); ?>
						{{ Form::model($record, 
						array('url' => URL_TOPICS_EDIT.'/'.$record->slug, 
						'method'=>'patch' ,'novalidate'=>'','name'=>'formTopics ')) }}
					@else
						{!! Form::open(array('url' => URL_TOPICS_ADD, 'method' => 'POST', 
						'novalidate'=>'','name'=>'formTopics ')) !!}
					@endif

					 @include('mastersettings.topics.form_elements', 
					 array('button_name'=> $button_name),
					 array('subjects'=>$subjects, 'parent_topics'=>$parent_topics))
					 
					{!! Form::close() !!}

                    </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
		<!-- /#page-wrapper -->
@stop

@section('footer_scripts')
 @include('common.validations')
@include('mastersettings.topics.scripts.js-scripts');
	@include('common.validations');
@stop
 
 