@extends($layout)
@section('header_scripts')
{!! Charts::assets() !!}
@stop
@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
    <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
    <li><strong>{{getPhrase('dashboard')}}</strong></li>
</ul>


			
<section class="panel panel-default ss-panel-bg" data-target=".ss-super-admins">
    <div class="row m-l-none m-r-none bg-light lter">

        <div class="col-sm-6 col-md-3 padder-v b-r b-light ss-super-admins"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-primary"></i>
                      <i class="fa fa-th fa-stack-1x text-white"></i>
                   <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
                    
            <a class="clear" href="{{URL_FEE_CATEGORIES}}"> <span class="h3 block m-t-xs"><strong>{{ App\FeeCategory::get()->count()}}</strong></span> <small class="text-muted text-uc">{{getPhrase('fee_categories')}}</small> </a>
        </div>

        <div class="col-sm-6 col-md-3 padder-v b-r b-light ss-super-admins"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-bars fa-stack-1x text-white"></i>
                   <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
                    
            <a class="clear" href="{{URL_FEE_PARTICULARS}}"> <span class="h3 block m-t-xs"><strong>{{ App\Feeparticulars::get()->count()}}</strong></span> <small class="text-muted text-uc">{{getPhrase('fee_particulars')}}</small> </a>
        </div>

        <div class="col-sm-6 col-md-3 padder-v b-r b-light ss-super-admins"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-warning"></i>
                      <i class="fa fa-money fa-stack-1x text-white"></i>
                   <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
                    
            <a class="clear" href="{{URL_FEE_ACCEPT}}"> <span class="h3 block m-t-xs"><strong></strong></span> <small class="text-muted text-uc">{{getPhrase('pay_fee')}}</small> </a>
        </div>

         <div class="col-sm-6 col-md-3 padder-v b-r b-light ss-super-admins"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-success"></i>
                      <i class="fa fa-clock-o fa-stack-1x text-white"></i>
                   <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
                    
            <a class="clear" href="{{URL_FEE_REPORTS_DAILY}}"> <span class="h3 block m-t-xs"><strong></strong></span> <small class="text-muted text-uc">{{getPhrase('fee_reports')}}</small> </a>
        </div>

        

    </div>    

</section>
                     {!! Charts::assets() !!}


                    <div class="row">
                    <div class="col-lg-12">
                        <div class="cs-card cs-form-card">
                           
                            <div class="col-md-8 col-md-offset-1" >
                                 {!! $chart->render() !!}
                            </div>
                             <h4 class="cs-heading-small font-bold text-center">Overall summary</h4>
                            <div class="col-md-3">
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
                	<div class="col-md-6 col-md-offset-4">
                	 <h4 class="cs-heading-small ">Category Analysis</h4>
                	 <?php $categories = App\FeeCategory::where('status','=',1)->get();

                	       ?>
                            @foreach($categories as $category)

                              {!! $category->getOverallPayments($category->id) !!}
                              @endforeach

                		 
                	</div>
                </div>
               
		<!-- /#page-wrapper -->

@stop

@section('footer_scripts')
 
@stop
