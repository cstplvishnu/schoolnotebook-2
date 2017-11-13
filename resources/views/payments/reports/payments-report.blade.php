@extends($layout)
@section('content')
  <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}} </a></li>
      <li>{{ $title}}</li>
    </ul>

<section class="panel panel-default ss-panel-bg">
    <div class="row m-l-none m-r-none bg-light lter">

    	 <div class="col-sm-6 col-md-3 padder-v b-r b-light ss-super-admins"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-money fa-stack-1x text-white"></i>
                    </span>
         <a class="clear" href="@if($payment_mode=='online')
							{{URL_ONLINE_PAYMENT_REPORT_DETAILS}}
							@else {{URL_OFFLINE_PAYMENT_REPORT_DETAILS}}
							@endif
							all"><span class="h3 block m-t-xs"><strong>{{$payments->all}}</strong></span> <small class="text-muted text-uc">{{ getPhrase('payments')}}</small></a>
        </div>

        

        

        <div class="col-sm-6 col-md-3 padder-v b-r b-light ss-super-admins"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-success"></i>
                      <i class="fa fa-check fa-stack-1x text-white"></i>
                    </span>
          <a class="clear" href="@if($payment_mode=='online')
							{{URL_ONLINE_PAYMENT_REPORT_DETAILS}}
							@else {{URL_OFFLINE_PAYMENT_REPORT_DETAILS}}
							@endif
							success"><span class="h3 block m-t-xs"><strong>{{$payments->success}}</strong></span> <small class="text-muted text-uc">{{ getPhrase('success')}}</small></a>
        </div>

        <div class="col-sm-6 col-md-3 padder-v b-r b-light ss-super-admins"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-warning"></i>
                      <i class="fa fa-tasks fa-stack-1x text-white"></i>
                    </span>
          <a class="clear" href="@if($payment_mode=='online')
							{{URL_ONLINE_PAYMENT_REPORT_DETAILS}}
							@else {{URL_OFFLINE_PAYMENT_REPORT_DETAILS}}
							@endif
							pending"><span class="h3 block m-t-xs"><strong>{{$payments->pending}}</strong></span> <small class="text-muted text-uc">{{ getPhrase('pending')}}</small></a>
        </div>

        <div class="col-sm-6 col-md-3 padder-v b-r b-light ss-super-admins"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-danger"></i>
                      <i class="fa fa-times-circle-o fa-stack-1x text-white"></i>
                    </span>
          <a class="clear" href="@if($payment_mode=='online')
							{{URL_ONLINE_PAYMENT_REPORT_DETAILS}}
							@else {{URL_OFFLINE_PAYMENT_REPORT_DETAILS}}
							@endif
							cancelled"><span class="h3 block m-t-xs"><strong>{{ $payments->cancelled }}</strong></span> <small class="text-muted text-uc">{{ getPhrase('cancelled')}}</small></a>
        </div>

    </div>
</section>    

 
 <div class="row">

        <div class="col-md-6">
            <section class="panel panel-default">
                <header class="panel-heading font-bold">{{getPhrase('payment_statistics')}}</header>
                 <div>
                  <div class="panel-body" >
              <canvas id="payments_chart" width="100" height="60"></canvas>
            </div>
          </div>
           </section>
        </div>

        <div class="col-md-6">
          <section class="panel panel-default">
              <header class="panel-heading font-bold">{{getPhrase('payment_monthly_statistics')}}</header>
                 <div >
               <div class="panel-body" >
              <canvas id="payments_monthly_chart" width="100" height="60"></canvas>
            </div>
          </div>
        </section>
        </div>

        
      </div>

@stop

@section('footer_scripts')
 
 @include('common.chart', array('chart_data'=>$payments_chart_data,'ids' =>array('payments_chart'), 'scale'=>TRUE))
 @include('common.chart', array('chart_data'=>$payments_monthly_data,'ids' =>array('payments_monthly_chart'), 'scale'=>true))
 
 

@stop

