@extends('layouts.admin.adminlayout')
@section('content')
      
				<!-- Page Heading -->
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i>{{getPhrase('home')}}</a></li>
			      <li><a href="{{URL_EMAIL_TEMPLATES}}">{{getPhrase('email_templates')}} </a></li>
			      <li>{{$title}}</li>
			    </ul>
					@include('errors.errors')
				<!-- /.row -->
				
				<div class="row">
                  <div class="col-sm-8 col-sm-offset-2">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
					<?php $button_name = getPhrase('save'); ?>
					@if ($record)
					 <?php $button_name = getPhrase('save'); ?>
						{{ Form::model($record, 
						array('url' => URL_EMAIL_TEMPLATES_EDIT.'/'.$record->slug, 
						'method'=>'patch','novalidate'=>'','name'=>'formEmails ')) }}
					@else
						{!! Form::open(array('url' => URL_EMAIL_TEMPLATES_ADD, 'method' => 'POST', 'files' => true,'novalidate'=>'','name'=>'formEmails ')) !!}
					@endif

					 @include('emails.templates.form_elements', 
					 array('button_name'=> $button_name),
					 array('record' => $record))
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
	@include('common.editor')


@stop
 
 