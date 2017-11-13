@extends($layout)
@section('content')
<link rel="stylesheet" href="{{JS}}fuelux/fuelux.css" type="text/css">

	<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
			     @if($role_name=='admin'||$role_name=='owner')
             <li><a href="{{URL_USERS_DASHBOARD}}">{{ getPhrase('users_dashboard') }}</a> </li>                    
			<li><a href="{{URL_STAFF_DETAILS.$user->slug}}">{{ $user->name }} {{getPhrase('details') }}</a> </li>
			@endif
			<li><a href="{{URL_LESSION_PLANS_DASHBOARD.$user->slug}}">{{ getPhrase('lesson_plans')}}</a> </li>
			      <li>{{$title}}</li>
   </ul>


<div class="row" ng-controller="lessionPlanController" ng-init="ingAngData({{$items}})">
  <div class="col-sm-12">
     <section class="panel panel-default">
       <header class="panel-heading font-bold">{{$title}}</header>
         <div class="row">
           <div class="col-sm-12">
               <div class="panel-body" ng-repeat="topic in topics">

                    <h4 class="title font-bold text-primary">@{{topic.topic_name}}</h4>

					<ul class="row topic-list list-group no-radius m-b-none m-t-n-xxs list-group-alt list-group-lg">
						<li class="col-md-6 list-group-item" ng-if="topic.childs.length != 0 " ng-repeat="subtopic in topic.childs" style="border:none;background:transparent;">
						 
							<div class="topics clearfix ">
							
							
						
							
							
								<label class="checkbox" style="display:inline-block;">
								
								 <input 
								    ng-if="subtopic.is_completed==null || subtopic.is_completed==0"
								    @if($role_name=='staff')
								    ng-click="updateTopic(subtopic.id, topic.course_subject_id, 1)"
								    
								    @else 
								    disabled="" 
								    @endif
								    
								    type="checkbox" style="margin-top:10px;" id="checkbox-{{$i}}{{$j}}" class="checkbox-custom" name="checkbox-{{$i}}{{$j}}">
                                  
								    
								   
								    <input 
								    ng-if="subtopic.is_completed!=null && subtopic.is_completed!=0"
								    @if($role_name=='staff')
								    ng-click="updateTopic(subtopic.id, topic.course_subject_id, 0)"
								    readonly="true" 
								    @else 
								    disabled="" 
								    @endif
								    checked type="checkbox" style="margin-top:10px;" id="checkbox-{{$i}}{{$j}}" class="checkbox-custom" name="checkbox-{{$i}}{{$j}}">
								    <label for="checkbox-{{$i}}{{$j}}" class="checkbox-custom-label">
									
								    
                                   
								    
								   <!-- <div class="item-checkbox">								    	
								    	 <i class="fa fa-fw fa-square-o checked"></i>
								    </div>-->
								    </label>
								  </label>
							 

							<label class="font-bold" ng-if="subtopic.is_completed==null || subtopic.is_completed==0" >@{{subtopic.topic_name | capitalize}}</label>
							<label class="font-bold" ng-if="subtopic.is_completed!=null && subtopic.is_completed!=0" class="text-primary">@{{subtopic.topic_name | capitalize}}</label>
							<div class="form-group pull-right m-t-md" ng-if="subtopic.is_completed!=null && subtopic.is_completed!=0" >
								<span>@{{subtopic.completed_on}}</span>
							</div>
							</div>
						</li>
						 <li class="list-group-item" ng-if="topic.childs.length==0" style="border:none;background:transparent;">
				          <div class="topics clearfix">
							 <h4>{{getPhrase('no_topics_available')}}</h4>
				           </div>
						 </li>
						
					</ul>

				  
				        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="{{JS}}fuelux/fuelux.js"></script>
@stop
@section('footer_scripts')
@include('staff.lessionplans.scripts.js-scripts')
@include('common.alertify')
 @stop
