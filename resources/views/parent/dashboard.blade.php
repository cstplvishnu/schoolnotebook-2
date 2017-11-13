 @extends($layout)
@section('content')

 
 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
    <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
    <li><strong>{{getPhrase('dashboard')}}</strong></li>
</ul>


				
                
  <section class="panel panel-default ss-panel-bg" data-target=".ss-super-admins">
    <div class="row m-l-none m-r-none bg-light lter">

        <div class="col-sm-6 col-md-4 padder-v b-r b-light ss-super-admins"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-primary"></i>
                      <i class="fa fa-random fa-stack-1x text-white"></i>
                   <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
                    
            <a class="clear" href="{{URL_STUDENT_EXAM_CATEGORIES}}"> <span class="h3 block m-t-xs"><strong>{{ App\QuizCategory::get()->count()}}</strong></span> <small class="text-muted text-uc">{{getPhrase('quiz_categories')}}</small> </a>
        </div>

        <div class="col-sm-6 col-md-4 padder-v b-r b-light ss-super-admins"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-list-ol fa-stack-1x text-white"></i>
                   <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
                    
            <a class="clear" href="{{URL_STUDENT_EXAM_ALL}}"> <span class="h3 block m-t-xs"><strong>{{ App\Quiz::get()->count()}}</strong></span> <small class="text-muted text-uc">{{getPhrase('quizzes')}}</small> </a>
        </div>

        <div class="col-sm-6 col-md-4 padder-v b-r b-light ss-super-admins"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-success"></i>
                      <i class="fa fa-users fa-stack-1x text-white"></i>
                   <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
                    
            <a class="clear" href="{{URL_PARENT_CHILDREN}}"> <span class="h3 block m-t-xs"><strong>{{ App\User::where('parent_id', '=', $user->id)->get()->count()}}</strong></span> <small class="text-muted text-uc">{{getPhrase('children')}}</small> </a>
        </div>

    </div>    

</section>    

				 
				<div class="row">

					<div class="col-md-6">
						 <section class="panel panel-default">
					    
					      <div class="panel-heading font-bold">{{getPhrase('latest_quizzes')}}</div>
					      @if(!count($latest_quizzes))
					      <br>
					 		 <p> &nbsp;&nbsp;&nbsp;{{getPhrase('no_quizzes_available')}}</p>
					 		 <p> &nbsp;&nbsp;&nbsp; <a href="{{URL_USERS_SETTINGS.Auth::user()->slug}}">{{getPhrase('click_here')}}</a> {{getPhrase('to_change_your_settings')}}</p>
					 	 @else

					    	<table class="table table-striped datatable">	
					    	<thead>
					    		<tr>
					    			<th>{{getPhrase('title')}}</th>
					    			<th>{{getPhrase('type')}}</th>
					    			<th>{{getPhrase('Action')}}</th>
					    		</tr>
					    	</thead>
					    	<tbody>
					    	@foreach($latest_quizzes as $quiz)
					 			<tr>
					 				<td>{{$quiz->title}}</td>
					 				<td>
					 				@if($quiz->is_paid)
					 					<span class="label label-danger">{{getPhrase('paid')}}
					 					</span>
				 					@else
				 					<span class="label label-success">{{getPhrase('free')}}
					 					</span>
				 					@endif
					 				</td>
					 				<td>
					 				@if($quiz->is_paid)
					 					<a href="{{URL_PAYMENTS_CHECKOUT.'exam/'.$quiz->slug}}" class="btn btn-xs btn-info">{{getPhrase('buy_now')}}</a> 
				 					@else
				 					-
				 					@endif
					 				</td>
					 			</tr>
					 		@endforeach

					    	</tbody>
					    	</table>  
					    @endif
					          </section>
					     
					    </div>
					 
					

						<div class="col-md-6">
							 <section class="panel panel-default">
					    
					      <div class="panel-heading font-bold">{{getPhrase('latest')}} LMS {{getPhrase('series')}}</div>
					      @if(!count($latest_series))
					      <br>
					 		 <p> &nbsp;&nbsp;&nbsp;{{getPhrase('no_series_available')}}</p>
					 		 <p> &nbsp;&nbsp;&nbsp; <a href="{{URL_USERS_SETTINGS.Auth::user()->slug}}">{{getPhrase('click_here')}}</a> {{getPhrase('to_change_your_settings')}}</p>
					 	 @else

					    	<table class="table table-striped datatable">	
					    	<thead>
					    		<tr>
					    			<th>{{getPhrase('title')}}</th>
					    			<th>{{getPhrase('type')}}</th>
					    			<th>{{getPhrase('Action')}}</th>
					    		</tr>
					    	</thead>
					    	<tbody>
					    	@foreach($latest_series as $series)
					 			<tr>
					 				<td>{{$series->title}}</td>
					 				<td>
					 				@if($series->is_paid)
					 					<span class="label label-danger">{{getPhrase('paid')}}
					 					</span>
				 					@else
				 					<span class="label label-success">{{getPhrase('free')}}
					 					</span>
				 					@endif
					 				</td>
					 				<td>
					 				@if($series->is_paid)
					 					<a href="{{URL_PAYMENTS_CHECKOUT.'lms/'.$series->slug}}" class="btn btn-xs btn-info">{{getPhrase('buy_now')}}</a> 
				 					@else
				 					-
				 					@endif
					 				</td>
					 			</tr>
					 		@endforeach

					    	</tbody>
					    	</table>  
					    @endif
					      </section>
					    </div>
					 
					</div>

				
				 
		

@stop

@section('footer_scripts')
  
@stop