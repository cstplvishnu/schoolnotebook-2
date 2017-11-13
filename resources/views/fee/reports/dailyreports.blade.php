@extends($layout)

@section('content')


<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
          <li>{{$title}}</li>
          </ul>

 
 <div class="row" ng-controller="studentFeePaidDetails" ng-init="ingAngData()">
                  <div class="col-sm-12">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">


    
        
       {!! Form::open(array('url' => URL_PRINT_STUDENTS_PAIDFEE_CLASSWISE, 'method' => 'POST', 'name'=>'htmlform ','target'=>'_blank', 'id'=>'htmlform', 'novalidate'=>'')) !!}

       

             <div>

         

                 <fieldset class="form-group col-md-6">
                                    

                        {{ Form::label('date_from', getphrase('date_from')) }}

                       {{ Form::text('date_from',  null,
                       [
                          'class'=>'input-sm  datepicker-input form-control',
                          'placeholder' => '2015-06-12',
                          'ng-model'=>'date_from',

                       ])}}
                                
                      

                </fieldset>


                 <fieldset class="form-group col-md-6">
                                     

                        {{ Form::label('date_to', getphrase('date_to')) }}
                       

                        {{ Form::text('date_to', null,
                        [
                           'class'=>'input-sm  datepicker-input form-control', 
                           'placeholder' => '2015-06-12',
                           'ng-model'=>'date_to',
                           'ng-change' =>'datesSelectd(date_from,date_to)',
                        ]) }}
                                
                     

                </fieldset>

                

                <div>
                    <fieldset class="form-group col-md-6">
                    <a class="btn btn-info" ng-click="getLastWeekReports()" href="#">{{getPhrase('weekly_reports')}}</a>
                    </fieldset>

                     <fieldset class="form-group col-md-6">

                      <a class="btn btn-info" ng-click="getLastMonthReports()" href="#">{{getPhrase('monthly_reports')}}</a>           </fieldset>
                </div>
</div>
               
   <div ng-show="result_data.length>0" class="row">
  <div class="col-sm-3 pull-right">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search" ng-model="search"> <span class="input-group-btn">
                  <button class="btn btn-sm btn-success" type="button"><i class="fa fa-search"></i></button>
              </span> 
          </div>
        </div>
   </div>
   <br>

   <div ng-if="result_data.length!=0">
  
    <div class="table-responsive" style="overflow-x:initial;">

   
    <table class="table table-striped b-t b-light ss-tb datatable">
    <thead class="panel-heading">
        <th style="text-align: center;"><b>{{getPhrase('sno')}}</b></th>
        <th style="text-align: center;"><b>{{getPhrase('paid_date')}}</b></th>
        <!-- <th style="text-align: center;"><b>{{getPhrase('payment_mode')}}</b></th> -->
        <th style="text-align: center;"><b>{{getPhrase('fee_category')}}</b></th>
        <th style="text-align: center;"><b>{{getPhrase('name')}}</b></th>
        <!-- <th style="text-align: center;"><b>{{getPhrase('roll_no')}}</b></th> -->
        <th style="text-align: right;"><b>{{getPhrase('amount')}}</b></th>
        <th style="text-align: right;"><b>{{getPhrase('discount')}}</b></th>
        <th style="text-align: right;"><b>{{getPhrase('paid_amount')}}</b></th>
        <th style="text-align: right;"><b>{{getPhrase('balance')}}</b></th>
        
       
    </thead>
    <tbody>


    <?php $currency  = getSetting('currency_symbol','site_settings');
    ?>
   
    <tr ng-repeat="user in result_data | filter:search track by $index" class="panel-content">

    
        <td style="text-align: center;" >@{{$index+1}}</td>
        <td style="text-align: center;" >@{{user.recevied_on}}</td>
        <!-- <td style="text-align: center;" >@{{user.payment_mode}}</td> -->
        <td style="text-align: center;"> @{{user.feecategory_title}}<br><strong>{{getPhrase('roll_no : ')}}</strong>@{{user.roll_no}}</td>
        <td style="text-align: center;">@{{user.name}}</td>
        <!-- <td style="text-align: center;">@{{user.roll_no}}</td> -->
        <td style="text-align: right;">{{$currency}} @{{user.total_amount}}</td>
        <td style="text-align: right;">{{$currency}} @{{user.discount_amount}}</td>
        <td style="text-align: right;">{{$currency}} @{{user.paid_amount}}</td>
        <td style="text-align: right;">{{$currency}} @{{user.balance}}</td>
        
        
        
          
    </tr> 
 
    </tbody>
    </table>
</div>
 </div>


<br>
<!-- <a ng-if="result_data.length!=0" class="btn btn-primary" ng-click="printIt()">Print</a> -->
    <div ng-if="result_data.length==0" class="text-center" style="font-size:20px"><strong>{{getPhrase('no_data_available')}}</strong></div>                         
                

                       
                    
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
        
 
{!! Form::close() !!}

@stop
 
 

@section('footer_scripts')

  
    @include('fee.reports.scripts.getdailyreports-script')

 <script src="{{JS}}bootstrap-toggle.min.js"></script>   
@stop