<!DOCTYPE html>
<html lang="en" >

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="">
	 
	<link rel="icon" href="#" type="image/x-icon" />
	
	<title>{{ isset($title) ? $title : 'Exam system' }}</title>

	@yield('header_scripts')
	<!-- Bootstrap Core CSS -->
  <link rel="stylesheet" href="{{CSS}}bootstrap.css" type="text/css" />

	<!-- Custom CSS -->
	<!-- Morris Charts CSS -->
	<link href="{{CSS}}plugins/morris.css" rel="stylesheet">
	  <link rel="stylesheet" href="{{CSS}}installation.css" type="text/css" />
	    <link rel="stylesheet" href="{{CSS}}notify.css" type="text/css" />


	<!-- Proxima Nova Fonts CSS -->
	<link href="{{CSS}}installation/proximanova.css" rel="stylesheet">
	<!-- Custom Fonts -->
	<link href="{{CSS}}installation/custom-fonts.css" rel="stylesheet" type="text/css">
	<link href="{{CSS}}installation/materialdesignicons.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="{{CSS}}sweetalert.css" rel="stylesheet" type="text/css">
</head>

<body class="login-screen" ng-app="academia" >

@yield('content')
	
       <!-- /#wrapper -->
		<!-- jQuery -->
  <script src="{{JS}}jquery.min.js"></script>
    <script src="{{JS}}notify.js"></script>


		<!-- Bootstrap Core JavaScript -->
          <script src="{{JS}}bootstrap.js"></script>
        <script src="{{JS}}installation/main.js"></script>
		<script src="{{JS}}sweetalert-dev.js"></script>
         
         <script src="{{JS}}angular.js"></script>
   <script src="{{JS}}ngStorage.js"></script>
    <script src="{{JS}}plugins/dragdrop/ngDraggable.js"></script>
    <script src="{{JS}}angular-messages.js"></script> 
    <script>
      var app = angular.module('academia', ['ngMessages','ngDraggable']);
    </script>


		@include('errors.formMessages')
		@yield('footer_scripts')
</body>

</html>