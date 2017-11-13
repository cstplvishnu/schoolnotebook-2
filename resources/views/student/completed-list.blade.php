@extends($layout)

@section('header_scripts')

@stop

@section('content')

        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li>{{$title}}</li>
    </ul>
    <section class="panel panel-default" ng-controller="TabController">
       <header class="panel-heading clear"><strong> {{$title}}</strong>  </header>
    
        
      {!! Form::open(array('url' => URL_PRINT_COURSE_COMPLETED_STUDENT_LIST, 'method' => 'POST', 'name'=>'htmlform ','target'=>'_blank', 'id'=>'htmlform', 'novalidate'=>'')) !!}

        <div class="panel panel-custom">
           
            <div class="panel-body instruction">
                  <div class="col-sm-10 col-sm-offset-3">
                @include('common.year-selection-view', array('class'=>'custom-row-6'))

                   </div>

                <hr>
                       
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
   
   <div ng-show="result_data.length!=0">

    <div class="m-row vertical-scroll">
    

   <h4 ng-if="result_data[0].course_dueration<=1" style="text-align: center;"><u>@{{class_title}}</u></h4>
    <h4 ng-if="result_data[0].course_dueration>1" style="text-align: center;"><u>@{{class_title_yer_sem}}</u></h4>
    
    <table class="table table-bordered" style="border-collapse: collapse;">
    <thead>
        <th style="border:1px solid #000;text-align:center;"><b>{{getPhrase('sno')}}</b></th>
        <th style="border:1px solid #000; text-align:center;"><b>{{getPhrase('name')}}</b></th>
        
        <th style="border:1px solid #000;text-align:center;"><b>{{getPhrase('roll_no')}}</b></th>
        <th style="border:1px solid #000;text-align:center;"><b>{{getPhrase('course')}}</b></th>
        <th style="border:1px solid #000;text-align:center;"><b>{{getPhrase('status')}}</b></th>
       
        
       
    </thead>
    <tbody>
   
    <tr ng-repeat="user in result_data | filter:search track by $index" >

    
            <td style="border:1px solid #000;text-align:center;" >@{{$index+1}}</td>
            <td style="border:1px solid #000;text-align:center;"><a target="_blank" href="{{URL_USER_DETAILS}}@{{user.slug}}">@{{user.name}}</a></td>
        
        <td style="border:1px solid #000;text-align:center;">@{{user.roll_no}}</td>
        <td style="border:1px solid #000;text-align:center;">@{{user.course_title}}</td>
        <td style="border:1px solid #000;text-align:center;">{{getPhrase('completed')}}</td>
        
          
    </tr> 
 
    </tbody>
    </table>
</div>
 </div>

<a ng-if="result_data.length!=0" class="btn btn-info pull-right" ng-click="printIt()">{{getPhrase('print')}}</a>

<div ng-show="result_data.length==0" class="text-center" >{{getPhrase('no_data_available')}}</div> 
<br>
</div>
                            
                       
                    
                </hr>
            </div>
        </div>
    

  
{!! Form::close() !!}

@stop
 
 

@section('footer_scripts')

  
    @include('student.scripts.completed-js-scripts')
    
@stop