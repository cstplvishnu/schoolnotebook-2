@extends($layout)
@section('content')
      
				<!-- Page Heading -->
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
			      <li><a href="{{URL_LANGUAGES_LIST}}">{{getPhrase('languages')}} </a></li>
			      <li>{{$title}}</li>
			    </ul>
					@include('errors.errors')
				<!-- /.row -->
				
				<div class="row">
                  <div class="col-sm-6 col-sm-offset-3">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
				
					@if ($record)

					
						{{ Form::model($record, 
						array('url' => URL_LANGUAGES_EDIT.'/'. $record->slug, 
						'method'=>'patch','novalidate'=>'','name'=>'formLanguage')) }}
					@else
						{!! Form::open(array('url' => URL_LANGUAGES_ADD, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'')) !!}
					@endif

					 @include('languages.form_elements', 
					 
					 array('record' => $record))
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
 

@stop
 
 