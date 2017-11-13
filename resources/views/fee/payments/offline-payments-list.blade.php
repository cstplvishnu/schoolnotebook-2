@extends($layout)
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li>{{$title}}</li>
    </ul>

<section class="panel panel-default" ng-controller="fee_payments_report" id="page-wrapper" >
<header class="panel-heading clear"><strong> {{$title}}</strong>
                  
                </header>	
				<!-- Page Heading -->
					
				<!-- /.row -->

				<div class="table-responsive" style="overflow-x:initial;">
						 
						<table class="table table-striped b-t b-light ss-tb datatable">
							<thead>
								<tr>
									<th>{{ getPhrase('fee_category')}}</th>
									<th>{{ getPhrase('name')}}</th>
									<th>{{ getPhrase('paid_amount')}}</th>
									<th>{{ getPhrase('payment_details')}}</th>
									<th>{{ getPhrase('status')}}</th>
									<th>{{ getPhrase('paid_date')}}</th>
									<th class="no-sort">{{ getPhrase('action')}}</th>
								  
								</tr>
							</thead>
							 
						</table>

					</div>
				
			<!-- /.container-fluid -->
			<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
{!! Form::open(array('url' => URL_PAYMENT_APPROVE_OFFLINE_FEE_PAYMENT, 'method' => 'POST', 'name'=>'formQuiz ',  )) !!}
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header ss-border-no  ss-panel-bg ">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <header class="ss-model panel-heading font-bold modal-title m-b-n">{{getPhrase('offline_fee_payment_details')}}</header>
      </div>
      <div class="modal-body">
        <div class="row">
           <div class="col-md-8 col-md-offset-2">
               <p><strong>{{getPhrase('fee_category')}}</strong> : @{{feecategory_title}}</p>
               <p><strong>{{getPhrase('student_name')}}</strong> : @{{user.name}}</p>
            <p><strong>{{getPhrase('paid_amount')}}</strong> : {{getCurrencyCode().' '}} @{{payment_record.paid_amount}}</p>
               <p><strong>{{getPhrase('paid_date')}}</strong> :  @{{payment_record.created_at}}</p>
              
               <p><strong>{{getPhrase('comments')}}</strong> : <textarea class="form-control" name="admin_comment"></textarea></p>
           </div>
           <input type="hidden" name="payment_slug" value="@{{payment_record.slug}}">
        </div>
      </div>
      <div class="modal-footer ss-border-no">
      <button class="btn btn-default " data-dismiss="modal" type="button">{{ getPhrase('cancel')}}</button>
      <button class="btn btn-info " name="submit" value="reject">{{ getPhrase('reject') }}</button>
      <button class="btn btn-success " name="submit" value="approve">{{ getPhrase('approve') }}</button>
      </div>
    </div>
{!! Form::close() !!}
  </div>
</div>
@endsection
 

@section('footer_scripts')
 @include('common.datatables', array('route'=>URL_FEE_OFFLINE_REPORTS_AJAXLIST, 'route_as_url' => TRUE))
  @include('fee.payments.scripts.js-scripts')
  <script>
function viewFeePaymentDetails(record_id)
{
    angular.element('#page-wrapper').scope().setDetails(record_id);
    angular.element('#page-wrapper').scope().$apply() 
 $('#myModal').modal('show');
}
</script>

@stop
