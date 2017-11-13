@extends($layout)

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
			      <li><a href="{{URL_SUBJECTS}}">{{getPhrase('subjects')}} </a></li>
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
				
					
					<div class="panel-body text-center">
					
					<a href="{{DOWNLOAD_LINK_SUBJECTS_IMPORT_EXCEL}}" class="btn btn-info helper_step2">{{getPhrase('clik_here_to_download_the_template')}}
					</a>
					
					<?php $button_name = getPhrase('upload'); ?>
					
						{!! Form::open(array('url' => URL_SUBJECTS_IMPORT, 'method' => 'POST', 'novalidate'=>'','name'=>'formExcel ', 'files'=>'true')) !!}
					

						<div class="row">
				 
					<fieldset class='col-sm-4 col-sm-offset-4 form-group margintop30'>
						{{ Form::label('excel', getphrase('upload').' Excel') }}
						{!! Form::file('excel', array('class'=>'form-control','id'=>'excel_input', 'accept'=>'.xls,.xlsx',

						    
							)) !!}

					</fieldset>
					  </div>
					
						 <div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_SUBJECTS}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success">{{ $button_name }}</button>
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