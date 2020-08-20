<?php
    session_start();
    require_once "functions.php";
    require_once "config.php";
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
            <div class="col-sm-2 col-xs-12">
                <?php include("menu_pendonor.php"); ?>
            </div>
            <div class="col-sm-10 col-xs-12">
                <h3 class="text-primary"><i class="fa fa-envelope"></i> History Donor Darah Anda </h3>
                <hr>
                <?php
                    $data_donor = $con->query("Select
                                                tb_donor.*,
                                                ifnull(tb_darah.nama_darah, 'Belum Diatur') as nama_darah
                                            From
                                                tb_donor Left Join
                                                tb_darah On tb_donor.id_darah = tb_darah.id_darah WHERE tb_donor.id_user = :id_user", array("id_user" => $_SESSION['id_user']))->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>No</th>
                        <th width="200">No Donor</th>
                        <th>Nama Pendonor</th>
                        <th>Tanggal Booking</th>
                        <th>Tanggal Donor</th>
                        <th>Darah</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>

                    <?php
                        foreach ($data_donor as $no => $donor)
                        {
                    ?>
                        <tr>
                            <td><?=$no+1?></td>
                            <td><?php echo "D".$donor['id_donor'].date("dmYHis", strtotime($donor['tgl_booking'])); ?></td>
                            <td><?php echo $donor['nama_lengkap']; ?></td>
                            <td><?php echo tanggal_indo($donor['tgl_booking']); ?></td>
                            <td><?php echo tanggal_indo($donor['tgl_donor'])." ".substr($donor['tgl_donor'], 10); ?></td>
                            <td><?php echo $donor['nama_darah']; ?></td>
                            <td><?php echo $donor['status']; ?></td>
                            <td><?php echo $donor['keterangan']; ?></td>
                            <td>
                                <?php if($donor['status'] == "Belum Selesai"): ?>
                                    <a href="user_batal_booking.php?id_donor=<?=$donor['id_donor']?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Batalkan Donor</a>
                                    <br>
                                    <br>
                                <?php endif; ?>
                                <a href="user_detail_booking.php?id_donor=<?=$donor['id_donor']?>" class="btn btn-sm btn-primary"><i class="fa fa-server"></i> Detail Donor</a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php include("admin_footer.php"); ?>
</body>

</html>