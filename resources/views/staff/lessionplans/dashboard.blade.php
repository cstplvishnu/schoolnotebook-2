@extends($layout)
@section('header_scripts')
 {!! Charts::assets() !!}
@stop
@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
       @if(checkRole(getUserGrade(2)))
       <li><a href="{{URL_USERS_DASHBOARD}}">{{ getPhrase('users_dashboard') }}</a> </li>
       

    <li><a href="{{URL_USERS."staff"}}">{{ getPhrase('staff_users') }}</a> </li>
    @endif
    <li><a href="{{URL_STAFF_DETAILS.$record->slug}}">{{ $record->name }} {{getPhrase('details') }}</a> </li> 
      <li>{{$title}}</li>
    </ul>


           <div class="row">
                  <div class="col-sm-12 ">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
					<?php $lessionPlanObject = new App\LessionPlan();?>
				 @foreach($subjects as $subject)
				 <?php 

				 $summary = $lessionPlanObject->getSubjectCompletedStatus($subject->subject_id, $subject->staff_id, $subject->id);
				 $percent_completed = round($summary->percent_completed);
				 ?>
				
				    <div class="col-md-3 text-center">
				    <div >
				    <div>
				    	
				    
				    <h4 class="font-bold" title="{{$subject->subject_title}}">{{$subject->subject_title}}</h4>
                        <p class="font-normal">{{$subject->course_title}}</p>
				    </div>
				    
				    	 <a class="card-footer text-muted" href="{{URL_LESSION_PLANS_VIEW_TOPICS.$user->slug.'/'.$subject->slug}}"> 
				    <?php   $chart = Charts::create('percentage', 'justgage')
								    ->title('')
								    ->elementLabel('')
								    ->values([$percent_completed,0,100])
								    ->responsive(false)
								    ->height(150)
								    ->width(0);
    				?>
    				 {!! $chart->render() !!}
 
					          </a>
                          </div>
					</div>

				@endforeach

					    </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@stop

