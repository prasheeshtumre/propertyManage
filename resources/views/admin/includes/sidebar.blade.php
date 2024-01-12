{{-- <style>
    #logout-confirm.modal-backdrop {
        --vz-backdrop-zindex: 1050;
        --vz-backdrop-bg: #000;
        --vz-backdrop-opacity: -0.5;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 0;
        width: 100vw;
        height: 100vh;
        background-color: var(--vz-backdrop-bg);
    }
    
</style> --}}

<style>
    .navbar-menu .navbar-nav .nav-sm .nav-link:before {
        display: none !important;
    }

    .navbar-menu .navbar-nav .nav-sm .nav-link {
        padding-left: 0px !important;
    }
</style>

<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/konu-icon.svg') }}" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/konu-icon.svg') }}" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/konu-logo-white.svg') }}" alt="" height="40">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>




                <li class="nav-item">
                    <a class="nav-link menu-link active" href="{{ route('admin.dashboard') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>

                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.property.gated-reports') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">View Gated Community</span>
                    </a>

                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.surveyor.management') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-file-fill"></i> <span data-key="t-dashboards"> User Management </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.surveyor.userview') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="fa-solid fa-square-poll-vertical"></i> <span data-key="t-dashboards">User-wise Survey
                            Report</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarLanding" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                        <i class="fa-solid fa-gear"></i><span data-key="t-landing">Masters</span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarLanding" style="">
                        <ul class="nav nav-sm flex-column">
                            <!-- end Dashboard Menu -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('admin.builder.index') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">

                                    <i class="fa-solid fa-building"></i> <span data-key="t-dashboards"> Builder
                                        Management</span>

                                </a>

                            </li> <!-- end Dashboard Menu -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ url('admin/floor-unit') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">

                                    <i class="fas fa-list-alt"></i> <span data-key="t-dashboards"> Manage
                                        Categories</span>

                                </a>

                            </li> <!-- end Dashboard Menu -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ url('admin/floor-unit-sub-category') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">

                                    <i class="fa-solid fa-list-ul"></i> <span data-key="t-dashboards"> Manage Sub
                                        Categories </span>

                                </a>

                            </li> <!-- end Dashboard Menu -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ url('admin/brand') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">

                                    <i class="fa-solid fa-bars-progress"></i> <span data-key="t-dashboards"> Manage
                                        Brands </span>

                                </a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('admin.construction_partner.index') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                    <i class="fa-solid fa-bars-progress"></i> <span data-key="t-dashboards">Construction Master</span>
                                </a>
                            </li>

                            <!-- end Dashboard Menu -->
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#locationMasters" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="locationMasters">
                        <i class="fa-solid fa-gear"></i><span data-key="t-landing">Area Masters</span>
                    </a>
                    <div class="menu-dropdown collapse" id="locationMasters" style="">
                        <ul class="nav nav-sm flex-column">
                            <!-- end Dashboard Menu -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('admin.city.index') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                    <i class="fa-solid fa-bars-progress"></i> <span data-key="t-dashboards">City</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('admin.pincode.index') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                    <i class="fa-solid fa-bars-progress"></i> <span data-key="t-dashboards">Pincode</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('admin.pincode-city-grouping.index') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                    <i class="fa-solid fa-bars-progress"></i> <span data-key="t-dashboards">Pincode and City Grouping </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('admin.area.index') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                    <i class="fa-solid fa-bars-progress"></i> <span data-key="t-dashboards">Area </span>
                                </a>
                            </li>
                            <!-- end Dashboard Menu -->
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="" role="button" aria-expanded="false" aria-controls="sidebarDashboards" data-bs-toggle="modal" data-bs-target="#logout-confirm">
                        <i class="fa-solid fa-power-off"></i> <span data-key="t-dashboards">Logout</span>
                    </a>

                    <!--Modal confirm logout-->
                    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}

                    {{-- <div class="modal fade" id="logout-confirm" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-md ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to logout ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="event.preventDefault();document.getElementById('logout-form1').submit();">Logout</button>
                                    <form id="logout-form1" action="{{ route('logout') }}" method="POST"
                    class="d-none">
                    @csrf
                    </form>
        </div>
    </div>
</div>
</div> --}}




</li> <!-- end Dashboard Menu -->
</ul>
</div>
<!-- Sidebar -->
</div>

<div class="sidebar-background"></div>
</div>