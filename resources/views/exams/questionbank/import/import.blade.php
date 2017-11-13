@extends($layout)

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
			      <li><a href="{{URL_QUIZ_QUESTIONBANK}}"> {{ getPhrase('questions')}}</a> </li>
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
					

					<div class="panel-body text-center">
					
					<a href="{{DOWNLOAD_LINK_QUESTION_IMPORT_EXCEL}}questions_radio_template.xlsx" class="btn btn-info helper_step2">{{getPhrase('single_answer')}}
					</a>
					<a href="{{DOWNLOAD_LINK_QUESTION_IMPORT_EXCEL}}questions_checkbox_template.xlsx" class="btn btn-info helper_step3">{{getPhrase('multi_answer')}}
					</a>
					<a href="{{DOWNLOAD_LINK_QUESTION_IMPORT_EXCEL}}questions_blanks_template.xlsx" class="btn btn-info helper_step4">{{getPhrase('fill_the_blanks')}}
					</a>
					<br>
				 
							<?php $button_name = getPhrase('upload'); ?>
					
						{!! Form::open(array('url' => URL_QUESTIONBAMK_IMPORT, 'method' => 'POST', 'novalidate'=>'','name'=>'formUsers ', 'files'=>'true')) !!}
					<?php $button_name = getPhrase('upload'); 
					// $question_types = array();
					$question_types 		= array( ''              => 'Select',
                                        'radio'         => 'Single Answer',
                                        'checkbox'      => 'Multi Answer',
                                        'blanks'        => 'Fill in blanks');

					?>
					 	<div class="row ">
						<fieldset class='col-sm-4 col-sm-offset-4 form-group margintop30 m-t'>
						{{ Form::label('question_type', getphrase('question_type')) }}
						<br>
						{{Form::select('question_type',$question_types , null, ['class'=>'form-control', "id"=>"question_type", "ng-model"=>"question_type" , 'required'=> 'true'])}}
						{!! Form::open(array('url' => URL_QUESTIONBAMK_IMPORT, 'method' => 'POST', 'novalidate'=>'','name'=>'formUsers ', 'files'=>'true')) !!}
						</fieldset>
				 
					<fieldset ng-if="question_type" class='col-sm-4 col-sm-offset-4 form-group margintop30'>
	
					{!! Form::file('excel', array('class'=>'form-control','id'=>'excel_input', 'accept'=>'.xls,.xlsx')) !!}
					 
					</fieldset>
					  </div>
					
						

					 <div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_QUIZ_QUESTIONBANK}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formUsers.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>
					{!! Form::close() !!}
					         </div>
			            </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
		<!-- /#page-wrapper -->
@endsection

@section('footer_scripts')
 @include('common.validations')
   @include('common.alertify')
 <script>
 	var file = document.getElementById('excel_input');

file.onchange = function(e){
    var ext = this.value.match(/\.([^\.]+)$/)[1];
    switch(ext)
    {
        case 'xls':
        case 'xlsx':
            
            break;
        default:
            alertify.error("{{getPhrase('file_type_not_allowed')}}");
            this.value='';
    }
};
 </script>
@stop