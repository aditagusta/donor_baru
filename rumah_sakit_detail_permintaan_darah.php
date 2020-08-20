<?php
    session_start();
    require_once "functions.php";
    require_once "config.php";
    $permintaan = $con->query("SELECT tb_permintaan.*, tb_darah.nama_darah FROM tb_permintaan INNER JOIN tb_darah ON tb_permintaan.id_darah = tb_darah.id_darah WHERE tb_permintaan.id_permintaan = :id_permintaan", array("id_permintaan" => $_GET['id_permintaan']))->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php"); ?>
</head>

<body>

    <?php include("menu_navigasi_atas.php"); ?>
    <div class="container" style='margin-top:70px;'>
        <div class="row">
            <div class="col-sm-3 col-xs-12">
                <?php include("menu_rumah_sakit.php"); ?>
            </div>
            <div class="col-sm-9 col-xs-12">
                <h3 class="text-primary"><i class="fa fa-envelope"></i> Detail Permintaan Darah </h3>
                <hr>
                    <div class="col-xs-12">
                        <div class="text-right" style="margin-bottom: 7px;">
                            <a href="rumah_sakit_history_permintaan_darah.php" class="btn btn-sm btn-primary"><i class="fa fa-server"></i> Kembali Ke History Permintaan Darah</a>
                            <!-- <a href="user_cetak_booking_donor.php?id_permintaan=<?=$permintaan['id_permintaan']?>" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak Bukti</a> -->
                        </div>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>No Permintaan</th>
                                <td><?php echo "P".$permintaan['id_permintaan']."-".date("dmYHis", strtotime($permintaan['tgl_permintaan'])); ?></td>
                            </tr>
                            <tr>
                                <th>Nama Pasien</th>
                                <td><?=$permintaan['nama_pasien']?></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td><?=$permintaan['jenis_kelamin']?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td><?=tanggal_indo($permintaan['tgl_lahir'])?></td>
                            </tr>
                            <tr>
                                <th>Golongan Darah</th>
                                <td><?=$permintaan['nama_darah']?></td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td><?=tanggal_indo($permintaan['tgl_permintaan'])." ".substr($permintaan['tgl_permintaan'], 10)?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Butuh</th>
                                <td><?=tanggal_indo($permintaan['tgl_butuh'])." ".substr($permintaan['tgl_butuh'], 10)?></td>
                            </tr>
                            <tr>
                                <th>Status Permintaan</th>
                                <td><?=$permintaan['status']?></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td><?=$permintaan['keterangan']?></td>
                            </tr>
                        </table>
                    </div>
            </div>
        </div>
    </div>
    <?php include("admin_footer.php"); ?>
</body>

</html>