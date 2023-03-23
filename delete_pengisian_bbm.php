<?php
session_start();
include './koneksi.php';

$username = $_GET['username'];
$id = $_GET['id'];

if ($username) {
    $sql_karyawan = mysqli_query($conn, "SELECT * FROM tb_karyawan WHERE username = '$username' ");
    $data_karyawan = mysqli_fetch_assoc($sql_karyawan);

    $sql_rekap = mysqli_query($conn, "SELECT * FROM tb_rekap_pengisian_bbm WHERE id = '$id' ");
    $data_rekap = mysqli_fetch_assoc($sql_rekap);

    $total_pengisian = $data_karyawan['total_pengisian'] - $data_rekap['biaya_pengisian'];

    mysqli_query($conn, "UPDATE tb_karyawan SET total_pengisian = '$total_pengisian' WHERE username = '$username' ");
    mysqli_query($conn, "DELETE FROM tb_rekap_pengisian_bbm WHERE id = '$id' ");

    echo "<script>
            window.alert('Data berhasil dihapus!');
            window.location.href = './data_pengisian_bbm.php';
        </script>";
}
