@extends($layout)



@section('content')

         <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li>{{$title}}</li>
    </ul>

    <section class="panel panel-default" ng-controller="TabController">
       <header class="panel-heading clear"><strong> {{$title}}</strong>  </header>
         {!! Form::open(array('url' => URL_PRINT_CLASS_OFFLINE_MARKS_REPORT, 'method' => 'POST', 'name'=>'htmlform ','target'=>'_blank', 'id'=>'htmlform', 'novalidate'=>'')) !!}

    <div class="panel panel-custom">
            
            <div class="panel-body instruction">

            <?php 
            $user = Auth::user();

            $role_name = getRoleData($user->role_id);
            
            $param = array('class'=>'custom-row-6');
            if($role_name=='student') {

                $param = array('user_slug'=>$user->slug, 
                                'class'=>'custom-row-6');
            }
        ?>
              <div class="row">
               <div class="col-sm-10 col-sm-offset-3">
                @include('common.year-selection-view', $param)
             <div class="row">
                   <div class="custom-row-6 col-md-6">
                         <label for = "offline_quiz_category_id">{{getPhrase('category')}}</label>
                        <select 
                        name      = "offline_quiz_category_id" 
                        id        = "offline_quiz_category_id" 
                        class     = "form-control" 
                        ng-model  = "offline_quiz_category_id" 
                        ng-change = "getStudentMarks112()"
                        ng-options= "option.id as option.title for option in quiz_categories track by option.id">
                        <option value="">{{getPhrase('select')}}</option>
                        </select>
                   </div>
                        </div>
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
 
    <div class="m-row vertical-scroll">
    
    <h4 ng-if="result_data.students.length>0" >@{{course_title}}</h4>
    <table ng-if="result_data.students.length>0" class="table table-bordered table-responsive" style="border-collapse: collapse;">
    <thead>
        <th style="border:1px solid #000;">{{getPhrase('name')}}</th>
        
        <th style="border:1px solid #000;">{{getPhrase('roll_no')}}</th>
        <th style="border:1px solid #000;" ng-repeat="subject in subjects">@{{subject.subject_code}} (@{{subject.total_marks}})</th>
        <th style="border:1px solid #000;">AVG. %</th>
        
    </thead>
    <tbody>
    <tr ng-repeat="student in students | filter:search track by $index">
        <td style="border:1px solid #000;"><a href="{{URL_USER_DETAILS}}@{{student.slug}}">@{{student.name}}</a></td>
        
        <td style="border:1px solid #000;">@{{student.roll_no}}</td>
        
         <td style="border:1px solid #000; text-align: right;" ng-repeat="marks_record in student.marks">@{{marks_record.score.marks_obtained}}</td>
        <td style="border:1px solid #000;">
       
        <div class="progress">
          <div  ng-class="{'progress-bar progress-bar-success':student.average>=75, 'progress-bar progress-bar-warning':student.average<75 && student.average>=50, 'progress-bar progress-bar-danger':student.average<50 && student.average>=0}" role="progressbar" aria-valuenow="@{{student.average}}"
          aria-valuemin="0" aria-valuemax="100" style="width:@{{student.average}}%">
            @{{student.average}}%
          </div>
        </div>

        </td>
    </tr> 
    </tbody>
    </table>
</div>
 
<div ng-if="result_data.students.length<=0"  class="text-center clear" >{{getPhrase('no_data_available')}}</div> 
<br>
<a ng-if="result_data.students.length>0"  class="btn btn-info pull-right" ng-click="printIt()">{{getPhrase('print')}}</a>
  </div>
</div>
<!--
              
            </div>
        </div>
-->
    </section>

{!! Form::close() !!}

@stop
 
@section('footer_scripts')

  @include('offlineexams.class-report.scripts.js-scripts')
    
@stop