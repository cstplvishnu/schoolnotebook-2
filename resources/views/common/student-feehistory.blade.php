@extends($layout)

@section('content')

             <?php 
                  
                  $particulars = App\FeeParticularPayment::getStudentSchedules($student_id,$feecategory_id);
                  // dd($particulars);
                  $student_details = App\Student::where('id','=',$student_id)->first();
                  $feecategory_details =  App\FeeCategory::getCategory($student_details);
                  $record  = App\User::where('id','=',$student_details->user_id)->first();
                  $currency  = getSetting('currency_symbol','site_settings');

                  $feeshedules  = App\FeeScheduleParticular::getStudentSchedules($feecategory_id,$student_id);
                  
                 
			    ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">

      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>
     @if(checkRole(getUserGrade(2)))
   <li><a href="{{URL_USERS_DASHBOARD}}">{{ getPhrase('users_dashboard') }}</a> </li>
   

	<li><a href="{{URL_USERS."student"}}">{{ getPhrase('student_users') }}</a> </li>
	@endif

	    @if(checkRole(getUserGrade(7)))
	<li><a href="{{URL_PARENT_CHILDREN}}">{{ getPhrase('children') }}</a> </li>
	@endif
	<li><a href="{{URL_USER_DETAILS.$record->slug}}">{{ $student_details->first_name.$student_details->middle_name.$student_details->last_name }} {{getPhrase('details') }}</a> </li> 

    <li>{{ getPhrase('fee_schedules') }}</li>

</ul>



@include('errors.errors')

      <div class="row" ng-controller="studentFeeSchedules" ng-init="ingAngData({{$items}})">
         <div class="col-sm-8" >

         
            <section class="panel panel-default">

                <header class="panel-heading clear"><strong>@{{ feecategory_details.title }} -  {{getPhrase('fee_paid_history')}}</strong></header>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel-body">
                           
                           <div class="row">
                              
                 <div class="panel panel-custom" id="feeschedule_data">
					
					
					<div class="panel-body packages cs-panel-body" id="myForm" >
						<div> 
                          
                          <!-- Panel -->
						   <div class="panel-group cs-panel" id="accordion">
						    <div class="panel panel-default">
						      <div class="panel-heading clear">
						          <a class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse1"><i class="fa fa-icn fa-angle-down" aria-hidden="true"></i> {{getPhrase('fee_paid_history')}}</a>
						      </div>
						      <div id="collapse1" class="panel-collapse collapse in">
						        <div class="panel-body table-responsive">
						        	<table class="table table-striped m-b-none">
										<thead>
											<tr>
												<th>{{getPhrase('paid_date')}}</th>
												<th>{{getPhrase('fee')}}</th>
												<th>{{getPhrase('previous_balance')}}</th>
												<th>{{getPhrase('total_fee')}}</th>
												<th>{{getPhrase('paid_amount')}}</th>
												<th>{{getPhrase('discount')}}</th>
												<th>{{getPhrase('balance')}}</th>
												<th>{{getPhrase('receipt')}}</th>
												
												
											</tr>
										</thead>
										<tbody>
										<tr ng-repeat = "item in paid_data">
                                          <td><b>@{{item.created_at}}</b></td>
                                          <td><b>{{$currency}} @{{item.amount}}</b></td>
                                          <td><b>{{$currency}} @{{item.previous_balance}}</b>&nbsp;&nbsp;&nbsp;<span ng-if="item.previous_balance >0"><a class="btn btn-primary btn-sm" href="#" onclick="showPreviousFeeData()" >{{getPhrase('view')}}</a></span></td>
                                          <td><b>{{$currency}} @{{item.total_amount}}</b></td>
                                          <td><b>{{$currency}} @{{item.paid_amount}}</b></td>
                                          <td><b>{{$currency}} @{{item.discount_amount}}</b></td>
                                          <td><b>{{$currency}} @{{item.balance}}</b></td>
                                          <td><a href="{{URL_PRINT_FEE_RECEIPT}}@{{item.transaction_id}}" class="btn btn-primary" target="_blank">{{getPhrase('yes')}}</a></td>
                                        </tr>
                                      </tbody>
									</table>
						        </div>
						      </div>
						    </div>
						    <div class="panel panel-default">
						      <div class="panel-heading clear">
						           <a class="panel-title"  data-toggle="collapse" data-parent="#accordion" href="#collapse2"><i class="fa fa-icn fa-angle-down" aria-hidden="true"></i> {{getPhrase('fee_category')}}</a>
						      </div>
						      <div id="collapse2" class="panel-collapse collapse">
						        <div class="panel-body table-responsive">
						        	 
                                  <table class="table table-striped m-b-none">
										<thead>
											<tr>
												<th>{{getPhrase('total_installments')}}</th>
												<th>{{getPhrase('total_fee')}}</th>
												<th>{{getPhrase('installment_amount')}}</th>
												<th>{{getPhrase('other_amount')}}</th>
												<th>{{getPhrase('final_fee')}}</th>
											</tr>
										</thead>
										
										<tr>
                                         <td class="text-right"><b>@{{ feecategory_details.total_installments }}</b></td>
                                         <td class="text-right"><b>{{$currency}} @{{ feecategory_details.total_fee }}</b></td>
                                         <td class="text-right"><b>{{$currency}} @{{ feecategory_details.installment_amount }}</b></td>
                                         <td class="text-right"><b>{{$currency}} @{{ feecategory_details.other_amount }}</b></td>
                                         <td class="text-right"><b>{{$currency}} @{{ final_fee}}</b></td>
										</tr>
									</table> 

									
						        </div>
						      </div>
						    </div>
						  </div>  <!-- /Panel -->
						</div>
					</div>
                 </div>
			   </div>
            </div>
          </div>
        </div>
 </section>
</div>

         <div class="col-sm-4">
            <section class="panel panel-default clear">
                <header class="panel-heading font-bold">{{getPhrase('fee_categories_list')}}</header>

         <div class="row">
			<div class="col-md-12 clearfix">
			
                  <div class="row" ng-repeat = "user in student">
			<div class="profile-details text-center">
				<div class="profile-img m-t">
				
				  <img ng-if="user.image!=null && user.image!=''" class="thumb img-circle" src="{{IMAGE_PATH_PROFILE}}@{{user.image}}" height="60">
            
            <img ng-if="user.image==null || user.image==''" class="thumb img-circle" src="{{IMAGE_PATH_USERS_DEFAULT_THUMB}}">

				</div>
				<div class="aouther-school">
					<h3>@{{user.name}}</h3>
					<p><span>@{{user.course_title+' - ('+user.academic_year_title+')'}}</span><span ng-if="user.current_year==-1" >{{getPhrase('completed')}}</span>
					<span ng-if="user.current_year!=-1 && user.course_dueration>1 && user.is_having_semister==1">@{{user.current_year +' Year'}} - @{{user.current_semister +' Semester'}}</span><span ng-if="user.current_year!=-1 && user.course_dueration>1 && user.is_having_semister==0">@{{user.current_year +' Year'}}</span></p>
					<p><span><strong>Roll</strong> : @{{user.roll_no}}</span></p>
				</div>

			</div>
		</div>

                  <div class="draggable-item-list" id="source">
					<div ng-repeat="item in source_items | filter:search track by $index" class="items-sub" 	
					ng-click="changeFeeCategory(item.feecategory_id,item.student_id)">@{{item.title}}
					
					</div>
				</div>

					 		
			</div>
		</div>

               

            </section>
        </div>
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
        <tr ng-repeat="item in previous_data | filter:search track by $index">
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

					

				
			

@stop

@section('footer_scripts')

@include('common.student-feepaid-history-script')

  <script >
   
    function showPreviousFeeData(feecat_id)
    {    
      $('#myModal').modal('show');
    }
</script>
@stop


