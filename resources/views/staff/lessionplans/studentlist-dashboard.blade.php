@extends($layout)
@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
			      <li>{{$title}}</li>
			    </ul>


              <div class="row">
                  <div class="col-sm-12">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
                    
                  <section class="panel panel-default ss-panel-bg">
                       <div class="row m-l-none m-r-none bg-light lter">

          
					<?php $lessionPlanObject = new App\LessionPlan();?>
				 @foreach($subjects as $subject)
                  
                  {!!Form::open(array('url'=>URL_LESSION_PLANS_VIEW_STUDENTS,'method'=>'POST','name'=>'studentList'))!!}

                 
				 <?php 

				 $summary = $lessionPlanObject->getSubjectCompletedStatus($subject->subject_id, $subject->staff_id, $subject->id);
				 $percent_completed = round($summary->percent_completed);
				 ?>

                      
          <div class="col-sm-12 col-md-4 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
             <i class="fa fa-circle fa-stack-2x {{getColorPad()}}"></i>
               <i class="fa fa-hand-o-up fa-stack-1x text-white"></i></span>

                      <input type="hidden" name="academic_id" value="{{$subject->academic_id}}" >
	                  <input type="hidden" name="course_id"   value="{{$subject->course_id}}" >
	                  <input type="hidden" name="course_parent_id"   value="{{$subject->course_parent_id}}" >
	                  <input type="hidden" name="year"        value="{{$subject->year}}" >
	                  <input type="hidden" name="semister"    value="{{$subject->semister}}" >

	                  <?php

	                  $title  = $subject->subject_title;
	                  if($subject->course_dueration>1){
	                  	if($subject->semister!=0){
                       
                       $title  = $subject->year.' '.getPhrase('year').' - '.$subject->semister.' '.getPhrase('semester');

	                  	}

	                  	else{
                          
                         $title  =  $subject->year.' '.getPhrase('year');

	                  	}
	                  }

	                  ?>

           <span class="block m-t-xs"><strong>{{ $title}}</strong></span> <small><font size="3px">{{ $subject->course_title}}</font></small>


                          <div>

	                          <button class="btn btn-info pull-right">{{ getPhrase('view_students') }}</button>

						</div>

        </div>

				    
					 {!!Form::close()!!}
				@endforeach
                             </div>
                        </section>
				     
				       </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@stop
@section('footer_scripts')

@stop
