<li class="nav-item dropdown">
    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="media align-items-center">
            <span class="avatar avatar-sm rounded-circle">
            <img alt="Image placeholder" src="https://i.pravatar.cc/300">
            </span>
            <div class="media-body  ml-2  d-none d-lg-block">
                <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
            </div>
        </div>
    </a>
    <div class="dropdown-menu  dropdown-menu-right ">
        <div class="dropdown-header noti-title">
            <h6 class="text-overflow m-0">Welcome {{ auth()->user()->name }}!</h6>
        </div>
        <div class="dropdown-divider"></div>
        <a href="{{ route('home') }}" class="dropdown-item">
            <i class="ni ni-shop"></i>
            <span>Home Page</span>
        </a>
        <a
            href="javascript:void(0);" class="dropdown-item"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"
        >
            <i class="ni ni-user-run"></i>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</li>
