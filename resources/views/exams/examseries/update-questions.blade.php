@extends('layouts.admin.adminlayout')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
        <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}} </a></li>
       <li><a href="{{URL_EXAM_SERIES}}">{{ getPhrase('exam_series')}}</a></li>
        <li class="active">{{isset($title) ? $title : ''}}</li>
    </ul>


@include('errors.errors')
      <div class="row" ng-controller="prepareQuestions">
         <div class="col-sm-8" >

         	<?php $settings = ($record) ? $settings : ''; ?>

            <section class="panel panel-default" ng-init="initAngData({{$settings}});">

                <header class="panel-heading clear"><strong>{{$title}}</strong></header>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel-body">
                           
                           <div class="row">

								<fieldset class="form-group col-md-6">

								{{ Form::label('exam_categories', getphrase('exam_categories')) }}

								<span class="text-danger">*</span>

								{{Form::select('exam_categories', $exam_categories, null, ['class'=>'form-control', 'ng-model' => 'category_id', 

								'placeholder' => 'Select', 'ng-change'=>'categoryChanged(category_id)' ])}}

							</fieldset> 

                        <div class="col-md-12">

							<div ng-if="examSeries!=''" class="vertical-scroll" >

								<h4 ng-if="categoryExams.length>0" class="text-success"><strong>{{getPhrase('total_exams')}} </strong>: @{{ categoryExams.length}} </h4>

								<table  

								  class="table table-hover"> 									 

									<th>{{getPhrase('exam_name')}}</th>

									<th>{{getPhrase('duration')}}</th>

									<th>{{getPhrase('marks')}}</th>

									<th>{{getPhrase('questions')}}</th>	

									<th>{{getPhrase('action')}}</th>	
 
									<tr ng-repeat="exam in categoryExams  track by $index">

										<td 

										title="@{{exam.title}}" ><strong>

										@{{exam.title}}</strong>

										</td>

										<td>@{{exam.dueration}}</td>

										<td>@{{exam.total_marks}}</td>

										<td>@{{exam.total_questions}}</td>

										<td><a 

										ng-click="addQuestion(exam);" class="btn btn-primary" >{{getPhrase('add')}}</a>

										  </td>

									</tr>

								</table>

								</div>	

					 			</div>


					 		</div>

                       
                       
                        </div>
                        
                    </div>
                </div>

            </section>

        </div>

         <div class="col-sm-4">
            <section class="panel panel-default clear">
                <header class="panel-heading font-bold">{{getPhrase('saved_exams')}}</header>

                <div>
                       <header class="panel-heading bg-white">
                         <a href="#"><strong>{{getPhrase('saved_exams')}} : @{{savedSeries.length}}</strong></a>
                        
                         <span class="text-muted m-l-sm pull-right"><a>
                           
                          <strong>{{getPhrase('total_questions')}} : @{{ totalQuestions }}</strong></a>
                         </span>
                       </header>
                 </div>
                 <div ng-if="savedSeries.length==0">
					<span><strong>{{getPhrase('no_data_available')}}</strong></span>
					</div>

               {!! Form::open(array('url' => URL_EXAM_SERIES_UPDATE_SERIES.$record->slug, 'method' => 'POST')) !!}

               <input type="hidden" name="saved_series" value="@{{savedSeries}}">

              <div class="row">
			<div class="col-md-12 clearfix">
				<div ng-if="savedSeries!=''" class="vertical-scroll" >
					 				
					 				<a class="remove-all-questions text-danger" ng-click="removeAll()">&nbsp;&nbsp;&nbsp;<u>{{ getPhrase('remove_all')}}</u></a>
					 				<table  
								  class="table table-hover">
								  <thead>
								  <tr>
									<th>{{getPhrase('title')}}</th>
									<th>{{getPhrase('questions')}}</th>
									<th>{{getPhrase('marks')}}</th>	
									<th></th>	
									</tr>
									</thead>
									<tbody>
										<tr ng-repeat="i in savedSeries track by $index">
										<td><strong>@{{ savedSeries[$index].title}}</strong></td>
										<td title="@{{ savedSeries[$index].question}}">@{{ savedSeries[$index].total_questions  }}</td>
										<td>@{{ savedSeries[$index].total_marks}}</td>
										<td><a ng-click="removeQuestion(i)" class="btn-outline btn-close text-danger"><i class="fa fa-close"></i></a></td>
										</tr>
									</tbody>
									</table>
					 			</div>

					 		 <div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                               
                                    <button class="btn btn-success">{{getPhrase('save')}}</button>
                              </div>
                            </div>
                        </div>
			     </div>
		</div>

                {!! Form::close() !!}

            </section>
        </div>
          
</div>

					

				
			

@stop

@section('footer_scripts')

@include('exams.examseries.scripts.js-scripts')

@stop


