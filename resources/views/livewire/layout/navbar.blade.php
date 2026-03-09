<!-- Navbar -->

<<<<<<< HEAD
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">

=======
<!-- Navbar -->

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">

>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
      <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="ti ti-menu-2 ti-md"></i>
      </a>
    </div>


    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

<<<<<<< HEAD
=======

>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
      <!-- Search -->
      <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
          <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
            <i class="ti ti-search ti-md me-2 me-lg-4 ti-lg"></i>
            <span class="d-none d-md-inline-block text-muted fw-normal">Search (Ctrl+/)</span>
          </a>
        </div>
      </div>
      <!-- /Search -->



<<<<<<< HEAD
      <ul class="navbar-nav flex-row align-items-center ms-auto">


 @php
    $user = Auth::user();
    $currentRoute = Route::currentRouteName();
@endphp
@if($user && ($user->userRoles->aka === 'GM' || $user->userRoles->aka === 'DIR' || $user->userRoles->aka === 'FD'))
    <!-- Switch Roles -->
    <li class="nav-item dropdown-language dropdown">
        <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow" 
           data-bs-toggle="dropdown" 
           href="javascript:void(0);" 
           role="button" 
           aria-expanded="false">
            <i class='ti ti-reload rounded-circle ti-md'></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <h6 class="dropdown-header">
                    <span class="badge bg-label-danger">
                        <i class="ti ti-copy ti-26px text-heading"></i> SWITCH ROLES
                    </span>
                </h6>
            </li>
            <li><hr class="dropdown-divider"></li>
            
            {{-- Default role based on current user --}}
            @if($user && $user->userRoles->aka === 'GM')
                <li>
                    <a href="{{ route('general-dashboard') }}" class="dropdown-item {{ $currentRoute === 'general-dashboard' ? 'active bg-light' : '' }}">
                        <i class="ti ti-home me-2"></i>
                        <span>DEFAULT (GM)</span>
                        @if($currentRoute === 'general-dashboard')
                            <i class="ti ti-check ms-auto text-success"></i>
                        @endif
                    </a>
                </li>
            @elseif($user && $user->userRoles->aka === 'DIR')
                <li>
                    <a href="{{ route('director-dashboard') }}" class="dropdown-item {{ $currentRoute === 'director-dashboard' ? 'active bg-light' : '' }}">
                        <i class="ti ti-home me-2"></i>
                        <span>DEFAULT (DIRECTOR)</span>
                        @if($currentRoute === 'director-dashboard')
                            <i class="ti ti-check ms-auto text-success"></i>
                        @endif
                    </a>
                </li>
            @elseif($user && $user->userRoles->aka === 'FD')
                <li>
                    <a href="{{ route('reservations-dashboard') }}" class="dropdown-item {{ $currentRoute === 'reservations-dashboard' ? 'active bg-light' : '' }}">
                        <i class="ti ti-home me-2"></i>
                        <span>DEFAULT (FRONT DESK)</span>
                        @if($currentRoute === 'reservations')
                            <i class="ti ti-check ms-auto text-success"></i>
                        @endif
                    </a>
                </li>
            @endif
            
            {{-- All available roles --}}
            @if($user && ($user->userRoles->aka === 'GM' || $user->userRoles->aka === 'DIR'))
                <li>
                    <a href="{{ route('reservations-dashboard') }}" class="dropdown-item {{ $currentRoute === 'reservations-dashboard' ? 'active bg-light' : '' }}">
                        <i class="ti ti-calendar me-2"></i>
                        <span>FRONT DESK</span>
                        @if($currentRoute === 'reservations-dashboard')
                            <i class="ti ti-check ms-auto text-success"></i>
                        @endif
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('general-dashboard') }}" class="dropdown-item {{ $currentRoute === 'general-dashboard' ? 'active bg-light' : '' }}">
                        <i class="ti ti-user-star me-2"></i>
                        <span>GENERAL MANAGER</span>
                        @if($currentRoute === 'general-dashboard')
                            <i class="ti ti-check ms-auto text-success"></i>
                        @endif
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('activity-log') }}" class="dropdown-item {{ $currentRoute === 'activity-log' ? 'active bg-light' : '' }}">
                        <i class="ti ti-truck me-2"></i>
                        <span>LOGISTICS</span>
                        @if($currentRoute === 'activity-log')
                            <i class="ti ti-check ms-auto text-success"></i>
                        @endif
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('main-dashboard') }}" class="dropdown-item {{ $currentRoute === 'main-dashboard' ? 'active bg-light' : '' }}">
                        <i class="ti ti-tools me-2"></i>
                        <span>MAINTENANCE</span>
                        @if($currentRoute === 'main-dashboard')
                            <i class="ti ti-check ms-auto text-success"></i>
                        @endif
                    </a>
                </li>
                
                <li>   
                    <a href="{{ route('dashboard') }}" class="dropdown-item {{ request()->is('fnb/dashboard') ? 'active bg-light' : '' }}">
                        <i class="ti ti-chef-hat me-2"></i>
                        <span>KITCHEN & RESTAURANT</span>
                        @if(request()->is('fnb/dashboard'))
                            <i class="ti ti-check ms-auto text-success"></i>
                        @endif
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('house-dashboard') }}" class="dropdown-item {{ $currentRoute === 'house-dashboard' ? 'active bg-light' : '' }}">
                        <i class="ti ti-bed me-2"></i>
                        <span>HOUSEKEEPING</span>
                        @if($currentRoute === 'house-dashboard')
                            <i class="ti ti-check ms-auto text-success"></i>
                        @endif
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('sales-dashboard') }}" class="dropdown-item {{ $currentRoute === 'sales-dashboard' ? 'active bg-light' : '' }}">
                        <i class="ti ti-chart-line me-2"></i>
                        <span>SALES & MARKETING</span>
                        @if($currentRoute === 'sales-dashboard')
                            <i class="ti ti-check ms-auto text-success"></i>
                        @endif
                    </a>
                </li>
            @elseif($user && $user->userRoles->aka === 'FD')
                {{-- Only Kitchen & Restaurant for Front Desk users, with limited View-just make orders(This behaviour will be based on demand by client) --}}
                <li>
                  <a href="{{ route('order') }}" class="dropdown-item {{ request()->is('fnb/order') ? 'active bg-light' : '' }}">
                        <i class="ti ti-chef-hat me-2"></i>
                        <span>KITCHEN & RESTAURANT</span>
                        @if(request()->is('fnb/order'))
                            <i class="ti ti-check ms-auto text-success"></i>
                        @endif
                    </a>
                </li>
            @endif
        </ul>
    </li>
    <!--/ Switch Roles -->
@endif
=======


      <ul class="navbar-nav flex-row align-items-center ms-auto">


        <!-- Language -->
        <li class="nav-item dropdown-language dropdown">
          <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
            <i class='ti ti-language rounded-circle ti-md'></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="javascript:void(0);" data-language="en" data-text-direction="ltr">
                <span>English</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="javascript:void(0);" data-language="fr" data-text-direction="ltr">
                <span>French</span>
              </a>
            </li>


          </ul>
        </li>
        <!--/ Language -->
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa

        <!-- Quick links  -->
        <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown">
          <a class="nav-link btn btn-text-secondary btn-icon rounded-pill btn-icon dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
            <i class='ti ti-layout-grid-add ti-md'></i>
          </a>
          <div class="dropdown-menu dropdown-menu-end p-0">
            <div class="dropdown-menu-header border-bottom">
              <div class="dropdown-header d-flex align-items-center py-3">
                <h6 class="mb-0 me-auto">System Shortcuts</h6>
                <a href="javascript:void(0)" class="btn btn-text-secondary rounded-pill btn-icon dropdown-shortcuts-add" data-bs-toggle="tooltip" data-bs-placement="top" title="Add shortcuts"><i class="ti ti-plus text-heading"></i></a>
              </div>
            </div>
            <div class="dropdown-shortcuts-list scrollable-container">
              <div class="row row-bordered overflow-visible g-0">
                <div class="dropdown-shortcuts-item col">
                  <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                    <i class="ti ti-calendar ti-26px text-heading"></i>
                  </span>
                  <a href="#" class="stretched-link">Calendar</a>
                  <small>Appointments</small>
                </div>
                <div class="dropdown-shortcuts-item col">
                  <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                    <i class="ti ti-file-dollar ti-26px text-heading"></i>
                  </span>
                  <a href="#" class="stretched-link">Invoices</a>
                  <small>Manage Accounts</small>
                </div>
              </div>
              <div class="row row-bordered overflow-visible g-0">
                <div class="dropdown-shortcuts-item col">
                  <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                    <i class="ti ti-user ti-26px text-heading"></i>
                  </span>
                  <a href="#" class="stretched-link">Users</a>
                  <small>Manage Users</small>
                </div>
                <div class="dropdown-shortcuts-item col">
                  <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                    <i class="ti ti-users ti-26px text-heading"></i>
                  </span>
                  <a href="#" class="stretched-link">Role Management</a>
                  <small>Permission</small>
                </div>
              </div>
              <div class="row row-bordered overflow-visible g-0">
                <div class="dropdown-shortcuts-item col">
                  <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                    <i class="ti ti-device-desktop-analytics ti-26px text-heading"></i>
                  </span>
                  <a href="#" class="stretched-link">Dashboard</a>
                  <small>User Dashboard</small>
                </div>
                <div class="dropdown-shortcuts-item col">
                  <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                    <i class="ti ti-settings ti-26px text-heading"></i>
                  </span>
                  <a href="#" class="stretched-link">Setting</a>
                  <small>Account Settings</small>
                </div>
              </div>
              <div class="row row-bordered overflow-visible g-0">
                <div class="dropdown-shortcuts-item col">
                  <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                    <i class="ti ti-help ti-26px text-heading"></i>
                  </span>
                  <a href="#" class="stretched-link">FAQs</a>
                  <small>FAQs & Articles</small>
                </div>
                <div class="dropdown-shortcuts-item col">
                  <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                    <i class="ti ti-square ti-26px text-heading"></i>
                  </span>
                  <a href="#" class="stretched-link">Modals</a>
                  <small>Useful Popups</small>
                </div>
              </div>
            </div>
          </div>
        </li>
        <!-- Quick links -->

        <!-- Notification -->
        <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
          <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
            <span class="position-relative">
              <i class="ti ti-bell ti-md"></i>
              <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
            </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end p-0">
            <li class="dropdown-menu-header border-bottom">
              <div class="dropdown-header d-flex align-items-center py-3">
                <h6 class="mb-0 me-auto"> User Notification Logs</h6>
                <div class="d-flex align-items-center h6 mb-0">
                  <span class="badge bg-label-primary me-2">8 New</span>
                  <a href="javascript:void(0)" class="btn btn-text-secondary rounded-pill btn-icon dropdown-notifications-all" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i class="ti ti-mail-opened text-heading"></i></a>
                </div>
              </div>
            </li>
            <li class="dropdown-notifications-list scrollable-container">
              <ul class="list-group list-group-flush">

                <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">

                </li>
                <li class="list-group-item list-group-item-action dropdown-notifications-item">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar">
<<<<<<< HEAD
                        <img alt class="rounded-circle">
=======
                        <img src="../../assets/img/avatars/6.png" alt class="rounded-circle">
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-1 small">New message from Maintenance</h6>
                      <small class="mb-1 d-block text-body">Your have new message from Mrs Jane</small>
                      <small class="text-muted">2 days ago</small>
                    </div>
                    <div class="flex-shrink-0 dropdown-notifications-actions">
                      <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                      <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                    </div>
                  </div>
                </li>
                <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar">
                        <span class="avatar-initial rounded-circle bg-label-warning"><i class="ti ti-alert-triangle"></i></span>
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-1 small">A reservation was cancelled</h6>
                      <small class="mb-1 d-block text-body">reservationI:D 78444547 was cancelled 28.63%, in the last last</small>
                      <small class="text-muted">3 days ago</small>
                    </div>
                    <div class="flex-shrink-0 dropdown-notifications-actions">
                      <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                      <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <li class="border-top">
              <div class="d-grid p-4">
                <a class="btn btn-primary btn-sm d-flex" href="javascript:void(0);">
                  <small class="align-middle">View all notifications</small>
                </a>
              </div>
            </li>
          </ul>
        </li>
        <!--/ Notification -->

        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
          <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">

                    <i class='menu-icon tf-icons ti ti-user'></i>

          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item mt-0" href="#">
                <div class="d-flex align-items-center">
                  <div class="flex-shrink-0 me-2">

                        <i class='menu-icon tf-icons ti ti-user'></i>

                  </div>
                  <div class="flex-grow-1">
                    <h6 class="mb-0">

                        {{auth()->user()->name}}

                    </h6>
    <small class="text-muted">@php
    $user = auth()->user()->load('userRoles') // load the relationship
    @endphp

 {{$user->userRoles->aka}}</small>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <div class="dropdown-divider my-1 mx-n2"></div>
            </li>
            <li>
              <a class="dropdown-item" href="#">
                <i class="ti ti-user me-3 ti-md"></i><span class="align-middle">My Profile</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#">
                <i class="ti ti-settings me-3 ti-md"></i><span class="align-middle">Settings</span>
              </a>
            </li>
            <li>

            </li>
            <li>
              <div class="dropdown-divider my-1 mx-n2"></div>
            </li>


            <li>
              <livewire:logout-button>
            </li>
          </ul>
        </li>
        <!--/ User -->



      </ul>
    </div>


    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper  d-none">
      <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search...">
      <i class="ti ti-x search-toggler cursor-pointer"></i>
    </div>



</nav>

<<<<<<< HEAD
<!-- / Navbar -->
=======
<!-- / Navbar -->
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
