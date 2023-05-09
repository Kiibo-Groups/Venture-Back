<!-- Topbar Start -->
<div class="navbar-custom" >
    <ul class="list-unstyled topnav-menu float-end mb-0" id="tooltip-container">

        <li>
            <a class="nav-link waves-effect waves-light" href="#" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lector de códigos QR">
                <i class="mdi mdi-qrcode noti-icon"></i>
            </a>
        </li>

        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="fe-bell noti-icon"></i>
                <!-- <span class="badge bg-danger rounded-circle noti-icon-badge">0</span>  -->
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-lg">

                <!-- item-->
                <div class="dropdown-item noti-title">
                    <h5 class="m-0">
                        <span class="float-end">
                            <a href="" class="text-dark">
                                <small>Limpiar Todo</small>
                            </a>
                        </span>Notificaciones
                    </h5>
                </div>

                <div class="noti-scroll" data-simplebar>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-primary">
                            <i class="mdi mdi-comment-account-outline"></i>
                        </div>
                        <p class="notify-details">No existen notificaciones pendientes
                            <small class="text-muted">estas al día</small>
                        </p>
                    </a> 
                </div>

                <!-- All-->
                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                    Ver todas
                    <i class="fe-arrow-right"></i>
                </a>

            </div>
        </li>

        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ asset('resources/images/users/'.Auth::user()->logo) }}" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ms-1">
                    {{Auth::user()->name}} <i class="mdi mdi-chevron-down"></i> 
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Bienvenido(a) !</h6>
                </div>

                <!-- item-->
                <a href="{{ route('dash') }}" class="dropdown-item notify-item">
                    <i class="fe-layout"></i>
                    <span>Inicio</span>
                </a>
                
                <!-- item-->
                <a href="{{ route('profile') }}" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>Perfíl</span>
                </a> 
                <!-- item-->
                <a href="{{ route('settings') }}" class="dropdown-item notify-item">
                    <i class="mdi mdi-cog"></i>
                    <span>Configuraciones</span>
                </a>

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>Cerrar sesión</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
  
    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="{{ route('dash') }}" class="logo logo-light text-center">
            <span class="logo-sm">
                <img src="{{ asset('resources/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('resources/images/logo-light.png') }}" alt="" height="16">
            </span>
        </a> 
    </div>
  
    <div class="clearfix"></div> 
</div>
<!-- end Topbar -->