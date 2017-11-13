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
       
        <li {{ isActive($active_class, 'messages') }} >
          <a href="{{URL_MESSAGES}}">
            <i class="fa fa-comments"></i>
            <span class="badge badge-sm up bg-danger m-l-n-sm count">{{$count = Auth::user()->newThreadsCount()}}</span>
          </a>
        
        </li>
      

        <li {{ isActive($active_class, 'user_profile') }} class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <img src="{{ getProfilePath(Auth::user()->image, 'thumb') }}">
            </span>
            <?php $user_name   = Auth::user()->name; ?>
             {{$user_name}}<b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <span class="arrow top"></span>
            <li>
              <a href="{{URL_USERS_EDIT}}{{Auth::user()->slug}}"><span> <i class="fa fa-user"></i> </span> {{getPhrase('my_profile')}}</a>
            </li>
            <li>
              <a href="{{URL_BOOKMARKS.Auth::user()->slug}}"><span> <i class="fa fa-bookmark"></i> </span>{{getPhrase('my_book_marks')}}</a>
            </li>
            <li>
              <a href="{{URL_USERS_CHANGE_PASSWORD}}{{Auth::user()->slug}}"><span> <i class="fa fa-key"></i> </span>{{getPhrase('change_password')}}</a>
            </li>
            <li>
              <a href="{{URL_USERS_SETTINGS.Auth::user()->slug}}"><span> <i class="fa fa-cog"></i> </span>{{getPhrase('settings')}}</a>
            </li>
            <li>
              <a href="{{URL_FEEDBACK_SEND}}"><span> <i class="fa fa-comment-o"></i> </span>{{getPhrase('feedback')}}</a>
            </li>
           
            <li class="divider"></li>
            <li>
                <a href="{{URL_USERS_LOGOUT}}"><span><i class="fa fa-sign-out"></i>  </span>{{getPhrase('logout')}}</a>
            </li>
          </ul>
        </li>
      </ul>      
