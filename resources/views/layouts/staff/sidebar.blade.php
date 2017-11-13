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
                    
                  
                    <li {{ isActive($active_class, 'subject_preferences') }} >
                     <a   href="{{URL_STAFF_SUBJECT_PREFERENCES.Auth::user()->slug}}">
                        <i class="fa fa-hand-o-up icon">
                          <b class="bg-success"></b>
                        </i>
                        
                        <span>{{getPhrase('subjects')}}</span>
                      </a>
                     
                    </li>
                    
                     <li {{ isActive($active_class, 'attendance') }} >
                     <a href="{{URL_STUDENT_ATTENDENCE.Auth::user()->slug}}">
                      <i class="fa fa-calendar" aria-hidden="true">
                          <b class="bg-info"></b>
                        </i>
                        
                        <span>{{getPhrase('attendance')}}</span>
                      </a>
                     
                    </li>

                    <li {{ isActive($active_class, 'lesson_plans') }}>
                      <a   href="{{URL_LESSION_PLANS_DASHBOARD.Auth::user()->slug}}">
                        <i class="fa fa-paper-plane-o">
                          <b class="bg-primary dker"></b>
                        </i>
                      
                        <span>{{getPhrase('lesson_plans')}}</span>
                      </a>
                    </li>

                    
                       <li {{ isActive($active_class, 'timetable') }}>
                        <a href="{{URL_TIMETABLE_STAFF_STUDENT_PRINT.Auth::user()->slug}}" target="_blank">
                        <i class="fa fa-laptop icon">
                          <b class="bg-info"></b>
                        </i>
                       
                        <span>{{ getPhrase('timetable') }}</span>
                      </a>
                     
                    </li>



                    <li {{ isActive($active_class, 'library') }}>
                      <a href="{{URL_USER_LIBRARY_DETAILS.Auth::user()->slug}}"  >
                        <i class="fa fa-exchange icon">
                          <b class="bg-warning"></b>
                        </i>
                      
                        <span>{{getPhrase('library')}}</span>
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
                        <i class="fa fa-bell icon">
                          <b class="bg-primary"></b>
                        </i>
                       
                        <span>{{getPhrase('alerts')}}</span>
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