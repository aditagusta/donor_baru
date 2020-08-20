<?php
    session_start();
    require_once "config.php";
    require_once "functions.php";

    $data_donor = $con->query("SELECT
                                         (SELECT COUNT(id_donor) FROM tb_donor WHERE status = 'Belum Diproses') AS belum_diproses,
                                         (SELECT COUNT(id_donor) FROM tb_donor WHERE status = 'Sudah Diproses') AS sudah_diproses,
                                         (SELECT COUNT(id_donor) FROM tb_donor WHERE status = 'Sudah Disalurkan') AS sudah_disalurkan
                                         ")->fetch(PDO::FETCH_ASSOC);

    $data_permintaan = $con->query("SELECT
                                         (SELECT COUNT(id_permintaan) FROM tb_permintaan WHERE status = 'Belum Diproses') AS belum_diproses,
                                         (SELECT COUNT(id_permintaan) FROM tb_permintaan WHERE status = 'Sudah Diproses') AS sudah_diproses")->fetch(PDO::FETCH_ASSOC);

    $data_darah = $con->query("SELECT nama_darah, stok FROM tb_darah GROUP BY id_darah ORDER BY nama_darah ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "head.php";
    ?>
</head>

<body>

    <?php include("menu_navigasi_atas.php"); ?>
    <div class="container" style='margin-top:70px'>
        <div class="row">
            <div class="col-sm-3">
                <?php include("menu_admin.php"); ?>
            </div>
            <div class="col-sm-9">
                <h3 class="text-primary"><i class="fa fa-search"></i> Dashboard </h3>
                <hr>

                <div class="col-sm-4">
                    <div class="panel">
                        <div class="panel-body">
                            Jumlah Data Donor <br>
                            Belum Diproses <?=$data_donor['belum_diproses']?> <br>
                            Sudah Diproses <?=$data_donor['sudah_diproses']?> <br>
                            Sudah Disalurkan <?=$data_donor['sudah_disalurkan']?> <br>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="panel">
                        <div class="panel-body">
                            Jumlah Data Permintaan Darah <br>
                            Belum Diproses <?=$data_permintaan['belum_diproses']?> <br>
                            Sudah Diproses <?=$data_permintaan['sudah_diproses']?> <br>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="panel">
                        <div class="panel-body">
                            Jumlah Stok Darah <br>
                            <?php foreach($data_darah as $darah): ?>
                                <?=$darah['nama_darah']?> <?=$darah['stok']?> <br>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>


            <?php include("admin_footer.php"); ?>


</body>

</html>