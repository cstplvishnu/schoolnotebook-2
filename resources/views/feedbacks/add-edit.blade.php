@extends($layout)

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
  <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
  <li>{{$title}}</li>
</ul>

				<!-- Page Heading -->
				
					@include('errors.errors')
				<!-- /.row -->
		<div class="row">
                  <div class="col-sm-6 col-sm-offset-3">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
					<?php $button_name = getPhrase('send'); ?>
					 
					{!! Form::open(array('url' => URL_FEEDBACK_SEND, 'method' => 'POST', 'name'=>'formQuiz ', 'novalidate'=>'')) !!}
					<div class="row">
 					 <fieldset class="form-group col-md-12">
						
						{{ Form::label('title', getphrase('title')) }}
						<span class="text-danger">*</span>
						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg :'.getPhrase(' title'),
							'ng-model'=>'title', 
							'ng-pattern'=>getRegexPattern('name1'), 
							'required'=> 'true', 
							'ng-class'=>'{"has-error": formQuiz.title.$touched && formQuiz.title.$invalid}',
							'ng-minlength' => '4',
							'ng-maxlength' => '45',
							)) }}
						<div class="validation-error" ng-messages="formQuiz.title.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('pattern')!!}
	    					{!! getValidationMessage('minlength',4,45)!!}
	    					{!! getValidationMessage('maxlength',4,45)!!}
						</div>
					</fieldset>
					</div>
					
					<div class="row">
					<fieldset class="form-group col-md-12">
						
						{{ Form::label('subject', getphrase('subject')) }}
						<span class="text-danger">*</span>
						{{ Form::text('subject', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('subject'),
							'ng-model'=>'subject', 
							'required'=> 'true', 
							'ng-pattern'=>getRegexPattern('name1'), 
							'ng-class'=>'{"has-error": formQuiz.subject.$touched && formQuiz.subject.$invalid}',
							'ng-minlength' => '2',
							'ng-maxlength' => '40',
							)) }}
						<div class="validation-error" ng-messages="formQuiz.subject.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('pattern')!!}
	    					{!! getValidationMessage('minlength',2,40)!!}
	    					{!! getValidationMessage('maxlength',2,40)!!}
						</div>
					</fieldset>
				 </div> 
					
					<div class="row">
					 <fieldset class="form-group col-md-12">
					 {{ Form::label('description', getphrase('description')) }}
						<span class="text-danger">*</span>
							 <textarea name="description" ng-model="description"
							 required="true" class='form-control' rows="5"></textarea>
						<div class="validation-error ckeditor" ng-messages="formQuiz.description.$error"  >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('number')!!}
						</div>
					</fieldset>
					</div>

					<div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                               
                        <button class="btn btn-success" ng-disabled='!formQuiz.$valid'>{{ $button_name }}</button>
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

@section('footer_scripts')
 @include('common.validations');
 
    
@stop
 
 