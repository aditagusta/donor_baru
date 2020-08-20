<?php
    session_start();
    require_once "config.php";
    require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include("head.php"); ?>

</head>

<body>
    <?php include("menu_navigasi_atas.php"); ?>
	<div class="container" style='margin-top:70px'>
		<div class="row">
			<div class="col-sm-3 col-xs-12">
				<?php include("menu_admin.php"); ?>
			</div>
			<div class="col-sm-9 col-xs-12">
                <h3 class="text-primary"><i class="fa fa-envelope"></i> Data Donor Darah </h3>
                <hr>
                <?php
                    $data_donor = $con->query("Select
                                                tb_donor.*,
                                                ifnull(tb_darah.nama_darah, 'Belum Diatur') as nama_darah
                                            From
                                                tb_donor Left Join
                                                tb_darah On tb_donor.id_darah = tb_darah.id_darah", array("id_user" => $_SESSION['id_user']))->fetchAll(PDO::FETCH_ASSOC);
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
                            <td><?php echo "D".$donor['id_donor']."-".date("dmYHis", strtotime($donor['tgl_booking'])); ?></td>
                            <td><?php echo $donor['nama_lengkap']; ?></td>
                            <td><?php echo tanggal_indo($donor['tgl_booking']); ?></td>
                            <td><?php echo tanggal_indo($donor['tgl_donor'])." ".substr($donor['tgl_donor'], 10); ?></td>
                            <td><?php echo $donor['nama_darah']; ?></td>
                            <td><?php echo $donor['status']; ?></td>
                            <td><?php echo $donor['keterangan']; ?></td>
                            <td>
                                <?php if($donor['status'] == "Belum Diproses"): ?>
                                    <a href="admin_proses_donor.php?id_donor=<?=$donor['id_donor']?>" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Proses Donor</a>
                                    <br>
                                    <br>
                                <?php endif; ?>

                                <?php if($donor['status'] == "Sudah Diproses"): ?>
                                    <a href="admin_salurkan_donor.php?id_donor=<?=$donor['id_donor']?>" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Salurkan Darah Pendonor</a>
                                    <br>
                                    <br>
                                <?php endif; ?>
                                <a href="admin_lihat_donor.php?id_donor=<?=$donor['id_donor']?>" class="btn btn-sm btn-primary"><i class="fa fa-server"></i> Detail Donor</a>
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