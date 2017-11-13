@extends($layout)
@section('content')


				<!-- Page Heading -->
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
				<!-- /.row -->
				
						 
						<div class="row library-items">
					<?php $settings = getSettings('lms'); ?>
					@if(count($categories))
						@foreach($categories as $c)
							<div class="col-md-3">
								<div class="library-item mouseover-box-shadow">
								<a href="{{URL_STUDENT_LMS_CATEGORIES_VIEW.$c->slug}}">
									<div class="item-image">
									<?php $image = $settings->defaultCategoryImage;
									if(isset($c->image) && $c->image!='')
										$image = $c->image;
									?>
										<img src="{{ PREFIX.$settings->categoryImagepath.$image}}" alt="" height="60%" width="60%" class="img-circle">
									</div>
									<div class="item-details">
										<h5 class="font-bold text-center">{{ $c->category }}</h5>
										<ul>
										
								
										</ul>
									
									</div>
								</a>
								</div>
							</div>
							 @endforeach
							@else
						<strong>&nbsp;&nbsp;Ooops...! {{getPhrase('No_Categories_available')}}</strong>
						
						<a href="{{URL_USERS_SETTINGS.Auth::user()->slug}}" class="btn btn-info">{{getPhrase('click_here_to_change_your_preferences')}}</a>
						@endif 
						</div>
						@if(count($categories))
						 <div class="pull-right">
						{!! $categories->links() !!}
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