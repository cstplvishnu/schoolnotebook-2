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

      <!--Header Section-->
      <header class="bg-dark dk header navbar navbar-fixed-top-xs">

       @include('layouts.librarian.header')
     </header>
  <!-- Left side column. contains the logo and sidebar -->

  <section>
      <section class="hbox stretch">
   <!--sidebar menu-->

  <!-- .aside -->
        <aside class="bg-dark lter aside-md hidden-print hidden-xs" id="nav">          
          <section class="vbox">
          

            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                
                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                  <ul class="nav">
                   <li {{ isActive($active_class, 'dashboard') }} > 
                      <a href="{{PREFIX}}" class="active">
                        <i class="fa fa-dashboard icon">
                          <b class="bg-success"></b>

                        </i>
                        <span>{{getPhrase('dashboard')}}</span>
                      </a>
                    </li>
                    
                   @if(checkRole(getUserGrade(8)))
                    <li {{ isActive($active_class, 'library') }}>
                      <a href="javascript:void(0);"  >
                        <i class="fa fa-book icon">
                          <b class="bg-warning"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>{{getPhrase('central_library')}}</span>
                      </a>
                      <ul class="nav lt">
                         <li {{ isSubActive($sub_active_class, 'asset_types') }} >
                          <a href="{{URL_LIBRARY_ASSETS}}" >                                                        
                            <i class="fa fa-database"></i>
                            <span>{{getPhrase('asset_types')}}</span>
                          </a>
                        </li>
                         <li {{ isSubActive($sub_active_class, 'master_type') }} >
                          <a href="{{URL_LIBRARY_MASTERS}}" >                                                        
                           <i class="fa fa-book" ></i>
                            <span>{{getPhrase('master_data')}}</span>
                          </a>
                        </li>
                         <li {{ isSubActive($sub_active_class, 'publishers') }} >
                          <a href="{{URL_PUBLISHERS}}" >                                                        
                            <i class="fa fa-paint-brush"></i>
                            <span>{{getPhrase('publishers')}}</span>
                          </a>
                        </li>
                         <li {{ isSubActive($sub_active_class, 'authors') }} >
                          <a href="{{URL_AUTHORS}}" >                                                        
                           <i class="fa fa-mortar-board"></i>
                            <span>{{getPhrase('authors')}}</span>
                          </a>
                        </li>
                         
                      </ul>
                    </li>
                   @endif 
                     <li {{ isActive($active_class, 'students') }} >
                      <a href="{{URL_LIBRARY_USERS}}student"" >
                      <i class="fa fa-users" aria-hidden="true">
                          <b class="bg-info"></b>
                        </i>
                        <span class="pull-right">
                        
                        </span>

                        
                        <span>{{getPhrase('students')}}</span>
                      </a>
                     
                    </li>

                    <li {{ isActive($active_class, 'staff') }}>
                      <a href="{{URL_LIBRARY_USERS}}staff""  >
                       <i class="fa fa-user" aria-hidden="true"></i>
                          <b class="bg-success"></b>
                        </i>
                        <span class="pull-right">
                        
                        </span>
                        <span>{{getPhrase('staff')}}</span>
                      </a>
                    
                    </li>

                    
                       <li {{ isActive($active_class, 'student_book_return') }}>
                        <a href="{{ URL_LIBRARY_LIBRARYDASHBOARD_BOOKS }}">
                        <i class="fa fa-users">
                          <b class="bg-info"></b>
                        </i>
                        <span class="pull-right">
                        
                        </span>
                        <span>{{getPhrase('student_book_return')}}</span>
                      </a>
                     
                    </li>

                    <li {{ isActive($active_class, 'staff_book_return') }}>
                      <a href="{{URL_LIBRARY_LIBRARYDASHBOARD_BOOKS_STAFF}}"  >
                        <i class="fa fa-user">
                          <b class="bg-warning"></b>
                        </i>
                      
                        <span>{{getPhrase('staff_book_return')}}</span>
                      </a>
                    </li>

                     
                   <li {{ isActive($active_class, 'user_messages') }}>
                      <a href="{{URL_MESSAGES}}"  >
                        <i class="fa fa-comments">
                          <b class="bg-danger"></b>
                        </i>
                       
                        <span>{{getPhrase('messages')}}<span> <h8 class="badge badge-sm up bg-danger m-l-n-sm count">{{$count = Auth::user()->newThreadsCount()}}</h8></span></span>
                      </a>
                     
                    </li>

                  

                     <li {{ isActive($active_class, 'notifications') }}>
                      <a href="{{URL_NOTIFICATIONS}}"  >
                        <i class="fa fa-flag icon">
                          <b class="bg-primary"></b>
                        </i>
                       
                        <span>{{getPhrase('notifications')}}</span>
                      </a>
                    
                    </li>

                    
                  </ul>
                </nav>
                <!-- / nav -->
              </div>
            </section>
            
            <footer class="footer lt hidden-xs b-t b-dark">
              <div id="chat" class="dropup">
                <section class="dropdown-menu on aside-md m-l-n">
                  <section class="panel bg-white">
                    <header class="panel-heading b-b b-light">Active chats</header>
                    <div class="panel-body animated fadeInRight">
                      <p class="text-sm">No active chats.</p>
                      <p><a href="{{URL_MESSAGES}}" class="btn btn-sm btn-default">Start a chat</a></p>
                    </div>
                  </section>
                </section>
              </div>
              <div id="invite" class="dropup">                
                <section class="dropdown-menu on aside-md m-l-n">
                  <section class="panel bg-white">
                    <header class="panel-heading b-b b-light">
                      John <i class="fa fa-circle text-success"></i>
                    </header>
                    <div class="panel-body animated fadeInRight">
                      <p class="text-sm">No contacts in your lists.</p>
                      <p><a href="#" class="btn btn-sm btn-facebook"><i class="fa fa-fw fa-facebook"></i> Invite from Facebook</a></p>
                    </div>
                  </section>
                </section>
              </div>
              
              <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon">
                <i class="fa fa-angle-left text"></i>
                <i class="fa fa-angle-right text-active"></i>
              </a>
              <div class="btn-group hidden-nav-xs">
                <button type="button" title="Chats" class="btn btn-icon btn-sm btn-dark" data-toggle="dropdown" data-target="#chat"><i class="fa fa-comment-o"></i></button>
               
              </div>
            </footer>
          </section>
</aside>
  

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
