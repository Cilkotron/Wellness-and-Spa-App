<!--
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top mb-5">
            <div class="container-fluid">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="">Welcome, {{ Auth::user()->name }}</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:;">
                    <i class="material-icons">dashboard</i>
                    <p class="d-lg-none d-md-block">
                        Stats
                    </p>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">person</i>
                    <p class="d-lg-none d-md-block">
                        Account
                    </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <span class="material-icons">
                                exit_to_app
                            </span>
                        Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="dispaly: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                </ul>
            </div>
            </div>
</nav>-->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
      <div class="navbar-wrapper">
        <a class="navbar-brand" href="">Welcome, {{ Auth::user()->name }}</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">
        <form class="navbar-form" style="display: none;">
          <div class="input-group no-border">
            <input type="text" value="" class="form-control" placeholder="Search...">
            <button type="submit" class="btn btn-white btn-round btn-just-icon">
              <i class="material-icons">search</i>
              <div class="ripple-container"></div>
            </button>
          </div>
        </form>
        <ul class="navbar-nav" >
          <li class="nav-item" style="display: none;">
            <a class="nav-link" href="javascript:;">
              <i class="material-icons">dashboard</i>
              <p class="d-lg-none d-md-block">
              </p>
            </a>
          </li>
          <li class="nav-item dropdown" style="display: none;">
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Mike John responded to your email</a>
              <a class="dropdown-item" href="#">You have 5 new tasks</a>
              <a class="dropdown-item" href="#">You're now friend with Andrew</a>
              <a class="dropdown-item" href="#">Another Notification</a>
              <a class="dropdown-item" href="#">Another One</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">person</i>
              <p class="d-lg-none d-md-block">
                Account
              </p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <span class="material-icons">
                        exit_to_app
                    </span>
                Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="dispaly: none;">
                    @csrf
                </form>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<br>
<br>


