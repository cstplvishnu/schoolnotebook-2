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

                    <li {{ isActive($active_class, 'fee') }} > 
                      <a href="{{URL_FEE_CATEGORIES}}" class="active">
                        <i class="fa fa-th">
                          <b class="bg-info"></b>

                        </i>
                        <span>{{getPhrase('fee_categories')}}</span>
                      </a>
                    </li>

                    <li {{ isActive($active_class, 'fee_particulars') }} > 
                      <a href="{{URL_FEE_PARTICULARS}}" class="active">
                        <i class="fa fa-bars">
                          <b class="bg-primary"></b>

                        </i>
                        <span>{{getPhrase('fee_particulars')}}</span>
                      </a>
                    </li>

                     <li {{ isActive($active_class, 'pay_fee') }} > 
                      <a href="{{URL_FEE_ACCEPT}}" class="active">
                        <i class="fa fa-credit-card">
                          <b class="bg-warning"></b>

                        </i>
                        <span>{{getPhrase('pay_fee')}}</span>
                      </a>
                    </li>

                    <li {{ isActive($active_class, 'fee_reports') }} > 
                      <a href="{{URL_FEE_REPORTS_DAILY}}" class="active">
                        <i class="fa fa-list-alt">
                          <b class="bg-danger"></b>

                        </i>
                        <span>{{getPhrase('fee_reports')}}</span>
                      </a>
                    </li>

                   
                    
                   <li {{ isActive($active_class, 'user_messages') }}>
                      <a href="{{URL_MESSAGES}}"  >
                        <i class="fa fa-comments">
                          <b class="bg-info"></b>
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