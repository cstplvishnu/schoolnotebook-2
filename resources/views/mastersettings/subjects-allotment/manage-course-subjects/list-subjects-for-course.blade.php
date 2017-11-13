@extends($layout)

@section('header_scripts')
<link href="{{CSS}}animate.css" rel="stylesheet">
@stop

@section('content')


<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
       <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>
		<li><a href="{{URL_MASTERSETTINGS_COURSE_SUBJECTS."staff"}}">{{ getPhrase('allocate_staff_to_courses')}}</a> </li>
		<li class="active">{{isset($title) ? $title : ''}}</li>
    </ul>

 <div class="row" ng-controller="courseSubjectsController" ng-init="ingAngData({{$items}})">
				<!-- Page Heading -->
				
					<?php 
					$subjects_list = [];
					$angular_keys = [];
					?>		

				<!-- /.row -->
					{!! Form::open(array('url' => URL_COURSE_SUBJECTS_UPDATE_STAFF, 'method' => 'POST', 'name'=>'formQuiz ', 'novalidate'=>'')) !!}

					<input type="hidden" name="academic_id" value="{{$academic_id}}">
					<input type="hidden" name="course_id" value="{{$record->id}}">
					<input type="hidden" name="course_parent_id" value="{{$record->parent_id}}">


<div class="col-sm-9">
          <section class="panel panel-default">
                <header class="panel-heading clear">
               
                        <strong>{{$title}}</strong>
                    </header>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel-body">
                           
                           
              
                    <section  class="panel-body slim-scroll" data-height="500px">

                    
                @for($yearno = 1; $yearno <= $record->course_dueration; $yearno++)
					<h4> {{ getPhrase('year').' '. $yearno }} </h4>
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
						<small >SEM {{ $semister }}</small>

						@include('mastersettings.subjects-allotment.manage-course-subjects.course-list-subview', 
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
						 

						 @include('mastersettings.subjects-allotment.manage-course-subjects.course-list-subview', 
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
						 
						 @include('mastersettings.subjects-allotment.manage-course-subjects.course-list-subview', 
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
                                        
                                     <a href="{{URL_MASTERSETTINGS_COURSE_SUBJECTS."staff"}}" class="btn btn-default">{{getPhrase('cancel')}}</a> 
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


        <div class="col-sm-3">
            <section class="panel panel-default clear">
                <header class="panel-heading font-bold">{{getPhrase('staff')}}</header>

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
                     	<ul class="list-replay list-sidebar">
					<li ng-repeat="item in source_items | filter:search " ng-drag="true" ng-drag-data="item" ng-drag-success="onDragComplete($data,$event)" >
							<a href="">
								<img ng-if="item.image==null || item.image==''" src="{{IMAGE_PATH_USERS_DEFAULT_THUMB}}" alt="" class="img-circle">
								<img ng-if="item.image!=null && item.image!=''" src="{{IMAGE_PATH_USERS_THUMB}}@{{item.image}}" alt="" class="img-circle">
								<h4>@{{item.name | uppercase}} <span class="time"><i class="fa fa-mars-stroke"></i> @{{item.gender | uppercase}}</span></h4>
								<p>
									<strong>Designation:</strong> @{{item.job_title}} &nbsp;&nbsp;&nbsp;
									<strong>Qualification:</strong> @{{item.qualification}}
								</p>
								<i class="mdi arrow-link mdi-chevron-right"></i>
								<ul class="hover-fab-list list-unstyled">
									<li class="heading">{{getPhrase('preferred_subjects')}}</li>
		
									<li ng-if="item.preference.length > 0" ng-repeat="preference in item.preference">
									
										@{{preference.subject_title}} 
										<i ng-if="preference.is_lab==1" class="fa fa-flask"></i>
									
									</li>

									<li ng-if="item.preference.length == 0">
										{{getPhrase('no_subjects_selected')}}	
									</li>

									
								</ul>
							</a>
					</li>

					</ul>
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
		
@stop
 
@section('footer_scripts')
	@include('mastersettings.subjects-allotment.scripts.js-scripts', array('keys'=>$keys))
	@include('common.alertify')
@stop 
