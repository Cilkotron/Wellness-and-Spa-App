<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ url('../admin/img/sidebar-3.jpg') }}">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}" class="simple-text logo-normal">Wellness&Spa</a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
            <li class="nav-item active {{ Request::is('/admin/dashboard*') ? 'active': ''  }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <p><span class="material-icons">dashboard</span>Dashboard</p>
                </a>
            </li>
            <li class="nav-item{{ Request::is('/admin/slider*') ? 'active': ''  }}">
                <a class="nav-link" href="{{ route('slider.index') }}">
                <p><span class="material-icons">sync_alt</span>Sliders</p>
                </a>
            </li>
            <li class="nav-item{{ Request::is('/admin/category*') ? 'active': ''  }}">
                <a class="nav-link" href="{{ route('category.index') }}">
                <p><span class="material-icons">category</span>Categories</p>
                </a>
            </li>
            <li class="nav-item{{ Request::is('/admin/service*') ? 'active': ''  }}">
                <a class="nav-link" href="{{ route('service.index') }}">
                <p><span class="material-icons">support</span>Services</p>
                </a>
            </li>
            <li class="nav-item{{ Request::is('/admin/reservation*') ? 'active': ''  }}">
                <a class="nav-link" href="{{ route('reservation.index') }}">
                <p><span class="material-icons">book_online</span>Reservations</p>
                </a>
            </li>
            <li class="nav-item{{ Request::is('/admin/contact*') ? 'active': ''  }}">
                <a class="nav-link" href="{{ route('contact.index') }}">
                <p><span class="material-icons">perm_contact_calendar</span>Contacts</p>
                </a>
            </li>
            <li class="nav-item{{ Request::is('/admin/reservation*') ? 'active': ''  }}">
                <a class="nav-link" href="{{ route('reservation.calendar') }}">
                <p><span class="material-icons">date_range</span>Calendar</p>
                </a>
            </li>


            </ul>
        </div>
</div>
