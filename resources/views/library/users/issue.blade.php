@extends($layout)
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')


 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      @if($role =='student')
	<li><a href="{{URL_LIBRARY_USERS}}student">{{ getPhrase('student_users')}}</a></li>	
	@endif
	@if($role == 'staff')
	<li><a href="{{URL_LIBRARY_USERS}}staff">{{ getPhrase('staff_users')}}</a></li>
	@endif
      <li>{{$title}}</li>
    </ul>
				<!-- Page Heading -->
	    <section class="panel panel-default">
			
				<input type="hidden" id="user_id" value="{{$user->id}}">
				<!-- /.row -->
				<div class="panel panel-custom" ng-controller="libraryIssues">
				<?php 
					$books_issued = (new App\LibraryIssue())->getCurrentIssuedRecords($user->id);
					$books_history = App\LibraryIssue::where('user_id',$user->id)
									->orderBy('issued_on', 'desc')
									->get();
				 ?>
					@include('library.users.statistics', 
					array('user'=>$user, 'books_issued'=>$books_issued, 'books_history'=>$books_history)
					)
                      
                      <header class="panel-heading bg-light">
				            <ul class="nav nav-tabs nav-justified">
				             <li class="active"><a data-toggle="tab" href="#profile" class="font-bold"><i class="fa fa-user"></i> {{ getPhrase('profile') }}</a></li>
							<li><a data-toggle="tab" href="#academic_details" class="font-bold"><i class="fa fa-book"></i> {{ getPhrase('books_taken') }}</a></li>
							<li><a data-toggle="tab" href="#personal_details" class="font-bold"><i class="fa fa-bookmark"></i> {{ getPhrase('issue_book')}}</a></li>
							<li><a data-toggle="tab" href="#contact_details" class="font-bold"><i class="fa fa-laptop"></i> {{ getPhrase('history') }}</a></li>
				            </ul>
				        </header>

					<div class="panel-body">
						
                       <div class="tab-content">
                             
                         <div class="tab-pane active" id="profile">
					
							@if($role=='student')
								@include('users.student.student-profile', array('student'=>$student, 'user'=>$user))
							@endif

							@if($role=='staff')

								@include('users.staff.staff-profile-library', array('staff'=>$staff, 'user'=>$user))
							@endif

							</div>

							<div id="academic_details" class="tab-pane">

								@include('library.users.assets_taken', array('user'=>$user, 'books_issued'=>$books_issued))

							</div>

							<div id="personal_details" class="tab-pane">
                             
                              @if($role=='student')

								@include('library.users.issue-asset-sub-view')

                               @endif

                                @if($role=='staff')

								@include('library.users.staff-issue-asset-sub-view')

                               @endif
                               
							</div>

							<div id="contact_details" class="tab-pane">
							
								@include('library.users.transaction-history', array('user'=>$user, 'books_issued'=>$books_issued, 'books_history'=>$books_history))
								
							</div>

						</div>

					</div>
					
				</div>
				
			</section>
@endsection


<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
@section('footer_scripts')
 @include('common.deletescript', array('route'=>URL_LIBRARY_MASTERS_COLLECTIONS_DELETE))
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

<script >
  $(function() {
        $("#auto").autocomplete({
            source: "{{URL_LIBRARY_ISSUES_GET_REFERENCE}}",
            minLength: 1,
            select: function( event, ui ) {
                $('#response').val(ui.item.id);
                getAssetDetails(ui.item.id);
            }
        });
    });	

  function getAssetDetails(asset_id) {
  	user_id = $('#user_id').val();
  	route = '{{URL_LIBRARY_ISSUES_GET_MASTER_DETAILS}}';  
  	token = $('[name="_token"]').val();
		    $.ajax({
		        url:route,
		        type: 'post',
		         dataType: 'json',
		        data: {_method: 'post', 'asset_id': asset_id, 'user_id': user_id, '_token':token},
		        success:function(data){
		        	console.log(data);
		        	$('#master_details').html(data.master_details);
		        	$('#asset_details').html(data.instance_details);
		        	$('#asset_image').html(data.image);
		        	$('#button').html(data.button);
		        	 
		         
		        }
		    });
  }
</script>


<script >
  $(function() {
        $("#staff-auto").autocomplete({
            source: "{{URL_LIBRARY_ISSUES_GET_REFERENCE_STAFF}}",
            minLength: 1,
            select: function( event, ui ) {
                $('#response').val(ui.item.id);
                getAssetDetails(ui.item.id);
            }
        });
    });	

  function getAssetDetails(asset_id) {
  	user_id = $('#user_id').val();
  	route = '{{URL_LIBRARY_ISSUES_GET_MASTER_DETAILS}}';  
  	token = $('[name="_token"]').val();
		    $.ajax({
		        url:route,
		        type: 'post',
		         dataType: 'json',
		        data: {_method: 'post', 'asset_id': asset_id, 'user_id': user_id, '_token':token},
		        success:function(data){
		        	$('#master_details').html(data.master_details);
		        	$('#asset_details').html(data.instance_details);
		        	$('#asset_image').html(data.image);
		        	$('#button').html(data.button);
		        	 
		         
		        }
		    });
  }
</script>
@stop
