@extends($layout)
@section('content')
      
				<!-- Page Heading -->
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i>{{getPhrase('home')}}</a></li>
			      <li><a href="{{URL_LIBRARY_MASTERS}}">{{getPhrase('library_masters')}} </a></li>
			      <li>{{$title}}</li>
			    </ul>
					@include('errors.errors')
				<!-- /.row -->
				
				<div class="row">
                  <div class="col-sm-9 col-sm-offset-1">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
					<?php $button_name = getPhrase('save'); ?>
					@if ($record)
					 <?php $button_name = getPhrase('save'); ?>
						{{ Form::model($record, 
						array('url' => URL_LIBRARY_MASTERS_EDIT.$record->slug, 
						'method'=>'patch', 'files' => 'true','name'=>'formLibraryMaster ', 'novalidate'=>'')) }}
					@else
						{!! Form::open(array('url' => URL_LIBRARY_MASTERS_ADD, 'method' => 'POST', 'files' => 'true','name'=>'formLibraryMaster ', 'novalidate'=>'')) !!}
					@endif
					
					 @include('library.library-masters.form_elements', 
					 array('button_name'=> $button_name),
					 array('authors' 		=> $authors,
					 		'publishers' 	=> $publishers,
					 		'asset_types' 	=> $asset_types,
					 		'record' 		=> $record,
					 		))
					 		
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
 @include('common.validations')
 @include('common.alertify')
    <script>
 	var file = document.getElementById('image');

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