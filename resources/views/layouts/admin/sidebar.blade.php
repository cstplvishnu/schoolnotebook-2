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
                     <li {{ isActive($active_class, 'users') }} > 
                      <a href="{{URL_USERS_DASHBOARD}}">
                        <i class="fa fa-users icon">
                          <b class="bg-info"></b>
                        </i>
                        <span>{{getPhrase('users')}}</span>
                      </a>
                      
                    </li>

                    <li {{ isActive($active_class, 'courses') }} >
                      <a href="#uikit">
                      <i class="fa fa-bullseye" aria-hidden="true">
                          <b class="bg-danger"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>{{getPhrase('master_setup')}}</span>
                      </a>
                      <ul class="nav lt">

                        <li {{ isSubActive($sub_active_class, 'acdemics') }}>
                          <a href="{{URL_MASTERSETTINGS_ACADEMICS}}">                                                        
                            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                            <span>{{getPhrase('academics')}}</span>
                          </a>
                        </li>

                         <li {{ isSubActive($sub_active_class, 'allocate_subject') }}>
                          <a href="{{URL_MASTERSETTINGS_COURSE_SUBJECTS_ADD}}">                                                        
                            <i class="fa fa-external-link-square" aria-hidden="true"></i>
                            <span>{{getPhrase('allocate_subject_to_course')}}</span>
                          </a>
                        </li>

                        <li {{ isSubActive($sub_active_class, 'allocate_staff') }}>
                          <a href="{{URL_MASTERSETTINGS_COURSE_SUBJECTS."staff"}}">                                                        
                            <i class="fa fa-street-view" aria-hidden="true"></i>
                            <span>{{getPhrase('allocate_staff_to_subject')}}</span>
                          </a>
                        </li>

                        <li {{ isSubActive($sub_active_class, 'courses_list') }}>
                          <a href="{{URL_MASTERSETTINGS_COURSE}}">                                                           
                            <i class="fa fa-list-ul" aria-hidden="true"></i>
                            <span>{{getPhrase('courses_list')}}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'add_course') }}>
                          <a href="{{URL_MASTERSETTINGS_COURSE_ADD}}">                                  
                           <i class="fa fa-question"></i>
                            <span>{{getPhrase('add_course')}}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'subjects') }}>
                          <a href="{{URL_MASTERSETTINGS_SUBJECTS}}">                                                        
                         <i class="fa fa-suitcase" aria-hidden="true"></i>
                            <span>{{getPhrase('subjects')}}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'topics') }}>
                          <a href="{{URL_MASTERSETTINGS_TOPICS}}">                                                                     
                           <i class="fa fa-list-ol"></i>
                            <span>{{getPhrase('topics')}}</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                   <li {{ isActive($active_class, 'academic') }}> 
                      <a href="javascript:void(0);">
                        <i class="fa fa-university icon">
                          <b class="bg-warning"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>{{getPhrase('academics')}}</span>
                      </a>
                      <ul class="nav lt">
                           @if($active_class == 'academic')

                           <li {{ isActive($active_class1, 'certificates') }}>

                            @else

                            <li {{ isActive($active_class, 'certificates') }}>

                           @endif
                          <a href="javascript:void(0);">                                                        
                            <i class="fa fa-certificate"></i>
                            <b class="bg-warning"></b>
                              <span class="pull-right">
                                <i class="fa fa-angle-down text"></i>
                                <i class="fa fa-angle-up text-active"></i>
                              </span>
                            <span>{{getPhrase('certificates')}}</span>
                          </a>
                           <ul class="nav lt">

                            <li {{ isSubActive($sub_active_class, 'id_cards') }}>
                          <a href="{{URL_CERTIFICATES_GENERATE_IDCARD}}">                                                        
                         <i class="fa fa-address-card-o"></i>
                            <span>{{getPhrase('id_cards')}}</span>
                          </a>
                        </li>

                        <li {{ isSubActive($sub_active_class, 'tc') }}>
                          <a href="{{URL_CERTIFICATE_BONAFIDE}}">                                                        
                         <i class="fa fa-list-alt"></i>
                            <span>{{getPhrase('bonafide_/')}} TC</span>
                          </a>
                        </li>
                            
                          </ul>
                        </li>

                       <li {{ isSubActive($sub_active_class, 'student_promotions') }}>
                          <a href="{{URL_STUDENT_TRANSFERS}}">                                                        
                         <i class="fa fa-exchange"></i>
                            <span>Transfers</span>
                          </a>
                        </li>

                        <li {{ isSubActive($sub_active_class, 'time_table') }} >
                          <a href="{{URL_TIMETABLE_VIEW}}">                                                        
                            <i class="fa fa-calendar"></i>
                            <span>TimeTable</span>
                          </a>
                        </li>

                         <li {{ isSubActive($sub_active_class, 'time_table_timings') }}>
                          <a href="{{URL_TIMINGSET}}">                                                        
                            <i class="fa fa-clock-o"></i>
                            <span>{{getPhrase('timetable_timings')}}</span>
                          </a>
                        </li>

                       <li {{ isSubActive($sub_active_class, 'offline_exams') }}>
                          <a href="{{URL_OFFLINE_EXAMS}}">                                                        
                           <i class="fa fa-external-link"></i>
                            <span>Offline Exams</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'attandance_report') }}>
                          <a href="{{URL_STUDENT_CLASS_ATTENDANCE}}">
                            <i class="fa fa-check-square-o"></i>
                            <span>{{ getPhrase('class_attendance_report')}}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'class_marks') }}>
                          <a href="{{URL_STUDENT_MARKS_REPORT}}">                                                        
                            <i class="fa fa-line-chart"></i>
                            <span> {{ getPhrase('class_marks_report')}}</span>
                          </a>
                        </li>

                        <li {{ isSubActive($sub_active_class, 'fee_paid_histroy') }}>
                          <a href="{{URL_CLASS_WISE_FEE_PAID_HISTORY}}"> <i class="fa fa-credit-card"></i>
                            <span>{{getPhrase('fee_paid_histroy')}}</span>
                          </a>
                        </li>

                        <li {{ isSubActive($sub_active_class, 'student_list') }}>
                          <a href="{{URL_STUDENT_LIST}}">                                                        
                           <i class="fa fa-users"></i>
                            <span>{{getPhrase('student_list')}}</span>
                          </a>
                        </li>
                      <li {{ isSubActive($sub_active_class, 'student_clist') }}>
                          <a href="{{URL_STUDENT_COMPLETED_LIST}}">                                                        
                            <i class="fa fa-graduation-cap"></i>
                            <span>{{ getPhrase('course_completed_student_list')}}</span>
                          </a>
                        </li>
                         <li {{ isSubActive($sub_active_class, 'student_dlist') }}>
                          <a href="{{URL_STUDENT_DETAINED_LIST}}">                                                        
                            <i class="fa fa-sort-amount-desc"></i>
                            <span>{{ getPhrase('detained_students_list')}}</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li {{ isActive($active_class, 'exams') }}>
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
                        <li {{ isSubActive($sub_active_class, 'categories') }}>
                          <a href="{{URL_QUIZ_CATEGORIES}}">                                                           
                            <i class="fa fa-random"></i>
                            <span>{{getPhrase('categories')}}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'question_bank') }}>
                          <a href="{{URL_QUIZ_QUESTIONBANK}}">                                  
                           <i class="fa fa-question"></i>
                            <span>{{getPhrase('question_bank')}}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'quiz') }} >
                          <a href="{{URL_QUIZZES}}">                                                        
                            <i class="fa fa-clock-o"></i>
                            <span>{{getPhrase('exam')}}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'exam_series') }}>
                          <a href="{{URL_EXAM_SERIES}}">                                                                     
                           <i class="fa fa-list-ol"></i>
                            <span>{{getPhrase('exam_series')}}</span>
                          </a>
                        </li>
                       <li {{ isSubActive($sub_active_class, 'offline_exam') }}>
                          <a href="{{URL_OFFLINEEXMAS_QUIZ_CATEGORIES}}">                                                        
                            <i class="fa fa-sort-amount-asc"></i>
                            <span>{{getPhrase('offline_exam_categories')}}</span>
                          </a>
                        </li>
                       <li {{ isSubActive($sub_active_class, 'instruction') }}>
                          <a href="{{URL_INSTRUCTIONS}}">                                                        
                            <i class="fa fa-hand-o-right"></i>
                            <span>{{getPhrase('instruction')}}</span>
                          </a>
                        </li>  
                      </ul>
                    </li>
                    <li {{ isActive($active_class, 'coupons') }} > 
                      <a href="#pages">
                       <i class="fa fa-tag icon">
                          <b class="bg-primary"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>{{getPhrase('coupons')}}</span>
                      </a>
                      <ul class="nav lt">
                        <li {{ isSubActive($sub_active_class, 'coupons_list') }}>
                          <a href="{{URL_COUPONS}}">                                                        
                            <i class="fa fa-list"></i>
                            <span>{{getPhrase('list')}}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'coupons_add') }}>
                           <a href="{{URL_COUPONS_ADD}}">                                                            
                            <i class="fa fa-plus-circle"></i>
                            <span>{{getPhrase('add')}}</span>
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
                        <li {{ isSubActive($sub_active_class, 'categories') }}>
                          <a href="{{ URL_LMS_CATEGORIES }}">                                                       
                             <i class="fa fa-random"></i>
                            <span>{{getPhrase('categories')}}</span>
                          </a>
                        </li>
                       <li {{ isSubActive($sub_active_class, 'contents') }}>
                          <a href="{{ URL_LMS_CONTENT }}">                                                       
                           <i class="fa fa-bars"></i>
                            <span>{{getPhrase('contents')}}</span>
                          </a>
                        </li>
                      <li {{ isSubActive($sub_active_class, 'series') }}>
                          <a href="{{ URL_LMS_SERIES }}">                                                           
                          <i class="fa fa-list-ol"></i>
                            <span>{{getPhrase('series')}}</span>
                          </a>
                        </li>
                      </ul>
                    </li>
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
                         <li {{ isSubActive($sub_active_class, 'asset_types') }}>
                          <a href="{{URL_LIBRARY_ASSETS}}" >                                                        
                            <i class="fa fa-database"></i>
                            <span>{{getPhrase('item_types')}}</span>
                          </a>
                        </li>
                         <li {{ isSubActive($sub_active_class, 'master_type') }}>
                          <a href="{{URL_LIBRARY_MASTERS}}" >                                                        
                           <i class="fa fa-book" ></i>
                            <span>{{getPhrase('master_data')}}</span>
                          </a>
                        </li>
                         <li {{ isSubActive($sub_active_class, 'publishers') }}>
                          <a href="{{URL_PUBLISHERS}}" >                                                        
                            <i class="fa fa-paint-brush"></i>
                            <span>{{getPhrase('publishers')}}</span>
                          </a>
                        </li>
                         <li {{ isSubActive($sub_active_class, 'authors') }}>
                          <a href="{{URL_AUTHORS}}" >                                                        
                           <i class="fa fa-mortar-board"></i>
                            <span>{{getPhrase('authors')}}</span>
                          </a>
                        </li>
                         <li {{ isSubActive($sub_active_class, 'library_students') }}>
                          <a href="{{URL_LIBRARY_USERS}}student" >                                                        
                           <i class="fa fa-user"></i>
                            <span>{{getPhrase('students')}}</span>
                          </a>
                        </li>
                         <li {{ isSubActive($sub_active_class, 'library_staff') }}>
                          <a href="{{URL_LIBRARY_USERS}}staff" >                                                        
                           <i class="fa fa-users"></i>
                            <span>{{ getPhrase('staff') }}</span>
                          </a>
                        </li>
                         <li {{ isSubActive($sub_active_class, 'student_return') }}>
                          <a href="{{URL_LIBRARY_LIBRARYDASHBOARD_BOOKS}}">                                                        
                           <i class="fa fa-book"></i>
                            <span>{{ getPhrase('student_book_return') }}</span>
                          </a>
                        </li>
                         <li {{ isSubActive($sub_active_class, 'staff_return') }}>
                          <a href="{{URL_LIBRARY_LIBRARYDASHBOARD_BOOKS_STAFF}}">                                                        
                         <i class="fa fa-book"></i>
                            <span>{{ getPhrase('staff_book_return') }}</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                     <li {{ isActive($active_class, 'fee') }}>
                      <a href="#pages"  >
                        <i class="fa fa-money">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>{{getPhrase('fee')}}</span>
                      </a>
                      <ul class="nav lt">
                        <li {{ isSubActive($sub_active_class, 'fee_category') }}>
                          <a href="{{URL_FEE_CATEGORIES}}" >                                                        
                            <i class="fa fa-th"></i>
                            <span>{{getPhrase('fee_categories')}}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'fee_particulars') }}>
                          <a href="{{URL_FEE_PARTICULARS}}" >                                                        
                            <i class="fa fa-bars"></i>
                            <span>{{ getPhrase('fee_particulars')}}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'fee_pay') }}>
                          <a href="{{URL_FEE_ACCEPT}}" >                                                        
                            <i class="fa fa-credit-card" aria-hidden="true"></i>

                            <span>{{ getPhrase('pay_fee')}}</span>
                          </a>
                        </li>
                         <li {{ isSubActive($sub_active_class, 'fee_reports') }}>
                          <a href="{{URL_FEE_REPORTS_DAILY}}" >                                                        
                            <i class="fa fa-list-alt" aria-hidden="true"></i>

                            <span>{{ getPhrase('fee_paid_reports')}}</span>
                          </a>
                        </li>
                         <li {{ isSubActive($sub_active_class, 'fee_payoffline') }}>
                          <a href="{{URL_FEE_REPORTS_OFFLINE}}" >                                                        
                           <i class="fa fa-bar-chart"></i>
                            <span>{{ getPhrase('offline_fee_payments')}}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'fee') }}>
                          <a a href="#" onclick="showFeeInstructions()">                                                        
                            <i class="fa fa-question"></i>
                            <span>{{getPhrase('help')}}</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                   <li {{ isActive($active_class, 'master_settings') }}>
                      <a href="#pages"  >
                        <i class="fa fa-cog icon">
                          <b class="bg-danger"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>{{getPhrase('settings')}}</span>
                      </a>
                      <ul class="nav lt">
                      
                        <li {{ isSubActive($sub_active_class, 'all_settings') }}>
                          <a href="{{URL_MASTERSETTINGS_SETTINGS}}" >                                                        
                            <i class="fa fa-cogs"></i>
                            <span>{{getPhrase('settings')}}</span>
                          </a>
                        </li>
                       <li {{ isSubActive($sub_active_class, 'religions') }}>
                          <a href="{{URL_MASTERSETTINGS_RELIGIONS}}" >   
                            <i class="fa fa-rebel"></i>
                            <span>{{ getPhrase('religions_master') }}</span>
                          </a>
                        </li>
                         <li {{ isSubActive($sub_active_class, 'categories_master') }}>
                          <a href="{{URL_MASTERSETTINGS_CATEGORIES}}" >  
                            <i class="fa fa-arrows" aria-hidden="true"></i>
                            <span>{{ getPhrase('categories_master') }}</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'email_templates') }}>
                          <a href="{{URL_MASTERSETTINGS_EMAIL_TEMPLATES}}" >  
                        <i class="fa fa-file-text" aria-hidden="true"></i>
                            <span>{{ getPhrase('email_templates') }}</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li {{ isActive($active_class, 'payment_reports') }}>
                      <a href="#payment reports"  >
                        <i class="fa fa-flag icon">
                          <b class="bg-success"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>{{getPhrase('payments')}}</span>
                      </a>
                      <ul class="nav lt">
                       <li {{ isSubActive($sub_active_class, 'online_payments') }}>
                          <a href="{{URL_ONLINE_PAYMENT_REPORTS}}">                                                        
                            <i class="fa fa-link"></i>
                            <span>Online Payments</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'offline_payments') }}>
                          <a href="{{URL_OFFLINE_PAYMENT_REPORTS}}">  
                            <i class="fa fa-chain-broken"></i>
                            <span>Offline Payments</span>
                          </a>
                        </li>
                        <li {{ isSubActive($sub_active_class, 'payments_export') }}>
                          <a href="{{URL_PAYMENT_REPORT_EXPORT}}">                                                        
                            <i class="fa fa-file-excel-o"></i>
                            <span>Export</span>
                          </a>
                        </li>
                      </ul>
                    </li>


                   <li {{ isActive($active_class, 'user_messages') }}>
                      <a href="{{URL_MESSAGES}}"  >
                        <i class="fa fa-comments">
                          <b class="bg-danger"></b>
                        </i>
                       
                        <span>{{getPhrase('messages')}}<span> <h8 class="badge badge-sm up bg-danger m-l-n-sm count">{{$count = Auth::user()->newThreadsCount()}}</h8></span></span>
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