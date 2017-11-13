<!DOCTYPE html>
<html class="app">
<head>
 <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">


  <meta name="description" content="{{getSetting('meta_description', 'seo_settings')}}">

  <meta name="keywords" content="{{getSetting('meta_keywords', 'seo_settings')}}">

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  
  <link rel="icon" href="{{IMAGE_PATH_SETTINGS.getSetting('site_favicon', 'site_settings')}}" type="image/x-icon" />

  <title>{{ isset($title) ? $title : getSetting('site_title','site_settings') }}</title>
    @yield('header_scripts')

  <link rel="stylesheet" href="{{CSS}}bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="{{CSS}}animate.css" type="text/css" />
  <link rel="stylesheet" href="{{CSS}}font-awesome.min.css" type="text/css" />
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" /> -->
  <link rel="stylesheet" href="{{CSS}}font.css" type="text/css" />
  <link rel="stylesheet" href="{{JS}}calendar/bootstrap_calendar.css" type="text/css" />
  <link rel="stylesheet" href="{{CSS}}app.css" type="text/css" />
  <link rel="stylesheet" href="{{CSS}}style.css" type="text/css" />
  <link rel="stylesheet" href="{{CSS}}notify.css" type="text/css" />
  <link rel="stylesheet" href="{{JS}}datepicker/datepicker.css" type="text/css" />
  <link href="{{CSS}}sweetalert.css" rel="stylesheet" type="text/css">
</head>
<body ng-app="academia" class="">
   <section class="vbox">
  
   <?php $block_class = '';

if(isset($block_navigation))

  $block_class = 'non-clickable';

 ?>

   

      <!--Header Section-->
      <header class="bg-dark dk header navbar navbar-fixed-top-xs {{$block_class}}">

       @include('layouts.student.header')
     </header>
  <!-- Left side column. contains the logo and sidebar -->
 

  <section>
      <section class="hbox stretch">
    <!-- sidebar: style can be found in sidebar.less -->
   
   <?php 


    if(!isset($block_sidebar)) { ?>

    @include('layouts.student.sidebar')
    <!-- /.sidebar -->
    <?php } ?>

  <!-- Content Wrapper. Contains page content -->

   <section id="content">
      <section class="vbox">   
        <section class="scrollable padder">
   @yield('content')

   
  </section>
          </section>
        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
        </section>
        <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      </section>
    </section>
  </section>
  <script src="{{JS}}jquery.min.js"></script>

  <!-- Bootstrap -->
  <script src="{{JS}}bootstrap.js"></script>
  <!-- Notify -->
  <script src="{{JS}}notify.js"></script>
  <!-- App --> 
  <script src="{{JS}}app.js"></script> 
  <script src="{{JS}}slimscroll/jquery.slimscroll.min.js"></script>
  <script src="{{JS}}charts/easypiechart/jquery.easy-pie-chart.js"></script>
  <script src="{{JS}}charts/sparkline/jquery.sparkline.min.js"></script>
  
  <script src="{{JS}}calendar/bootstrap_calendar.js"></script>
  <script src="{{JS}}calendar/demo.js"></script>
  <script src="{{JS}}sortable/jquery.sortable.js"></script>
  <script src="{{JS}}app.plugin.js"></script>
  
  <!-- datepicker -->
  <script src="{{JS}}datepicker/bootstrap-datepicker.js"></script>
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
     <script type="text/javascript">

      var csrfToken = $('[name="csrf_token"]').attr('content');

      setInterval(refreshToken, 600000); // 1 hour 

      function refreshToken(){
          $.get('refresh-csrf').done(function(data){
              csrfToken = data; // the new token
          });
      }

      setInterval(refreshToken, 600000); // 1 hour 
      
       


  </script>


</body>
</html>
