@extends('layouts.admin.adminlayout')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
        <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}} </a></li>
        <li><a href="{{URL_LMS_SERIES}}">LMS {{ getPhrase(' series')}}</a></li>
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

								{{ Form::label('lms_categories', getphrase('select_subject')) }}

								 

								{{Form::select('lms_categories', $categories, null, ['class'=>'form-control', 'ng-model' => 'category_id', 

								'placeholder' => 'Select', 'ng-change'=>'categoryChanged(category_id)' ])}}

							</fieldset>

							<?php $lmssettings = getSettings('lms');?>

							<fieldset class="form-group col-md-6">

								{{ Form::label('file_type', getphrase('file_type')) }}

								 

								{{Form::select('file_type', $lmssettings->content_types, null, ['class'=>'form-control', 'ng-model' => 'content_type', 

								'placeholder' => getPhrase('Select')  ])}}

							</fieldset>

                           
                           <div class="col-md-12">

							<div ng-if="examSeries!=''" class="vertical-scroll" >

								<h4 ng-if="categoryItems.length>0" class="text-success"><strong>{{getPhrase('total_exams')}} </strong>: @{{ categoryItems.length}} </h4>

								<table  

								  class="table table-hover"> 									 

									<th>{{getPhrase('title')}}</th>

									<th>{{getPhrase('code')}}</th>

									<th>{{getPhrase('type')}}</th>

                                    <th>{{getPhrase('action')}}</th>	
 
									
									<tr ng-repeat="item in categoryItems | filter : {content_type: content_type} | filter:search_term  track by $index">

										<td 

										title="@{{item.title}}" ><strong>

										@{{item.title}}</strong>

										</td>

										<td>@{{item.code}}</td>

										<td>@{{item.content_type}}</td>

										<td><a 

										ng-click="addToBag(item);" class="btn btn-primary" >{{getPhrase('add')}}</a>

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
                <header class="panel-heading font-bold">{{getPhrase('saved_contents')}}</header>

                <div>
                       <header class="panel-heading bg-white">
                       
                        
                         <span class="text-muted m-l-sm pull-right"><a>
                           
                          <strong>{{getPhrase('total_contents')}} : @{{ savedSeries.length }}</strong></a>
                         </span>
                       </header>
                 </div>
                 <div ng-if="savedSeries.length==0">
					<span><strong>{{getPhrase('no_data_available')}}</strong></span>
					</div>

                 {!! Form::open(array('url' => URL_LMS_SERIES_UPDATE_SERIES.$record->slug, 'method' => 'POST')) !!}

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
									<th>{{getPhrase('type')}}</th>
									<th>{{getPhrase('code')}}</th>	
									<th></th>	
									</tr>
									</thead>
									<tbody>
										<tr ng-repeat="i in savedSeries track by $index">
										<td><strong>@{{ savedSeries[$index].title}}</strong></td>
										<td title="@{{ savedSeries[$index].content_type}}">@{{ savedSeries[$index].content_type  }}</td>
										<td>@{{ savedSeries[$index].code}}</td>
										<td><a ng-click="removeItem(i)" class="btn-outline btn-close text-danger"><i class="fa fa-close"></i></a></td>
										</tr>
									</tbody>
									</table>
					 			</div>

					 		<div class="form-group">
                            <div class="col-md-12 clear">
                                <div class="doc-buttons pull-right"> 
                               
                        <button class="btn btn-success">{{ getPhrase('save') }}</button>
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

@include('lms.lmsseries.scripts.js-scripts')

@stop


