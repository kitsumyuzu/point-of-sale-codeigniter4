        <div class="container-scroller">
            <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo mr-5" href="/Home/"><img src="<?= base_url('/assets/images/items') ?>/logo-brand-expand.png" class="mr-2" alt="logo"></a>
                    <a class="navbar-brand brand-logo-mini" href="/Home/"><img src="<?= base_url('/assets/images/items') ?>/logo-brand-collapse.png" alt="logo"></a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown"><img src="<?= base_url('assets/images/'.($settings -> profile ? $settings -> profile : 'default-profile.png')) ?>" alt="profile"/></a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item">
                                    <i class="ti-settings text-primary"></i>Settings
                                </a>
                                <a href="<?= base_url('/home/authentication_logout') ?>" class="dropdown-item">
                                    <i class="ti-power-off text-primary"></i>Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="icon-menu"></span>
                    </button>
                </div>
            </nav>

            <div class="container-fluid page-body-wrapper">

                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <!-- Start: Menu -->
                        <ul class="nav">

                            <li class="nav-item">
                                <a class="nav-link" href="/home/dashboard/?">
                                    <i class="fas fa-house-chimney menu-icon"></i>
                                    <span class="menu-title">Dashboard</span>
                                </a>
                            </li>

                        <hr style="background-color: #ffffff; height: 2px;">

                            <li class="nav-item">
                                <a class="nav-link" href="/Produk/view_kategori/?">
                                    <i class="fas fa-cube menu-icon"></i>
                                    <span class="menu-title">Kategori</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/Produk/?">
                                    <i class="fas fa-cube menu-icon"></i>
                                    <span class="menu-title">Produk</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/Home/view_member/?">
                                    <i class="fas fa-id-card-clip menu-icon"></i>
                                    <span class="menu-title">Member</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/Home/view_supplier/?">
                                    <i class="fas fa-user-tie menu-icon"></i>
                                    <span class="menu-title">Supplier</span>
                                </a>
                            </li>

                        <hr>

                            <li class="nav-item">
                                <a class="nav-link" href="/Laporan/view_pengeluaran/?">
                                    <i class="fas fa-sack-dollar menu-icon"></i>
                                    <span class="menu-title">Pengeluaran</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/Laporan/view_pembelian/?">
                                    <i class="fas fa-truck-fast menu-icon"></i>
                                    <span class="menu-title">Pembelian</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/Laporan/view_penjualan/?">
                                    <i class="fas fa-user-tag menu-icon"></i>
                                    <span class="menu-title">Penjualan</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/Laporan/view_transaksi_baru/?">
                                    <i class="fas fa-cart-shopping menu-icon"></i>
                                    <span class="menu-title">Transaksi</span>
                                </a>
                            </li>

                        <hr>

                            <li class="nav-item">
                                <a class="nav-link" href="/Laporan/?">
                                    <i class="fas fa-file menu-icon"></i>
                                    <span class="menu-title">Laporan</span>
                                </a>
                            </li>

                        <hr>

                            <li class="nav-item">
                                <a class="nav-link" href="/User/?">
                                    <i class="fas fa-circle-user menu-icon"></i>
                                    <span class="menu-title">User</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-gear menu-icon"></i>
                                    <span class="menu-title">Setting</span>
                                </a>
                            </li>

                        </ul>
                    <!-- End: Menu -->
                </nav>