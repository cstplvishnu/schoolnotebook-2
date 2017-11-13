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
  <!-- <link rel="stylesheet" href="{{CSS}}font-awesome.min.css" type="text/css" /> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
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

      <!--Header Section-->
      <header class="bg-dark dk header navbar navbar-fixed-top-xs">

       @include('layouts.admin.header')

     </header>
  <!-- Left side column. contains the logo and sidebar -->

  <section>
      <section class="hbox stretch">
    <!-- sidebar: style can be found in sidebar.less -->
    @include('layouts.admin.sidebar')
    <!-- /.sidebar -->
  

  <!-- Content Wrapper. Contains page content -->

   <section id="content" style="width: 100%">
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
  
  <script src="{{JS}}datepicker/bootstrap-datepicker.js"></script>
  <script src="{{JS}}sweetalert-dev.js"></script>
  
   <script src="{{JS}}angular.js"></script>
   <script src="{{JS}}ngStorage.js"></script>
    <script src="{{JS}}plugins/dragdrop/ngDraggable.js"></script>
    <script src="{{JS}}angular-messages.js"></script> 
    <script>
      var app = angular.module('academia', ['ngMessages','ngDraggable']);
    </script>

  <script >
   
    function showFeeInstructions()
    {    
      
        $(function(){
            PNotify.removeAll();
            new PNotify({
                title: "{{getPhrase('fee_instructions')}}",
                text: "<div> <ol><li>{{getPhrase('first_create_the_fee_particulars_(_ex:- _uniform_fee,_tution_fee)')}}</li> <li>{{getPhrase('create_fee_category_(_ex:- 2017-2018 _computer_science_1st_year_1st_semester)')}}</li> <li >{{getPhrase('assign_fee_particulars_to_respected_fee_category')}}</li> <b>{{getPhrase('note : ')}}</b>{{getPhrase('once_particulars_are_assigned_to_fee_category_you_cannot_delete_fee_category')}} <li>{{getPhrase('create_fee_schedules_for_selected_fee_category')}}</li><b>{{getPhrase('note : ')}}</b>{{getPhrase('if_any_payment_is_done_you_cannot_update_fee_schedules')}}<li><b>{{getPhrase('you_can_add_non_term_fee_particulars_even_payment_is_done')}}</b></li></ol></div>",
                type: "info",
                delay: 10000,
                shadow: true,
                width: "500px",
                
                animate: {
                            animate: true,
                            in_class: 'fadeInLeft',
                            out_class: 'fadeOutRight'
                        }
                });
        });
    }
</script>

<script>
  function showDropdow(){

    $('#users_list').show();

  }

</script>



@include('errors.formMessages')
 


@yield('footer_scripts')
     <script type="text/javascript">

      var csrfToken = $('[name="csrf_token"]').attr('content');

      setInterval(refreshToken, 600000); // 10 minitutes 

      function refreshToken(){
          $.get('refresh-csrf').done(function(data){
              csrfToken = data; // the new token
          });
      }

      setInterval(refreshToken, 600000); // 10 minitutes 
      
       


  </script>


       @include('common.search-users')

<div class="ajax-loader" id="ajax_loader"><img src="{{AJAXLOADER}}"> {{getPhrase('please_wait')}}...</div>


</body>

</html>


