<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
  <meta charset="utf-8" />
   <link rel="icon" href="{{IMAGE_PATH_SETTINGS.getSetting('site_favicon', 'site_settings')}}" type="image/x-icon" />
 <title>{{ isset($title) ? $title : getSetting('site_title','site_settings') }}</title>
 @yield('header_scripts')
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="{{CSS}}bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="{{CSS}}animate.css" type="text/css" />
  <link rel="stylesheet" href="{{CSS}}font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="{{CSS}}font.css" type="text/css" />
    <link rel="stylesheet" href="{{CSS}}app.css" type="text/css" />
    <link rel="stylesheet" href="{{CSS}}animate.css" type="text/css" />
    <link rel="stylesheet" href="{{CSS}}notify.css" type="text/css" />
    <link rel="stylesheet" href="{{CSS}}installation.css" type="text/css" />
 
</head>
<body class="" ng-app="academia">

@yield('content')

	<script src="{{JS}}jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="{{JS}}bootstrap.js"></script>
  <!-- App -->
  <script src="{{JS}}app.js"></script> 
  <script src="{{JS}}slimscroll/jquery.slimscroll.min.js"></script>
  <script src="{{JS}}app.plugin.js"></script>


    <script src="{{JS}}angular.js"></script>
   <script src="{{JS}}ngStorage.js"></script>
   <script src="{{JS}}plugins/dragdrop/ngDraggable.js"></script>
   <script src="{{JS}}angular-messages.js"></script> 
   <script>
      var app = angular.module('academia', ['ngMessages','ngDraggable']);
   </script>
  <script src="{{JS}}notify.js"></script>


   @include('errors.formMessages')

	@include('common.validations')

		
		
		{!!getSetting('google_analytics', 'seo_settings')!!}
</body>



</html>