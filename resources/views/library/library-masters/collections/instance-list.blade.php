@extends($layout)
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')

 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      	<li><a href="{{URL_LIBRARY_MASTERS}}">{{ getPhrase('masters')}}</a></li>
      <li>{{$title}}</li>
    </ul>
  
  <section class="panel panel-default">

  	<?php 
         $image_path = IMAGE_PATH_UPLOAD_EXAMSERIES_DEFAULT;
         if($master_record->image)
         	$image_path = IMAGE_PATH_UPLOAD_LIBRARY.$master_record->image;
    ?>
				<!-- Page Heading -->
				<header class="panel-heading clear"> <img src="{{$image_path}}" class="img-circle" height="8%" width="8%"> <span><strong>{{$title}}</strong></span>
                  <label class="pull-right"><a href="{{URL_LIBRARY_COLLECTIONS_ADD}}{{ $master_record->slug }}" class="btn btn-info">{{getPhrase('new')}}</a></label>
                </header>

								
				<!-- /.row -->
					@include('library.library-masters.collections.instance-list-information', array('master_record' => $master_record))
				<div class="panel panel-custom">
					
					<div class="panel-body packages">
                        

                        <div class="table-responsive" style="overflow-x:initial;">
						 
						<table class="table table-striped b-t b-light ss-tb datatable">
							<thead>
								<tr>
									<th>{{ getPhrase('item_no')}}</th>
									<th>{{ getPhrase('type')}}</th>
									<th>{{ getPhrase('status')}}</th>
									<th id="helper_step2" class="no-sort">{{ getPhrase('action')}}</th>
								  
								</tr>
							</thead>
							 
						</table>
						

					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
			<div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-sm">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header ss-border-no">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title text-center font-bold">{{getPhrase('item_status')}}</h4>
			      </div>
			      <div class="modal-body">
			      {!!Form::open(array('url'=> URL_LIBRARY_COLLECTIONS_STATUS,'method'=>'POST','name'=>'collection_status'))!!} 

			      <span id="message"></span>
			      <p class="text-center">{{getPhrase('are_you_sure_to_change_status')}}?</p>

			        <input type="hidden" name="asset_no" id="asset_no" >
			        <input type="hidden" name="current_status" id="current_status" >
			      
			        
			      </div>
			      <div class="modal-footer ss-border-no">
			        <button type="button" class="btn btn-default" data-dismiss="modal">{{getPhrase('no')}}</button>
			        <button type="submit" class="btn btn-info" >{{getPhrase('yes')}}</button>
			      </div>
			      {!!Form::close()!!}
			    </div>

			  </div>
			</div>
</section>
@endsection
 

@section('footer_scripts')
  
 @include('common.datatables', array('route'=>URL_LIBRARY_COLLECTIONS_LIST.$master_record->slug,'route_as_url' => TRUE))
 @if(count($records))
 @include('common.deletescript', array('route'=>URL_LIBRARY_MASTERS_COLLECTIONS_DELETE,'route_as_url' => TRUE))
 @endif
 <script >
 	 
 		function changeStatus(asset_no, status)
 		{
 			
 			$('#asset_no').val(asset_no);
 			$('#current_status').val(status);
 			
 			$('#myModal').modal('show');
 		}

  
 </script>


@stop
