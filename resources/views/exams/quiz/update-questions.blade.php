@extends('layouts.admin.adminlayout')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
        <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}} </a></li>
        <li><a href="{{URL_QUIZZES}}">{{ getPhrase('exams')}}</a></li>
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

								{{ Form::label('subject', getphrase('subjects')) }}

								<span class="text-danger">*</span>

								{{Form::select('subject', $subjects, null, ['class'=>'form-control', 'ng-model' => 'subject_id', 

								'placeholder' => 'Select', 'ng-change'=>'subjectChanged(subject_id)','id'=>'helper_step2' ])}}

							</fieldset>


								<fieldset class="form-group col-md-6 helper_step3">

								{{ Form::label('difficulty', getphrase('difficulty')) }}
			

								<select ng-model="difficulty" class="form-control" >

								<option value="">{{getPhrase('select')}}</option>	

								<option value="easy">{{getPhrase('easy')}}</option>	

								<option value="medium">{{getPhrase('medium')}}</option>	

								<option value="hard">{{getPhrase('hard')}}</option>	

								</select>

								</fieldset>



								<fieldset class="form-group col-md-6 helper_step4">

								{{ Form::label('question_type', getphrase('question_type')) }}

								<select ng-model="question_type" class="form-control" >

									<option selected="selected" value="">{{getPhrase('select')}}</option>

									<option value="radio">{{getPhrase('single_answer')}}</option>

									<option value="checkbox">{{getPhrase('multi_answer')}}</option>


									<option value="blanks">{{getPhrase('fill_in_the_blanks')}}</option>

									<option value="match">{{getPhrase('match_the_following')}}</option>

									<option value="para">{{getPhrase('paragraph')}}</option>

									<option value="video">{{getPhrase('video')}}</option>
									<option value="audio">{{getPhrase('audio')}}</option>

								</select>

								</fieldset>



								<fieldset class="form-group col-md-6">

								{{ Form::label('searchTerm', getphrase('search_term')) }}

								{{ Form::text('searchTerm', $value = null , $attributes = array('class'=>'form-control', 

						'placeholder' => getPhrase('enter_search_term'),

						'ng-model'=>'searchTerm',
						'id'=>'helper_step5')) }}

								</fieldset>


								<div class="col-md-12" ng-show="contentAvailable">

							<div ng-if="subjectQuestions!=''" class="vertical-scroll" >

								<h4 class="text-success"><strong>Questions : @{{ subjectQuestions.length }}</strong> </h4>
								<table  

								  class="table table-hover">

  									 

									<th ><strong>{{getPhrase('subject')}}</strong></th>

									<th>{{getPhrase('question')}}</th>

									<th>{{getPhrase('difficulty')}}</th>

									<th>{{getPhrase('type')}}</th>

									<th>{{getPhrase('marks')}}</th>	

									<th>{{getPhrase('action')}}</th>	


									<tr ng-repeat="question in subjectQuestions | filter: { difficulty_level:difficulty, question_type:question_type} | filter: searchTerm track by $index ">
										 

										<td>@{{subject.subject_title}}</td>

										<td 

										title="@{{subjectQuestions[$index].question}}" >

										@{{question.question}}

										</td>

										
										<td>@{{question.difficulty_level | uppercase}}</td>

										<td>@{{question.question_type | uppercase}}</td>

										<td>@{{question.marks}}</td>

										<td><a 
										 

										ng-click="addQuestion(question, subject);" class="btn btn-info" >{{getPhrase('add')}}</a>

									  		

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
                <header class="panel-heading font-bold">{{getPhrase('saved_questions')}}</header>

                <div>
                 <header class="panel-heading bg-white">
                         <a href="#"><strong>{{getPhrase('saved_questions')}} : @{{savedQuestions.length}}</strong></a>
                        
                         <span class="text-muted m-l-sm pull-right"><a>
                           
                          <strong>{{getPhrase('total_marks')}} : @{{ totalMarks }}</strong></a>
                         </span>
                       </header>
                 </div>

                {!! Form::open(array('url' => URL_QUIZ_UPDATE_QUESTIONS.$record->slug, 'method' => 'POST')) !!}

                <input type="hidden" name="saved_questions" value="@{{savedQuestions}}">

                <div class="row">
                	
                    <div class="col-sm-12">
                        <div class="panel-body">
                           
                                <div class="row">
                                    <div class="col-sm-12">
                                        
                                       <div ng-if="savedQuestions!=''" class="vertical-scroll" >

					 				<a class="remove-all-questions text-danger" style="cursor: pointer;" ng-click="removeAll()"><u>{{getPhrase('remove_all')}}</u></a>

					 				<table  

								  class="table table-hover">

								  <thead>

								  <tr>

									<th>{{getPhrase('subject')}}</th>

									<th>{{getPhrase('question')}}</th>

									<th>{{getPhrase('marks')}}</th>	

									<th></th>	

									</tr>

									</thead>

									<tbody>

										<tr ng-repeat="i in savedQuestions track by $index">

										<td>@{{ savedQuestions[$index].subject_title}}</td>

										<td title="@{{ savedQuestions[$index].question}}">@{{ savedQuestions[$index].question  }}</td>

										<td>@{{ savedQuestions[$index].marks}}</td>

										<td><a ng-click="removeQuestion(i)" style="cursor: pointer;" class="btn-outline btn-close text-danger"><i class="fa fa-close"></i></a></td>

										</tr>

									</tbody>

									</table>

					 			</div>
                              
                              <br>
					 			 <div class="buttons text-right" >

							<button class="btn btn-success">{{getPhrase('save')}}</button>

						</div>	

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

@include('exams.quiz.scripts.js-scripts')

@stop


