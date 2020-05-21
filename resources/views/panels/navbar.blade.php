{{-- navabar  --}}
<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu 
@if(isset($configData['navbarType'])){{$configData['navbarClass']}} @endif" 
data-bgcolor="@if(isset($configData['navbarBgColor'])){{$configData['navbarBgColor']}}@endif">
  <div class="navbar-wrapper">
    <div class="navbar-container content">
      <div class="navbar-collapse" id="navbar-mobile">
        <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
        </div>
        <ul class="nav navbar-nav float-right">
          <li class="dropdown dropdown-language nav-item">
            <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdown-flag">
              <a class="dropdown-item" href="{{url('lang/en')}}" data-language="en">
                <i class="flag-icon flag-icon-us mr-50"></i> English
              </a>
              <a class="dropdown-item" href="{{url('lang/fr')}}" data-language="fr">
                <i class="flag-icon flag-icon-fr mr-50"></i> French
              </a>
              <a class="dropdown-item" href="{{url('lang/de')}}" data-language="de">
                <i class="flag-icon flag-icon-de mr-50"></i> German
              </a>
              <a class="dropdown-item" href="{{url('lang/pt')}}" data-language="pt">
                <i class="flag-icon flag-icon-pt mr-50"></i> Portuguese
              </a>
            </div>
          </li>
          <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
          <li class="dropdown dropdown-user nav-item">
            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
              <div class="user-nav d-sm-flex d-none">
                <span class="user-name">{{auth()->user()->name}}</span>
                <span class="user-status text-muted">Available</span>
              </div>
              <span><img class="round" src="{{auth()->user()->profile->photo}}" alt="avatar" height="40" width="40"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pb-0">
              <a class="dropdown-item" href="{{asset('page-user-profile')}}">
                <i class="bx bx-user mr-50"></i> Edit Profile
              </a>
              <div class="dropdown-divider mb-0"></div>
              <a href="{{ route('admin.logout') }}"
                       onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="dropdown-item">
                <i class="bx bx-power-off mr-50"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    @csrf
</form>