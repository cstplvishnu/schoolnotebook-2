@extends('layouts.student.studentlayout')

@section('content')


<link href="{{CSS}}animate.css" rel="dns-prefetch"/>
<link rel="stylesheet" href="{{JS}}fuelux/fuelux.css" type="text/css">


<div id="page-wrapper" class="examform" ng-controller="angExamScript" ng-init="initAngData({{json_encode($bookmarks)}})">


         {!! Form::open(array('url' => URL_STUDENT_EXAM_FINISH_EXAM.$quiz->slug, 'method' => 'POST', 'id'=>'onlineexamform')) !!}

        <div class="col-md-9 col-sm-9 col-xs-12">

        <!-- /.row -->

        <!-- Page Hints -->

        <div class="row">
    <div class="m-t-lg">
        <ul class="suggestions">
            <li class="icon" id="subjectBar" title="{{getPhrase('click_here_to_list_subjects')}}"> <i class=" icon-books">

                        </i> </li>
            <li>
                <a class="positive" data-placement="bottom" data-toggle="tooltip" href="#" title="Left Arrow for Previous Question"> <i class="fa fa-arrow-left fa-2"></i> &nbsp;{{getPhrase('previous')}} </a>
            </li>
            <li> <a class="positive" data-placement="bottom" data-toggle="tooltip" href="#" title="Right Arrow for Next Question">

                           &nbsp;{{getPhrase('next')}} &nbsp;<i class="fa fa-arrow-right fa-2"></i> 

                        </a> </li>
            <li> <a class="positive" data-placement="bottom" data-toggle="tooltip" href="#" title="Escape for Clear Answer ">

                           ESCAPE {{getPhrase('clear_answer')}}

                        </a> </li>
            <li> <a class="positive" data-placement="bottom" data-toggle="tooltip" href="#" title="Add/Remove Bookmark">

                            SHIFT + <i class="fa fa-arrow-up fa-2"></i> <i class="fa fa-arrow-down fa-2"></i> {{getPhrase('bookmarks')}}

                        </a> </li>
        </ul>
    </div>
</div>



@include('student.exams.exam-leftbar-subjects', array('subjects' => $subjects))

       

  <div class="row">
     <section class="panel panel-default clear">
       <header class="panel-heading clear"> {{getPhrase('exam_duration')}}: 
           
        <span class="pull-right exam-duration m-t-vxxs">
              {{getPhrase('exam_duration')}}:
            <span>
              {{ $time_hours }}:{{ $time_minutes }}:00
            </span>
         </span> 
                            
            <span class="pull-right hints m-r">
                <label class="checkbox-inline">
                    <input ng-model="hints" type="checkbox">
                       <span class="hint">
                        {{getPhrase('hints')}}
                       </span> 
                    </label>
                 </span>
                 
             </header>

                <div class="panel panel-custom">

                    <div class="panel-heading clearfix">

                       <!-- <div class="pull-right exam-duration">

                            {{getPhrase('exam_duration')}}:

                            <span>

                                {{ $time_hours }}:{{ $time_minutes }}:00

                            </span>

                        </div>-->
                <!-- <div class="pull-right hints">
                        <span class="hint">
                            {{getPhrase('hints')}}
                        </span>
                        <label class="checkbox-inline">
                            <input ng-model="hints" style="display:block;" type="checkbox">
                               
                              
                        </label>
                    </div>-->
                       

                        <h5 class="font-bold width-auto">
                            <span class="text-uppercase">
                                {{$title}}
                            </span>
                            : {{getPhrase('question')}}
                            <span id="question_number">
                                1
                            </span>
                            of {{ count($questions)}}
                        </h5>

    

                    </div>

                    <div class="panel-body question-ans-box">

                        {{-- START of questions List --}}

                        <div id="questions_list">

                        

                        <?php 



                        $questionHasVideo = FALSE; ?>

                            @foreach($questions as $question)



                            <?php if(!$questionHasVideo)

                            {

                                if($question->question_type=='video')

                                $questionHasVideo = TRUE;

                            } ?>

      

                                    <?php    

                                    $image_path = PREFIX.(new App\ImageSettings())->

                                    getExamImagePath(); 



                                    ?>

                            <div 
                            class="question_div subject_{{$question->subject_id}}" 
                            name="question[{{$question->id}}]" 
                            id="{{$question->id}}" 
                            style="display:none;" value="0">

 

                            <input type="hidden" name="time_spent[{{$question->id}}]" id="time_spent_{{$question->id}}" value="0">

                                

                            

                               

                            



<header class="questions">
{!! $question->question !!} 
  <span class="font-bold">
 
  @if($question->question_type!='audio' && $question->question_type !='video')
  @if($question->question_file)
  <img class="image " src="{{$image_path.$question->question_file}}" style="max-height:200px;">
  @endif
  @endif
 
   <span class="pull-right"> <a ng-if="bookmarks[{{$question->id}}] >= 0" title="{{getPhrase('unbookmark_this_question')}}" 
        ng-click="bookmark({{$question->id}},'delete','questions');"  href="javascript:void(0)" class="pull-right btn btn-link"> 
      <i class="fa fa-star item-bookmark"></i></a>

     <a ng-if="bookmarks[{{$question->id}}] == -1" title="{{getPhrase('bookmark_this_question')}}" ng-click="bookmark({{$question->id}},'add','questions');" href="javascript:void(0)" class="pull-right btn btn-link"> <i class="fa fa-star-o item-bookmark"></i></a>
                                   {{$question->marks}} Mark(s)</span>
 
</span>

                                    <div class="option-hints pull-right default" data-placement="left" data-toggle="tooltip" ng-show="hints" title="{{ $question->hint }}">

                                        <i class="mdi mdi-help-circle"> </i>
                                    </div>

                                </header>
                          
								@include('student.exams.question_'.$question->question_type, array('question', $question, 'image_path' => $image_path ))
	
                            </div>

                            @endforeach

                        </div>

                        {{-- End of questions List --}}

                        

                        <hr>

                            <div class="row">

                                <div class="col-md-12">

                                    <button class="btn btn-success button prev" type="button">

                                        <i class="mdi mdi-chevron-left ">

                                        </i>

                                        {{getPhrase('previous')}}

                                    </button>

                                    <button class="btn btn-dark button next" id="markbtn" type="button">

                                        {{getPhrase('mark_for_review')}} & {{getPhrase('next')}}

                                    </button>

                                    <button class="btn btn-success button next" type="button">

                                        {{ getPhrase('next')}}

                                        <i class="mdi mdi-chevron-right">

                                        </i>

                                    </button>

                                    <button class="btn btn-dark button clear-answer" type="button">

                                        {{getphrase('clear_answer')}}

                                    </button>

                                    <button class="btn btn-danger button   finish" type="submit">

                                        {{getPhrase('finish')}}

                                    </button>

                                </div>

                            </div>

                     

                    </div>

                </div>

            </section>

          

        </div>


        </div>
        
        
        
        
        
        
        
        
        
        
        

        <div class="col-md-3">
          
           <?php 
              $questions  = $questions;
              $quiz     = $quiz;
             ?>
 <section class="panel panel-default clear m-t-lg">
          <header class="panel-heading font-bold">Time Status</header>
   
        <div class="panel-body">
         
          <div id="timerdiv" class="countdown-styled ">
            <span id="hours">{{ $time_hours }}</span> : 
            <span id="mins">{{ $time_minutes }}</span> : 
            <span id="seconds">00</span>

          </div>
           
        </div>
        <div class="panel-heading countdount-heading">
          <h5 class="font-bold">{{getPhrase('total_time')}} <span class="pull-right">{{ $time_hours }}:{{ $time_minutes }}:00</span></h5>
        </div>


          <div class="panel-body">
          <div class="sub-heading">
            <h5 class="font-bold">{{$quiz->title}}</h5>
            <p>{{ ucfirst($quiz->category->category) .' '. getPhrase('category')}}</p>
          </div>
          <ul class="question-palette" id="pallete_list">
            @for($i=0; $i<count($questions); $i++)
            <li class="palette pallete-elements not-visited" onclick="showSpecificQuestion({{$i}});">
            <span>{{$i+1}}</span>
            </li>
            @endfor
          </ul>
        </div>
        <hr>
        <div class="panel-heading">
          <h5 class="font-bold">{{ getPhrase('summary')}}</h5>
        </div>
        <div class="panel-body">
          <ul class="legends">
            <li  class="palette answered"><span id="palette_total_answered">1</span> {{getPhrase('answered')}}</li>
            <li  class="palette marked"><span id="palette_total_marked">2</span> {{getPhrase('marked')}}</li>
            <li  class="palette not-answered"><span id="palette_total_not_answered">3</span> {{getPhrase('not_answered')}}</li>
            <li  class="palette not-visited"><span id="palette_total_not_visited">4</span> {{getPhrase('not_visited')}}</li>
          </ul>
        </div>

            
        </div>

          {!! Form::close() !!}



</div>

<!-- /#page-wrapper -->

@stop



@section('footer_scripts')

  

@include('student.exams.scripts.js-scripts')
@include('common.editor')



<!--JS Control-->

@if($questionHasVideo)

@include('common.video-scripts')

@endif

<script src="{{JS}}fuelux/fuelux.js"></script>

<script type="text/javascript">

/**

 * intilizetimer(hours, minutes, seconds)

 * This method will set the values to defaults

 */


$(document).ready(function () {
    
     intilizetimer({{ $time_hours }},{{ $time_minutes }},1); 
    

});

   document.onmousedown=disableclick;
    status=getPhrase("right_clickdisabled");
    function disableclick(event)
    {
      if(event.button==2)
       {
        
         return false;    
       }
    } 


</script>

@stop



 
   
 

