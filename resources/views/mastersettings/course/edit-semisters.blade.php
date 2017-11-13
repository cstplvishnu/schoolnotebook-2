@extends('layouts.admin.adminlayout')
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i>{{getPhrase('home')}}</a></li>
			      <li><a href="{{URL_MASTERSETTINGS_COURSE}}">{{getPhrase('courses')}} </a></li>
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
					 
					
						{{ Form::model($records, 
						array('url' => ['mastersettings/course/editSemisters'], 
						'method'=>'patch')) }}
					
					@foreach($records as $record)
						 <fieldset class="form-group">
							
							{{ Form::label('year'.$record->year, ucfirst('year '.$record->year)) }}
							
							{{ Form::text($record->id, $value = $record->total_semisters , $attributes = array('class'=>'form-control', 'placeholder' => '2')) }}
						</fieldset>
					@endforeach
 					
 						<div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                               
                        <button class="btn btn-success">{{ getPhrase('save') }}</button>
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
			
@stop

 