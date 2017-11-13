@extends($layout)
@section('content')


				<!-- Page Heading -->
 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li>{{$title}}</li>
    </ul>

          <div class="row">
                  <div class="col-sm-12 ">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
				<!-- /.row -->
				
						 
						<div class="row library-items">
					 
					@if(count($series))
						@foreach($series as $c)
							<div class="col-md-3">
								<div class="library-item mouseover-box-shadow ss-shadows">
								<div class="ss-hover-content">
									<div class="item-image">
									@if($c->is_paid)
									<div class="label-primary label-band">{{getPhrase('premium')}}</div>
									@else
									<div class="label-danger  label-band">{{getPhrase('free')}}</div>
									@endif	

									<?php $image = IMAGE_PATH_UPLOAD_EXAMSERIES_DEFAULT;
									if(isset($c->image) && $c->image!='')
										$image = IMAGE_PATH_UPLOAD_SERIES.$c->image;
									?>
										<img src="{{$image}}" alt="{{$c->title}}" height="60%" width="60%" class="img-circle"	>
										
										<div class="hover-content"> 
										  <div class="buttons">
										    <a href="{{URL_STUDENT_EXAM_SERIES_VIEW_ITEM.$c->slug}}" class="btn btn-info">{{getPhrase('view_more')}}</a> 
										  </div>
										</div>
										
									</div>
									<div class="item-details">
									  <h5 class="font-bold text-center">{{ $c->title }}</h5>
									  <div class="quiz-short-discription">
										{!!$c->short_description!!}
									  </div>
										<ul class="list-group no-radius m-b-none m-t-n-xxs list-group-alt list-group-lg">
											<li class="list-group-item ss-noborder1 pull-left"><i class="icon-bookmark"></i> {{ $c->total_exams.' '.getPhrase('quizzes')}}</li>
											<li class="list-group-item ss-noborder1 pull-right"><i class="icon-eye"></i> {{ $c->total_questions.' '.getPhrase('questions')}}</li>
										</ul>
									
									</div>
								</div>
								</div>
							</div>
							 @endforeach
							 	@else 
							Ooops...! {{getPhrase('No_series_available')}}

						<a href="{{URL_USERS_SETTINGS.$user->slug}}" >{{getPhrase('click_here_to_change_your_preferences')}}</a>
							@endif
						</div>

						@if(count($series))
						 <div class="pull-right">
						    {!! $series->links() !!}
					    </div>
						@endif
                        
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
					
		<!-- /#page-wrapper -->

@stop