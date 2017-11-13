@extends($layout)
 
@section('content')



<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
  <li><a href="{{PREFIX}}"><i class="fa fa-home"></i>{{getPhrase('home')}}</a></li>
 <li><a href="{{URL_MASTERSETTINGS_COURSE_SUBJECTS."staff"}}">{{ getPhrase('allocate_staff_to_subject')}}</a> </li>			<li>{{$title}}</li>
</ul>

        
        <div class="row">
                  <div class="col-sm-10 col-sm-offset-1">
                     <section class="panel panel-default">
                       <header class="panel-heading clear font-bold">
                       <div class="pull-right messages-buttons">
							 
							<a href="{{URL_MASTERSETTINGS_COURSE_SUBJECTS_ADD}}" class="btn  btn-primary button helper_step1" >{{ getPhrase('allocate_subject_to_course')}}</a>
							 
						</div>
					{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
								
				
					
				 @for($yearno = 1; $yearno <= $record->course_dueration; $yearno++)
					<h4> {{ getPhrase('year').' '. $yearno }} </h4>
					
					@if($record->is_having_semister)
					<?php 
					$semisters = App\CourseSemister::getCourseYearSemisters($course_id, $yearno);
					?>

						@for($semister=0; $semister < $semisters->total_semisters; $semister++)
						<small>SEM {{ $semister+1 }}</small>
						@include('mastersettings.course-subjects.course-list-subview', 
						array(	
							'academic_id' 	=> $academic_id,
							'course_id' 	=> $course_id,
							'yearno' 		=> $yearno,
							'semister' 		=> $semister+1,
							))
						
				
						@endfor
						
						@if($semisters->total_semisters == 0)
						 @include('mastersettings.course-subjects.course-list-subview', 
						array(	
							'academic_id' 	=> $academic_id,
							'course_id' 	=> $course_id,
							'yearno' 		=> $yearno,
							'semister' 		=> 0,
							))
						@endif

					@else
						 @include('mastersettings.course-subjects.course-list-subview', 
						array(	
							'academic_id' 	=> $academic_id,
							'course_id' 	=> $course_id,
							'yearno' 		=> $yearno,
							'semister' 		=> 0,
							))
					@endif
				@endfor
					  </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
			
@stop
 
 
