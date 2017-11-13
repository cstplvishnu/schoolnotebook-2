@extends($layout)
<!-- @section('header_scripts')
<link href="{{CSS}}plugins/datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">   

@stop -->
@section('content')
<div id="page-wrapper" ng-controller="schedule_controller">

<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
							<li><a href="{{URL_FEE_CATEGORIES}}">{{ getPhrase('fee_categories')}}</a> </li>
							<li class="active">{{isset($title) ? $title : ''}}</li>
						</ol>
					</div>
				</div>
					@include('errors.errors')
				<!-- /.row -->
				
				<div class="panel panel-custom">
					<div class="panel-heading">
						<div class="pull-right messages-buttons">
							 
							<a href="{{URL_FEE_CATEGORIES}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a>
							 
						</div>
					<h1>{{ $title }}  </h1>
					</div>
					<div class="panel-body">
					<?php $button_name = getPhrase('create'); ?>
					
						{!! Form::open(array('url' => URL_FEE_CATEGORIES_SHEDULES_ADD, 'method' => 'POST','name'=>'formSchedule', 'novalidate'=>'')) !!}

					 @include('fee.schedules.schedule-form-elements', array('button_name'=> $button_name,'feecategory'=>$feeCategory))
					 
					{!! Form::close() !!}
					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
     </div>
		<!-- /#page-wrapper -->
@stop
@section('footer_scripts')

@include('fee.schedules.scripts.schedule-scripts')
 @stop