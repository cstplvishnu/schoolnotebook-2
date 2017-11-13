@extends($layout)
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')
   

				<!-- Page Heading -->
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
					<li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}} </a></li>
					<li><a href="{{URL_USERS_DASHBOARD}}"> {{getPhrase('users_dahboard')}} </a></li>
					<li>{{$title}}</li>
				</ul>
				       
				<!-- /.row -->
			<section class="panel panel-default">

				  @if(!count($academic_details)||!count($course_details))
	       				<div class="alert alert-warning">
                              <strong>{{getPhrase('Note:')}}</strong> {{getPhrase('please_update_master_setup_details_before_creating_users.')}}
                         </div>	
                         @endif	
					<header class="panel-heading clear"><strong> {{$title}}</strong>
                  <label class="pull-right">
                  	@if($role=='student') 
							<a href="{{URL_USERS_IMPORT}}" class="btn btn-dark" >{{ getPhrase('import_excel')}}</a>
							@endif
							@if(count($academic_details)&&count($course_details))
							<a href="{{URL_USERS_ADD}}" class="btn btn-info" >{{ getPhrase('add_user')}}</a>
							 @endif
							 @if(!count($academic_details)||!count($course_details))
							 <a href="javascript:void(0);" class="btn btn-info" onclick="showMessage()" >{{ getPhrase('add_user')}}</a>
							  @endif
                  </label>
                
						
						
						@if($role=='student')
						<div class="alert alert-info m-t-lg">
                              <strong>{{getPhrase('Note:')}}</strong> {{getPhrase('If do not update the student admission details, those students are available in all users list.')}}&nbsp;&nbsp;&nbsp;{{getPhrase('for all users list')}}  &nbsp;<a href="{{URL_USERS."users"}}" class="btn  btn-warning button btn-xs">{{ getPhrase('click_here')}}</a>
                           </div>
                           @endif
					</header>

                    
						<div class="table-responsive" style="overflow-x:initial;">
						<table class="table table-striped b-t b-light ss-tb datatable">
							<thead>
								<tr>
								     @if($role =='student')

									<th class="no-sort"></th>
                                    <th id="helper_step2">{{ getPhrase('name')}}</th>
								 	<th>{{ getPhrase('course')}}</th>
								 	<th>{{ getPhrase('year-sem')}}</th>
								 	<th>{{ getPhrase('email')}}</th>
									<th  id="helper_step3" class="no-sort">{{ getPhrase('action')}}</th>

									@elseif($role=='staff')

									<th class="no-sort"></th>
									<th>{{ getPhrase('name')}}</th>
									<th>{{ getPhrase('staff_id')}}</th>
									<th>{{ getPhrase('job_title')}}</th>
									<th>{{ getPhrase('branch')}}</th>
									<th>{{ getPhrase('email')}}</th>
									<th class="no-sort">{{ getPhrase('action')}}</th>

									@elseif($role=='users')

									<th class="no-sort"></th>
									<th>{{ getPhrase('name')}}</th>
									<th>{{ getPhrase('email')}}</th>
								    <th>{{ getPhrase('role')}}</th>
                                    <th class="no-sort">{{ getPhrase('action')}}</th>

                                    @else

									<th class="no-sort"></th>
									<th>{{ getPhrase('name')}}</th>
									<th>{{ getPhrase('email')}}</th>
                                    <th class="no-sort">{{ getPhrase('action')}}</th>
                                    
									@endif
								</tr>
							</thead>
							 
						</table>
						</div>
						 
	</section>

			<!-- /.container-fluid -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header ss-border-no">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{getPhrase('staff_status')}}</h4>
      </div>
      <div class="modal-body">
      {!!Form::open(array('url'=> URL_STAFF_EDIT_PROFILE_STATUS,'method'=>'POST','name'=>'userstatus'))!!} 

      <span id="message"></span>

        <input type="hidden" name="user_slug" id="user_slug" >
        <input type="hidden" name="current_status" id="current_status" >
        <input type="hidden" name="user_id" id="user_id" >

        
      </div>
      <div class="modal-footer ss-border-no">
        <button type="button" class="btn btn-warning" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-success" >Yes</button>
      </div>
      {!!Form::close()!!}
    </div>

  </div>
</div>

@endsection
 
@section('footer_scripts')
 @include('common.datatables', array('route'=>URL_USERS_LIST_GETLIST.$role, 'route_as_url'=>true))
 @include('common.deletescript', array('route'=>URL_USERS_DELETE))
 <script >
 	 
 		function changeStatus(user_slug, status,user_id)
 		{
 			$('#user_slug').val(user_slug);
 			$('#current_status').val(status);
 			$('#user_id').val(user_id);
 			message = '{{ getPhrase('are_you_sure_to_make_user_active')}}?'; 
 			if(status==1)
 			message = '{{ getPhrase('are_you_sure_to_make_user_inactive')}}?'; 
 			$('#message').html(message);

 			$('#myModal').modal('show');
 		}

 		function showMessage(){
          new PNotify({
                title: "Sorry",
                text: "{{getPhrase('please_update_master_setup_details')}}",
                type: "info",
                delay: 1500,
                shadow: true,
                
                animate: {
                            animate: true,
                            in_class: 'fadeInLeft',
                            out_class: 'fadeOutRight'
                        }
                });
 		}
  
 </script>
@stop
