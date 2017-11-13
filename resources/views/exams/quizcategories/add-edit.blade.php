@extends('layouts.admin.adminlayout')
@section('content')
      
				<!-- Page Heading -->
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
			      <li><a href="{{URL_QUIZ_CATEGORIES}}">{{getPhrase('categories')}} </a></li>
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
						array('url' => URL_QUIZ_CATEGORY_EDIT.'/'.$record->slug, 
						'method'=>'patch', 'files' => true, 'novalidate'=>'','name'=>'formCategories')) }}
					@else
						{!! Form::open(array('url' => URL_QUIZ_CATEGORY_ADD, 'method' => 'POST', 'files' => true, 'novalidate'=>'','name'=>'formCategories')) !!}
					@endif

					 @include('exams.quizcategories.form_elements', 
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
  @include('common.validations');
  @include('common.alertify')
 <script>
 	var file = document.getElementById('filestyle-0');

file.onchange = function(e){
    var ext = this.value.match(/\.([^\.]+)$/)[1];
    switch(ext)
    {
        case 'jpg':
        case 'jpeg':
        case 'png':
    
            break;
        default:
           alertify.error("{{getPhrase('file_type_not_allowed')}}");
            this.value='';
    }
};
 </script>
@stop
 