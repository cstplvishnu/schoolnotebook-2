@extends($layout)

@section('header_scripts')
<link href="{{CSS}}animate.css" rel="stylesheet">
@stop


@section('content')

 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
       <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>
		<li><a href="{{URL_MASTERSETTINGS_ACADEMICS}}">{{ getPhrase('academics')}}</a> </li>
		<li class="active">{{isset($title) ? $title : ''}}</li>
    </ul>
    

				
					@include('errors.errors')

	  <div class="row" ng-controller="academicCourses" ng-init="ingAngData({{$items}})">


	  	 <?php $button_name = getPhrase('create'); ?>
					
					 <?php $button_name = getPhrase('update'); ?>
						{{ Form::model($record, 
						array('url' => URL_MASTERSETTINGS_ACADEMICS_COURSES.$record->slug, 
						'method'=>'post')) }}

        <div class="col-sm-9">
          <div class="ss-fix">

          <section class="panel panel-default ss-fixes">
                <header class="panel-heading clear"><strong>{{$title}}</strong></header>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel-body">
                           
                           
               <section class="panel panel-default">
                    <header class="panel-heading">                    
                        <strong >{{$record->academic_year_title}}</strong>
                    </header>
                    <section class='containerVertical' id="target"  ng-drop="true" ng-drop-success="onDropComplete($data,$event)" data-height="230px">

                    
                <div ng-if="!allocated_courses.length" class="subject-placeholder"> {{getPhrase('drag_and_drop_here')}}</div>
           		<div ng-repeat="item in allocated_courses" class="items-sub" id="allocated_courses-@{{item.id}}">@{{item.course_title}}
           		<input type="hidden" name="selected_list[]" data-myname="@{{item.course_title}}" value="@{{item.id}}">
           		<input type="hidden" name="parent_list[]" value="@{{item.parent_id}}">
           		<i class="fa fa-trash text-danger pull-right" ng-click="removeItem(item,'{{$record->id}}')"></i>
           		</div>

                    </section>
                    
                  </section>
                       </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-md-12 ">
                                        <div class="doc-buttons pull-right"> 
                                        
                                     <a href="{{URL_MASTERSETTINGS_ACADEMICS}}" class="btn btn-default">{{getPhrase('cancel')}}</a> 
                                       <button class="btn btn-success">{{getPhrase('save')}}</button>
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
          </div>
        </div>

        <div class="col-sm-3">
            <section class="panel panel-default clear">
                <header class="panel-heading font-bold">{{getPhrase('courses')}}</header>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        
                                       <div class="m-t-xs m-b-xs">
                                          <div class="input-group search datagrid-search">

                                            <input type="text" class="input-sm form-control" name="search" ng-model="search" placeholder="{{getPhrase('search')}}" />

                                            <div class="input-group-btn">
                                              <button class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
                                            </div>
                                          </div>
                                        </div>
                                        
                                        <section class="scrollable">

          <div class="m-t m-b-xs" id="source">
			<div ng-repeat="item in courses | filter:search track by $index" class="btn ss-left-text"
					ng-drag="true" ng-drag-data="item" ng-drag-success="onDragComplete($data,$event)" 	
					><span> <i class="fa fa-bars pull-left"></i> </span>@{{item.course_title}}
					<input type="hidden" name="course_id[]" data-myname="@{{item.course_title}}"  value="@{{item.id}}">
					<input type="hidden" name="parent_id[]" value="@{{item.parent_id}}">
					</div>
				</div>
                                         
                                          
                                          
                                        </section>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
        {!! Form::close() !!}
    </div>				
				<!-- /.row -->
				
			

	
@stop



@section('footer_scripts')
@include('mastersettings.academic-courses.scripts.js-scripts')
@include('common.alertify')

<!-- @include('common.affix-window-size-script', array('newId'=>'app')) -->
 @stop