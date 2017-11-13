@extends($layout)

@section('content')

 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li>{{$title}}</li>
    </ul>

<div id="page-wrapper">

{!! Form::open(array('url' => URL_PAYNOW_FEE, 'method' => 'POST', 'id'=>'payform')) !!} 

								
									<input type="hidden" name="gateway" id="gateway" value="">
									<input type="hidden" name="user_id"  value="{{$user->id}}">
									<input type="hidden" name="student_id"  value="{{$student->id}}">
									<input type="hidden" name="amount_to_pay" value="{{$amount_to_pay}}">
									<input type="hidden" name="current_feecategory_id" value="{{$current_feecategory_id}}">
<!-- 									<input type="hidden" name="paid_amount" id="paid_amount" value="">
 -->

									


									{!! Form::close() !!}





			<div class="row">
                  <div class="col-sm-9 col-sm-offset-1">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">

					<font size="4px" >{{getPhrase('dear')}} <strong>{{$user->username}}</strong> {{getPhrase('you_have_to_pay_the_amount')}} <strong>{{getCurrencyCode()}} {{$amount_to_pay}}</strong></font>

						

						<div class="row">

							<div class="ordered-item">

							

								<div class="col-md-6 centered">

									<div>

								

									<div class="input-group" >

              						</div>

                  	

									</div>

								</div>


                         
                                </div>

						</div>



					

						<div class="row m-t-md">

							<div class="col-md-12 text-center">

								<div class="payment-type clear m-r">

									<div class="pull-right">

									<?php 

									$payu = getSetting('payu', 'module'); 

									

									$paypal = getSetting('paypal', 'module'); 

									$offline = getSetting('offline_payment', 'module'); 

									if($payu == '1') {

									?>

									<button type="submit" onclick="submitForm('payu');"  class="btn btn-s-md btn-success btn-card"><i class=" icon-credit-card"></i> {{getPhrase('payu')}}</button> 

									<?php } 

									if($paypal=='1') {

									?>

									

									<button type="submit" class="btn btn-s-md btn-dark btn-paypal" onclick="submitForm('paypal');"><i class="icon-paypal"></i> {{getPhrase('paypal')}}</button>

									<?php } 

									if($offline=='1') {

									?>

									<button type="submit" class="btn btn-info" onclick="submitForm('offline');" data-toggle="tooltip" data-placement="right" title="{{ getPhrase('click_here_to_update_payment_details') }}"><i class="fa fa-money" ></i> {{getPhrase('offline_payment')}}</button>

									<?php } ?>

									</div>

								</div>

							</div>

						</div>

                         </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
		

<script type="text/javascript">

	function submitForm(gatewayType) {

		$('#gateway').val(gatewayType);

		$('#payform').submit();

	}

</script>



</div>

@stop

@section('footer_scripts')


@include('common.alertify')

@stop

