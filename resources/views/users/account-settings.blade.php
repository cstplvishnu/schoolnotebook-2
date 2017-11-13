 
@extends($layout)
 
@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
                           
   @if(checkRole(getUserGrade(2)))
	<li><a href="{{URL_USERS}}">{{ getPhrase('users')}}</a> </li>
	<li class="active">{{isset($title) ? $title : ''}}</li>
	@else
	<li class="active">{{$title}}</li>
	@endif
    </ul>
<div class="row">
                  <div class="col-sm-12">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">

			
					@include('errors.errors')
				<!-- /.row -->

				<?php 
				$user_options = null;
				if($record->settings)
					$user_options = json_decode($record->settings)->user_preferences;
				?>
					


					 
						{{ Form::model($record, 
						array('url' => URL_USERS_SETTINGS.$record->slug, 
						'method'=>'patch','novalidate'=>'','name'=>'formUsers ', 'files'=>'true' )) }}
					
					<!-- <h1></h1> -->
					 <h4 class="m-b-lg font-bold">{{getPhrase('quiz_and_exam_series')}}</h4>


					<div class="row">
					@foreach($quiz_categories as $category)
 				<?php 

	 					$checked = '';
	 					if($user_options) {
	 						if(count($user_options->quiz_categories))
	 						{
	 							if(in_array($category->id,$user_options->quiz_categories))
	 								$checked='checked';
	 						}
	 					}
 					?>


					<div class="col-md-3 form-group">
                     <label class= "control-label"><strong>{{$category->category}}</strong></label>
                     <div>
                       <label class="switch">
                         <input type="checkbox" name="quiz_categories[{{$category->id}}]" {{$checked}}>
                         <span></span>
                       </label>
                     </div>
                   </div>

					@endforeach
				 
				 </div>
                   
                   <h4 class="font-bold m-b-lg">LMS {{getPhrase('categories')}}</h4>

					<div class="row">
					@foreach($lms_category as $category)
 					<?php 

	 					$checked = '';
	 					if($user_options) {
	 						if(count($user_options->lms_categories))
	 						{
	 							if(in_array($category->id,$user_options->lms_categories))
	 								$checked='checked';
	 						}
	 					}
 					?>
					

					<div class="col-md-3 form-group">
                     <label class="control-label"><strong>{{$category->category}}</strong></label>
                     <div>
                       <label class="switch">
                         <input type="checkbox" name="lms_categories[{{$category->id}}]" {{$checked}}>
                         <span></span>
                       </label>
                     </div>
                   </div>
					@endforeach
				 
				 </div>

				 <div class="buttons text-right">
							<button class="btn btn-success"
							>{{ getPhrase('save') }}</button>
						</div>
				 
					{!! Form::close() !!}


					   </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
		<!-- /#page-wrapper -->
					

@endsection

@section('footer_scripts')
 @include('common.validations');
 <script src="{{JS}}bootstrap-toggle.min.js"></script>
@stop