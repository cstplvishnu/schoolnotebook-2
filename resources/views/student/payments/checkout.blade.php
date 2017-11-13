@extends($layout)

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
     <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>

              @if($item_type=='combo' || $item_type=='exam')

              <li> <a href="{{URL_STUDENT_EXAM_SERIES_LIST}}">{{getPhrase('exam_series')}} </a> </li>

              @else

              <li> <a href="{{URL_STUDENT_LMS_SERIES}}">{{getPhrase('learning_management_series')}} </a> </li>

              @endif

              <li class="active"> {{ $title }} </li>
    </ul>

<div id="page-wrapper" ng-init="intilizeData({{$item}})" ng-controller="couponsController">

{!! Form::open(array('url' => URL_PAYNOW.$item->slug, 'method' => 'POST', 'id'=>'payform')) !!} 

								 <input type="hidden" name="item_name" id="item_name" ng-model="item_name" value="{{$item->slug}}">

									<input type="hidden" name="gateway" id="gateway" value="" >

									<input type="hidden" name="type" ng-model="item_type" value="{{$item_type}}" >

									<input type="hidden" name="is_coupon_applied" id="is_coupon_applied"  value="0" >

									<input type="hidden" name="coupon_id" id="coupon_id"  value="0" >

									<input type="hidden" name="actual_cost" id="actual_cost" value="{{$item->cost}}" >

									<input type="hidden" name="discount_availed" id="discount_availed"  value="0" >

									<input type="hidden" name="after_discount" id="after_discount" value="{{$item->cost}}" >

									 <input type="hidden" name="parent_user" value="{{$parent_user}}">	

									 <?php 

									 		$selected_child_id = 0;

									 		if($parent_user) {

									 			if(count($children))

									 			{

									 				$selected_child_id = $children[0]->id;

									 			}

									 		}

									 ?>

									 <input type="hidden" name="parent_user" value="{{$parent_user}}">	

									 <input type="hidden" id="selected_child_id" name="selected_child_id" value="{{$selected_child_id}}">	

									{!! Form::close() !!}





			

			

				<!-- /.row -->
				
			<!--	panel header section starts here-->
                
                <div class="row">
                  <div class="col-sm-8 col-xs-12">
                    <section class="panel panel-default">
                    <header class="panel-heading font-bold">{{getPhrase('checkout')}}</header>
                    
                   <div class="row">
                     <div class="col-sm-12">
                       <div class="panel-body">
                           <div class="row">
                               <div class="col-md-7 col-sm-7 col-xs-12">
                                   <h4 class="font-bold m-b-lg">{{getPhrase('item')}}</h4>
                                   
                                   
                               
                                   
                                <article class="comment-item m-b-lg">
                                  <a class="pull-left m-r">
                                   
									<?php if($item_type=='combo' || $item_type=='lms')	{

										$image = IMAGE_PATH_UPLOAD_LMS_DEFAULT;

										if($item->image)

											$image = IMAGE_PATH_UPLOAD_SERIES_THUMB.$item->image;

										$image_path = $image;

										if($item_type=='lms') {

											if($item->image)

											$image_path = IMAGE_PATH_UPLOAD_LMS_SERIES_THUMB.$item->image;

										}

									?>


               <i class="icon"><img class="icon-images" src="{{$image_path}}" alt="{{$item->title}}" height="70" width="70" ></i>

									<?php } ?>
                                  </a>
                                  <section class="comment-body m-b-lg">
                                    <header>
                                        <a href="javascript:void(0);"><h5 class="font-bold">{{$item->title}}</h5></a>
                                    </header>
                                    <div>{{getPhrase('valid_for').' '.$item->validity.' '.getPhrase('days')}}</div>
                                  </section>
                                </article>
                                   
                                   
                                   
                                   
                                   	<div class="apply-coupon m-b-lg m-t-xl">

								@if(getSetting('coupons', 'module') ==  '1')

									<div class="input-group" >

										<input type="text" ng-model="coupon_code" class="form-control apply-input-lg" placeholder="{{getPhrase('enter_coupon_code')}}" ng-disabled="isApplied" >

										<span class="input-group-btn">

              								<button class="btn btn-success button apply-input-button" ng-click="validateCoupon('{{$item->slug}}','{{$item_type}}', {{$item->cost}}, {{$selected_child_id}})" type="button" ng-disabled="isApplied">{{getPhrase('apply')}}</button>

              							</span> 

              						</div>

                  				@endif

									</div>
                                   
                               </div>
                               
                               
                               <div class="col-md-5 col-sm-5 col-xs-12">
                                   <div class="row">
                                       <div class="col-sm-6 col-xs-12">
                                           <header class="font-bold m-b-xs">{{getPhrase('cost')}}</header>
                                           
                                           <label>{{ getCurrencyCode().$item->cost }}</label>
                                       </div>
                                       <div class="col-sm-6 col-xs-12">
                                           <header class="font-bold m-b-xs">{{getPhrase('total')}}</header>
                                           
                                           <label>{{ getCurrencyCode().$item->cost }}</label>
                                       </div>
                                   </div>
                                   
                                   
                                   <div class="row">
                                   
                                       
                                            
                                            <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                            <li class="list-group-item">
                              <a href="#" class="clear">
                                <small class="pull-right">{{ getCurrencyCode().$item->cost }}</small>
                                <strong class="block">Cart Subtotal</strong>
                              </a>
                            </li>
                            
                            <li class="list-group-item">
                              <a href="#" class="clear">
                                <small class="pull-right">{{ getCurrencyCode()}}
                                  <span contenteditable="false" ng-bind="ngdiscount">0</span></small>
                                <strong class="block">Discount</strong>
                              </a>
                            </li>
                            
                            <li class="list-group-item">
                              <a href="#" class="clear">
                                <small class="pull-right">{{ getCurrencyCode()}}
                                  <span contenteditable="false" ng-bind="ngtotal">{{$item->cost}}</span></small>
                                <strong class="block">Order Total</strong>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </section>                               
                                                                                         
                                                                                                   
                                   
                                   </div>
                               
                               </div>
                               
                               
                              <!-- payment gate way section starts here-->
                               
                               <div class="row">
                                 <div class="col-sm-12">
                                    
                                      
                                         @if($parent_user)

					 	@if(count($children))
							<div id="childrens_list_div">
							@include('student/payments/childrens-list', array('children'=>$children, 'item_type'=>$item_type, 'item_id'=>$item->id ) )
							</div>

						@else

							<h3>{{getPhrase('please_add_children_to_continue_payment')}}</h3>

						@endif

					 @endif

					<?php 

							$is_eligible_for_payment = TRUE;

							if($parent_user) {

								if(!count($children))

									$is_eligible_for_payment = FALSE;

							}

                          ?>

					@if($is_eligible_for_payment)

						<div class="row m-t-md">

							<div class="col-md-12">

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

					@endif
                                          
                                              
                                 </div>
                               </div>
                               
                               
                           </div>  
                       </div>
                     </div>
                   </div>
                    
                  </section>
                    </div>
                    <!--aside nav bar path-->
                    <div class="col-sm-4 col-xs-12">
                       
                       
               <section class="panel panel-default clear">
                <header class="panel-heading font-bold">Billing Details</header>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel-body">
                            
                            
                            
                            
                <section class="scrollable hover">
                  <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-alt list-group-lg">
                    <li class="list-group-item ss-noborderd">
                      <a href="#" class="clear">
                        <small class="pull-right text-muted">Shana Rey</small>
                        <strong>Name</strong>
                      </a>
                    </li>
                    
                    <li class="list-group-item ss-noborderd">
                      <a href="#" class="clear">
                        <small class="pull-right text-muted">hassie69@gmail.com</small>
                        <strong>Email</strong>
                      </a>
                    </li>
                    
                    <li class="list-group-item ss-noborderd">
                      <a href="#" class="clear">
                        <small class="pull-right text-muted">0616826622</small>
                        <strong>Phone</strong>
                      </a>
                    </li>
                  </ul>
                </section>
                            
                            <div class="panel-heading m-t-lg">
                            <header class="font-bold m-b">Billing Address</header>
                            <p class="m-t">86446 Flatley View Suite 937 Beierside, WV 13921</p>
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

@include('coupons.scripts.js-scripts', array('item'=>$item))

@include('common.alertify')

@stop

