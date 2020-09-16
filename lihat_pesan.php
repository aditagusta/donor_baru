<?php
    session_start();
    require_once "config.php";
    require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include("head.php");?>
	</head>
	<body>

<?php include("menu_navigasi_atas.php"); ?>
<div class="container">
	<div class="row">
		<div class="col-sm-3">
			<?php include("menu_admin.php");?>
		</div>
		<div class="col-sm-9" >
			<h3><i class="fa fa-envelope"></i> Pesan <hr>  
		<?php
			// set pesan ke sudah lihat
			$con->update("tb_pesan", array("status" => 1), array("id_pesan" => $_GET['id']));
			$data_pesan = $con->get("tb_pesan", "*", array("id_pesan" => $_GET['id']));
			echo "<h4>".$data_pesan['nama']." <small>".$data_pesan['email'].", ".$data_pesan['kontak']."</small></h4>";
			echo "<p>Pesan Masuk Pada ".tanggal_indo($data_pesan['tgl_pesan']).substr($data_pesan['tgl_pesan'], 10)."</p>";
			echo "<p>Isi Pesan : <br> ".$data_pesan['pesan']."</p>";
			?>
			<a href="admin_pesan.php" class="btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a></h3>
				<a href="admin_hapus_pesan.php?id=<?php echo $_GET['id']; ?>" class="btn-sm btn-primary"><i class="fa fa-trash"></i> Hapus Pesan</a></h3>
		</div>
	</div>
</div>
	 <?php include("admin_footer.php"); ?>
	</body>
</html>