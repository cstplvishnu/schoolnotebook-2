@extends($layout)

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
		<li class="active">{{getPhrase('export_payment_records')}}</li>
    </ul>

<div id="page-wrapper" ng-controller="payments_report" ng-init="initAngData()">
			<div class="container-fluid">
				<!-- Page Heading -->
				
					@include('errors.errors')
				<!-- /.row -->
				
 <div >
 
					<div class="panel-body" >
					<?php $button_name = getPhrase('download_excel'); 

					?>
			 
					{!! Form::open(array('url' => URL_PAYMENT_REPORT_EXPORT, 'method' => 'POST', 'name'=>'formQuiz ',  )) !!}
					
				<div class="row">
        <div class="col-sm-12">
            <section class="panel panel-default">
                <header class="panel-heading font-bold">EXPORT PAYMENTS REPORT</header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-3">
                                 <fieldset class='form-group'> 
                                  {{ Form::label('all_records', getphrase('all_records')) }}
                        <div class="m-b-sm">
		                <div class="btn-group toggle-tick">
		                  <label class="btn btn-sm btn-info ss-radio-no active">{{ Form::radio('all_records', 1, true, array('id'=>'paid ', 'name'=>'all_records', 'ng-model'=>'all_records')) }}
		                   <!-- <input type="radio" name="options" id="option1">--><i class="fa fa-check text-active"></i>{{getPhrase('Yes')}}
		                  </label>
		                  <label class="btn btn-sm btn-success ss-radio-no">{{ Form::radio('all_records', 0, false, array('id'=>'free', 'name'=>'all_records', 'ng-model'=>'all_records')) }}
		                   <!-- <input type="radio" name="options" id="option2">--><i class="fa fa-check text-active"></i>{{getPhrase('No')}}
		                  </label>
		                </div>
		              </div>
                       </fieldset> 

                        </div>
                        <div class="col-sm-4" ng-show="all_records==0">
                                <div class="form-group">
                                    <label class="col-lg-12">From Date</label>
                                    <div class="col-lg-12">
                                        <input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="2016-06-12"  name="from_date"> </div>
                                </div>
                        </div>
                        <div class="col-sm-5" ng-show="all_records==0">
                                <div class="form-group">
                                    <label class="col-lg-12">To Date</label>
                                    <div class="col-lg-12">
                                        <input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="2016-06-12"  name="to_date"> </div>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                          {{ Form::label('payment_type', getphrase('payment_type')) }}
                                <div class="m-b-sm">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-sm btn-info active" for="free1">
                                            {{ Form::radio('payment_type', 'all', true, array('id'=>'free1', 'name'=>'payment_type')) }}<i class="fa fa-check text-active"></i> All </label>
                                        <label class="btn btn-sm btn-primary" for="paid1">
                                            {{ Form::radio('payment_type', 'online', false, array('id'=>'paid1', 'name'=>'payment_type')) }}<i class="fa fa-check text-active"></i> Online </label>
                                        <label class="btn btn-sm btn-warning" for="offline">
                                            {{ Form::radio('payment_type', 'offline', false, array('id'=>'offline', 'name'=>'payment_type')) }}<i class="fa fa-check text-active"></i> Offline </label>
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-5">
                           {{ Form::label('payment_status', getphrase('payment_status')) }}
                                <div class="m-b-sm">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-sm btn-info active" for="payment_status_all">
                                            {{ Form::radio('payment_status', 'all', true, array('id'=>'payment_status_all', 'name'=>'payment_status')) }}<i class="fa fa-check text-active"></i> All </label>
                                        <label class="btn btn-sm btn-success" for="payment_status_success">
                                           {{ Form::radio('payment_status', 'success', false, array('id'=>'payment_status_success', 'name'=>'payment_status')) }}<i class="fa fa-check text-active"></i> Success </label>
                                        <label class="btn btn-sm btn-info" for="payment_status_pending">
                                           {{ Form::radio('payment_status', 'pending', false, array('id'=>'payment_status_pending', 'name'=>'payment_status')) }}<i class="fa fa-check text-active"></i> Pending </label>
                                        <label class="btn btn-sm btn-danger" for="payment_status_cancelled">
                                           {{ Form::radio('payment_status', 'cancelled', false, array('id'=>'payment_status_cancelled', 'name'=>'payment_status')) }}<i class="fa fa-check text-active"></i> Cancelled </label>
                                    </div>
                                </div>
                        </div>

                        <div class="buttons text-center m-t">
                            <button class="btn btn-s-md t-m btn-success m-r pull-right"
                             >{{ $button_name }}</button>
                        </div>
                        
                    </div>
                </div>
            </section>
        </div>
                  </div>
					{!! Form::close() !!}
					</div>

				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
@stop

@section('footer_scripts')
 @include('payments.scripts.js-scripts');
<script>
    
$(document).ready(function () {
   $('.toggle-tick input').click(function () {
       $('input:not(:checked)').parent().removeClass("active");
       $('input:checked').parent().addClass("active");
   });    
});
</script>
 
    
@stop
 
 