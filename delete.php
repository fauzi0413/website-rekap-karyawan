<?php
session_start();
include './koneksi.php';

$username = $_GET['username'];
$level = $_GET['level'];

if ($username) {
    mysqli_query($conn, "DELETE FROM tb_user WHERE username = '$username' ");
    if ($level == 'Karyawan') {
        mysqli_query($conn, "DELETE FROM tb_karyawan WHERE username = '$username' ");
    }

    echo "<script>
            window.alert('Data berhasil dihapus!');
            window.location.href = './data_akun.php?level=$level';
        </script>";
}
