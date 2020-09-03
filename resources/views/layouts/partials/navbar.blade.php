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
</nav>
<br>
<br>


