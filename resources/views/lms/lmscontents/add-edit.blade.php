@extends($layout)
@section('content')
      
				<!-- Page Heading -->
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
			      <li><a href="{{URL_LMS_CONTENT}}">{{getPhrase('contents')}} </a></li>
			      <li>{{$title}}</li>
			    </ul>
					@include('errors.errors')
				<!-- /.row -->
				
				<?php 
					$settings = ($record) ? $settings : ''; 
				?>

				<div class="row" ng-init="initAngData('{{ $settings }}');" ng-controller="angLmsController">
                  <div class="col-sm-10 col-sm-offset-1">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
				<?php $button_name = getPhrase('save'); ?>
					@if ($record)
					 <?php $button_name = getPhrase('save'); ?>
						{{ Form::model($record, 
						array('url' => URL_LMS_CONTENT_EDIT. $record->slug, 'novalidate'=>'','name'=>'formLms ',
						'method'=>'patch', 'files' => true)) }}
					@else
						{!! Form::open(array('url' => URL_LMS_CONTENT_ADD, 
							'novalidate'=>'','name'=>'formLms ',
						'method' => 'POST', 'files' => true)) !!}
					@endif
					 @include('lms.lmscontents.form_elements', 
					 array('button_name'=> $button_name),
					 array('subjects'=>$subjects, 'record'=>$record))
					 	 	
					{!! Form::close() !!}

                    </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
		<!-- /#page-wrapper -->
@stop

@section('footer_scripts')   
@include('lms.lmscontents.scripts.js-scripts')
@include('common.validations');
@include('common.editor'); 
  @include('common.alertify')
   <script>
 	var file = document.getElementById('image_input');

file.onchange = function(e){
    var ext = this.value.match(/\.([^\.]+)$/)[1];
    switch(ext)
    {
        case 'jpg':
        case 'jpeg':
        case 'png':

     
            break;
        default:
               alertify.error("{{getPhrase('file_type_not_allowed')}}");
            this.value='';
    }
};
 </script>
@stop