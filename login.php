<?php

session_start();

require './koneksi.php';

$sql = mysqli_query($conn, "SELECT * FROM tb_user");
$data = mysqli_fetch_assoc($sql);

if ($_SESSION['admin'] || $_SESSION['karyawan']) {
    header('location:index.php');
}

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password' ");
    $hasil = mysqli_fetch_assoc($result);

    // Cek Username dan password
    if (mysqli_num_rows($result) == 1) {
        // set session
        if ($hasil['level'] == 'Admin') {
            $_SESSION['admin'] = $hasil['username'];
            header('location:index.php');
        }
        else if ($hasil['level'] == 'Karyawan') {
            $_SESSION['karyawan'] = $hasil['username'];
            header('location:index.php');
        }
    } else {
        echo '
        <script>
            window.alert("Username atau password yang anda masukkan salah, silahkan coba lagi!")
        </script>';
    }

    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Pages Login";

include 'head.php';

?>

<body>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/icon.png" alt="Logo" style="  max-height: 70px;">
                                    <span class="ms-2">Rekap Karyawan</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-5">

                                <div class="card-body">

                                    <div class="py-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your username & password to login</p>
                                    </div>

                                    <form class="row g-3" method="post">

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="username" class="form-control" id="username" required>
                                                <div class="invalid-feedback">Please enter your username.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="passwrod" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 mb-3" type="submit" name="login">Login</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
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