@extends($layout)
@section('header_scripts')
@stop
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
            <li>{{$title}}</li>
          </ul>

          <div class="row">
                  <div class="col-sm-9 col-sm-offset-1">
                     <section class="panel panel-default" ng-controller="feePayController">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">

                    
                         {!! Form::open(array('url' => URL_STUDENT_FEE_PAY_ADD, 'method' => 'POST','name'=>'formSchedule', 'novalidate'=>'')) !!}
                        <div class="row">

                        <fieldset class="form-group col-md-6">

                           {{ Form::label('feeCategories', getphrase('fee_categories')) }}

                            <span class="text-danger">*</span>

                            {{ Form::select('feeCategories', $feeCategories, null, 
                            ['class'=>'form-control',
                            "id"=>"feeCategories", 
                            "ng-model"=>"feeCategories", 
                            "ng-change" => "categoryChanged(feeCategories)",
                            'required'=> 'true', 
                             'ng-class'=>'{"has-error": formSchedule.feeCategories.$touched && formSchedule.feeCategories.$invalid}',
                         ])}}
                        <div class="validation-error" ng-messages="formSchedule.feeCategories.$error" >
                             {!! getValidationMessage()!!}
                         </div>
                            

                        </fieldset>

                        <fieldset ng-if="selected_feecategory" class="form-group col-md-6">
                       
                         <label for = "student_id">{{getPhrase('select_student')}} <span class="text-danger">*</span></label>
                        <select 
                        name      = "student_id" 
                        id        = "student_id" 
                        class     = "form-control" 
                        ng-model  = "student_id" 
                        ng-change = "getStuduntFeeDetails(selected_feecategory, student_id)"
                        ng-options= "option.id as option.roll_no+'-'+option.first_name+' '+option.middle_name+' '+option.last_name for option in students track by option.id">
                        <option value="">{{getPhrase('select')}}</option>
                        </select>
                    </fieldset> 
                  
                  </div>

                  <div class="row" ng-if="selected_studentid">
                    <div class="col-md-12">
                    <div class="btn btn-primary panel-btn collapsed" data-toggle="collapse" data-target="#student_details_box">{{getPhrase('student_details')}} <span class="dc-caret">
                   <i class="fa fa-angle-down" aria-hidden="true"></i></span></div>

                      <div class="collapse panel-expand-box" id="student_details_box">
                      <div class="row">
                          <div class="col-md-2">
                               <div class="profile-details text-center" ng-if="student_image==''">
                            <div class="profile-img"><img src="{{IMAGE_PATH_PROFILE_DEFAULT}}" alt=""  style="width: 100px;height: 100px;" class="img-circle"></div>
                        </div>
                            <div class="profile-details text-center" ng-if="student_image!=''">
                            <div class="profile-img"><img src="{{IMAGE_PATH_PROFILE}}@{{student_image}}" alt=""  style="width: 100px;height: 100px;" class="img-circle"></div>
                        </div>
                             <b class="text-center" style="display: block;"> 
                             @{{student.first_name + student.middle_name + student.last_name | uppercase}} - @{{student.roll_no}}
                             </b>
                        </div>
                          
                          <div class="col-md-10">
                             <div class="row">
                                 <div class="col-md-4 col-md-offset-1">
                                     <table class="table panel-table">
                                         <tbody>
                                             <tr>
                                                 <th>{{getPhrase('academic_year')}}</th>
                                                 <td>@{{academic_data.academic_title}}</td>
                                             </tr> 
                                             <tr>
                                                 <th>{{getPhrase('branch')}}</th>
                                                 <td>@{{academic_data.course_parent_title}}</td>
                                             </tr>
                                             <tr>
                                                 <th>{{getPhrase('class')}}</th>
                                                 <td>@{{academic_data.course_title}} @{{student.current_year}} year @{{student.current_semister}} semister</td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>
                                 <div class="col-md-6">
                                      <table class="table panel-table">
                                         <tbody>
                                             <tr>
                                                 <th>{{getPhrase('father_name')}}</th>
                                                 <td>@{{student.fathers_name}}</td>
                                             </tr> 
                                             <tr>
                                                 <th>{{getPhrase('email')}}</th>
                                                 <td>@{{user_details.email}}</td>
                                             </tr>
                                             <tr>
                                                 <th>{{getPhrase('phone')}}</th>
                                                 <td>@{{user_details.phone}} </td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                          </div>
                      </div>
                      </div>
                      </div>
                  </div>
           {{--        <br>
                  <div class="row" ng-if="selected_studentid">
                  <div class="col-md-12">
                 <div class="btn btn-primary panel-btn collapsed" data-toggle="collapse" data-target="#fee_details_box">{{getPhrase('fee_details')}}
                <span class="dc-caret">
                   <i class="fa fa-angle-down" aria-hidden="true"></i></span></div>
                  <br>
                      <div class=" collapse panel-expand-box" id="fee_details_box">
                      <div class=" pad15">
                         <div class="row">
                          <div class="col-md-6">
                              <div class="panel panel-primary">
                              <div class="panel-heading">Fee Details</div>
                                <div class="panel-body">Fee Details comes here</div>
                            </div>
                          </div>
                          <div class="col-md-6">
                              <div class="panel panel-primary">
                              <div class="panel-heading">Payments History</div>
                                <div class="panel-body">Payments History comes here</div>
                            </div>
                          </div>
                         </div>
                         </div>
                      </div>
                  </div>
                  </div> --}}

                  <br>

            <div class="row" ng-if="selected_studentid">
            <div class="col-md-12">
            {{-- <div>
             <h2>{{getPhrase('student_details')}}</h2>
               <p><u>{{getPhrase('student_name')}}</u> : <b> @{{student.first_name}} @{{student.middle_name}} @{{student.last_name}}</b></p>
               <p><u>{{getPhrase('father_name')}}</u> : <b>@{{student.fathers_name}}</b></p>
               <p><u>{{getPhrase('academic_year')}}</u> : <b>@{{academic_data.academic_title}}</b></p>
               <p><u>{{getPhrase('branch')}}</u> : <b>@{{academic_data.course_parent_title}}</b></p>
               <p><u>{{getPhrase('class ')}}</u> : <b>@{{academic_data.course_title}}</b></p>
               <p><u>{{getPhrase('year')}}</u> : <b>@{{student.current_year}}</b></p>
               <p><u>{{getPhrase('semister')}}</u> : <b>@{{student.current_semister}}</b></p>  
               
                   
                       

            </div> --}}
                  <div class="btn btn-primary panel-btn collapsed" data-toggle="collapse" data-target="#fee_particulars_box">{{getPhrase('fee_particulars')}}
                     <span class="dc-caret">
                   <i class="fa fa-angle-down" aria-hidden="true"></i></span></div>

                   <div class="collapse panel-expand-box" id="fee_particulars_box">
                     <table  class="table feeparticulars-table table-bordered">

                    <thead>
                        <tr>
                             <th colspan="2" class="text-center" >{{getPhrase('particulars')}}</th>
                             <th colspan="5" class="text-center">{{getPhrase('details')}}</th>
                             <th class="text-center">{{getPhrase('total_to_pay')}}</th>
                             
                           </tr>
                        
                        <tr>
                        <td colspan="2">&nbsp;</td>
                          <td class="text-center">Amount</td>
                          <td colspan="2" class="text-center">Paid</td>
                          
                          <td colspan="2" class="text-center">Discount</td>
                          <td>&nbsp;</td>
                        </tr>
                       
                    </thead>
                    
                    <tbody>
                   
                    <tr ng-repeat="item in payment_details | filter:search track by $index">

                    

                       <?php $currency = getSetting('currency_symbol','site_settings'); ?>

                     <td colspan="2" ng-if="item.is_term==1">Term - @{{item.installment}}</td>
                     <td colspan="2" ng-if="item.is_term==0"> (Others) </td>


                    <td class="text-right">
                    {{$currency}} @{{item.total_amount | currency : '' : 2}}
                    
                     
                    </td>
                    
                    <td colspan="2" class="text-right">
                     <span ng-if="item.paid_amount==0"> - </span>
                     <span ng-if="item.paid_amount>0"> {{$currency}} @{{item.paid_amount| currency : '' : 2}} </span>
              
                    </td>

                     <td colspan="2" class="text-right">
                     <span ng-if="item.discount_data==0"> - </span>
                     <span ng-if="item.discount_data>0"> {{$currency}} @{{item.discount_data| currency : '' : 2}} </span>
              
                    </td>
                     <td colspan="2" class="text-right">
                       <span ng-if="(item.total_amount - item.paid_amount)==0"> - </span>
                        <span ng-if="(item.total_amount - item.paid_amount)>0">  {{$currency}} @{{(item.total_amount - (item.paid_amount + item.discount_data))| currency : '' : 2}}
                        </span>
                        
                     </td>
                    <input type="hidden" name="is_term[]" value="@{{item.is_term}}">
                    <input type="hidden" name="feeschedule_id[]" value="@{{item.feeschedule_id}}">
                    <input type="hidden" name="feeschedule_praticular_id[]" value="@{{item.feeschedule_praticular_id}}">
                    <input type="hidden" name="particular_id[]" value="@{{item.payment_record.feeparticular_id}}">
                    <input type="hidden" name="term_number[]" value="@{{item.installment}}">
                    <input type="hidden" name="academic_id[]" value="@{{item.academic_id}}">
                    <input type="hidden" name="course_parent_id[]" value="@{{item.course_parent_id}}">
                    <input type="hidden" name="course_id[]" value="@{{item.course_id}}">
                    <input type="hidden" name="year[]" value="@{{item.year}}">
                    <input type="hidden" name="semister[]" value="@{{item.semister}}">

                    </tr> 
 
                    </tbody>
                      <tfoot>
                        <tr>
                         
                          <td colspan="2"><strong>{{getPhrase('total')}}</strong></td>
                          <td class="text-right"><strong>{{$currency}} @{{total_fee | currency : '' : 2}}</strong></td>
                          <td colspan="2" class="text-right">

                          <span ng-if="total_amount_paid==0"> - </span>
                          <span ng-if="total_amount_paid>0"><strong> {{$currency}} @{{(total_amount_paid) | currency : '' : 2 }}</strong></span>

                          </td>
                           <td colspan="2" class="text-right" >

                          <span ng-if="discount_sum==0"> - </span>
                          <span ng-if="discount_sum>0"><strong> {{$currency}} @{{(discount_sum) | currency : '' : 2 }}</strong></span>

                          </td>
                          <td class="text-right"><strong>{{$currency}} @{{net_amount_to_pay | currency : '' : 2}}</strong></td>

                        </tr>
                      </tfoot>
                    </table>
                    </div>
                   
                  </div> 
                  </div>
                  <br>
                  <div class="row">
                   <div class="col-md-12">
                  <?php $minimum_percentage = 100;// getSetting('minimum_fee_accept_percentage', 'fee_settings'); 

                  ?>
              {{--     <div ng-if="selected_studentid" class="alert alert-info">
                    
                    <strong>Info! </strong> 
                    @if($minimum_percentage==100)
                    Student need to pay 100% of the fee...!
                    @else
                    Student need to pay atleast {{$minimum_percentage}}% of the fee...!
                    @endif
                  </div> --}}
                  </div>
                  </div>
                 

                 <div class="row" ng-if="selected_studentid">
                  <div class="col-md-12">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td><strong>{{getphrase('payment_mode')}}</strong></td>
                          <td> 
                           
                            {{ Form::select('payment_mode', $payment_ways, null, 
                            ['class'=>'form-control',
                            "id"=>"payment_mode", 
                            "ng-model"=>"payment_mode", 
                            'required'=> 'true',
                            'ng-init' =>'payment_mode="cash"',
                             
                             'ng-class'=>'{"has-error": formSchedule.payment_mode.$touched && formSchedule.payment_mode.$invalid}',
                         ])}}
                          </td>
                          </tr>
                        
                        <tr ng-if="previous_amount > 0">
                          <td><strong>Previous Due</strong></td>
                          <td><strong>{{$currency}} @{{previous_amount | currency : '' : 2 }}</strong>&nbsp;&nbsp;&nbsp;&nbsp;<span><a class="btn btn-primary btn-sm" href="#" onclick="showPreviousFeeData()" >{{getPhrase('view')}}</a></span></td>
                        </tr>

                        <tr>
                          <td><strong>Amount to Pay</strong></td>
                          <td><strong>{{$currency}} @{{net_amount_to_pay | currency : '' : 2 }}</strong></td>
                        </tr>

                        <tr>
                          <td><strong>{{getphrase('discount')}}</strong></td>
                          <td>
                           
                            {{ Form::number('discount', null, 
                            ['class'=>'form-control',
                            "id"=>"discount", 
                            "ng-model"=>"discount", 
                            'required'=> 'true',
                            'min'=>'0',
                            'string-to-number'=>'discount',
                            'ng-change'=>'afterDiscount(discount,total_amount_pay)',
                             
                             'ng-class'=>'{"has-error": formSchedule.discount.$touched && formSchedule.discount.$invalid}',
                         ])}} 
                          </td>
                        </tr>

                        

                         <tr>
                          <td><strong>Total Amount</strong></td>
                          <td><strong>{{$currency}} @{{total_amount_pay | currency : '' : 2 }}</strong></td>
                        </tr>

                         <tr>
                          <td><strong>After Discount</strong></td>
                          <td><strong>@{{currency_symbol}} @{{final_pay | currency : '' : 2 }}</strong></td>
                        </tr>

                        <tr>
                          <td><strong>Enter amount</strong></td>
                          <td><strong><input autofocus="true" ng-model="paid_amount" ng-change="validateAmount(final_pay, paid_amount,{{$minimum_percentage}})" type="number" name="pay_amount"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Notes</strong></td>
                          <td><textarea name="notes" class="form-control"></textarea></td>
                        </tr>
                      </tbody>
                      
                    </table>
                  </div>
                  </div>



                  <div ng-if="payment_mode=='other'" class="row">

                         <fieldset class="form-group col-md-12">
                        
                        {{ Form::label('other_payment_mode', getphrase('other_payment_mode')) }}
                        <span class="text-danger">*</span>
                        
                        {{ Form::textarea('other_payment_mode', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => getPhrase('other_payment_mode'),'id'=>'other_payment_mode')) }}
                         </fieldset>

                  </div>
                  <input type="hidden" name="paid_percentage" value="@{{paid_percentage}}">
                  <div class="form-group" ng-if="total_number==0">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                    <div  class="buttons text-center" >
                            <button class="btn btn-info"
                            ng-disabled='!show_pay_button'>{{ getPhrase('pay_now') }}</button>
                        </div>   
                      </div>
                    </div>  
                 </div>




                    
                   {!! Form::close() !!}

            </div>
            <!-- /.container-fluid -->
            <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;color:#44a1ef;">{{getPhrase('previous_fee_details')}}</h4>
      </div>
    
     
      <div class="modal-body">
      <table class="table">
      <thead>
      <tr>
        <th><strong>{{getPhrase('fee_category')}}</strong></th>
        <th><strong>{{getPhrase('particular_name')}}</strong></th>
        <th><strong>{{getPhrase('term_number')}}</strong></th>
        <th><strong>{{getPhrase('is_schedule')}}</strong></th>
        <th><strong>{{getPhrase('amount')}}</strong></th>
      </tr> 
     
      </thead>
      <tbody>
        <tr ng-repeat="item in previous_details | filter:search track by $index">
          <td>@{{item.title}}</td>
          <td>@{{item.particular_title}}</td>
          <td ng-if = "item.term_number!=null">@{{item.term_number}}</td>
          <td ng-if = "item.term_number==null"> - </td>
          <td ng-if = "item.is_schedule=='1'" >{{getPhrase('yes')}}</td>
          <td ng-if = "item.is_schedule=='0'">{{getPhrase('no')}}</td>
          <td>{{$currency}} @{{item.amonut| currency : '' : 2 }}</td>
        </tr>
      </tbody>
      <tfoot>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><strong>{{getPhrase('total')}}</strong></td>
        <td><strong> {{$currency}} @{{previous_amount | currency : '' : 2}}</strong></td>
        </tr>
      </tfoot>
        
      </table>
     
     </div>
    
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">{{getPhrase('ok')}}</button>
      </div>
    
    </div>

  </div>



                       </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
        
@endsection
 

@section('footer_scripts')
@include('fee.payfee.scripts.js-scripts')
<script >
   
    function showPreviousFeeData(feecat_id)
    {    
      $('#myModal').modal('show');
    }
</script>
 
@stop
