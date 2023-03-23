<!-- MODAL UNTUK DETAIL TRANSAKSI -->
<?php

$sql = mysqli_query($conn, "SELECT * FROM tb_rekap_pengisian_bbm WHERE id = '$data_pengisian[id]' ");
$data = mysqli_fetch_assoc($sql);

?>
<div class="modal fade" id="modalTransaksi<?= $data['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Transaksi Pengisian BBM</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?php
            $sql = mysqli_query($conn, "SELECT * FROM tb_rekap_pengisian_bbm WHERE id = '$data_pengisian[id]' ");
            $data = mysqli_fetch_assoc($sql);

            $sql_karyawan = mysqli_query($conn, "SELECT * FROM tb_karyawan WHERE username = '$data[username]' ");
            $data_karyawan = mysqli_fetch_assoc($sql_karyawan);
            ?>

            <div class="modal-body">
                <div class="row">
                    <div class="col-5 col-md-4 label fw-bold mb-3">Kode Transaksi</div>
                    <div class="col-6 text-primary">00<?= $data['id'] ?></div>
                </div>

                <div class="row">
                    <div class="col-5 col-md-4 label fw-bold mb-3">Nama Karyawan</div>
                    <div class="col-6"><?= $data_karyawan['nama_karyawan'] ?></div>
                </div>

                <div class="row">
                    <div class="col-5 col-md-4 label fw-bold mb-3">Biaya Pengisian</div>
                    <div class="col-6"><?= rupiah($data['biaya_pengisian']) ?></div>
                </div>

                <div class="row">
                    <div class="col-5 col-md-4 label fw-bold mb-3">Kilometer</div>
                    <div class="col-6"><?= jarak($data['kilometer']) ?></div>
                </div>

                <div class="row">
                    <div class="col-5 col-md-4 label fw-bold mb-3">Tanggal Pengisian BBM</div>
                    <div class="col-6"><?= $data['tanggal'] ?></div>
                </div>

                <div class="row">
                    <div class="col-5 col-md-4 label fw-bold mb-3">Keterangan</div>
                    <div class="col-6"><?= $data['keterangan'] ?></div>
                </div>

                <div class="row">
                    <div class="col-5 col-md-4 label fw-bold mb-3">Bukti Pembayaran</div>
                    <div class="col-6"><img src="./bukti_pembayaran/<?= $data['bukti_pembayaran'] ?>" class="" style="max-width: 100%;" alt="-"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL TRANSAKSI -->