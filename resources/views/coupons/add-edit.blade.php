@extends('layouts.admin.adminlayout')
@section('content')
      
				<!-- Page Heading -->
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
			      <li><a href="{{URL_COUPONS}}"> {{getPhrase('coupons')}} </a></li>
			      <li>Create Coupon</li>
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
						array('url' => URL_COUPONS_EDIT.$record->slug, 
						'method'=>'patch', 'name'=>'formQuiz ', 'novalidate'=>'','class'=>'bs-example form-horizontal')) }}
					@else
						{!! Form::open(array('url' => URL_COUPONS_ADD, 'method' => 'POST', 'name'=>'formQuiz ', 'novalidate'=>'','class'=>'bs-example form-horizontal')) !!}
					@endif
					

					 @include('coupons.form_elements', 
					 array('button_name'=> $button_name),
					 array('record' => $record, 'categories' => $categories))
					 		
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

  <script>
 	var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
 
var checkin = $('#dpd1').datepicker({
  onRender: function(date) {
    return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  if (ev.date.valueOf() > checkout.date.valueOf()) {
    var newDate = new Date(ev.date)
    newDate.setDate(newDate.getDate() + 1);
    checkout.setValue(newDate);
  }
  checkin.hide();
  $('#dpd2')[0].focus();
}).data('datepicker');
var checkout = $('#dpd2').datepicker({
  onRender: function(date) {
    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  checkout.hide();
}).data('datepicker');
 </script>
 

@stop
 
 