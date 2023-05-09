<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ asset('resources/images/users/'.Auth::user()->logo) }}" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
            <div class="dropdown">
                <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown"  aria-expanded="false">{{ Auth::user()->name }}</a>
                <div class="dropdown-menu user-pro-dropdown">
                    <!-- item-->
                    <a href="{{ route('dash') }}" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>Inicio</span>
                    </a>
    
                    <!-- item-->
                    <a href="{{ route('settings') }}" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Configuraciones</span>
                    </a> 
    
                    <!-- item-->
                    <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Cerrar sesión</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
    
                </div>
            </div>

            <p class="text-muted left-user-info">Panel de control</p>

            <ul class="list-inline">
                <li class="list-inline-item">
                    <!-- Configuraciones -->
                    <a href="{{ route('settings') }}" class="text-muted left-user-info">
                        <i class="mdi mdi-cog"></i>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-power"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">NAVEGACIÒN</li>
                
                <!-- Dashboard --> 
                <li>
                    <a href="#dash" data-bs-toggle="collapse">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> Dashboard </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="dash">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('dash') }}">Inicio</a>
                            </li>
                            <li>
                                <a href="{{ route('profile') }}">Perfíl</a>
                            </li>
                            <li>
                                <a href="{{ route('settings') }}">Configuraciones</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Dashboard -->
                
                <li class="menu-title mt-2">Opciones</li>

                <!-- Generador de QR -->
                <li>
                    <a href="#qr_generator" data-bs-toggle="collapse">
                        <i class="mdi mdi-qrcode"></i>
                        <span> Generador de QR </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="qr_generator">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('qr_generator') }}">Listado</a>
                            </li>
                            <li>
                                <a href="{{ route('new_qr') }}">Agregar Elemento</a>
                            </li>
                            <li>
                                <a href="{{ route('list_qr') }}">QR generados</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Generador de QR -->

                <!-- Itinerarios -->
                <li>
                    <a href="#banners" data-bs-toggle="collapse">
                        <i class="mdi mdi-file-image"></i>
                        <span> Itinerario & Banner</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="banners">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('banners') }}">Listado</a>
                            </li>
                            <li>
                                <a href="{{ asset('banner/add') }}" >Agregar Elemento</a>
                            </li> 
                        </ul>
                    </div>
                </li>
                <!-- Itinerarios -->
 
                <!-- Eventos -->
                <li>
                    <a href="#events" data-bs-toggle="collapse">
                        <i class="mdi mdi-badge-account-alert"></i>
                        <span> Eventos </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="events">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('events') }}">Listado</a>
                            </li>
                            <li>
                                <a href="{{ asset('events/add') }}" >Agregar Elemento</a>
                            </li> 
                        </ul>
                    </div>
                </li>
                <!-- Eventos -->
 
                <!-- Encuestas -->
                <li>
                    <a href="#encuestas" data-bs-toggle="collapse">
                        <i class="mdi mdi-form-select"></i>
                        <span> Encuestas </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="encuestas">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('survey') }}">Listado</a>
                            </li>
                            <li>
                                <a href="{{ asset('survey/add') }}" >Agregar Elemento</a>
                            </li> 
                        </ul>
                    </div>
                </li>
                <!-- Encuestas -->

                <!-- Beacons -->
                <li>
                    <a href="#beacons" data-bs-toggle="collapse">
                        <i class="mdi mdi-rss-box"></i>
                        <span> Beacons </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="beacons">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('beacons') }}">Listado</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Beacons -->

                <!-- Usuarios -->
                <li>
                    <a href="#users" data-bs-toggle="collapse">
                        <i class="mdi mdi-face-shimmer-outline"></i>
                        <span> Usuarios </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('users') }}">Listado</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Usuarios -->

                <!-- staff -->
                <li>
                    <a href="#staff" data-bs-toggle="collapse">
                        <i class="mdi mdi-bike-fast"></i>
                        <span> Staff </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="staff">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#">Listado</a>
                            </li>
                            <li>
                                <a href="#">Agregar Elemento</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- staff -->
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->