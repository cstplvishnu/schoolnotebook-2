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
                          <b class="bg-danger"></b>

                        </i>
                        <span>{{getPhrase('dashboard')}}</span>
                      </a>
                    </li>
                    
                  
                    <li {{ isActive($active_class, 'exams') }} >
                      <a href="#uikit" >
                        <i class="fa fa-pencil-square-o icon">
                          <b class="bg-success"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>{{getPhrase('exams')}}</span>
                      </a>
                      <ul class="nav lt">
                        <li {{ isSubActive($sub_active_class, 'categories') }} >
                          <a href="{{URL_STUDENT_EXAM_CATEGORIES}}">                                                           
                            <i class="fa fa-random"></i>
                            <span>{{getPhrase('exam_categories')}}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'exam_series') }} >
                          <a href="{{URL_STUDENT_EXAM_SERIES_LIST}}">                                  
                           <i class="fa fa-list-ol"></i>
                            <span>{{getPhrase('exam_series')}}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'scheduled_exams') }} >
                          <a href="{{URL_QUIZ_GET_SCHEDULED_EXAMS.Auth::user()->slug}}">                                                        
                            <i class="fa fa-clock-o"></i>
                            <span>{{getPhrase('scheduled_exams')}}</span>
                          </a>
                        </li>
                       
                      </ul>
                    </li>
                    
                     <li {{ isActive($active_class, 'analysis') }} >
                      <a href="#uikit" >
                      <i class="fa fa-bullseye" aria-hidden="true">
                          <b class="bg-info"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>{{getPhrase('analysis')}}</span>
                      </a>
                      <ul class="nav lt">

                        <li {{ isSubActive($sub_active_class, 'by_subject') }} >
                          <a href="{{ URL_STUDENT_ANALYSIS_SUBJECT.Auth::user()->slug }}">                                                        
                            <i class="fa fa-key" aria-hidden="true"></i>
                            <span>{{getPhrase('by_subject')}}</span>
                          </a>
                        </li>

                        <li {{ isSubActive($sub_active_class, 'by_exam') }} >
                          <a href="{{URL_STUDENT_ANALYSIS_BY_EXAM.Auth::user()->slug}}">                                                           
                            <i class="fa fa fa-suitcase" aria-hidden="true"></i>
                            <span>{{getPhrase('by_exam')}}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'exam_attempt_history') }} >
                          <a href="{{URL_STUDENT_EXAM_ATTEMPTS.Auth::user()->slug}}">                                  
                           <i class="fa fa-history"></i>
                            <span>{{getPhrase('exam_attempt_history')}}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'scheduled_exam_marks') }} >
                          <a href="{{URL_STUDENT_RESULTS.Auth::user()->slug}}">                                                        
                         <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                            <span>{{getPhrase('scheduled_exam_marks')}}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'class_marks') }} >
                          <a href="{{URL_STUDENT_MARKS_REPORT}}">                                                                     
                           <i class="fa fa-line-chart"></i>
                            <span>{{getPhrase('class_marks_report')}}</span>
                          </a>
                        </li>

                        <li {{ isSubActive($sub_active_class, 'timetable') }} >
                          <a href="{{URL_TIMETABLE_STAFF_STUDENT_PRINT.Auth::user()->slug}}" target="_blank">                                                                     
                           <i class="fa fa-calendar"></i>
                            <span>{{getPhrase('timetable')}}</span>
                          </a>
                        </li>


                       
                       
                      </ul>
                    </li>

                    <li {{ isActive($active_class, 'users-1') }}>
                      <a href="#pages"  >
                        <i class="fa fa-money">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>{{getPhrase('fee_board')}}</span>
                      </a>
                      <?php 
                       
                       $student_details  = App\Student::where('user_id','=',Auth::user()->id)->first();


                      ?>
                      <ul class="nav lt">
                        <li {{ isSubActive($sub_active_class, 'fee_schedules') }} >
                          <a href="{{URL_USER_FEE_SCHEDULES.$student_details->id}}" >                                                        
                            <i class="fa fa-bars"></i>
                            <span>{{getPhrase('fee_categories')}}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'fee_history') }} >
                          <a href="{{URL_USER_FEE_PAID_HISTORY.$student_details->id}}" >                                                        
                            <i class="fa fa-money"></i>
                            <span>{{ getPhrase('fee_particulars')}}</span>
                          </a>
                        </li>
                       
                        
                      </ul>
                    </li>

                    
                       <li {{ isActive($active_class, 'lms') }}>
                        <a href="javascript:void(0);">
                        <i class="fa fa-laptop icon">
                          <b class="bg-info"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>LMS</span>
                      </a>
                      <ul class="nav lt">
                        <li {{ isSubActive($sub_active_class, 'lms_categories') }} >
                          <a href="{{ URL_STUDENT_LMS_CATEGORIES }}">                                                       
                             <i class="fa fa-random"></i>
                            <span>{{getPhrase('categories')}}</span>
                          </a>
                        </li>
                      
                      <li {{ isSubActive($sub_active_class, 'lms_series') }} >
                          <a href="{{ URL_STUDENT_LMS_SERIES }}">                                                           
                          <i class="fa fa-list-ol"></i>
                            <span>{{getPhrase('series')}}</span>
                          </a>
                        </li>
                      </ul>
                    </li>

                    <li {{ isActive($active_class, 'library') }}>
                      <a href="{{URL_USER_LIBRARY_DETAILS.Auth::user()->slug}}"  >
                        <i class="fa fa-book icon">
                          <b class="bg-warning"></b>
                        </i>
                      
                        <span>{{getPhrase('central_library')}}</span>
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

                    <li {{ isActive($active_class, 'payment_reports') }}>
                      <a href="{{URL_PAYMENTS_LIST.Auth::user()->slug}}"  >
                        <i class="fa fa-credit-card">
                          <b class="bg-success"></b>
                        </i>
                       
                        <span>{{getPhrase('payments')}}</span>
                      </a>
                    
                    </li>

                     <li {{ isActive($active_class, 'notifications') }}>
                      <a href="{{URL_NOTIFICATIONS}}"  >
                        <i class="fa fa-flag icon">
                          <b class="bg-primary"></b>
                        </i>
                       
                        <span>{{getPhrase('alerts')}}</span>
                      </a>
                    
                    </li>

                     <li {{ isActive($active_class, 'users_settings') }}>
                      <a href="{{URL_USERS_SETTINGS.Auth::user()->slug}}"  >
                        <i class="fa fa-cogs">
                          <b class="bg-warning"></b>
                        </i>
                        
                        <span>{{getPhrase('settings')}}</span>
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