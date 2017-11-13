@extends($layout)

@section('content')


 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li>{{$title}}</li>
    </ul>

 <section class="panel panel-default" ng-controller="TabController">

       <header class="panel-heading clear"><strong> {{$title}}</strong>  </header>
        
       {!! Form::open(array('url' => URL_PRINT_STUDENTS_PAIDFEE_CLASSWISE, 'method' => 'POST', 'name'=>'htmlform ','target'=>'_blank', 'id'=>'htmlform', 'novalidate'=>'')) !!}

        <div class="panel panel-custom">
           
            <div class="panel-body instruction">
                <fieldset class="form-group col-md-6 col-sm-offset-3">

                           {{ Form::label('feecategories', getphrase('fee_category')) }}

                            <span class="text-danger">*</span>

                            {{ Form::select('feecategories', $feecategories, null, 
                            ['class'=>'form-control',
                            "id"=>"feecategories", 
                            "ng-model"=>"feecategories", 
                            "ng-change" => "categoryChanged(feecategories)",
                            'required'=> 'true', 
                            
                         ])}}
                       
                            

                        </fieldset>

                   

                <hr>
                       
   <div ng-show="result_data.length>0" class="row">

   
       
   </div>
   <br>

   <div ng-if="result_data.length!=0">
   <div>

     <div class="row wrapper">
            <lable class="col-sm-12">{{getPhrase('add_total_blank_columns')}}: </lable>
            <div class="col-sm-3 m-b-xs">
                <div class="dataTables_length" id="DataTables_Table_0_length">
                     <input type="number" name="extracols" id="extracols"  ng-model="total_blank_columns" ng-change="addColumns(total_blank_columns)" class="form-control " ng-init="total_blank_columns=1;addColumns(1); " value="1" >
                 </div>
            </div>
            <div class="col-sm-6 m-b-xs text-center-xs">
                <label style="text-align:center;display:block;">
                    
                </label>
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search" ng-model="search"> <span class="input-group-btn">
                  <button class="btn btn-sm btn-success" type="button"><i class="fa fa-search"></i></button>
              </span> 
          </div>
        </div>
        </div>
   
   <br>
   <br>
   


    <div class="m-row vertical-scroll">

    <h4 ng-if="result_data[0].course_dueration<=1" style="text-align: center;"><u>@{{class_title}}</u></h4>
    <h4 ng-if="result_data[0].course_dueration>1" style="text-align: center;"><u>@{{class_title_yer_sem}}</u></h4>

    <table class="table table-bordered" style="border-collapse: collapse;">
    <thead>
        <th style="border:1px solid #000;text-align: center;"><b>{{getPhrase('sno')}}</b></th>
        <th style="border:1px solid #000;text-align: center;"><b>{{getPhrase('name')}}</b></th>
        
        <th style="border:1px solid #000;text-align: center;"><b>{{getPhrase('roll_no')}}</b></th>
        <th style="border:1px solid #000;text-align: center;"><b>{{getPhrase('amount')}}</b></th>
        <th style="border:1px solid #000;text-align: center;"><b>{{getPhrase('paid_amount')}}</b></th>
        <th style="border:1px solid #000;text-align: center;"><b>{{getPhrase('discount')}}</b></th>
        <th style="border:1px solid #000;text-align: center;"><b>{{getPhrase('balance')}}</b></th>
        <th style="border:1px solid #000;text-align: center;"><b>%</b></th>
        <th style="border:1px solid #000;text-align: center;" ng-repeat="col in blank_columns"></th>
        
       
    </thead>
    <tbody>


    <?php $currency  = getSetting('currency_symbol','site_settings');
    ?>
   
    <tr ng-repeat="user in result_data | filter:search track by $index">

    
             <td style="border:1px solid #000;text-align: center;" >@{{$index+1}}</td>
            <td style="border:1px solid #000;text-align: left;"><a target="_blank" href="{{URL_USER_DETAILS}}@{{user.slug}}">@{{user.name}}</a></td>
        
        <td style="border:1px solid #000;text-align: right;">@{{user.roll_no}}</td>
        <td style="border:1px solid #000;text-align: right;">{{$currency}} @{{user.amount}}</td>
        <td style="border:1px solid #000;text-align: right;">{{$currency}} @{{user.paid_amount}}</td>
        <td style="border:1px solid #000;text-align: right;">{{$currency}} @{{user.discount_amount}}</td>
        <td style="border:1px solid #000;text-align: right;">{{$currency}} @{{user.balance}}</td>
        <td style="border:1px solid #000;">
       
        <div class="progress">
          <div  ng-class="{'progress-bar progress-bar-success':user.paid_percentage>=75, 'progress-bar progress-bar-warning':user.paid_percentage<75 && user.paid_percentage>=50, 'progress-bar progress-bar-danger':user.paid_percentage<50 && user.paid_percentage>=0}" role="progressbar" aria-valuenow="@{{user.paid_percentage}}"
          aria-valuemin="0" aria-valuemax="100" style="width:@{{user.paid_percentage}}%">
            @{{user.paid_percentage}}%
          </div>
        </div>

        </td>
        <td style="border:1px solid #000;text-align: center;" ng-repeat="col in blank_columns">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
        
        
          
    </tr> 
 
    </tbody>
    </table>
</div>
 </div>

<div ng-if="result_data.length==0" class="text-center" >{{getPhrase('no_data_available')}}</div> 
<br>
<a ng-if="result_data.length!=0" class="btn btn-info pull-right" ng-click="printIt()">Print</a>
  </div>
</div>
                            
                       
                    
                </hr>
            </div>
        </div>
  

 
{!! Form::close() !!}

@stop
 
 

@section('footer_scripts')

  
    @include('student.fee.scripts.feepaid-history-script')
    
@stop