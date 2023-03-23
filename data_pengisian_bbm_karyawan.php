<?php
$Y = date('Y');

// Data Januari
$sql_jan = mysqli_query($conn, "SELECT SUM(biaya_pengisian) AS biaya FROM tb_rekap_pengisian_bbm WHERE tanggal > '" . $Y . "-01-00' && tanggal < '" . $Y . "-02-00' && username = '$data[username]' ");
$data_jan = mysqli_fetch_array($sql_jan);

// Data Februari
$sql_feb = mysqli_query($conn, "SELECT SUM(biaya_pengisian) AS biaya FROM tb_rekap_pengisian_bbm WHERE tanggal > '" . $Y . "-02-00' && tanggal < '" . $Y . "-03-00' && username = '$data[username]' ");
$data_feb = mysqli_fetch_array($sql_feb);

// Data Maret
$sql_mar = mysqli_query($conn, "SELECT SUM(biaya_pengisian) AS biaya FROM tb_rekap_pengisian_bbm WHERE tanggal > '" . $Y . "-03-00' && tanggal < '" . $Y . "-04-00' && username = '$data[username]' ");
$data_mar = mysqli_fetch_array($sql_mar);

// Data April
$sql_aprl = mysqli_query($conn, "SELECT SUM(biaya_pengisian) AS biaya FROM tb_rekap_pengisian_bbm WHERE tanggal > '" . $Y . "-04-00' && tanggal < '" . $Y . "-05-00' && username = '$data[username]' ");
$data_aprl = mysqli_fetch_array($sql_aprl);

// Data Mei
$sql_mei = mysqli_query($conn, "SELECT SUM(biaya_pengisian) AS biaya FROM tb_rekap_pengisian_bbm WHERE tanggal > '" . $Y . "-05-00' && tanggal < '" . $Y . "-06-00' && username = '$data[username]'");
$data_mei = mysqli_fetch_array($sql_mei);

// Data Juni
$sql_jun = mysqli_query($conn, "SELECT SUM(biaya_pengisian) AS biaya FROM tb_rekap_pengisian_bbm WHERE tanggal > '" . $Y . "-06-00' && tanggal < '" . $Y . "-07-00' && username = '$data[username]'");
$data_jun = mysqli_fetch_array($sql_jun);

// Data Juli
$sql_jul = mysqli_query($conn, "SELECT SUM(biaya_pengisian) AS biaya FROM tb_rekap_pengisian_bbm WHERE tanggal > '" . $Y . "-07-00' && tanggal < '" . $Y . "-08-00' && username = '$data[username]'");
$data_jul = mysqli_fetch_array($sql_jul);

// Data Agustus
$sql_ags = mysqli_query($conn, "SELECT SUM(biaya_pengisian) AS biaya FROM tb_rekap_pengisian_bbm WHERE tanggal > '" . $Y . "-08-00' && tanggal < '" . $Y . "-09-00' && username = '$data[username]'");
$data_ags = mysqli_fetch_array($sql_ags);

// Data September
$sql_sep = mysqli_query($conn, "SELECT SUM(biaya_pengisian) AS biaya FROM tb_rekap_pengisian_bbm WHERE tanggal > '" . $Y . "-09-00' && tanggal < '" . $Y . "-10-00' && username = '$data[username]'");
$data_sep = mysqli_fetch_array($sql_sep);

// Data Oktober
$sql_okt = mysqli_query($conn, "SELECT SUM(biaya_pengisian) AS biaya FROM tb_rekap_pengisian_bbm WHERE tanggal > '" . $Y . "-10-00' && tanggal < '" . $Y . "-11-00' && username = '$data[username]'");
$data_okt = mysqli_fetch_array($sql_okt);

// Data November
$sql_nov = mysqli_query($conn, "SELECT SUM(biaya_pengisian) AS biaya FROM tb_rekap_pengisian_bbm WHERE tanggal > '" . $Y . "-11-00' && tanggal < '" . $Y . "-12-00' && username = '$data[username]'");
$data_nov = mysqli_fetch_array($sql_nov);

// Data Desember
$sql_des = mysqli_query($conn, "SELECT SUM(biaya_pengisian) AS biaya FROM tb_rekap_pengisian_bbm WHERE tanggal > '" . $Y . "-12-00' && tanggal < '" . $Y . "-12-31' && username = '$data[username]'");
$data_des = mysqli_fetch_array($sql_des);
