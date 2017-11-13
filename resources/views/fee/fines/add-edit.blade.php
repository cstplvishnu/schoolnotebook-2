@extends($layout)

@section('header_scripts')
 
@stop

@section('content')
<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
							<li><a href="{{URL_FEE_FINES}}">{{ getPhrase('fines')}}</a> </li>
							<li class="active">{{isset($title) ? $title : ''}}</li>
						</ol>
					</div>
				</div>
					@include('errors.errors')
				<!-- /.row -->
				
				<div class="panel panel-custom">
					<div class="panel-heading">
						<div class="pull-right messages-buttons">
							<a href="{{URL_FEE_FINES}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a>
						</div>
					<h1>{{ $title }}  </h1>
					</div>
					<div class="panel-body" >
					<?php $button_name = getPhrase('save'); ?>
					@if ($record)
					 <?php $button_name = getPhrase('save'); ?>
						{{ Form::model($record, 
						array('url' =>URL_FEE_FINES_EDIT.$record->slug, 
						'method'=>'patch')) }}
					@else
						{!! Form::open(array('url' => URL_FEE_FINES_ADD, 'method' => 'POST')) !!}
					@endif

					 @include('fee.fines.form_elements', 
					 array('button_name'=> $button_name),
					 array('fee_categories'=>$fee_categories ))
					 
					{!! Form::close() !!}
					 

					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
@stop
@section('footer_scripts')
 
 
 
	
@stop
 