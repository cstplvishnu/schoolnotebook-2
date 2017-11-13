 
@extends($layout)

@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
			      <li>{{$title}}</li>
			    </ul>
<div class="row">
                  <div class="col-sm-6 col-sm-offset-3">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
				<!-- Page Heading -->
				
					@include('errors.errors')
				<!-- /.row -->
				
					<div class="panel-body form-auth-style">
					<?php $button_name = getPhrase('save'); ?>
					@if ($record)
					 <?php $button_name = getPhrase('save'); ?>
						{{ Form::model($record, 
						array('url' => ['users/change-password', $record->slug], 
						'method'=>'patch', 'novalidate'=>'', 'name'=>"changePassword")) }}
					@endif

					 @include('users.change-password.form_elements', array('button_name'=> $button_name, 'record' => $record)) 
					 
					{!! Form::close() !!}
				

				        </div>
                    </div>
                </div>
            </div>
            </section>
        </div>
    </div>	

@endsection

@section('footer_scripts')
	@include('common.validations');
@stop