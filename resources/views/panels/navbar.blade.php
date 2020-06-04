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
          <li class="dropdown dropdown-user nav-item">
            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
              <div class="user-nav d-sm-flex d-none">
                <span class="user-name">{{auth()->user()->name}}</span>
              </div>
              <span><img class="round" src="{{auth()->user()->profile->photo}}" alt="avatar" height="40" width="40"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pb-0">
              <a class="dropdown-item" href="{{route('admin.account.edit', [auth()->user()->id])}}">
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