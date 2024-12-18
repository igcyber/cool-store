<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
      <div class="sidebar-brand-icon">
        <i class="fab fa-apple"></i>
      </div>
      <div class="sidebar-brand-text mx-3">APPLE STORE</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('admin/dashboard*') ? ' active' :  '' }}">
      <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>DASHBOARD</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      PRODUK
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('admin/category*') ? ' active' :  '' }} {{ Request::is('admin/product*') ? ' active' :  '' }}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa fa-shopping-bag"></i>
        <span>PRODUK</span>
      </a>
      <div id="collapseTwo" class="collapse {{ Request::is('admin/category*') ? ' show' :  '' }} {{ Request::is('admin/product*') ? ' show' :  '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">KATEGORI & PRODUK</h6>
          <a class="collapse-item {{ Request::is('admin/category*') ? ' active' : '' }}" href="#">KATEGORI</a>
          <a class="collapse-item {{ Request::is('admin/product*') ? ' active' : '' }}" href="#">PRODUK</a>
        </div>
      </div>
    </li>

    <div class="sidebar-heading">
      ORDERS
    </div>

    <li class="nav-item {{ Request::is('admin/order*') ? ' active' :  '' }}">
      <a class="nav-link" href="#">
        <i class="fas fa-shopping-cart"></i>
        <span>ORDERS</span></a>
    </li>

    <li class="nav-item {{ Request::is('admin/customer*') ? ' active' :  '' }}">
      <a class="nav-link" href="#">
        <i class="fas fa-users"></i>
        <span>CUSTOMERS</span></a>
    </li>

    <li class="nav-item {{ Request::is('admin/slider*') ? ' active' :  '' }}">
      <a class="nav-link" href="#">
        <i class="fas fa-laptop"></i>
        <span>SLIDERS</span></a>
    </li>

    <li class="nav-item {{ Request::is('admin/profile*') ? ' active' :  '' }}">
      <a class="nav-link" href="#">
        <i class="fas fa-user-circle"></i>
        <span>PROFILE</span></a>
    </li>

    <li class="nav-item {{ Request::is('admin/user*') ? ' active' :  '' }}">
      <a class="nav-link" href="#">
        <i class="fas fa-users"></i>
        <span>USERS</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
