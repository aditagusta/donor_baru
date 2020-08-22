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
        $sql_tambahan .= " AND tb_donor.id_darah = ".$id_darah;
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

    if($_GET['status'] != "")
    {
        $status = $_GET['status'];
        $sql_tambahan .= " AND tb_donor.status = '".$_GET['status']."'";
    }
    else
    {
        $status = "Semua Status Pendonor";
    }
    $data_donor = $con->query("Select tb_donor.*,
                ifnull(tb_darah.nama_darah, 'Belum Diatur') as nama_darah
            From
                tb_donor Left Join
                tb_darah On tb_donor.id_darah = tb_darah.id_darah WHERE tb_donor.tgl_donor >= DATE('".$tgl_awal."') AND tb_donor.tgl_donor <= DATE('".$tgl_akhir."') ".$sql_tambahan)->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php"); ?>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Laporan Donor Darah</h1>
        <p>Periode <b><?=tanggal_indo($tgl_awal)?> - <?=tanggal_indo($tgl_akhir)?></b></p>
        <p>Golongan Darah <b><?=$darah?></b></p>
        <p>Status Pendonor <b><?=$status?></b></p>
        <table class="table table-striped table-bordered" id="datatable">
            <tr>
                <th>No</th>
                <th width="200">No Donor</th>
                <th>Nama Pendonor</th>
                <th>Tanggal Booking</th>
                <th>Tanggal Donor</th>
                <th>Darah</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>

            <?php
                foreach ($data_donor as $no => $donor)
                {
            ?>
                <tr>
                    <td><?=$no+1?></td>
                    <td><?php echo "D".$donor['id_donor']."-".date("dmYHis", strtotime($donor['tgl_booking'])); ?></td>
                    <td><?php echo $donor['nama_lengkap']; ?></td>
                    <td><?php echo tanggal_indo($donor['tgl_booking']); ?></td>
                    <td><?php echo tanggal_indo($donor['tgl_donor'])." ".substr($donor['tgl_donor'], 10); ?></td>
                    <td><?php echo $donor['nama_darah']; ?></td>
                    <td><?php echo $donor['status']; ?></td>
                    <td><?php echo $donor['keterangan']; ?></td>
                </tr>
            <?php
                }
            ?>
        </table>
    </div>
</body>

</html>

