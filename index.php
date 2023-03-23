<?php

session_start();

require './koneksi.php';

if ($_SESSION['admin'] || $_SESSION['karyawan']) {
    if($_SESSION['admin']){
        $user = $_SESSION['admin'];
    }
    if($_SESSION['karyawan']){
        $user = '';
        $user = $_SESSION['karyawan'];
    }
}
else{
    header('location:login.php');
}


$sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$user' ");
$data = mysqli_fetch_assoc($sql);


?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Dashboard";

include 'head.php';

?>

<body>

    <?php

    include './navbar.php';

    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <?php
                        if ($data['level'] == 'Admin') {
                        ?>
                            <!-- Pengisian BBM Card -->
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card revenue-card">

                                    <div class="card-body">
                                        <h5 class="card-title">Total Pengisian BBM <span>| Per <?= date('Y')  ?></span></h5>

                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                            <div class="ps-3">
                                                <?php
                                                $Y = date('Y');
                                                $sql_total = mysqli_query($conn, "SELECT SUM(biaya_pengisian) AS total_pengisian FROM tb_rekap_pengisian_bbm WHERE tanggal > '" . $Y . "-01-00' && tanggal < '" . $Y . "-12-31' ");
                                                $data_total = mysqli_fetch_assoc($sql_total)
                                                ?>
                                                <h6><?= rupiah($data_total['total_pengisian']) ?></h6>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- End Pengisian BBM Card -->

                            <!-- Total Karyawan -->
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card customers-card">

                                    <div class="card-body">
                                        <h5 class="card-title">Total Karyawan</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-people"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>
                                                    <?php
                                                    $sql_karyawan = mysqli_query($conn, "SELECT count(id) AS jumlah FROM tb_user WHERE level = 'Karyawan' ");
                                                    $jumlah_karyawan = mysqli_fetch_array($sql_karyawan);
                                                    echo $jumlah_karyawan['jumlah']
                                                    ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- End Total Karyawan -->

                            <!-- Reports -->
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-body">
                                        <h5 class="card-title">Data Pengisian BBM <span>| Per <?= date('Y')  ?></span></h5>

                                        <!-- Bar Chart -->
                                        <canvas id="barChart" style="max-height: 400px;"></canvas>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", () => {
                                                new Chart(document.querySelector('#barChart'), {
                                                    type: 'bar',
                                                    data: {
                                                        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                                                        datasets: [{
                                                            label: 'Biaya Pengisian',
                                                            <?php
                                                            
                                                            include './data_pengisian_bbm_admin.php';

                                                            ?>
                                                            data: [<?= $data_jan['biaya'] ?>, <?= $data_feb['biaya'] ?>, <?= $data_mar['biaya'] ?>, <?= $data_aprl['biaya'] ?>, <?= $data_mei['biaya'] ?>, <?= $data_jun['biaya'] ?>, <?= $data_jul['biaya'] ?>, <?= $data_ags['biaya'] ?>, <?= $data_sep['biaya'] ?>, <?= $data_okt['biaya'] ?>, <?= $data_nov['biaya'] ?>, <?= $data_des['biaya'] ?>
                                                            ],
                                                            backgroundColor: [
                                                                'rgba(255, 99, 132, 0.2)',
                                                                'rgba(255, 159, 64, 0.2)',
                                                                'rgba(255, 205, 86, 0.2)',
                                                                'rgba(75, 192, 192, 0.2)',
                                                                'rgba(54, 162, 235, 0.2)',
                                                                'rgba(153, 102, 255, 0.2)',
                                                                'rgba(201, 203, 207, 0.2)',
                                                                'rgba(255, 99, 132, 0.2)',
                                                                'rgba(255, 159, 64, 0.2)',
                                                                'rgba(255, 205, 86, 0.2)',
                                                                'rgba(75, 192, 192, 0.2)',
                                                                'rgba(54, 162, 235, 0.2)'
                                                            ],
                                                            borderColor: [
                                                                'rgb(255, 99, 132)',
                                                                'rgb(255, 159, 64)',
                                                                'rgb(255, 205, 86)',
                                                                'rgb(75, 192, 192)',
                                                                'rgb(54, 162, 235)',
                                                                'rgb(153, 102, 255)',
                                                                'rgb(201, 203, 207)',
                                                                'rgba(255, 99, 132)',
                                                                'rgba(255, 159, 64)',
                                                                'rgba(255, 205, 86)',
                                                                'rgba(75, 192, 192)',
                                                                'rgba(54, 162, 235)'
                                                            ],
                                                            borderWidth: 1
                                                        }]
                                                    },
                                                    options: {
                                                        scales: {
                                                            y: {
                                                                beginAtZero: true
                                                            }
                                                        }
                                                    }
                                                });
                                            });
                                        </script>
                                        <!-- End Bar CHart -->

                                    </div>
                                </div>

                            </div>
                    </div><!-- End Reports -->

                    <!-- Top Selling -->
                    <div class="col-12" id="data_pengisian">
                        <div class="card top-selling overflow-auto">

                            <div class="card-body pb-0">
                                <h5 class="card-title mb-0">Data Pengisian BBM Karyawan <span>| s.d. <?= date('Y')  ?></span></h5>

                                <!-- Search Bar -->
                                <div class="mb-3 row">
                                    <div class="col-11">
                                        <form class="search-form d-flex align-items-center" method="POST" action="">
                                            <input type="text" name="search" placeholder="Search by nama karyawan" class="form-control" style="border-radius: 10px 0 0 10px;" required>
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
                                            <th scope="col">Nama Karyawan</th>
                                            <th scope="col">No Plat Kendaraan</th>
                                            <th scope="col">Tanggal Pengisian Terakhir</th>
                                            <th scope="col">Biaya Pengisian Terakhir</th>
                                            <th scope="col">Total Biaya Pengisian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        if (isset($_POST['search'])) {
                                            $nama = $_POST['search'];
                                            $query = mysqli_query($conn, "SELECT * FROM tb_karyawan WHERE total_pengisian != 0 && nama_karyawan LIKE '%$nama%' ORDER BY nama_karyawan ASC");
                                            echo "<script>window.location.href = './index.php#data_pengisian';</script>";
                                        } else {
                                            $query = mysqli_query($conn, "SELECT * FROM tb_karyawan WHERE total_pengisian != 0 ORDER BY nama_karyawan ASC");
                                        }
                                        while ($data_karyawan = mysqli_fetch_assoc($query)) {
                                            $sql_pengisian = mysqli_query($conn, "SELECT * FROM tb_rekap_pengisian_bbm WHERE username = '$data_karyawan[username]' ");
                                            $data_pengisian = mysqli_fetch_assoc($sql_pengisian);
                                        ?>
                                            <tr>
                                                <th scope="row"><?= $no++ ?></th>
                                                <td><a type="button" class="text-link" data-bs-toggle="modal" data-bs-target="#modalTransaksi<?= $data_pengisian['id'] ?>">00<?= $data_pengisian['id'] ?></a></td>
                                                <td><?= $data_karyawan['nama_karyawan'] ?></td>
                                                <td><?= $data_karyawan['no_plat'] ?></td>
                                                <td><?= $data_pengisian['tanggal'] ?></td>
                                                <td><?= rupiah($data_pengisian['biaya_pengisian']) ?></td>
                                                <td class="fw-bold"><?= rupiah($data_karyawan['total_pengisian']) ?></td>
                                            </tr>
                                        <?php
                                            include './detail_transaksi.php';
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Top Selling -->

                <?php
                        } else if ($data['level'] == 'Karyawan') {
                ?>
                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Data Pengisian BBM <span>| Per <?= date('Y')  ?></span></h5>

                                <!-- Bar Chart -->
                                <canvas id="barChart" style="max-height: 400px;"></canvas>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new Chart(document.querySelector('#barChart'), {
                                            type: 'bar',
                                            data: {
                                                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                                                datasets: [{
                                                    label: 'Sembunyikan Data',
                                                    <?php
                                                            
                                                    include './data_pengisian_bbm_karyawan.php';

                                                    ?>
                                                    data: [<?= $data_jan['biaya'] ?>, <?= $data_feb['biaya'] ?>, <?= $data_mar['biaya'] ?>, <?= $data_aprl['biaya'] ?>, <?= $data_mei['biaya'] ?>, <?= $data_jun['biaya'] ?>, <?= $data_jul['biaya'] ?>, <?= $data_ags['biaya'] ?>, <?= $data_sep['biaya'] ?>, <?= $data_okt['biaya'] ?>, <?= $data_nov['biaya'] ?>, <?= $data_des['biaya'] ?>
                                                    ],
                                                    backgroundColor: [
                                                        'rgba(255, 99, 132, 0.2)',
                                                        'rgba(255, 159, 64, 0.2)',
                                                        'rgba(255, 205, 86, 0.2)',
                                                        'rgba(75, 192, 192, 0.2)',
                                                        'rgba(54, 162, 235, 0.2)',
                                                        'rgba(153, 102, 255, 0.2)',
                                                        'rgba(201, 203, 207, 0.2)'
                                                    ],
                                                    borderColor: [
                                                        'rgb(255, 99, 132)',
                                                        'rgb(255, 159, 64)',
                                                        'rgb(255, 205, 86)',
                                                        'rgb(75, 192, 192)',
                                                        'rgb(54, 162, 235)',
                                                        'rgb(153, 102, 255)',
                                                        'rgb(201, 203, 207)'
                                                    ],
                                                    borderWidth: 1
                                                }]
                                            },
                                            options: {
                                                scales: {
                                                    y: {
                                                        beginAtZero: true
                                                    }
                                                }
                                            }
                                        });
                                    });
                                </script>
                                <!-- End Bar CHart -->

                            </div>
                        </div>

                    </div>
                </div><!-- End Reports -->

                <!-- Top Selling -->
                <div class="col-12">
                    <div class="card top-selling overflow-auto">

                        <div class="card-body pb-0">
                            <h5 class="card-title">Data Pengisian BBM Karyawan <span>| Per <?= date('Y')  ?></span></h5>

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
                                    $jumlah = 1;
                                    $query = mysqli_query($conn, "SELECT * FROM tb_rekap_pengisian_bbm WHERE username = '$data[username]' ORDER BY kilometer DESC ");
                                    while ($data_pengisian = mysqli_fetch_assoc($query) and $jumlah <= 3) {
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
                                        $jumlah++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="col-12 text-center pb-3">
                                <a href="./data_pengisian_bbm.php">Lihat Lainnya <i class="bi bi-arrow-right fw-bold"></i></a>
                            </div>

                        </div>

                    </div>
                </div><!-- End Top Selling -->

            <?php
                        }
            ?>

            </div>
            </div><!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->

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