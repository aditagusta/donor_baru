<?php
    session_start();
    $_SESSION['id_user'] = 1;
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
    <?php include("admin_head.php"); ?>
</head>

<body>

    <?php include("user_navigasiatas.php"); ?>
    <div class="container" style='margin-top:70px;'>
        <div class="row">
            <div class="col-sm-2 col-xs-12">
                <?php include("user_navigasi.php"); ?>
            </div>
            <div class="col-sm-10 col-xs-12">
                <h3 class="text-primary"><i class="fa fa-envelope"></i> Detail Booking Jadwal Donor </h3>
                <hr>
                    <div class="col-sm-4 col-xs-12 text-left">
                        <h4>Foto Pendonor</h4>
                        <img src="images/<?=$donor['foto']?>" width="250" />
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <div class="text-right" style="margin-bottom: 7px;">
                            <a href="user_history_booking.php" class="btn btn-sm btn-primary"><i class="fa fa-server"></i> Kembali Ke History Booking</a>
                            <a href="user_cetak_booking_donor.php?id_donor=<?=$donor['id_donor']?>" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak Bukti</a>
                        </div>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>No Donor</th>
                                <td><?=date("d-m-Y-His".$donor['id_donor'], strtotime($donor['tgl_booking']))?></td>
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
    </div>
    <?php include("admin_footer.php"); ?>
</body>

</html>