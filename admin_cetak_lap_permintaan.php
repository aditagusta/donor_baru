<?php
    session_start();
    require_once "config.php";
    require_once "functions.php";
    $tgl_awal = date("Y-m-01");
    $tgl_akhir = date("Y-m-t");
    $id_darah = null;
    $status = "";
    $sql_tambahan = "";

    if(!empty($_GET['tgl_awal']))
    {
        $tgl_awal = $_GET['tgl_awal'];
    }

    if($_GET['id_darah'] != "")
    {
        $id_darah = $_GET['id_darah'];
        $sql_tambahan .= " AND tb_permintaan.id_darah = ".$id_darah;
        $darah = $con->get("tb_darah", "*", array("id_darah" => $id_darah))['nama_darah'];
    }
    else
    {
        $darah = "Semua Golongan Darah";
    }

    if(!empty($_GET['tgl_akhir']))
    {
        $tgl_akhir = $_GET['tgl_akhir'];
    }

    if(!empty($_GET['status']))
    {
        $status = $_GET['status'];
        $sql_tambahan .= " AND tb_permintaan.status = '".$_GET['status']."'";
    }
    else
    {
        $status = "Semua Status Pendonor";
    }

    $sql = "Select tb_permintaan.*,
            tb_rs.*,
            tb_darah.nama_darah
        From
            tb_permintaan Left Join tb_darah On tb_permintaan.id_darah = tb_darah.id_darah 
            Join tb_rs ON tb_permintaan.id_rs = tb_rs.id_rs WHERE tb_permintaan.tgl_butuh >= DATE('".$tgl_awal."') AND tb_permintaan.tgl_butuh <= DATE('".$tgl_akhir."') ".$sql_tambahan." ORDER BY tb_permintaan.tgl_butuh";

    $data_permintaan = $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "head.php"; ?>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Laporan Permintaan Darah</h1>
        <p>Periode <b><?=tanggal_indo($tgl_awal)?> - <?=tanggal_indo($tgl_akhir)?></b></p>
        <p>Golongan Darah <b><?=$darah?></b></p>
        <p>Status Permintaan <b><?=$status?></b></p>
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
                </tr>
            <?php
                }
            ?>
        </table>
    </div>
</body>

</html>
