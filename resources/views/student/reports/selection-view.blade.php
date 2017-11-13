@extends($layout)
@section('content')
      
        <!-- Page Heading -->
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
           <li> <a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
                  @if(checkRole(getUserGrade(2)))
                       <li><a href="{{URL_USERS_DASHBOARD}}">{{ getPhrase('users_dashboard') }}</a> </li>
                       @endif

                    @if(checkRole(getUserGrade(2)))
                    <li><a href="{{URL_USERS."student"}}">{{ getPhrase('student_users') }}</a> </li>
                    @endif
                      
                      @if(checkRole(getUserGrade(7)))
                   <li><a href="{{URL_PARENT_CHILDREN}}">{{ getPhrase('children') }}</a> </li>
                   @endif
                  
                   <li><a href="{{URL_USER_DETAILS.$user->slug}}">{{ $user->name }} {{getPhrase('details') }}</a> </li> 
                   <li>{{ getPhrase('marks_details') }} </li>
          </ul>
          @include('errors.errors')
        <!-- /.row -->
        
        <div class="row">
                  <div class="col-sm-12">
                     <section class="panel panel-default" ng-controller="TabController">
                       <header class="panel-heading font-bold">{{getPhrase('select_details')}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
         <?php 
                $loggedInUser     = Auth::user();
                $loggedInUserRole = getRoleData($loggedInUser->role_id);

        ?>

        <div class="panel panel-custom">
           
            <div class="panel-body instruction">
                <div class="row">
                   
                         @include('common.year-selection-view',array(
                                'user_slug'=>$user->slug, 
                                'class'=>'custom-row-6'))
                </div>
                
                    
   <div ng-hide="show_div">
       {{getPhrase('no_data_available_with_the_selection')}}
   </div>
  <div class="row" ng-if="year_selected" ng-show="show_div">
  <div class="col-md-12">
<div class="row">
    <div class="col-md-9"><h3>Select Category</h3></div>
    <div class="col-md-3">
      
    </div>
</div>
  </div>
    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked nav-tabs nav-tabs-custom">
        <li  ng-repeat="category in exam_categories" ng-class="{ active: isSet(category.id) }">
            <a href ng-click="setTab(category.id)">@{{category.category}}</a>
            
        </li>
         
        </ul>
    </div>
 
    <div class="col-md-9">    
    <div class="table-responsive" ng-if="exam_list.length>0">
          <table class="table table-hover table-striped result-info-table">
            <thead>
            <tr>
                <th><strong>{{getPhrase('title')}}</strong></th>
                <th><strong>{{getPhrase("score")}}</strong></th>
                <th><strong>{{getPhrase('status')}}</strong></th>
                <th><strong>{{getPhrase('date_of_exam')}}</strong></th>
                <th><strong>{{getPhrase('action')}}</strong></th>
                </tr>
            </thead>  
            <tbody>
            <tr ng-repeat="exam in exam_list | filter:search track by $index">
                
                <td>@{{exam.title}}</td>
                <td>@{{exam.marks_obtained}}/@{{exam.total_marks}}</td>
                <td>@{{exam.exam_status|uppercase}} (@{{exam.percentage}})</td>
                <td>@{{exam.updated_at}}</td>
                <td>
                <a href="{{URL_STUDENT_EXAM_ANALYSIS_BYSUBJECT.$user->slug}}/@{{exam.quiz_slug}}/@{{exam.result_slug}}" target="_blank" class="btn btn-info btn-sm">{{getPhrase('analysis')}}</a>
                
                &nbsp;&nbsp;<a href="{{URL_RESULTS_VIEW_ANSWERS}}@{{exam.quiz_slug}}/@{{exam.result_slug}}" target="_blank" class="btn btn-success btn-sm">{{getPhrase('view_key')}}</a>
                </td>
                </tr>
            </tbody>
          </table>
        </div>


  </div>
</div>
                  
                </hr>
            </div>
        </div>

                    </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /#page-wrapper -->
@stop

@section('footer_scripts')

  
    @include('student.reports.scripts.js-scripts',array('user_slug'=>$user->slug,'user'=>$user))
    
@stop
 
 