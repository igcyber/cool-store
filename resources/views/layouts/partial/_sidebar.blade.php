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
    <li class="nav-item {{ Request::is('admin/categories*') ? ' active' :  '' }} {{ Request::is('admin/product*') ? ' active' :  '' }}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa fa-shopping-bag"></i>
        <span>PRODUK</span>
      </a>
      <div id="collapseTwo" class="collapse {{ Request::is('admin/categories*') ? ' show' :  '' }} {{ Request::is('admin/products*') ? ' show' :  '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">KATEGORI & PRODUK</h6>
          <a class="collapse-item {{ Request::is('admin/categories*') ? ' active' : '' }}" href="{{ route('admin.categories.index') }}">KATEGORI</a>
          <a class="collapse-item {{ Request::is('admin/products*') ? ' active' : '' }}" href="{{ route('admin.products.index') }}">PRODUK</a>
        </div>
      </div>
    </li>

    <div class="sidebar-heading">
      PESANAN
    </div>

    <li class="nav-item {{ Request::is('admin/orders*') ? ' active' :  '' }}">
      <a class="nav-link" href="{{ route('admin.orders.index') }}">
        <i class="fas fa-shopping-cart"></i>
        <span>PESANAN</span></a>
    </li>

    <li class="nav-item {{ Request::is('admin/customer*') ? ' active' :  '' }}">
      <a class="nav-link" href="{{ route('admin.customer.index') }}">
        <i class="fas fa-users"></i>
        <span>CUSTOMERS</span></a>
    </li>

    <li class="nav-item {{ Request::is('admin/sliders*') ? ' active' :  '' }}">
      <a class="nav-link" href="{{ route('admin.sliders.index') }}">
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
