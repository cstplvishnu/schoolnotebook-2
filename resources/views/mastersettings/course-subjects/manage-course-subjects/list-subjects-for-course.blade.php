@extends($layout)
 
@section('header_scripts')
<link href="{{CSS}}animate.css" rel="stylesheet">
@stop

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
       <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>
		<li><a href="{{URL_MASTERSETTINGS_COURSE_SUBJECTS_ADD}}">{{ getPhrase('add_subject_to_course')}}</a> </li>
		<li class="active">{{isset($title) ? $title : ''}}</li>
    </ul>

 <div class="row" ng-controller="courseSubjectsController" ng-init="ingAngData({{$items}})">
			
					<?php 
					$subjects_list = [];
					$angular_keys = [];
					?>		

				<!-- /.row -->
					{!! Form::open(array('url' => URL_MASTERSETTINGS_COURSE_SUBJECTS_ADD, 'method' => 'POST', 'name'=>'formQuiz ', 'novalidate'=>'')) !!}

					<input type="hidden" name="academic_id" value="{{$academic_id}}">
					<input type="hidden" name="course_id" value="{{$record->id}}">
					<input type="hidden" name="course_parent_id" value="{{$record->parent_id}}">

	    <div class="col-sm-8">
		<div class="ss-fix">
          <section class="panel panel-default ss-fixes">
                <header class="panel-heading clear">
                    <strong>{{$title}}</strong>
                 </header>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel-body">
                           
                           
              
                    <section  class="panel-body slim-scroll" data-height="500px">

                    
               		
				 @for($yearno = 1; $yearno <= $record->course_dueration; $yearno++)
					<h5 class="font-bold"><strong> {{ getPhrase('year').' '. $yearno }} </strong></h5>
					<div class="sem-parent-container">
					
					@if($record->is_having_semister)
					<?php 
					$semisters = App\CourseSemister::getCourseYearSemisters($course_id, $yearno);
					
					$total_data = [];
					

					?>

						@for($semister=1; $semister <= $semisters->total_semisters; $semister++)
						
						<?php 
						$subjects_list = App\CourseSubject::getCourseSavedSubjects($academic_id, $course_id, $yearno, $semister);
						$angular_key = $yearno.'_'.$semister;
						?>
						<small>SEM {{ $semister }}</small>

						@include('mastersettings.course-subjects.manage-course-subjects.course-list-subview', 
						array(	
							'academic_id' 	=> $academic_id,
							'course_id' 	=> $course_id,
							'yearno' 		=> $yearno,
							'semister' 		=> $semister,
							'subjects' 		=> $subjects_list,
							'angular_key'   => $angular_key,
							))
							 <?php $angular_keys[] = $angular_key;?>
						
						@endfor
						
						@if($semisters->total_semisters == 0)
						<?php 
						$subjects = App\CourseSubject::getCourseSavedSubjects($academic_id, $course_id, $yearno, 0);
						$angular_key = $yearno.'_0';
						 
						?>

						 @include('mastersettings.course-subjects.manage-course-subjects.course-list-subview', 
						array(	
							'academic_id' 	=> $academic_id,
							'course_id' 	=> $course_id,
							'yearno' 		=> $yearno,
							'semister' 		=> 0,
							'subjects' 		=> $subjects_list,
							'angular_key'   => $angular_key,
							))
							 <?php $angular_keys[] = $angular_key;?>
						@endif

					@else
					<?php 
						$subjects = App\CourseSubject::getCourseSavedSubjects($academic_id, $course_id, $yearno, 0);
						$angular_key = $yearno.'_0';
						?>
						 @include('mastersettings.course-subjects.manage-course-subjects.course-list-subview', 
						array(	
							'academic_id' 	=> $academic_id,
							'course_id' 	=> $course_id,
							'yearno' 		=> $yearno,
							'semister' 		=> 0,
							'subjects' 		=> $subjects_list,
							'angular_key'   => $angular_key,
							))
							 <?php $angular_keys[] = $angular_key;?>
					@endif
					 </div>
				@endfor

                    </section>

                     <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-md-12 ">
                                        <div class="doc-buttons pull-right"> 
                                        
                                     <a href="{{URL_MASTERSETTINGS_COURSE}}" class="btn btn-default">{{getPhrase('cancel')}}</a> 
                                       <button class="btn btn-success">{{getPhrase('save')}}</button>
                                          
                                        </div>
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



		<div class="col-sm-4">
            <section class="panel panel-default clear">
                <header class="panel-heading font-bold">{{getPhrase('subjects')}}</header>

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
					<div ng-repeat="item in source_items | filter:search track by $index" class="btn ss-left-text"
					ng-drag="true" ng-drag-data="item" ng-drag-success="onDragComplete($data,$event)" 	
					><span><i class="fa fa-bars pull-left"></i> </span>@{{item.subject_title}}
					
					
					<i ng-if="item.is_lab==1" class="fa fa-flask pull-right text-primary" title="{{getPhrase('lab')}}" aria-hidden="true"></i> 
					
					<i ng-if="item.is_elective_type==1" class="fa fa-hand-pointer-o pull-right text-info" title="{{getPhrase('elective')}}" aria-hidden="true"></i>
					
					<input type="hidden" data-myname="@{{item.subject_title}}"  value="@{{item.id}}">
					
					</div>
				</div>
				<p>&nbsp;&nbsp;</p>
	 			<i class="fa fa-flask text-primary" title="{{getPhrase('lab')}}" aria-hidden="true"></i> &nbsp;&nbsp;{{getPhrase('lab')}}
	 			&nbsp;&nbsp;
				<i class="fa fa-hand-pointer-o text-info" title="{{getPhrase('elective')}}" aria-hidden="true"></i>&nbsp;&nbsp;
				{{getPhrase('elective')}}
                                         
                                          
                                          
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
		
@stop
 
@section('footer_scripts')
	@include('mastersettings.course-subjects.scripts.js-scripts', array('keys'=>$angular_keys))
	@include('common.alertify')

	
@stop 

