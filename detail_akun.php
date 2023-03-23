<!-- MODAL UNTUK DETAIL DATA AKUN -->
<?php

$sql_user = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = '$data[id]' ");
$data_user = mysqli_fetch_assoc($sql_user);

?>
<div class="modal fade" id="modalTransaksi<?= $data_user['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Akun <?= $data_user['level'] ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?php
            $sql_karyawan = mysqli_query($conn, "SELECT * FROM tb_karyawan WHERE username = '$data_user[username]' ");
            $data_karyawan = mysqli_fetch_assoc($sql_karyawan);
            ?>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12 text-center">
                        <?php
                        if ($data['foto_profil'] == '') {
                            if ($data['jenis_kelamin'] == 'L') {
                        ?>
                                <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle mb-3" style="min-width: 100px;">
                            <?php
                            } else {
                            ?>
                                <img src="assets/img/messages-1.jpg" alt="Profile" class="rounded-circle mb-3" style="min-width: 100px;">
                            <?php
                            }
                        } else {
                            ?>
                            <img src="./profile/<?= $data['foto_profil'] ?>" alt="Profile" class="rounded-circle mb-3" style="max-width: 100px;height: 95px;">
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-5 col-md-4 label fw-bold mb-3">Nama Karyawan</div>
                    <div class="col-6"><?= $data_user['nama_user'] ?></div>
                </div>

                <div class="row">
                    <div class="col-5 col-md-4 label fw-bold mb-3">Username</div>
                    <div class="col-6"><?= $data_user['username'] ?></div>
                </div>

                <div class="row">
                    <div class="col-5 col-md-4 label fw-bold mb-3">Jenis Kelamin</div>
                    <div class="col-6"><?= $data_user['jenis_kelamin'] ?></div>
                </div>

                <div class="row">
                    <div class="col-5 col-md-4 label fw-bold mb-3">No Telpon</div>
                    <div class="col-6"><?= $data['no_telpon'] ?></div>
                </div>

                <div class="row">
                    <div class="col-5 col-md-4 label fw-bold mb-3">Email</div>
                    <div class="col-6"><?= $data['email'] ?></div>
                </div>

                <?php

                if ($data_user['level'] == "Karyawan") {
                ?>
                    <div class="row">
                        <div class="col-5 col-md-4 label fw-bold mb-3">Nama Kendaraan</div>
                        <div class="col-6"><?= $data_karyawan['nama_kendaraan'] ?></div>
                    </div>

                    <div class="row">
                        <div class="col-5 col-md-4 label fw-bold mb-3">No Plat Kendaraan</div>
                        <div class="col-6"><?= $data_karyawan['no_plat'] ?></div>
                    </div>

                    <div class="row">
                        <div class="col-5 col-md-4 label fw-bold mb-3">Total Pengisian BBM</div>
                        <div class="col-6"><?= rupiah($data_karyawan['total_pengisian']) ?></div>
                    </div>
                <?php
                }

                ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL TRANSAKSI -->