<?php
    session_start();
    require_once "functions.php";
    require_once "config.php";
    $donor = $con->query("Select
    tb_donor.*,
    IFNULL(tb_darah.nama_darah, 'Belum Diketahui') AS nama_darah,
    tb_rs.nama_rs,
    tb_rs.lokasi,
    tb_rs.kontak
From
    tb_donor Left Join
    tb_darah On tb_donor.id_darah = tb_darah.id_darah Left Join
    tb_rs On tb_donor.id_rs = tb_rs.id_rs WHERE tb_donor.id_donor = :id_donor", array("id_donor" => $_GET['id_donor']))->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php';?>
</head>

<body>

    <?php include("menu_navigasi_atas.php"); ?>
    <div class="container" style='margin-top:70px'>
        <div class="row">
            <div class="col-sm-3 col-xs-12">
                <?php include("menu_admin.php"); ?>
            </div>
            <h3 class="text-primary"><i class="fa fa-envelope"></i> Detail Pendonor Darah</h3>
            <hr>
            <div class="col-sm-9 col-xs-12">

                    <div class="col-sm-4 col-xs-12 text-left">
                        <h4>Foto Pendonor</h4>
                        <img src="images/<?=$donor['foto']?>" width="250" />
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <div class="text-right" style="margin-bottom: 7px;">
                            <a href="admin_donor.php" class="btn btn-sm btn-primary"><i class="fa fa-server"></i> Kembali</a>
                        </div>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>No Donor</th>
                                <td><?="D".$donor['id_donor']."-".date("dmYHis", strtotime($donor['tgl_booking']))?></td>
                            </tr>
                            <tr>
                                <th>Nama Pendonor</th>
                                <td><?=$donor['nama_lengkap']?></td>
                            </tr>
                            <tr>
                                <th>Golongan Darah</th>
                                <td><?=$donor['nama_darah']?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Booking</th>
                                <td><?=tanggal_indo($donor['tgl_booking'])." ".substr($donor['tgl_booking'], 10)?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Melakukan Donor</th>
                                <td><?=tanggal_indo($donor['tgl_donor'])." ".substr($donor['tgl_donor'], 10)?></td>
                            </tr>
                            <tr>
                                <th>Status Booking</th>
                                <td><?=$donor['status']?></td>
                            </tr>
                            <tr>
                                <th>Nama Orang Tua Pendonor</th>
                                <td><?=$donor['nama_ortu']?></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td><?=$donor['jenis_kelamin']?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td><?=tanggal_indo($donor['tgl_lahir'])?></td>
                            </tr>
                            <tr>
                                <th>Berat Badan</th>
                                <td><?=$donor['berat_badan']?> Kg</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><?=$donor['alamat']?></td>
                            </tr>
                            <tr>
                                <th>Nohp</th>
                                <td><?=$donor['nohp']?></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td><?=$donor['keterangan']?></td>
                            </tr>
                        </table>
                    </div>
                    </div>

        </div>
        <?php include("admin_footer.php"); ?>


</body>

</html>