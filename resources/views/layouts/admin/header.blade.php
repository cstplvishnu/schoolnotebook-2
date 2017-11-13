 

      <div class="navbar-header aside-md">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="fa fa-bars"></i>
        </a>
        <a href="{{PREFIX}}" class="navbar-brand"><img src="{{IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')}}" alt="{{getSetting('site_title','site_settings')}}" class="m-r-sm"></a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
    

      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
        <li class="hidden-xs">
          <a href="#" class="dropdown-toggle dk" data-toggle="dropdown">
            <i class="fa fa-bell"></i>
            <span class="badge badge-sm up bg-danger m-l-n-sm count"></span>
          </a>
          <section class="dropdown-menu aside-xl">

            <section class="panel bg-white">

              <header class="panel-heading b-light bg-light">
                <strong>{{getPhrase('you_have ')}}<span class="count">5</span> {{getPhrase('notifications')}}</strong>
              </header>

              <div class="list-group list-group-alt animated fadeInRight">
                
                <?php $newUsers = (new App\User())->getLatestUsers(); ?>
                
                @foreach($newUsers as $user)

                <a href="{{URL_USER_DETAILS.$user->slug}}" class="media list-group-item">
                  <span class="pull-left thumb-sm">
                   <img src="{{ getProfilePath($user->image)}}" alt="" class="img-circle">
                  </span>
                  <span class="media-body block m-b-none">
                    <strong>{{ucfirst($user->name)}}</strong> {{getPhrase('was_joined_as')}} {{getRoleData($user->role_id)}}<br>
                    <small class="text-muted">{{$user->updated_at->diffForHumans()}}</small>
                  </span>
                </a>
                
                @endforeach 

               </div>

              <footer class="panel-footer text-sm">
                <a href="{{URL_USERS."users"}}" class="pull-right"><i class="fa fa-cog"></i></a>
                <a href="{{URL_USERS."users"}}" >{{getPhrase('see_all_users')}}</a>
              </footer>
            </section>
          </section>

        </li>
       
       <!-- Serach Bar -->

        <li class="dropdown hidden-xs" ng-controller = "searchStudentController">
          <a href="#" class="dropdown-toggle dker" data-toggle="dropdown"><i class="fa fa-fw fa-search"></i></a>
          <section class="dropdown-menu aside-xl animated fadeInUp">
            <section class="panel bg-white">
             <div class="form-group wrapper m-b-none">

                  <div class="input-group">

                    <input type="text" class="form-control" placeholder="Search Student"  id="mysearch"  onkeypress="showDropdow()" ng-model = "enteredtext" ng-change="textChanged(enteredtext)" >

                    
                    
                     <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-icon"><i class="fa fa-search"></i></button>
                    </span>

                  </div>
                </div>

                <ul class="dropdown-menu animated fadeInRight user-search" id="users_list" ng-if="searchtestlenght > 0" style="width: 100%">

                    <li ng-repeat = "student in students" ng-if="students.length>0">
                
                     <a href="{{URL_USER_DETAILS}}@{{student.slug}}" class="thumb pull-left m-r" style="height: 25%; width: 25%">
                        <img ng-if=" student.image!='' " src="{{IMAGE_PATH_PROFILE}}@{{student.image}}" class="img-circle">
                        <img ng-if=" student.image=='' " src="{{IMAGE_PATH_PROFILE_DEFAULT}}" class="img-circle">
                      </a>

                           <div class="ss-search-bar">
                            <a href="{{URL_USER_DETAILS}}@{{student.slug}}" class="text-info"><strong>{{getPhrase('name')}}</strong> : @{{student.name}}
                             <small class="block text-muted"><strong>{{getPhrase('roll_no')}}</strong> : @{{student.roll_no}}</small>
                             <small class="block text-muted"><strong>{{getPhrase('class')}}</strong> : @{{student.course_title}}</small></a>
                           </div>

                     </li>

                     <li ng-if="students.length==0" class="text-center"><strong>{{getPhrase('no_user_available')}}</strong>

                       
                     </li>

                     
                </ul>

            </section>
          </section>
        </li>
     <!-- End Search Bar -->

        <li {{ isActive($active_class, 'user_profile') }} class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <img src="{{IMAGES}}avatar.jpg">
            </span>
             <?php $user_name   = Auth::user()->name; ?>
             {{$user_name}} <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <span class="arrow top"></span>
            <li>
              <a href="{{URL_USERS_EDIT}}{{Auth::user()->slug}}"><i class="fa fa-user"></i> {{getPhrase('my_profile')}}</a>
            </li>
            <li>
              <a href="{{URL_USERS_CHANGE_PASSWORD}}{{Auth::user()->slug}}"><i class="fa fa-key"></i> {{getPhrase('change_password')}}</a>
            </li>
            <li>
              <a href="{{URL_FEEDBACKS}}"><i class="fa fa-pencil"></i> {{getPhrase('feedback')}}</a>
            </li>
            <li>
              <a href="{{URL_ADMIN_NOTIFICATIONS}}">
                <i class="fa fa-bell"></i> {{getPhrase('notifications')}}
              </a>
            </li>
            <!-- <li>
              <a href="{{URL_MESSAGES}}">
                <span class="badge bg-danger pull-right">{{$count = Auth::user()->newThreadsCount()}}</span>
               <i class="fa fa-envelope"></i> {{getPhrase('messages')}}
              </a>
            </li> -->
            <li>
              <a href="{{URL_LANGUAGES_LIST}}"><i class="fa fa-language"></i> {{getPhrase('languages')}}</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="{{URL_USERS_LOGOUT}}"><i class="fa fa-sign-out"></i> {{getPhrase('logout')}}</a>
            </li>
          </ul>
        </li>
      </ul>      
