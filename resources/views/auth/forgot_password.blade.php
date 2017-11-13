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

          <strong>Forgot Password</strong>

        </header>

     {!! Form::open(array('url' => URL_FORGOT_PASSWORD, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"passwordForm")) !!}

         <div class="row">
           
           <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1">
            
              <div class="form-group">
              
              <div class="row">
              
              <div class="col-md-12 m-b">

           
           <label class="m-b m-t">
            <label class="control-label">Forgot Password</label>
               <span class="text-danger">*</span></label>

            {{ Form::email('email', $value = null , $attributes = array('class'=>'form-control',

      'ng-model'=>'email',

      'required'=> 'true',

      'placeholder' => getPhrase('email'),

      'ng-class'=>'{"has-error": passwordForm.email.$touched && passwordForm.email.$invalid}',

    )) }}

  <div class="validation-error ss-change m-b" ng-messages="passwordForm.email.$error" >

    {!! getValidationMessage()!!}

    {!! getValidationMessage('email')!!}

  </div>

                  </div>
                 <div class="col-md-12 m-b clear">

         <a href="{{URL_USERS_LOGIN}}" type="button" class="btn btn-default" >{{getPhrase('cancel')}}</a>

        <button type="submit" class="btn btn-success pull-right" ng-disabled='!passwordForm.$valid'>{{getPhrase('submit')}}</button>

          </div>
          </div>
       
        <!--  <div class="line line-dashed"></div>-->
         
        
       {!! Form::close() !!}
       </div>
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