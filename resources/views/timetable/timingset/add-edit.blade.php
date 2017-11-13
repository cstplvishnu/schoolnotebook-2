@extends('layouts.admin.adminlayout')

<link href="{{CSS}}plugins/datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">	

@section('content')


<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
        <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
        <li><a href="{{URL_TIMINGSET}}">{{ getPhrase('timing_sets')}}</a> </li>
		<li class="active">{{isset($title) ? $title : ''}}</li>
    </ul>

 <div class="row">
        <div class="col-sm-12">
<section class="panel panel-default clear">

	<header class="panel-heading font-bold clear">{{getPhrase('create_set')}}</header>
<?php 
$data = null;
if($record) {
 
	$data = $timingset;
	
}
?>
<div ng-controller="timigsetController" ng-init="intilizeData({{$data}})">
 

					@if ($record)
					
						{{ Form::model($record, 
						array('url' => URL_TIMINGSET_EDIT.'/'.$record->slug, 
						'method'=>'patch', 'name'=>'formTimingset ', 'novalidate'=>'')) }}
					@else
						{!! Form::open(array('url' => URL_TIMINGSET_ADD, 'method' => 'POST', 'name'=>'formTimingset ', 'novalidate'=>'')) !!}
					@endif

				<!-- Page Heading -->
				
				@include('errors.errors')	

				<div class="row">
				<div class="panel panel-custom col-lg-12 ">
					<div class="col-md-7">
						
					<div class="panel-body " >
	

					 @include('timetable.timingset.form_elements', 
					 array('record' => $record))
					
					</div>
					</div>
					<div class="col-md-5">
						
						@include('timetable.timingset.right-bar')
					</div>
					</div>
				
				</div>

				 {!! Form::close() !!}
			</div>
			<!-- /.container-fluid -->
	</section>
</div>
</div>
@stop
@section('footer_scripts')
  <script src="{{JS}}bootstrap-toggle.min.js"></script>   
  @include('common.alertify')
  @include('timetable.timingset.scripts.js-scripts');
  @include('common.validations');
  <script src="{{JS}}moment.min.js"></script>
  <script src="{{JS}}plugins/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
 <script>
 
      $(function () {
        $('.datetimepicker').datetimepicker({
        	  format: 'HH:mm',
        	  stepping: 10,
        });
        
    });
 </script>

@stop
 
