@extends($layout)

@section('content')

<section class="panel panel-default" ng-model="academia" ng-controller="instructions">
     
     <header class="panel-heading clear"> 
     <h4 class="font-bold">{{getPhrase('Instructions')}} <span class="pull-right text-italic">{{getPhrase('please_read_the_instructions_carefully')}}</span></h4> </header>
				
	<div class="panel panel-custom col-lg-12" >
					
					<div class="panel-body instruction no-arrow">

						<div class="row">
							<div class="col-md-12">
								<h4 class="font-bold">{{getPhrase('exam_name')}}:   {{$record->title}} </h4>
								<h5 class="font-bold">{{$instruction_title}}:</h5>
								@if($instruction_data=='')			
								<ol>
									<li>Total of {{$record->dueration}} minutes duration will be given to attempt all the questions.</li>
									<li>The clock has been set at the server and the countdown timer at the top right corner of your screen will display the time remaining for you to complete the exam. When the clock runs out the exam ends by default - you are not required to end or submit your exam.</li>
									<li>The question palette at the right of screen shows one of the following statuses of each of the questions numbered:</li>
								</ol>
								@else 
								{!! $instruction_data !!}
								@endif

								<ul class="guide">
									<li>
										<span class="answer"><i class="fa fa-check"></i></span> You have answered the question.
									</li>
									<li>
										<span class="notanswer"><i class="fa fa-close"></i></span> You have not answered the question.
									</li>
									<li>
										<span class="marked"><i class="fa fa-eye"></i></span> You have answered the question but have marked the question for review.
									</li>
									<li>
										<span class="notvisited"><i class="fa fa-eye-slash"></i></span> You have not visited the question yet.
									</li>
								</ul>

							</div>

						</div>


						<hr>
						<?php
						$paid_type =  false;
						if($record->is_paid && !isItemPurchased($record->id, 'exam'))	
						$paid_type = true;
						?>
						<div class="form-group row">
						{!! Form::open(array('url' => 'exams/student/start-exam/'.$record->slug, 'method' => 'POST')) !!}
							<div class="col-md-12">
							@if(!$paid_type)	
								<input type="checkbox" name="option" id="free" checked="" ng-model="agreeTerms">
								<label for="free" > <span class="fa-stack checkbox-button"> <i class="mdi mdi-check active"></i> </span> The computer provided to me is in proper working condition. I have read and understood the instructions given above. </label>
								
								<br><span class="text-danger" ng-show="!agreeTerms">{{ getPhrase('please_accept_terms_and_conditions')}}</span> 

								@endif
								<div class="text-center clear">
									@if($paid_type)	
									<a href="{{URL_PAYMENTS_CHECKOUT.'exam/'.$record->slug}}" class="btn btn-success pull-right"><i class="icon-credit-card"></i> {{getPhrase('buy_now')}}</a>	
									@else

									<button ng-if="agreeTerms" class="btn btn-info pull-right">{{getPhrase('start_exam')}}</button>
									@endif
								</div>

							</div>
					{!! Form::close() !!}

						</div>


					</div>
				</div>
			</section>
@endsection
 

@section('footer_scripts')
  <script src="{{JS}}angular.js"></script>
  <script>
 var app = angular.module('academia', []);
app.controller('instructions', function($scope, $http) {
	
});
</script>

@stop
