@extends($layout)
@section('content')

<div id="page-wrapper">
			<div class="container-fluid">
			<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							 <li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
							 <li>{{ $title}}</li>
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

								<p class="card-text">{{ getPhrase('fee_reports')}}</p>
							</div>
							<a class="card-footer text-muted" 
							href="{{URL_FEE_REPORTS}}">
								{{ getPhrase('view_all')}}
							</a>
						</div>
					</div>
				</div>
@stop

@section('footer_scripts')

@stop
