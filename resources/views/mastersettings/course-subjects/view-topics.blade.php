@extends($layout)
@section('content')


<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li><a href="{{URL_MASTERSETTINGS_COURSE_SUBJECTS."staff"}}">{{ getPhrase('allocate_staff_to_subject')}}</a> </li>
      <li>{{$title}}</li>
    </ul>

<div class="row">
<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-4 col-xs-12">
<section class="panel panel-default">
				<!-- Page Heading -->
				<header class="panel-heading clear"> <strong>{{$subject->subject_title}}</strong></header>
				
					<section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="activity">	 	
				
					@if(!count($topics))
					<heading class="panel-heading clear title">{{getPhrase('no_topics_available')}}</h4>
					@endif

					@foreach($topics as $topic)

					<h4 class="padder title" id="helper_step2">{{$topic->topic_name}}</h4>
					<ul class="row topic-list list-group no-radius m-b-none m-t-n-xxs">

					@foreach($topic->childs as $child_topic)

					@if(!count($child_topic->topic_name))
					<strong class="block">{{getPhrase('no_topics_available')}}</strong>
					@endif

					  <li class="col-md-6 list-group-item" style="border-color:transparent;">
                        <div class="topics clearfix">
                            <strong class="padder" id="helper_step3">{{$child_topic->topic_name}}</strong>
                        </div>
                      </li>
                      
					@endforeach
					</ul>
            @endforeach
          </div>
        </div>
      </section>	
    </section>
  </div>
</div>
			
@stop
@section('footer_scripts')

 @stop