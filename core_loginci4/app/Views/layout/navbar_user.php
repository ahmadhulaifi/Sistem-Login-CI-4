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
                    <a href="<?= base_url(); ?>/logout" class="dropdown-item btn btn-outline-dark" data-toggle="modal" data-target="#logoutModal">
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
                <!-- <li class="nav-header">Admin</li> -->
                <a href="<?= base_url('/user'); ?>" class="nav-link <?php echo ($title == 'Dashboard') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>

                <?php
                $db = \Config\Database::connect();
                // $builder = $db->table('users');

                $role_id = session('role_id');

                $querymenu = $db->table('user_menu')->select('user_menu.id,menu,icon')->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id')->where('user_access_menu.role_id', $role_id)->orderBy('user_access_menu.menu_id', 'ASC')->get()->getResultArray();

                ?>

                <!-- looping menu  -->
                <?php foreach ($querymenu as $m) : ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon <?= $m['icon']; ?>"></i>
                            <p>
                                <?= $m['menu']; ?>
                                <i class="fas fa-angle-left right"></i>
                                <!-- <span class="badge badge-info right">6</span> -->
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-pills nav-fill">

                            <!-- siapkan sub menu sesuai menu -->

                            <?php

                            $menuid = $m['id'];

                            $querysubmenu = $db->table('user_sub_menu')->select('user_sub_menu.id,user_sub_menu.sub_menu,user_sub_menu.url,user_sub_menu.icon,user_sub_menu.is_active')->join('user_menu', 'user_sub_menu.menu_id = user_menu.id')->where('user_sub_menu.menu_id', $menuid)->where('user_sub_menu.is_active', 1)->orderBy('user_sub_menu.menu_id', 'ASC')->get()->getResultArray();
                            ?>

                            <?php foreach ($querysubmenu as $sm) : ?>

                                <li class="nav-item">
                                    <a href="<?= base_url($sm['url']); ?>" class="sub_menu nav-link <?php echo ($title == $sm['sub_menu']) ? 'active' : '' ?>">
                                        <i class="<?= $sm['icon']; ?>"></i>
                                        <p><?= $sm['sub_menu']; ?></p>
                                    </a>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    </li>

                <?php endforeach; ?>


                <a href="" class="nav-link" data-toggle="modal" data-target="#logoutModal">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        Logout
                    </p>
                </a>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


<!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Yakin ingin Logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <a href="<?= base_url(); ?>/logout" type="button" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>