@extends($layout)

@section('header_scripts')
 <link rel="stylesheet" type="text/css" href="{{CSS}}select2.css">
@stop

@section('content')
<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
							<li><a href="{{URL_FEE_DISCOUNTS}}">{{ getPhrase('discounts')}}</a> </li>
							<li class="active">{{isset($title) ? $title : ''}}</li>
						</ol>
					</div>
				</div>
					@include('errors.errors')
				<!-- /.row -->
				<?php $settings = ($record) ? $settings : ''; ?>

				<div class="panel panel-custom" ng-init="initAngData('{{ $settings }}');" ng-controller="angFeeDiscounts">
					<div class="panel-heading">
						<div class="pull-right messages-buttons">
							<a href="{{URL_FEE_DISCOUNTS}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a>
						</div>
					<h1>{{ $title }}  </h1>
					</div>
					<div class="panel-body" >
					<?php $button_name = getPhrase('save'); ?>
					@if ($record)
					 <?php $button_name = getPhrase('save'); ?>
						{{ Form::model($record, 
						array('url' => URL_FEE_DISCOUNTS_EDIT.$record->slug, 
						'method'=>'patch')) }}
					@else
						{!! Form::open(array('url' => URL_FEE_DISCOUNTS_ADD, 'method' => 'POST')) !!}
					@endif

					 @include('fee.feediscounts.form_elements', 
					 array('button_name'=> $button_name),
					 array(
					 'fee_categories'		=> $fee_categories, 
					 'course_parent_list'	=> $course_parent_list, 
					 'course'				=> $course_list, 
					 'categories'			=> $categories, 
					 'academics'			=> $academics, 
					 ))
					{!! Form::close() !!}
					</div>

				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
@stop
@section('footer_scripts')
 <script src="{{JS}}angular.js"></script>
 <script src="{{JS}}select2.js"></script>
 {{-- <script src="{{JS}}scripts/feeDiscounts.js"></script> --}}
@include('fee.feediscounts.scripts.js-scripts')

	
@stop
 