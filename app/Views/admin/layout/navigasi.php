<!-- <php $request = service('request'); ?> -->
<!-- Menu -->


<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?= base_url() ?>" class="app-brand-link">
            <img src="<?= base_url('images/default_avatar.png'); ?>" width="50" alt="" />

            <span class="app-brand-text demo menu-text fw-bolder ms-2"><?= session()->get('user_data')['full_name'] ?></span>
        </a>

        <!-- <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a> -->
        <!-- <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a> -->
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <!-- Dashboard -->
        <li class="menu-item <?= $uri1 === 'dashboard' ? "active" : "" ?>">
            <a href="<?= base_url('dashboard') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Halaman</span>
        </li>
        <li class="menu-item <?= $uri1 === 'kriteria' ? "active" : "" ?>">
            <a href="<?= base_url('kriteria') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-spa"></i>
                <div data-i18n="Boxicons">Data Kriteria</div>
            </a>
        </li>
        <li class="menu-item <?= $uri1 === 'subkriteria' ? "active" : "" ?>">
            <a href="<?= base_url('subkriteria') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-extension"></i>
                <div data-i18n="Boxicons">Data Sub Kriteria</div>
            </a>
        </li>
        <li class="menu-item <?= $uri1 === 'alternatif' ? "active" : "" ?>">
            <a href="<?= base_url('alternatif') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="alternatif">Data Alternatif</div>
            </a>
        </li>
        <li class="menu-item <?= $uri1 === 'penilaian' ? "active" : "" ?>">
            <a href="<?= base_url('penilaian') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-check-shield"></i>
                <div data-i18n="penilaian">Data Penilaian</div>
            </a>
        </li>
        <li class="menu-item <?= $uri1 === 'perhitungan' ? "active" : "" ?>">
            <a href="<?= base_url('perhitungan') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calculator"></i>
                <div data-i18n="perhitungan">Data Perhitungan</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Setting Aplikasi</span>
        </li>

        <!-- <li class="menu-item <= $uri1 === 'setting' ? "active" : "" ?>">
            <a href="<= base_url('setting') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Boxicons">Setting Website</div>
            </a>
        </li> -->
        <li class="menu-item <?= $uri1 === 'usermanajemen' ? "active" : "" ?>">
            <a href="<?= base_url('usermanajemen') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Boxicons">User Manajemen</div>
            </a>
        </li>

    </ul>
</aside>
<!-- / Menu -->

<!-- Layout container -->
<div class="layout-page">
    <!-- <style>
        #clock {
            font-size: 2rem;
            letter-spacing: 7px;
            text-shadow: 0px 2px 2px rgba(0, 0, 0, 0.4);

        }

        #date {
            font-size: 1rem;
            letter-spacing: 2px;


        }

        .shortcut-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .shortcut-card:hover {
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.5);
            transform: translateY(-5px);
        }
    </style> -->
    <!-- Navbar -->

    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-primary" id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <span class="app-brand-text demo" style="text-transform: capitalize !important;">SPK MAUT</span>
                </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->


                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="<?= base_url('images/default_avatar.png'); ?>" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="menu-item">
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="<?= base_url('images/default_avatar.png'); ?>" alt class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block"><?= session()->get('user_data')['full_name'] ?></span>
                                        <small class="text-muted"><?= session()->get('user_data')['level'] ?></small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>

                        <li class="menu-item">
                            <a class="dropdown-item" href="<?= base_url('setting-akun') ?>">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">Setting Akun</span>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="<?= base_url('login/logout') ?>">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </nav>

    <!-- / Navbar -->

    <!-- Content wrapper -->