@extends($layout)
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')
 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      @if($payment_mode=='online')
      <li><a href="{{URL_ONLINE_PAYMENT_REPORTS}}">{{$payments_mode}}</a> </li>
      @else
      <li><a href="{{URL_OFFLINE_PAYMENT_REPORTS}}">{{$payments_mode}}</a> </li>
      @endif
      <li>{{$title}}</li>
 </ul>

<section class="panel panel-default" id="page-wrapper" ng-controller="payments_report">
           
                     <header class="panel-heading clear"><strong> {{$title}}</strong> </header>
                   
                        <div class="table-responsive" style="overflow-x:initial;"> 
                        <table class="table table-striped b-t b-light ss-tb datatable">
                            <thead>
                                <tr>
                                    <th class="no-sort"></th>
                                    <th>{{ getPhrase('user_name')}}</th>
                                    <th>{{ getPhrase('item')}}</th>
                                    <th>{{ getPhrase('plan')}}</th>
                                    <th>{{ getPhrase('start_date')}}</th>
                                    <th>{{ getPhrase('end_date')}}</th>
                                    <th>{{ getPhrase('payment_gateway')}}</th>
                                    <th>{{ getPhrase('updated_at')}}</th>
                                    <th class="no-sort">{{ getPhrase('payment_status')}}</th>
                                    
                                </tr>
                            </thead>
                             
                        </table>
                        </div>

                    
               
          
            <!-- /.container-fluid -->
            <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
{!! Form::open(array('url' => URL_PAYMENT_APPROVE_OFFLINE_PAYMENT, 'method' => 'POST', 'name'=>'formQuiz ',  )) !!}
    <!-- Modal content-->
    <div class="modal-content">
     
      
         <button type="button" class="close ss-close" data-dismiss="modal">&times;</button>
       
        <header class="ss-model panel-heading font-bold modal-title">{{getPhrase('offline_payment_details')}}</header>
        
        
      
      <div class="modal-body">
        <div class="row">
           <div class="col-md-8 col-md-offset-2">
               <p><strong>{{getPhrase('name')}}</strong> : @{{payment_record.item_name}}</p>
               <p><strong>{{getPhrase('cost')}}</strong> : {{getCurrencyCode().' '}} @{{payment_record.cost}}</p>
               <p><strong>{{getPhrase('coupon_applied')}}</strong> : @{{coupon_applied}}</p>
               <p><strong> @{{payment_record.other_details.coupon_applied}}</strong></p>
               <div ng-if="other_details.is_coupon_applied==1">
               <p><strong>{{getPhrase('discount')}}</strong> : {{getCurrencyCode().' '}}@{{other_details.discount_availed}}</p>
               <p><strong>{{getPhrase('after_discount')}}</strong> : {{getCurrencyCode().' '}}@{{other_details.after_discount}}</p>
               </div>
               <p><strong>{{getPhrase('plan_type')}}</strong> : @{{payment_record.plan_type}}</p>
               <p><strong>{{getPhrase('notes')}}</strong> :  @{{payment_record.notes}}</p>
               <p><strong>{{getPhrase('created_at')}}</strong> : @{{payment_record.created_at}}</p>
               <p><strong>{{getPhrase('updated_at')}}</strong> : @{{payment_record.updated_at}}</p>
               <p><strong>{{getPhrase('comments')}}</strong> : <textarea class="form-control" name="admin_comment"></textarea></p>
               <input type="hidden" name="record_id" value="@{{payment_record.id}}">
           </div>
        </div>
      </div>
      <div class="modal-footer ss-border-no">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ getPhrase('cancel')}}</button>
      <button class="btn btn-info" name="submit" value="reject" >{{ getPhrase('reject') }}</button>
      <button class="btn btn-success" name="submit" value="approve" >{{ getPhrase('approve') }}</button>
      </div>
    
    </div>  
{!! Form::close() !!}
  </div>
</div>
</section>
       
@endsection
 
@section('footer_scripts')
  
 @include('common.datatables', array('route'=>$ajax_url, 'route_as_url' => TRUE))
 @include('payments.scripts.js-scripts');
<script>
function viewDetails(record_id)
{
    angular.element('#page-wrapper').scope().setDetails(record_id);
    angular.element('#page-wrapper').scope().$apply() 
 $('#myModal').modal('show');
}
</script>
@stop
