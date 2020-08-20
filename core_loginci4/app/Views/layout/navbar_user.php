<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('/user'); ?>" class="nav-link">Home</a>
        </li> -->
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">

            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
                <span class="badge badge-warning navbar-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <center>

                    <img src="<?= base_url(); ?>\asset\images\user\<?= $user['image']; ?>" class="img-circle" alt="" height="200px">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item btn btn-outline-dark " href="#">
                        Edit Profil (lom setting)
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url(); ?>/logout" class="dropdown-item btn btn-outline-dark ">
                        Logout
                    </a>
                </center>
            </div>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> -->
    </ul>
</nav>
<!-- /.navbar -->


<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="<?= base_url(); ?>/user" class="brand-link navbar-primary">
        <img src="<?= base_url(); ?>/asset/images/logo_fisiart.png" alt="Fisiartsolution" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Fisiart Solution</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url(); ?>/asset/images/user/<?= $user['image']; ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $user['nama']; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/layout/top-nav.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top Navigation</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top Navigation + Sidebar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/boxed.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Boxed</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Sidebar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-topnav.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Navbar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-footer.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Footer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Collapsed Sidebar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <a href="<?= base_url('/logout'); ?>" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        Logout
                    </p>
                </a>

                <!-- <li class="nav-header">EXAMPLES</li> -->

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>