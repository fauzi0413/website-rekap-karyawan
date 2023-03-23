<?php

session_start();

require './koneksi.php';

if ($_SESSION['admin']) {
    if ($_SESSION['admin']) {
        $user = $_SESSION['admin'];
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
$title = "Data Akun";

include 'head.php';

?>

<body>

    <?php

    include './navbar.php';

    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <?php
            $level = $_GET['level'];
            ?>

            <h1>Data <?= $level ?></h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                    <li class="breadcrumb-item active">Data <?= $level ?></li>
                </ol>
            </nav>
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
                                    <div class="row ms-1">
                                        <h5 class="card-title col-10">Data Akun <?= $level ?></h5>

                                        <a href="./create.php?level=<?= $level ?>" class="col-2 my-auto"><span class="btn btn-success"><i class="bi-plus-lg"></i> Tambah</span></a>
                                    </div>

                                    <!-- Search Bar -->
                                    <div class="mb-3 row">
                                        <div class="col-11">
                                            <form class="search-form d-flex align-items-center" method="POST" action="">
                                                <input type="text" name="search" placeholder="Search by username" class="form-control" style="border-radius: 10px 0 0 10px;" required>
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
                                                <th scope="col">Nama User</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Password</th>
                                                <th scope="col">Level</th>
                                                <th scope="col" class="text-center"><i class="bi bi-gear-fill"></i></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $no = 1;
                                            if (isset($_POST['search'])) {
                                                $username = $_POST['search'];
                                                $sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' && level = '$level' ");
                                            } else {
                                                $sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE level = '$level' ");
                                            }
                                            while ($data = mysqli_fetch_assoc($sql)) {
                                            ?>

                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $data['nama_user'] ?></td>
                                                    <td><a type="button" class="text-link fw-bold" data-bs-toggle="modal" data-bs-target="#modalTransaksi<?= $data['id'] ?>"><?= $data['username'] ?></a></td>
                                                    <td><?= $data['password'] ?></td>
                                                    <td><?= $data['level'] ?></td>
                                                    <td class="text-center">
                                                        <a href="./update.php?username=<?= $data['username'] ?>&level=<?= $level ?>" class="me-1">Ubah</a>
                                                        <a href="./delete.php?username=<?= $data['username'] ?>&level=<?= $level ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data tersebut?')" class="ms-1">Hapus</a>
                                                    </td>
                                                </tr>

                                            <?php
                                                include './detail_akun.php';
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Data Karyawan -->

                    </div>
                </div><!-- End Main side columns -->

            </div>
        </section>

    </main><!-- End #main -->

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