@extends($layout)
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li><a href="{{URL_USERS_DASHBOARD}}"> {{getPhrase('users_dashboard')}}</a></li>
      <li>{{$title}}</li>
    </ul>

<section class="panel panel-default">

	         <header class="panel-heading clear"><strong> {{$title}}</strong></header>

				<!-- /.row -->
					
					<div class="table-responsive" style="overflow-x:initial;">
						<table class="table table-striped b-t b-light ss-tb datatable">
							<thead>
								<tr>

                                   
                                    
									<th class="no-sort"></th>
									<th>{{ getPhrase('name')}}</th>
									<th>{{ getPhrase('staff_id')}}</th>
									<th>{{ getPhrase('job_title')}}</th>
									<th>{{ getPhrase('branch')}}</th>
									<th>{{ getPhrase('email')}}</th>
									<th class="no-sort">{{ getPhrase('action')}}</th>

									
								</tr>
							</thead>
							 
						</table>
						</div>
						 


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
        
      </div>
      <div class="modal-footer ss-border-no">
        <button type="button" class="btn btn-warning" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-success" >Yes</button>
      </div>
      {!!Form::close()!!}
    </div>

  </div>
</div>

</section>
@endsection
 
@section('footer_scripts')
 
 @include('common.datatables', array('route'=>URL_USERS_STAFF_INACTIVE_GETLIST.$role, 'route_as_url'=>true))
 
 <script >
 	 
 		function changeStatus(user_slug, status)
 		{
 			$('#user_slug').val(user_slug);
 			$('#current_status').val(status);
 			message = '{{ getPhrase('are_you_sure_to_make_user_active')}}?'; 
 			if(status==1)
 			message = '{{ getPhrase('are_you_sure_to_make_user_inactive')}}?'; 
 			$('#message').html(message);

 			$('#myModal').modal('show');
 		}
  
 </script>
@stop
