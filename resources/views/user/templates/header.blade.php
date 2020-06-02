<div class="chooos-div">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand" href="{{route('home')}}"><img src="images/logo.png"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link text-nav mr-5 text-white active" href="{{route('home')}}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-nav mr-5 text-white" href="#about">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-nav mr-5 text-white" href="#features">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-nav mr-5 text-white" href="#Technology">Technology</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-nav mr-5 text-white" data-toggle="modal" data-target="#exampleModalCenter2" style="cursor: pointer;">Pricing</a>
              </li>
              @if(Auth::check())
              <li class="nav-item">
                <a class="nav-link text-nav mr-5 text-white" href="{{url('dashboard-ecommerce')}}" >My Account</a>
              </li>
              @else
              <li class="nav-item">
                <a class="nav-link text-nav mr-5 text-white" href="#SignUp" data-toggle="modal" data-target="#exampleModalCenter">SignUp</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-nav mr-5 text-white" href="#SIgnIn" data-toggle="modal" data-target="#exampleModalCenter1">Sign In</a>
              </li>
              @endif
            </ul>
          </div>
        </nav>
      </div>

      