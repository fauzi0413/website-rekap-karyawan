<?php
session_start();

require './koneksi.php';

$user = $_SESSION['admin'];

$sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$user' ");
$data = mysqli_fetch_assoc($sql);

if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}

$username = $_GET['username'];

if (isset($_POST['btn_update'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $email = $_POST['email'];
    $no_telpon = $_POST['no_telpon'];
    $level = $_POST['level'];

    // tambahan data karyawan
    $nama_kendaraan = $_POST['nama_kendaraan'];
    $no_plat = $_POST['no_plat'];

    mysqli_query($conn, "UPDATE tb_user SET password = '$password', nama_user = '$nama_lengkap', jenis_kelamin = '$jenis_kelamin', no_telpon = '$no_telpon', email = '$email' WHERE username = '$username' ");

    if ($level == 'Karyawan') {
        mysqli_query($conn, "UPDATE tb_karyawan SET nama_karyawan = '$nama_lengkap', nama_kendaraan = '$nama_kendaraan', no_plat = '$no_plat' WHERE username = '$username' ");
    }

    echo "<script>
            window.alert('Data berhasil diubah!');
            window.location.href = './data_akun.php?level=$level';
        </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Ubah Akun";

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

            <h1>Ubah Data <?= $level ?></h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="./data_akun.php?level=<?= $level ?>">Data <?= $level ?></a></li>
                    <li class="breadcrumb-item active">Ubah Data <?= $level ?></li>
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

                                <div class="card-body py-4">

                                    <!-- Horizontal Form -->
                                    <form method="post">
                                        <div class="row mb-3">
                                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="username" name="username" placeholder="ex : dea123" value="<?= $username ?>" disabled>
                                            </div>
                                        </div>

                                        <?php


                                        $sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' ");
                                        $data = mysqli_fetch_assoc($sql);

                                        ?>

                                        <input type="hidden" name="username" value="<?= $data['username'] ?>">
                                        <input type="hidden" name="level" value="<?= $data['level'] ?>">
                                        <div class="row mb-3">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputPassword" name="password" placeholder="ex : dea123" value="<?= $data['password'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="ex : Dea Anastasia Priadi" value="<?= $data['nama_user'] ?>" required>
                                            </div>
                                        </div>
                                        <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="L" <?php if ($data['jenis_kelamin'] == 'L') echo 'checked' ?>>
                                                    <label class="form-check-label" for="laki">
                                                        Laki-laki
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" <?php if ($data['jenis_kelamin'] == 'P') echo 'checked' ?>>
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Perempuan
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="row mb-3">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="ex : dea123@gmail.com" value="<?= $data['email'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="no_telpon" class="col-sm-2 col-form-label">No Telpon</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="no_telpon" name="no_telpon" placeholder="ex : 082112014647" value="<?= $data['no_telpon'] ?>" required>
                                            </div>
                                        </div>
                                        <?php
                                        if ($level == 'Karyawan') {
                                            $sql = mysqli_query($conn, "SELECT * FROM tb_karyawan WHERE username = '$username' ");
                                            $data = mysqli_fetch_assoc($sql);
                                        ?>
                                            <div class="row mb-3">
                                                <label for="nama_kendaraan" class="col-sm-2 col-form-label">Nama Kendaraan</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="nama_kendaraan" name="nama_kendaraan" placeholder="ex : Toyota Avanza" value="<?= $data['nama_kendaraan'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="no_plat" class="col-sm-2 col-form-label">No Plat Kendaraan</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="no_plat" name="no_plat" placeholder="ex : B 1234 BKS" value="<?= $data['no_plat'] ?>" required>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary" name="btn_update" onclick="return confirm('Apakah anda yakin ingin mengubah data tersebut?')">Update</button>
                                        </div>
                                    </form><!-- End Horizontal Form -->

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