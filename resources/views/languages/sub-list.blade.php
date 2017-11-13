@extends($layout)

@section('content')
	<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
			      <li><a href="{{URL_LANGUAGES_LIST}}">{{getPhrase('languages')}} </a></li>
			      <li>{{$title}}</li>
			  </ul>
   <div class="row">
                  <div class="col-sm-11 col-sm-offset-1">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
				<!-- Page Heading -->
				
					<?php $language_data = json_decode($record->phrases);?>			
				<!-- /.row -->
				
					{!! Form::open(array('url' => URL_LANGUAGES_UPDATE_STRINGS.$record->slug, 'method' => 'PATCH', 
						'novalidate'=>'','name'=>'formSettings ', 'files'=>'true')) !!}
						<div class="table-responsive"> 
						<ul class="list-group">
						@if(count($language_data))
						@foreach($language_data as $key=>$value)
						 
					 <div class="col-md-6">
						<fieldset class="form-group">
						   {{ Form::label($key, $key) }}
						  
						   <input type="text" class="form-control" name="{{$key}}" 
					 		required="true" value = "{{$value}}" >
					 		 

							</fieldset>
							</div>

						  @endforeach

						  @else
							  <li class="list-group-item">{{ getPhrase('no_settings_available')}}</li>
						  @endif
						</ul>

						</div>

						@if(count($language_data))
						<div class="buttons text-right">
							<button class="btn btn-success" ng-disabled='!formTopics.$valid'
							>{{ getPhrase('save') }}</button>
						</div>
						@endif
							{!! Form::close() !!}
					
			          

                </div>
            </section>
        </div>
    </div>
@endsection
 


