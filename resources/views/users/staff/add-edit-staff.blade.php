@extends($layout)

@section('content')


 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li><a href="{{URL_USERS."users"}}">{{ getPhrase('all_users')}}</a> </li>
      <li>{{getPhrase('staff_profile')}}</li>
    </ul>
				@include('errors.errors')	<!-- Page Heading -->
	    <section class="panel panel-default">
			  
			  <header class="panel-heading clear"> {{getPhrase('update')}} <strong>{{ $user_name }}</strong> {{ getPhrase('profile')}}
                  <label class="pull-right">
                  	<a href="{{URL_USERS."staff"}}" class="btn btn-info">{{getPhrase('staff')}}</a>
                  </label>
                </header>
				

				<!-- /.row -->
				<div class="panel panel-custom m-t" ng-controller="staffController">
				       
				      
                      
                      <header class="panel-heading bg-light">
				          <ul class="nav nav-tabs nav-justified">
				            <li class="{{isActive($tab_active, 'general')}}"><a data-toggle="tab" href="#academic_details"><strong><i class="fa fa-user"></i> {{ getPhrase('general_details')}}</strong></a></li>
							
							<li class="{{isActive($tab_active, 'personal')}}" ><a data-toggle="tab" href="#personal_details"><strong><i class="fa fa-user-circle"></i> {{ getPhrase('personal_details')}}</strong></a></li>
							
							<li  class="{{isActive($tab_active, 'contact')}}" ><a data-toggle="tab" href="#contact_details"><strong><i class="fa fa-phone"></i> {{ getPhrase('contact_details')}}</strong></a></li>
				          </ul>
				        </header>

					<div class="panel-body">
						
                       <div class="tab-content">


                          @include('users.staff.staff-general-details-fields', 
					array('tab_active' => $tab_active, 'record' => $record ,'courses_list'=>$courses_list, 'courses_parent_list'=>$courses_parent_list))
							@include('users.staff.staff-personel-details-fields', 
									array('tab_active' => $tab_active, 'record' => $record,'countries' => $countries))
							@include('users.staff.staff-contact-details-fields', 
									array('tab_active' => $tab_active, 'record' => $record))
							 
						</div>



					</div>
				</div>
			</section>
@endsection


@section('footer_scripts')
 @include('users.staff.scripts.js-scripts')
@stop
