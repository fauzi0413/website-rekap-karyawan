<?php
session_start();

require './koneksi.php';

if ($_SESSION['karyawan']) {
    $user = $_SESSION['karyawan'];
}
else{
    header('location:login.php');
}

$sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$user' ");
$data = mysqli_fetch_assoc($sql);

if (isset($_POST['btn_submit'])) {

    $rand = rand();
    $tempdir = "bukti_pembayaran/";
    if (!file_exists($tempdir))
        mkdir($tempdir, 0755);
    //gambar akan di simpan di folder gambar
    $nama_gambar = $rand . '_' . basename($_FILES['bukti_pembayaran']['name']);
    $target_path = $tempdir . $nama_gambar;

    if (move_uploaded_file($_FILES['bukti_pembayaran']['tmp_name'], $target_path)) {
        $username = $_POST['username'];
        $kilometer = $_POST['kilometer'];
        $biaya_pengisian = $_POST['biaya_pengisian'];
        $tanggal = $_POST['tanggal'];
        $keterangan = $_POST['keterangan'];

        if($tanggal <= date('Y-m-d')){
            mysqli_query($conn, "INSERT INTO tb_rekap_pengisian_bbm VALUES ('', '$tanggal', '$username', '$kilometer', '$biaya_pengisian', '$keterangan', '$nama_gambar')");

            $sql = mysqli_query($conn, "SELECT * FROM tb_karyawan WHERE username = '$data[username]' ");
            $data = mysqli_fetch_assoc($sql);

            $total_pengisian = $data['total_pengisian'] + $biaya_pengisian;

            mysqli_query($conn, "UPDATE tb_karyawan SET total_pengisian = $total_pengisian WHERE username = '$username' ");

            echo "<script>
                window.alert('Data berhasil ditambahkan!');
                window.location.href = './data_pengisian_bbm.php';
            </script>";
        }
        else{
            echo "<script>
                window.alert('Tanggal pengisian tidak boleh melebihi tanggal hari ini!');
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Tambah Data Pengisian BBM";

include 'head.php';

?>

<body>

    <?php

    include './navbar.php';

    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah Data Pengisian BBM</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="./data_pengisian_bbm.php">Data Pengisian BBM</a></li>
                    <li class="breadcrumb-item active">Tambah Data Pengisian BBM</li>
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
                                    <form method="post" enctype='multipart/form-data'>
                                        <input type="hidden" class="form-control" id="username" name="username" placeholder="ex : dea123" value="<?= $data['username'] ?>">

                                        <div class="row mb-3">
                                            <label for="kilometer" class="col-sm-2 col-form-label">Kilometer</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" id="kilometer" name="kilometer" placeholder="ex : 100" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="biaya_pengisian" class="col-sm-2 col-form-label">Biaya Pengisian BBM</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" id="biaya_pengisian" name="biaya_pengisian" placeholder="ex : 100000" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="email" class="col-sm-2 col-form-label">Tanggal Pengisian</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="no_telpon" class="col-sm-2 col-form-label">Keterangan</label>
                                            <div class="col-sm-10">
                                                <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keperluan BBM" required></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="bukti_pembayaran" class="col-sm-2 col-form-label">Bukti Pembayaran</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary" name="btn_submit">Submit</button>
                                            <a href="./create_pengisian_bbm.php" class="btn btn-danger">Reset</a>
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