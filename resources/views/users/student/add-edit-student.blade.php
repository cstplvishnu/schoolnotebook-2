@extends($layout)

@section('content')


 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li><a href="{{URL_USERS."users"}}">{{ getPhrase('all_users')}}</a> </li>
      <li>{{$title}}</li>
    </ul>
				<!-- Page Heading -->
	    <section class="panel panel-default">
			  
			  <header class="panel-heading clear"> {{getPhrase('update')}} <strong>{{ $user_name }}</strong> {{ getPhrase('profile')}}
                  <label class="pull-right">
                  	<a href="{{URL_USERS."student"}}" class="btn btn-info">{{getPhrase('students')}}</a>
                  </label>
                </header>
				

				<!-- /.row -->
				<div class="panel panel-custom m-t" ng-controller="academic_controller">
				       
				      
                      
                      <header class="panel-heading bg-light">
				            <ul class="nav nav-tabs nav-justified">
				            <li class="{{isActive($tab_active, 'general')}}"><a data-toggle="tab" class="font-bold" href="#academic_details"><i class="fa fa-user"></i> {{ getPhrase('general_details')}}</a></li>
							
							<li class="{{isActive($tab_active, 'personal')}}" ><a data-toggle="tab" class="font-bold" href="#personal_details"><i class="fa fa-user-circle"></i> {{ getPhrase('personal_details')}}</a></li>
							
							<li  class="{{isActive($tab_active, 'contact')}}" ><a data-toggle="tab" class="font-bold" href="#contact_details"><i class="fa fa-phone"></i> {{ getPhrase('contact_details')}}</a></li>

							<li  class="{{isActive($tab_active, 'parent_details')}}" ><a data-toggle="tab" class="font-bold" href="#parent_details"> <i class="fa fa-male"></i> {{ getPhrase('parent_login')}}</a></li>
				            </ul>
				        </header>

					<div class="panel-body">
						
                       <div class="tab-content">


                             @include('users.student.student-general-details-fields', 
									array('tab_active' => $tab_active, 'record' => $record,  'academic_years'=>$academic_years, 'courses_list'=>$courses_list, 'courses_parent_list'=>$courses_parent_list, 'years'=>$years, 'semisters'=>$semisters,
										'having_semiseter'=>$having_semiseter
									))
							@include('users.student.student-personel-details-fields', 
									array('tab_active' => $tab_active, 'record' => $record,'countries' => $countries, 'religions'=>$religions, 'categories'=>$categories))
							@include('users.student.student-contact-details-fields', 
									array('tab_active' => $tab_active, 'record' => $record,'ph_no'=>$ph_no))
							@include('users.student.student-parent-details-fields', 
									array('tab_active' => $tab_active, 'record' => $record,'countries' => $countries, 'religions'=>$religions, 'categories'=>$categories))
							 
						</div>



					</div>
				</div>
			</section>
@endsection


@section('footer_scripts')
	@include('users.student.scripts.js-scripts')

	<script type="text/javascript">
		$(document).ready(function () {
   $('.toggle-tick input').click(function () {
       $('input:not(:checked)').parent().removeClass("active");
       $('input:checked').parent().addClass("active");
   });    
});
	</script>
@stop
