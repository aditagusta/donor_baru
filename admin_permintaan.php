<?php
    session_start();
    require_once "config.php";
    require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "head.php"; ?>
</head>

<body>

    <?php include("menu_navigasi_atas.php"); ?>
    <div class="container" style='margin-top:70px'>
        <div class="row">
            <div class="col-sm-3">
                <?php include("menu_admin.php"); ?>
            </div>

            <div class="col-sm-9 col-xs-12">
                <h3 class="text-primary"><i class="fa fa-envelope"></i> Data Permintaan Darah </h3>
                <hr>
                <?php
                    $data_permintaan = $con->query("Select
                                                    tb_permintaan.*,
                                                    tb_rs.*,
                                                    tb_darah.nama_darah
                                                From
                                                    tb_permintaan Left Join tb_darah On tb_permintaan.id_darah = tb_darah.id_darah 
                                                    Join tb_rs ON tb_permintaan.id_rs = tb_rs.id_rs 
                                                     ORDER BY tb_permintaan.tgl_butuh")->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>No</th>
                        <th width="200">No Permintaan</th>
                        <th>Rumah Sakit</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal</th>
                        <th>Tanggal Butuh</th>
                        <th>Darah</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>

                    <?php
                        foreach ($data_permintaan as $no => $permintaan)
                        {
                    ?>
                        <tr>
                            <td><?=$no+1?></td>
                            <td><?php echo "P".$permintaan['id_permintaan']."-".date("dmYHis", strtotime($permintaan['tgl_permintaan'])); ?></td>
                            <td><?php echo $permintaan['nama_rs']; ?></td>
                            <td><?php echo $permintaan['nama_pasien']; ?></td>
                            <td><?php echo tanggal_indo($permintaan['tgl_permintaan']); ?></td>
                            <td><?php echo tanggal_indo($permintaan['tgl_butuh']); ?></td>
                            <td><?php echo $permintaan['nama_darah']; ?></td>
                            <td><?php echo $permintaan['status']; ?></td>
                            <td><?php echo $permintaan['keterangan']; ?></td>
                            <td>
                                <a href="admin_lihat_donor.php?id_permintaan=<?=$permintaan['id_permintaan']?>" class="btn btn-sm btn-primary"><i class="fa fa-server"></i> Detail Permintaan</a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </table>

            </div>
        </div>

            <?php include("admin_footer.php"); ?>
</body>

</html>