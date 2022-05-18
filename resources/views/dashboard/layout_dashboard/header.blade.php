
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="{{ url('/')}}"><img src="{{URL::asset('assets/images/logo.png')}}" alt="logo" style="width:120px; height: 100%" /></a>
          <a class="navbar-brand brand-logo-mini" href="{{ url('/')}}"><img src="{{URL::asset('assets/images/logo-mini.png')}}"  alt="logo" style="width:30px; height: 50px"/></a>
       

        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <!--<div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
              </div>
            </form>
          </div>-->

          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                @if(Auth::user()->photo == "")
                <div class="nav-profile-img">
                  <img src="{{URL::asset('assets/images/faces/face1.jpg')}}" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">{{ Auth::user()->name }}</p>
                </div>
                @else
                <div class="nav-profile-img">
                  <?php $photo=Auth::user()->photo ; ?>
                  <img src='{{ URL::asset("img/$photo")}}' alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">{{ Auth::user()->name }}</p>
                </div>
                @endif
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
               
                <a class="dropdown-item" href="{{ url('/profile')}}">
                  <i class="mdi mdi-account-box mr-2 text-success"></i> Profile 
                </a>
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{url('/')}}">
                  <i class="mdi mdi-directions-fork mr-2 text-primary"></i>Voir vitrine</a>
              </div>
            </li>
            


            <li class="nav-item dropdown">
              <!--<a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-email-outline"></i>
                <span class="count-symbol bg-warning"></span>
              </a>-->
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0">Messages</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face3.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">4 new messages</h6>
              </div>
            </li>
            @if(Auth::user()->role != 2)
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                @if(count(Auth::user()->unreadNotifications)==0)
                <span class="count-symbol" id="cnt"><span id="msgtest"></span></span>
                @else
                <span id="cnt" class="count-symbol bg-danger"><span id="msgtest">{{count(Auth::user()->unreadNotifications)}}
                </span></span>
                @endif
              </a>
              <div id="app">
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown" id="drop_note" style="max-height: 800px; overflow-y: scroll;">
                <h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider" id="after"></div>
                
                @foreach(Auth::user()->unreadNotifications as $notification)
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon ">
                      <i class="mdi mdi-receipt text-warning"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    @if($notification->type=="$notification->type")
                    <h6 class="preview-subject font-weight-normal mb-1">Commande</h6>
                    @else
                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                    @endif
                    @include('vitrine.notification.'.snake_case(class_basename($notification->type)))
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                
                @endforeach
                
                
                
              </div>
              </div>
            </li>
            @endif
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="mdi mdi-power"></i>
              </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
            </li>
            
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>


      </nav>