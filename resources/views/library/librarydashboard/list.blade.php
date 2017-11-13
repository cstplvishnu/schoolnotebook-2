@extends($layout)
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')
 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li>{{$title}}</li>
    </ul>
<section class="panel panel-default">
				<!-- Page Heading -->
				<header class="panel-heading clear"><strong> {{$title}}</strong>
                  
                </header>

					<div class="table-responsive" style="overflow-x:initial;">
						 
						<table class="table table-striped b-t b-light ss-tb datatable">
							<thead>
								<tr>
									<th class="no-sort"></th>
									<th>{{ getPhrase('roll_no')}}</th>
									<th>{{ getPhrase('name')}}</th>
									<th>{{ getPhrase('academic_details')}}</th>
								 	<th>{{ getPhrase('asset no')}}</th>
								 	<th>{{ getPhrase('asset_name')}}</th>
									<th>{{ getPhrase('email')}}</th>
									<th>{{ getPhrase('date-_issue/_return')}}</th>
									<th id="helper_step1" class="no-sort">{{ getPhrase('returned')}}</th>
 						</tr>
							</thead>
							 
						</table>

					</div>
					 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{getPhrase('student_book_returned')}}</h4>
      </div>
      <div class="modal-body">
      {!!Form::open(array('url'=> URL_LIBRARY_RETURN_ASSET,'method'=>'POST','name'=>'userstatus'))!!} 

      <span id="message"></span>
         
        <input type="hidden" name="user_id" id="user_id" >
        <input type="hidden" name="issue_id" id="id" >
        <input type="hidden" name="instance_id" id="library_instance_id" >
        <input type="hidden" name="master_id" id="master_asset_id" >
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary" >Yes</button>
      </div>
      {!!Form::close()!!}
    </div>

  </div>
</div>
			<!-- /.container-fluid -->
		</section>
@endsection
 

@section('footer_scripts')
 @include('common.datatables', array('route'=>'librarydashboard.datatable'))
   
    <script >
 	 
 		function changeStatus(user_id, id,library_instance_id,master_asset_id)
 		{
 			$('#user_id').val(user_id);
 			$('#id').val(id);
 			$('#library_instance_id').val(library_instance_id);
 			$('#master_asset_id').val(master_asset_id);
 			message = '{{ getPhrase('are_you_sure_to_returned_the_book')}}?'; 
 		
 			$('#message').html(message);

 			$('#myModal').modal('show');
 		}
  
 </script>


 @stop
