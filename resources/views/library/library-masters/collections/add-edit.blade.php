@extends($layout)
@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
  <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
  <li><a href="{{URL_LIBRARY_MASTERS}}"> {{ getPhrase('masters')}}</a></li>
  <li><a href="{{URL_LIBRARY_COLLECTIONS}}{{ $master_record->slug}}"> {{ $master_record->title.' '.getPhrase('collections')}}</a></li>
  <li>{{$title}}</li>
</ul>


<div class="row">
                  <div class="col-sm-9 col-sm-offset-1">
                     <section class="panel panel-default" ng-controller="angLibraryController">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
				<!-- Page Heading -->
				
					@include('errors.errors')
				<!-- /.row -->
				<?php 

				 	$librarySettings = getLibrarySettings();
				

				?>
				
					<?php $button_name = getPhrase('create'); ?>
				   @if($record)
				   <?php $button_name =  getphrase('update');?>
				   {{ Form::model($record,array('url'=>URL_LIBRARY_COLLECTIONS_EDIT.$master_record->slug,'method'=>'patch')) }}
				   @else
					{!! Form::open(array('url' => URL_LIBRARY_COLLECTIONS_ADD.$master_record->slug, 'method' => 'POST')) !!} 
                   @endif

					<div class="row">
						 <fieldset class="form-group col-md-4">
							
							{{ Form::label('series_prefix', getphrase('series_prefix')) }}
							<span class="text-danger">*</span>
							 <div class="input-group">
	      						<div class="input-group-addon">{{getSetting('library_series_prefix','library_settings')}}</div>
							{{ Form::text('series_prefix', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'A1001', 'ng-model'=>'prefix')) }}
							</div>
						</fieldset>

						<fieldset class="form-group col-md-4">
							{{ Form::label('from', getphrase('from')) }}
							<span class="text-danger">*</span>
							{{ Form::text('from', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg: 1', 'ng-model'=>'from')) }}
						</fieldset>
						<fieldset class="form-group col-md-4">
							{{ Form::label('to', getphrase('to')) }}
							<span class="text-danger">*</span>
							{{ Form::text('to', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg: 100', 'ng-model'=>'to')) }}
						</fieldset>
					
					</div>
					<div class="row">
					<?php $collectionTypes = (new App\librarySettings())->getCollectionTypes();
						?>
						<fieldset class="form-group col-md-4">
							{{ Form::label('asset_type', getphrase('type')) }}
							<span class="text-danger">*</span>
							{{Form::select('asset_type', $collectionTypes, null, ['class'=>'form-control'])}}
						</fieldset>

					 	<fieldset ng-if="from!=null" class="form-group col-md-4">
							{{ Form::label('to', 'Number Preview') }}
							<input type="text" class="form-control" readonly value="{{$librarySettings->prefix}} @{{ prefix }} @{{ from }}">
						</fieldset>

						<fieldset ng-if="from!=null" class="form-group col-md-4">
							{{ Form::label('to', '&nbsp; &nbsp;') }}
							<input type="text" class="form-control" readonly value="{{$librarySettings->prefix}} @{{ prefix }} @{{ to }}">
						</fieldset>
						
					</div>
					<div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_LIBRARY_COLLECTIONS}}{{ $master_record->slug}}" class="btn btn-s-md btn-dark">{{ $master_record->title.' '.getPhrase('collections')}}</a>
                        <button class="btn btn-info">{{ getPhrase('generate') }}</button>
                              </div>
                            </div>
                        </div>
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

 <script src="{{JS}}libraryMaster.js"></script>

@stop
 