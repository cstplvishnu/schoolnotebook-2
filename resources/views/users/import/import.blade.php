@extends($layout)

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i>{{getPhrase('home')}}</a></li>
			      <li><a href="{{URL_USERS."all"}}">{{getPhrase('users')}} </a></li>
			      <li>{{$title}}</li>
			    </ul>

				<!-- Page Heading -->
				
					@include('errors.errors')
				<!-- /.row -->

				  <div class="row" ng-controller="TabController">
                  <div class="col-sm-10 col-sm-offset-1">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
				
	
						<div class="col-md-4">
					<div class="panel-body text-center">
					
					<a href="{{DOWNLOAD_LINK_USERS_IMPORT_EXCEL}}" class="btn btn-info">{{getPhrase('download_template')}}
					</a>
					
					<?php $button_name = getPhrase('upload'); ?>
					
						{!! Form::open(array('url' => URL_USERS_IMPORT, 'method' => 'POST', 'novalidate'=>'','name'=>'formUsers ', 'files'=>'true')) !!}
					

	 
				 
					<fieldset >
					<label class="margintop30">Upload Excel</label>
						{{-- {{ Form::label('excel', getphrase('upload_excel')) }} --}}
						 
						
					{!! Form::file('excel', array('class'=>'form-control','id'=>'excel_input', 'accept'=>'.xls,.xlsx', 'required'=>'true')) !!}
							 
							 
					 
					</fieldset>
	 
					
						 <div class="form-group m-t">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                                <a href="{{URL_USERS."all"}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                        <button class="btn btn-success" ng-disabled='!formUsers.$valid'>{{ $button_name }}</button>
                              </div>
                            </div>
                        </div>

					 
					{!! Form::close() !!}
					</div>
				</div>

                    
                    <div class="col-md-8">
						<div class="col-md-12 col-sm-offset-3">
						<h4><strong>{{ getPhrase('information_helper_for_excel_data')}}</strong></h4>
                         
                         
						  @include('common.year-selection-view')
						  <div class="row">
						  <div class="col-md-12 vertical-scroll" >
						  <p ng-if="result_data.length<=0" >No Data Available with the selection</p>
						 
						  </div>
						  	
						  </div>
					    
					    </div>

				
				        </div>

				      <div class="col-md-12">

				      	 <table class="table table-striped b-t b-light ss-tb datatable"  ng-if="result_data">
						  <thead>
						 	<th>Academic ID</th>
						  	<th>Course parent ID</th>
						  	<th>Course ID</th>
						  	<th>Year</th>
						  	<th>Semester</th>
						  	
						  </thead>	
						  <tbody>

						  	<tr>
						  		<td>@{{result_data.academic_id}}</td>
						  		<td>@{{result_data.course_parent_id}}</td>
						  		<td>@{{result_data.course_id}}</td>
						  		<td>@{{result_data.year}}</td>
						  		<td>@{{result_data.semister}}</td>
						  		
						  	</tr>
						  </tbody>
						  </table>	
				      	
				      </div>  

				


					</div>
                </div>
            </section>
        </div>
    </div>
			
			
@endsection

@section('footer_scripts')
 @include('common.validations')
   @include('common.alertify')
   @include('users.import.scripts.js-scripts')
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