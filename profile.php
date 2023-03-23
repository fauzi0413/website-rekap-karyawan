<?php
error_reporting(0);

session_start();

require './koneksi.php';

if ($_SESSION['admin'] || $_SESSION['karyawan']) {
    if ($_SESSION['admin']) {
        $user = $_SESSION['admin'];
    } else if ($_SESSION['karyawan']) {
        $user = $_SESSION['karyawan'];
    }
}
else{
    header('location:login.php');
}


$sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$user' ");
$data = mysqli_fetch_assoc($sql);


if (isset($_POST['btn_ubah'])) {
    if (isset($_POST['ubah_foto'])) {

        $rand = rand();
        $tempdir = "profile/";
        if (!file_exists($tempdir))
            mkdir($tempdir, 0755);
        //gambar akan di simpan di folder gambar
        $nama_gambar = $rand . '_' . basename($_FILES['profile']['name']);
        $target_path = $tempdir . $nama_gambar;

        if (move_uploaded_file($_FILES['profile']['tmp_name'], $target_path)) {
            $username = $_POST['username'];
            $nama_lengkap = $_POST['nama_lengkap'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $no_telpon = $_POST['no_telpon'];
            $email = $_POST['email'];
            $nama_kendaraan = $_POST['nama_kendaraan'];
            $no_plat = $_POST['no_plat'];

            mysqli_query($conn, "UPDATE tb_user SET nama_user = '$nama_lengkap', jenis_kelamin = '$jenis_kelamin', no_telpon = '$no_telpon', email = '$email', foto_profil = '$nama_gambar' WHERE username = '$username' ");

            mysqli_query($conn, "UPDATE tb_karyawan SET nama_karyawan = '$nama_lengkap', nama_kendaraan = '$nama_kendaraan', no_plat = '$no_plat' WHERE username = '$username' ");

            echo "<script>
                window.alert('Data berhasil diubah!');
                window.location.href = './profile.php';
            </script>";
        }
    } else {
        $username = $_POST['username'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $no_telpon = $_POST['no_telpon'];
        $email = $_POST['email'];
        $nama_kendaraan = $_POST['nama_kendaraan'];
        $no_plat = $_POST['no_plat'];

        mysqli_query($conn, "UPDATE tb_user SET nama_user = '$nama_lengkap', jenis_kelamin = '$jenis_kelamin', no_telpon = '$no_telpon', email = '$email' WHERE username = '$username' ");

        mysqli_query($conn, "UPDATE tb_karyawan SET nama_karyawan = '$nama_lengkap', nama_kendaraan = '$nama_kendaraan', no_plat = '$no_plat' WHERE username = '$username' ");

        echo "<script>
            window.alert('Data berhasil diubah!');
            window.location.href = './profile.php';
        </script>";
    }
}

if (isset($_POST['btn_password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $renewpassword = $_POST['renewpassword'];

    $sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password' ");
    if (mysqli_num_rows($sql) == 1) {
        if ($newpassword == $renewpassword) {
            mysqli_query($conn, "UPDATE tb_user SET password = '$newpassword' WHERE username = '$username' ");
            echo "<script>
                    window.alert('Password berhasil diubah!');
                </script>";
        } else {
            echo "<script>
                window.alert('Password baru yang anda masukkan tidak sama, silahkan coba lagi!');
            </script>";
        }
    } else {
        echo "<script>
                window.alert('Password yang anda masukkan tidak sesuai, silahkan coba lagi!');
            </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Profile";

include 'head.php';

?>

<body>

    <?php

    include './navbar.php';

    ?>

    <main id="main" class="main mt-5">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

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
                                <img src="./profile/<?= $data['foto_profil'] ?>" alt="Profile" class="rounded-circle" style="max-width: 150px;height: 140px;">
                            <?php
                            }
                            ?>

                            <h2><?= $data['nama_user'] ?></h2>
                            <h3><?= $data['level'] ?></h3>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Detail</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Ubah Profile</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ubah Password</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Profile Details</h5>
                                    <div class="row">
                                        <div class="col-5 col-md-4 label ">Nama Lengkap</div>
                                        <div class="col-6"><?= $data['nama_user'] ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-5 col-md-4 label">Username</div>
                                        <div class="col-6"><?= $data['username'] ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-5 col-md-4 label">Jenis Kelamin</div>
                                        <div class="col-6"><?= $data['jenis_kelamin'] ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-5 col-md-4 label">No Telpon</div>
                                        <div class="col-6"><?= $data['no_telpon'] ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-5 col-md-4 label">Email</div>
                                        <div class="col-6"><?= $data['email'] ?></div>
                                    </div>

                                    <?php
                                    if ($data['level'] == 'Karyawan') {
                                        $sql = mysqli_query($conn, "SELECT * FROM tb_karyawan WHERE username = '$data[username]' ");
                                        $data_karyawan = mysqli_fetch_assoc($sql);
                                    ?>
                                        <div class="row">
                                            <div class="col-5 col-md-4 label">Nama Kendaraan</div>
                                            <div class="col-6"><?= $data_karyawan['nama_kendaraan'] ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-5 col-md-4 label">No Plat Kendaraan</div>
                                            <div class="col-6"><?= $data_karyawan['no_plat'] ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-5 col-md-4 label">Total Pengisian BBM</div>
                                            <div class="col-6"><?= rupiah($data_karyawan['total_pengisian']) ?></div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="username" value="<?= $data['username'] ?>">
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="checkbox" name="ubah_foto" value="true" class="form-check-input mb-3"> Ceklis jika ingin mengubah foto<br>
                                                <input type="file" class="form-control" id="profile" name="profile">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nama_lengkap" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nama_lengkap" type="text" class="form-control" id="nama_lengkap" value="<?= $data['nama_user'] ?>">
                                            </div>
                                        </div>

                                        <fieldset class="row mb-3">
                                            <legend class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin</legend>
                                            <div class="col-md-8 col-lg-9">
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
                                            <label for="company" class="col-md-4 col-lg-3 col-form-label">No Telpon</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="no_telpon" type="text" class="form-control" id="no_telpon" value="<?= $data['no_telpon'] ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Job" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="email" value="<?= $data['email'] ?>">
                                            </div>
                                        </div>

                                        <?php
                                        if ($data['level'] == "Karyawan") {
                                        ?>
                                            <div class="row mb-3">
                                                <label for="Country" class="col-md-4 col-lg-3 col-form-label">Nama Kendaraan</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="nama_kendaraan" type="text" class="form-control" id="nama_kendaraan" value="<?= $data_karyawan['nama_kendaraan'] ?>">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="Address" class="col-md-4 col-lg-3 col-form-label">No Plat Kendaraan</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="no_plat" type="text" class="form-control" id="no_plat" value="<?= $data_karyawan['no_plat'] ?>">
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                        <div class="text-center">
                                            <button type="submit" name="btn_ubah" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ingin mengubah data tersebut?')">Ubah</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form method="post">

                                        <input type="hidden" name="username" value="<?= $data['username'] ?>">
                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control" id="currentPassword" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newpassword" type="password" class="form-control" id="newPassword" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="renewpassword" type="password" class="form-control" id="renewPassword" required>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" name="btn_password" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ingin mengubah password anda?')">Ubah Password</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
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