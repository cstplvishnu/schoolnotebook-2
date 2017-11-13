@extends($layout)
@section('header_scripts')
{!! Charts::assets() !!}
@stop
@section('content')

<div id="page-wrapper">
			<div class="container-fluid">
			<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							 
							<li><i class="fa fa-home"></i> {{ $title}}</li>
						</ol>
					</div>
				</div>

				 <div class="row">
					<div class="col-md-3">
						<div class="card card-blue text-xs-center helper_step1">
							<div class="card-block">
					  <h4 class="card-title">
					  <i class="fa fa-bars"></i>
					  </h4>

								<p class="card-text">{{ getPhrase('fee_particulars')}}</p>
							</div>
							<a class="card-footer text-muted" 
							href="{{URL_FEE_PARTICULARS}}">
								{{ getPhrase('view_all')}}
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card card-green text-xs-center helper_step2">
							<div class="card-block">
					  
					  	<h4 class="card-title">
								<i class="fa fa-th"></i>
						  
					  </h4>

								<p class="card-text">{{ getPhrase('fee_categories')}}</p>
							</div>
							<a class="card-footer text-muted" 
							href="{{URL_FEE_CATEGORIES}}">
								{{ getPhrase('view_all')}}
							</a>
						</div>
					</div>
                  <div class="col-md-3">
						<div class="card card-red text-xs-center helper_step2">
							<div class="card-block">
					  
					  	<h4 class="card-title">
								<i class="fa fa-money" aria-hidden="true"></i>
						  
					  </h4>

								<p class="card-text">{{ getPhrase('pay_fee')}}</p>
							</div>
							<a class="card-footer text-muted" 
							href="{{URL_FEE_ACCEPT}}">
								{{ getPhrase('view_all')}}
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card card-yellow text-xs-center helper_step2">
							<div class="card-block">
					  
					  	<h4 class="card-title">
								<i class="icon-total-time"></i>
						  
					  </h4>

								<p class="card-text">{{ getPhrase('fee_reports_class_wise')}}</p>
							</div>
							<a class="card-footer text-muted" 
							href="{{URL_CLASS_WISE_FEE_PAID_HISTORY}}">
								{{ getPhrase('view_all')}}
							</a>
						</div>
					</div>
				</div>
                     {!! Charts::assets() !!}


                   <div class="row">
                    <div class="col s12">
                        <div class="cs-card cs-form-card">
                            <h4 class="cs-heading-small">Monthly Analysis</h4>
                            <div class="col-md-8" >
                                 {!! $chart->render() !!}
                            </div>
                             <h4 class="cs-heading-small">Overall summary</h4>
                            <div class="col-md-4">
                         		<?php 
                         		$summary = (object)App\FeeParticularPayment::getOverallPayments();

                         		$cc =Charts::create('bar', 'highcharts')
					    ->title('Last 30 days payments')
					    ->elementLabel('Overall monthly summary')
					    ->labels(['Expected Amount', 'Paid Amount'])
					    ->values([$summary->amount, $summary->paid])
					    
					    ->responsive(true);?>
					    {!! $cc->render() !!}  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-md-6 col-md-offset-3">
                	 <h4 class="cs-heading-small">Category Analysis</h4>
                	 <?php $categories = App\FeeCategory::where('status','=',1)->get();

                	       ?>
                            @foreach($categories as $category)

                              {!! $category->getOverallPayments($category->id) !!}
                              @endforeach

                		 
                	</div>
                </div>
		 
	 
</div>
		<!-- /#page-wrapper -->

@stop

@section('footer_scripts')
 
@stop
