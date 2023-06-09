<?php

session_start();

require './koneksi.php';
require './data_pengisian_bbm_admin.php';

if ($_SESSION['admin'] || $_SESSION['karyawan']) {
    if ($_SESSION['admin']) {
        $user = $_SESSION['admin'];
    } else if ($_SESSION['karyawan']) {
        $user = $_SESSION['karyawan'];
    }
} else {
    header('location:login.php');
}

$sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$user' ");
$data = mysqli_fetch_assoc($sql);

?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Data Pengisian BBM";

include 'head.php';

?>

<body>

    <?php

    include './navbar.php';

    ?>

    <main id="main" class="main">

        <div class="pagetitle row">
            <div class="col-10">
                <h1>Data Pengisian BBM Karyawan</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                        <li class="breadcrumb-item active">Data Pengisian BBM</li>
                    </ol>
                </nav>
            </div>
            <div class="col-2 ">
                <?php
                if ($data['level'] == "Admin") {
                    if ($_GET['bulan'] != "") {
                ?>
                        <a href="./cetak_data_pengisian_bbm.php?bulan=<?= $_GET['bulan'] ?>" class="btn btn-success">Print <i class="ms-1 bi bi-printer-fill"></i></a>
                    <?php
                    } else {
                    ?>
                        <a href="./cetak_data_pengisian_bbm.php" class="btn btn-success">Print <i class="ms-1 bi bi-printer-fill"></i></a>
                <?php
                    }
                }
                ?>
            </div>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Main columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Data Karyawan -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">

                                <div class="card-body pb-0">

                                    <?php
                                    // 
                                    // TABEL UNTUK KARYAWAN
                                    // 
                                    if ($data['level'] == "Karyawan") {
                                        $sql_karyawan = mysqli_query($conn, "SELECT * FROM tb_karyawan WHERE username = '$data[username]' ");
                                        $data_karyawan = mysqli_fetch_assoc($sql_karyawan);

                                        $query = mysqli_query($conn, "SELECT * FROM tb_rekap_pengisian_bbm WHERE username = '$data[username]' ORDER BY kilometer DESC");
                                        $data_pengisian = mysqli_fetch_assoc($query);
                                    ?>
                                        <div class="row ms-1">
                                            <h5 class="col-10 card-title">Total Pengisian BBM : <span class="text-dark fw-bold fs-5"><?= rupiah($data_karyawan['total_pengisian']) ?></span> <br class="mb-2"> Kilometer Terakhir : <span class="text-dark fw-bold fs-5">
                                                    <?php
                                                    if (mysqli_num_rows($query) == 0) {
                                                        echo 0;
                                                    } else {
                                                        echo jarak($data_pengisian['kilometer']);
                                                    }
                                                    ?></span></h5>

                                            <a href="./create_pengisian_bbm.php" class="col-2 my-auto"><span class="btn btn-success"><i class="bi-plus-lg"></i> Tambah</span></a>
                                        </div>

                                        <!-- Search Bar -->
                                        <div class="mb-3 row">
                                            <div class="col-11">
                                                <form class="search-form d-flex align-items-center" method="POST" action="">
                                                    <input type="text" name="search" placeholder="Search by kode transaksi" class="form-control" style="border-radius: 10px 0 0 10px;" required>
                                                    <button type="submit" class="btn btn-primary" style="border-radius: 0 10px 10px 0;"><i class="bi bi-search"></i></button>
                                                </form>
                                            </div>
                                            <div class="col-1">
                                                <a href="" class="btn btn-danger py-1 my-auto" title="Refresh Page"><i class="bi bi-arrow-clockwise fs-5"></i></a>
                                            </div>
                                        </div><!-- End Search Bar -->

                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Kode Transaksi</th>
                                                    <th scope="col">Tanggal Pengisian</th>
                                                    <th scope="col">Biaya Pengisian</th>
                                                    <th scope="col">Kilometer</th>
                                                    <th scope="col" class="text-center col-2"><i class="bi bi-gear-fill"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                if (isset($_POST['search'])) {
                                                    $id = substr($_POST['search'], 2);
                                                    $query = mysqli_query($conn, "SELECT * FROM tb_rekap_pengisian_bbm WHERE username = '$data[username]' && id = '$id' ");
                                                } else {
                                                    $query = mysqli_query($conn, "SELECT * FROM tb_rekap_pengisian_bbm WHERE username = '$data[username]' ORDER BY kilometer DESC ");
                                                }
                                                while ($data_pengisian = mysqli_fetch_assoc($query)) {
                                                    $sql_karyawan = mysqli_query($conn, "SELECT * FROM tb_karyawan WHERE username = '$data_pengisian[username]' ");
                                                    $data_karyawan = mysqli_fetch_assoc($sql_karyawan);
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?= $no++ ?></th>
                                                        <td><a type="button" class="text-link" data-bs-toggle="modal" data-bs-target="#modalTransaksi<?= $data_pengisian['id'] ?>">00<?= $data_pengisian['id'] ?></a></td>
                                                        <td><?= $data_pengisian['tanggal'] ?></td>
                                                        <td><?= rupiah($data_pengisian['biaya_pengisian']) ?></td>
                                                        <td><?= jarak($data_pengisian['kilometer']) ?></td>
                                                        <td class="text-center">
                                                            <a href="./update_pengisian_bbm.php?id=<?= $data_pengisian['id'] ?>" class="me-1">Ubah</a>
                                                            <a href="./delete_pengisian_bbm.php?username=<?= $data_karyawan['username'] ?>&id=<?= $data_pengisian['id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data tersebut?')" class="ms-1">Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    include './detail_transaksi.php';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php
                                        // 
                                        // TABEL UNTUK ADMIN
                                        // 
                                    } elseif ($data['level'] == "Admin") {
                                    ?>
                                        <!-- Search Bar -->
                                        <div class="my-3 row">
                                            <div class="col-7">
                                                <form class="search-form d-flex align-items-center" method="POST" action="">
                                                    <input type="text" name="search" placeholder="Search by kode transaksi" class="form-control" style="border-radius: 10px 0 0 10px;" required>
                                                    <button type="submit" class="btn btn-primary" style="border-radius: 0 10px 10px 0;"><i class="bi bi-search"></i></button>
                                                </form>
                                            </div>
                                            <div class="col-4">
                                                <div class="dropdown">
                                                    <button class="w-100 btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Filter Berdasarkan Bulan
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="?bulan=1">Januari</a></li>
                                                        <li><a class="dropdown-item" href="?bulan=2">Februari</a></li>
                                                        <li><a class="dropdown-item" href="?bulan=3">Maret</a></li>
                                                        <li><a class="dropdown-item" href="?bulan=4">April</a></li>
                                                        <li><a class="dropdown-item" href="?bulan=5">Mei</a></li>
                                                        <li><a class="dropdown-item" href="?bulan=6">Juni</a></li>
                                                        <li><a class="dropdown-item" href="?bulan=7">Juli</a></li>
                                                        <li><a class="dropdown-item" href="?bulan=8">Agustus</a></li>
                                                        <li><a class="dropdown-item" href="?bulan=9">September</a></li>
                                                        <li><a class="dropdown-item" href="?bulan=10">Oktober</a></li>
                                                        <li><a class="dropdown-item" href="?bulan=11">November</a></li>
                                                        <li><a class="dropdown-item" href="?bulan=12">Desember</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <a href="./data_pengisian_bbm.php" class="btn btn-danger py-1 my-auto" title="Refresh Page"><i class="bi bi-arrow-clockwise fs-5"></i></a>
                                            </div>
                                        </div><!-- End Search Bar -->

                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Kode Transaksi</th>
                                                    <th scope="col">Nama Karyawan</th>
                                                    <th scope="col">No Plat Kendaraan</th>
                                                    <th scope="col">Tanggal Pengisian</th>
                                                    <th scope="col">Biaya Pengisian</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;

                                                $Y = date('Y');
                                                $bulan = $_GET['bulan'];
                                                if ($bulan < 10) {
                                                    $tanggal_bulan = "00";
                                                    $awal_bulan = "0" . $_GET['bulan'];
                                                    $akhir_bulan = "0" . $_GET['bulan'] + 1;
                                                } else {
                                                    $tanggal_bulan = "00";
                                                    $awal_bulan = $_GET['bulan'];
                                                    if ($bulan == "12") {
                                                        $akhir_bulan = $_GET['bulan'];
                                                        $tanggal_bulan = "31";
                                                    } else {
                                                        $akhir_bulan = $_GET['bulan'] + 1;
                                                    }
                                                }

                                                if ($bulan) {
                                                    if (isset($_POST['search'])) {
                                                        $id = substr($_POST['search'], 2);
                                                        $query = mysqli_query($conn, "SELECT * FROM tb_rekap_pengisian_bbm WHERE id = '$id' && tanggal > '" . $Y . "-" . $awal_bulan . "-00' && tanggal < '" . $Y . "-" . $akhir_bulan . "-" . $tanggal_bulan . "' ORDER BY tanggal DESC");
                                                    } else {
                                                        $query = mysqli_query($conn, "SELECT * FROM tb_rekap_pengisian_bbm WHERE tanggal > '" . $Y . "-" . $awal_bulan . "-00' && tanggal < '" . $Y . "-" . $akhir_bulan . "-" . $tanggal_bulan . "' ORDER BY tanggal DESC");
                                                    }
                                                } else {
                                                    if (isset($_POST['search'])) {
                                                        $id = substr($_POST['search'], 2);
                                                        $query = mysqli_query($conn, "SELECT * FROM tb_rekap_pengisian_bbm WHERE id = '$id' ORDER BY tanggal DESC");
                                                    } else {
                                                        $query = mysqli_query($conn, "SELECT * FROM tb_rekap_pengisian_bbm ORDER BY tanggal DESC");
                                                    }
                                                }
                                                while ($data_pengisian = mysqli_fetch_assoc($query)) {
                                                    $sql_karyawan = mysqli_query($conn, "SELECT * FROM tb_karyawan WHERE username = '$data_pengisian[username]' ");
                                                    $data_karyawan = mysqli_fetch_assoc($sql_karyawan);
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?= $no++ ?></th>
                                                        <td><a type="button" class="text-link" data-bs-toggle="modal" data-bs-target="#modalTransaksi<?= $data_pengisian['id'] ?>">00<?= $data_pengisian['id'] ?></a></td>
                                                        <td><?= $data_karyawan['nama_karyawan'] ?></td>
                                                        <td><?= $data_karyawan['no_plat'] ?></td>
                                                        <td><?= $data_pengisian['tanggal'] ?></td>
                                                        <td><?= rupiah($data_pengisian['biaya_pengisian']) ?></td>
                                                    </tr>
                                                <?php
                                                    include './detail_transaksi.php';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php
                                    }
                                    ?>

                                </div>

                            </div>
                        </div><!-- End Data Karyawan -->

                    </div>
                </div><!-- End Main side columns -->

            </div>
        </section><!-- Modal -->

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <!-- <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer> -->
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>