@extends('layouts.site')
@section('content')

  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">    

    <div class="container aside-xxl">

      <!-- <a class="navbar-brand block" href="index.html">Notebook</a> -->
      <div class="logo text-center"><img src="{{IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')}}" alt="" height="59" width="211" ></div>
		 <div class="men-caption">
     <p class="navbar-brand block">{{getSetting('login_page_title','site_settings')}}</p>

      
<section class="panel panel-default bg-white m-t-lg">

        <header class="panel-heading text-center">

          <strong>Sign in</strong>

        </header>
        
        <div class="row">
          <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-xs-12 col-sm-offset-1 m-t-lg m-b-lg">

       {!! Form::open(array('url' => URL_USERS_LOGIN, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"loginForm")) !!}

         <div class="row">
         <div class="col-md-12 m-b"> 
         
          <div class="form-group">

            <label class="control-label">Email</label>
              <span class="text-danger">*</span>
            {{ Form::text('email', $value = null , $attributes = array('class'=>'form-control input-lg',

			'ng-model'=>'email',

			'required'=> 'true',

			'placeholder' => getPhrase('username').'/'.getPhrase('email'),

			'ng-class'=>'{"has-error": loginForm.email.$touched && loginForm.email.$invalid}',

		)) }}

				<div class="validation-error ss-change" ng-messages="loginForm.email.$error" >

					{!! getValidationMessage()!!}

					{!! getValidationMessage('email')!!}

				</div>
             </div>
            </div>
          </div>
          
        <div class="row">
         <div class="col-md-12 m-b"> 

          <div class="form-group">

		            <label class="control-label">Password</label>
		            <span class="text-danger">*</span>

		            {{ Form::password('password', $attributes = array('class'=>'form-control input-lg',

					'placeholder' => getPhrase("password"),

					'ng-model'=>'registration.password',

					'required'=> 'true', 

					'ng-class'=>'{"has-error": loginForm.password.$touched && loginForm.password.$invalid}',

					'ng-minlength' => 5

				)) }}

			 <div class="validation-error ss-change" ng-messages="loginForm.password.$error" >

				{!! getValidationMessage()!!}

				{!! getValidationMessage('password')!!}

			</div>
          </div>
       </div>
     </div>

          <!--<div class="checkbox">
            <label>
              <input type="checkbox"> Keep me logged in
            </label>
          </div>-->
         
          <a href="{{URL_USERS_FORGOT_PASSWORD}}" class="pull-right btn btn-info m-t-xs">{{getPhrase('forgot_password')}}</a>
         

          <div class="text-left">

		  <button type="submit" class="btn btn-primary" ng-disabled='!loginForm.$valid'>{{getPhrase('sign_in')}}</button>

			</div>


         
         <!-- <div class="line line-dashed"></div>-->
         
        
       {!! Form::close() !!}
       
            </div>
            </div>

      </section>
      
       </div>
     
     </div>
  </section>
  <!-- footer -->
  <!-- <footer id="footer">
    <div class="text-center padder">
      <p>
        <small>Web app framework base on Bootstrap<br>&copy; 2013</small>
      </p>
    </div>
  </footer> -->
  <!-- / footer -->
  
@stop