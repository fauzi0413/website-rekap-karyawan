<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="./index.php" class="logo d-flex align-items-center">
            <img src="assets/img/icon.png" alt="">
            <span class="d-none d-lg-block ms-2">Rekap Karyawan</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

                    <?php
                    if ($data['foto_profil'] == '') {
                        if ($data['jenis_kelamin'] == 'L') {
                    ?>
                            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <?php
                        } else {
                        ?>
                            <img src="assets/img/messages-1.jpg" alt="Profile" class="rounded-circle">
                        <?php
                        }
                    } else {
                        ?>
                        <img src="./profile/<?= $data['foto_profil'] ?>" alt="Profile" class="rounded-circle" style="max-width: 40px; height: 50px;">
                    <?php
                    }
                    ?>

                    <span class="d-none d-md-block dropdown-toggle ps-2"><?= $data['nama_user'] ?></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?= $data['nama_user'] ?></h6>
                        <span><?= $data['level'] ?></span>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="./profile.php">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="./logout.php">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="./index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->


        <?php
        if ($data['level'] == 'Admin') {
        ?>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-card-list"></i><span>Data Akun</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="./data_akun.php?level=Karyawan">
                            <i class="bi bi-circle"></i><span>Karyawan</span>
                        </a>
                    </li>
                    <li>
                        <a href="./data_akun.php?level=Admin">
                            <i class="bi bi-circle"></i><span>Admin</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Tables Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="./data_pengisian_bbm.php">
                    <i class="bi bi-menu-button-wide"></i>
                    <span>Data Pengisian BBM</span>
                </a>
            </li><!-- End Dashboard Nav -->
        <?php
        } elseif ($data['level'] == 'Karyawan') {
        ?>

            <li class="nav-item">
                <a class="nav-link collapsed" href="./data_pengisian_bbm.php">
                    <i class="bi bi-menu-button-wide"></i>
                    <span>Data Pengisian BBM</span>
                </a>
            </li><!-- End Dashboard Nav -->

        <?php
        }
        ?>

        <li class="nav-item">
            <a class="nav-link collapsed" href="./profile.php">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->
    </ul>

</aside><!-- End Sidebar-->