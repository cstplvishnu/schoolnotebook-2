@extends('layouts.admin.adminlayout')
@section('header_scripts')

@stop
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
			    <li><a href="{{URL_SETTINGS_LIST}}">{{ getPhrase('settings')}}</a>  </li>
			      <li>{{$title}}</li>
			    </ul>

				<!-- Page Heading -->
				
								
				<!-- /.row -->
				<div class="row">
                  <div class="col-sm-9 col-sm-offset-1">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
					<div class="row">
						@if($record->image)
						<img src="{{IMAGE_PATH_SETTINGS.$record->image}}" width="100" height="100">
						@endif
					</div>
					{!! Form::open(array('url' => URL_SETTINGS_ADD_SUBSETTINGS.$record->slug, 'method' => 'PATCH', 
						'novalidate'=>'','name'=>'formSettings ', 'files'=>'true')) !!}
						<div class="row"> 
						<ul class="list-group">
						@if(count($settings_data))

						@foreach($settings_data as $key=>$value)
						<?php 
							$type_name = 'text';

							if($value->type == 'number' || $value->type == 'email' || $value->type=='password')
								$type_name = 'text';
							else
								$type_name = $value->type;
						?>
						@include(
									'mastersettings.settings.sub-list-views.'.$type_name.'-type', 
									array('key'=>$key, 'value'=>$value)
								)
						  @endforeach

						  @else
							  <li class="list-group-item">{{ getPhrase('no_settings_available')}}</li>
						  @endif
						</ul>

						</div>

						 

						@if(count($settings_data))
						  <div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                        <button class="btn btn-success">{{ getPhrase('save') }}</button>
                              </div>
                            </div>
                        </div>
						@endif
							{!! Form::close() !!}
							@if($record->slug=='id-card-settings')
							
							@include('mastersettings.settings.id-card-templates')
							@elseif($record->slug=='site-settings')
							
							@endif


				        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
			
@endsection
 

@section('footer_scripts')
  <script src="{{JS}}bootstrap-toggle.min.js"></script>

@stop
