@extends($layout)
@section('content')
      
				<!-- Page Heading -->
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
			      <li><a href="{{URL_LIBRARY_ASSETS}}">{{getPhrase('asset_types')}} </a></li>
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
						array('url' => URL_LIBRARY_ASSETS_EDIT.$record->slug, 
						'method'=>'patch','name'=>'formAssets ', 'novalidate'=>'')) }}
					@else
						{!! Form::open(array('url' =>URL_LIBRARY_ASSETS_ADD, 'method' => 'POST','name'=>'formAssets ', 'novalidate'=>'')) !!}
					@endif

					 @include('library.libraryassets.form_elements', 
					 array('button_name'=> $button_name),
					 array())
					{!! Form::close() !!}

                    </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
		<!-- /#page-wrapper -->
@stop


 
 