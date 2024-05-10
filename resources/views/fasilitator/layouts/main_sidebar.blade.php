<!-- Brand Logo -->
<a href="index3.html" class="brand-link">
    <img src="{{ asset('template/dist/img/markopi.png') }}" alt="markopi" class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">Markopi</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('template/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">Fasilitator Markopi</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="/dashboard" class="nav-link {{ \Route::is('dashboard') ? 'active' : '' }}">
                    <i class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8h5z" />
                        </svg>
                    </i>
                    <p>
                        Beranda
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
