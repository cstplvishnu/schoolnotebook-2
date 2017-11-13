@extends($layout)

@section('header_scripts')
 
<link href="{{CSS}}bootstrap-datepicker.css" rel="stylesheet">
@stop

@section('content')

          <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li>{{$title}}</li>
    </ul>

    <section class="panel panel-default" ng-controller="TabController">
       <header class="panel-heading clear"><strong> {{$title}}</strong>  </header>
    
        {!! Form::open(array('url' => URL_PRINT_CLASS_ATTENDANCE_REPORT, 'method' => 'POST', 'name'=>'htmlform ','target'=>'_blank', 'id'=>'htmlform', 'novalidate'=>'')) !!}

        
        <div class="panel panel-custom">
            
            <div class="panel-body instruction clear">
                  <div class="col-md-10 col-md-offset-3 col-sm-12 col-xs-12">
                @include('common.year-selection-view', array('class'=>'custom-row-6'))
                  </div>
                       
   <div ng-show="result_data.length>0" class="row">

   <div class="col-sm-3 pull-right m-b">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search" ng-model="search"> <span class="input-group-btn">
                  <button class="btn btn-sm btn-success" type="button"><i class="fa fa-search"></i></button>
              </span> 
          </div>
      </div>
   </div>

 <div class="m-row vertical-scroll" id="printable_data">
  
    <table ng-if="result_data.length>0" class="table table-bordered" style="border-collapse: collapse;">
    <thead>
        <th style="border:1px solid #000;">{{getPhrase('sno')}}</th>
        <th style="border:1px solid #000;" >{{getPhrase('name')}}</th>
        <th style="border:1px solid #000;">{{getPhrase('roll_no')}}</th>
        <th style="border:1px solid #000;">{{getPhrase('total_class')}}</th>
        <th style="border:1px solid #000;">{{getPhrase('present')}}</th>
        <th style="border:1px solid #000;">{{getPhrase('absent')}}</th>
        <th style="border:1px solid #000;">{{getPhrase('leave')}}</th>
        <th style="border:1px solid #000;">%</th>
        
    </thead>
    <tbody>
    <tr ng-repeat="user in result_data | filter:search track by $index">
        <td style="border:1px solid #000; text-align: right;">@{{user.sno}}</td>
        <td style="border:1px solid #000;"><a href="{{URL_USER_DETAILS}}@{{user.slug}}">@{{user.name}}</a></td>
        <td style="border:1px solid #000;">@{{user.roll_no}}</td>
        <td style="border:1px solid #000; text-align: right;">@{{user.total_classes}}</td>
        <td style="border:1px solid #000;text-align: right;">@{{user.present}}</td>
        <td style="border:1px solid #000;text-align: right;">@{{user.absent}}</td>
        <td style="border:1px solid #000;text-align: right;">@{{user.leave}}</td>
        <td style="border:1px solid #000;">
       
        <div class="progress">
          <div  ng-class="{'progress-bar progress-bar-success':user.percentage>=75, 'progress-bar progress-bar-warning':user.percentage<75 && user.percentage>=50, 'progress-bar progress-bar-danger':user.percentage<50 && user.percentage>=0}" role="progressbar" aria-valuenow="@{{user.percentage}}"
          aria-valuemin="0" aria-valuemax="100" style="width:@{{user.percentage}}%">
            @{{user.percentage}}%
          </div>
        </div>

        </td>
    </tr> 
    </tbody>
    </table>
</div>
 
<div ng-if="result_data.length==0" class="text-center" >{{getPhrase('no_data_available')}}</div> 

<a ng-if="result_data.length!=0" class="btn btn-info pull-right" ng-click="printIt()">{{getPhrase('print')}}</a>
  </div>
</div>
                            
                       
                    
               
            </div>
        </div>
    
{!! Form::close() !!}
@stop
 
 

@section('footer_scripts')

  
    @include('attendance.class-report.scripts.js-scripts')
    
@stop