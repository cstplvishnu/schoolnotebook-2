 
@extends('layouts.site')

@section('content')

<div class="login-content">

		<div class="logo text-center"><img src="{{IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')}}" alt="" height="59" width="211" ></div>
		 <div class="men-caption">
     <p>{{getSetting('login_page_title','site_settings')}}</p>
  </div>


		{!! Form::open(array('url' => URL_USERS_LOGIN, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"loginForm")) !!}



		@include('errors.errors')	

		

			
	{!! Form::close() !!}

  </div>

</div>

@stop



@section('footer_scripts')

	@include('common.validations')

@stop