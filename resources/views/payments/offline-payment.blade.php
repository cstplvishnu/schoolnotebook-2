@extends($layout)

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
			      <li><a href="{{URL_PAYMENTS_CHECKOUT.$type.'/'.$slug}}">{{getPhrase('payment_types')}}</a></li>
			     <li class="active">{{getPhrase('offline_payment_form')}}</li>
			    </ul>
					@include('errors.errors')
<div class="row">
                  <div class="col-sm-9 col-sm-offset-1">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
					
					 <div class="jumbotron">
					  <h3>{{getPhrase('offline_payment_instructions')}}</h3>
					  <?php $instructions = $paypal = getSetting('offline_payment_information', 'payment_gateways'); ?>
					  {!!$instructions!!}
					</div>
					{!! Form::open(array('url' => URL_UPDATE_OFFLINE_PAYMENT, 'method' => 'POST', 'name'=>'formQuiz ',  )) !!}
					 
					<input type="hidden" name="payment_data" value="{{$payment_data}}">
					<div class="row">
					 <fieldset class="form-group col-md-12">
					 {{ Form::label('payment_details', getphrase('payment_details')) }}
						<span class="text-danger">*</span>
							 <textarea name="payment_details" ng-model="payment_details"
							 required="true" class='form-control ckeditor'  rows="5"></textarea>
						<div class="validation-error"    >
	    					{!! getValidationMessage()!!}
						</div>
					</fieldset>
					</div>
				
						<div class="buttons text-right">
							<button class="btn btn-success"
							 >{{ getPhrase('ok') }}</button>
						</div>
					{!! Form::close() !!}
				       
				       </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@stop

@section('footer_scripts')
<script >
	history.pushState(null, null, location.href);
window.onpopstate = function(event) {
    history.go(1);
};
</script>

 @include('common.validations');
    
@stop
 
 