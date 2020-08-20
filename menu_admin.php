<?php
include 'config.php';
$sql =  $con->count("tb_pesan", "*", ["status" => 0]);
if ($sql != 0) {
	$mes = '<spasql class="badge pull-right">' . $sql . ' Belum dibaca</spasql>';
} else {
	$mes = "";
}
?>
<h3 class="text-primary"><i class="glyphicon glyphicon-dashboard"></i> Beranda</h3>
<hr>

<ul class="nav nav-stacked">
	<li><a href="admin_pesan.php"><i class="fa fa-envelope fa-lg"></i> Pesan Masuk <?php echo $mes; ?></a></li>
	<li><a href="admin_darah.php"><i class="fa fa-search fa-lg"></i> Data Darah</a></li>
	<li><a href="admin_permintaan.php"><i class="fa fa-users fa-lg text-success"></i> Permintaan Darah</a></li>
	<li><a href="admin_donor.php"><i class="fa fa-users fa-lg text-danger"></i> Donor Darah</a></li>
	<li><a href="admin_lap_permintaan.php"><i class="fa fa-book fa-lg"></i> Laporan Permintaan Darah</a></li>
	<li><a href="admin_darah_laporan.php"><i class="fa fa-book fa-lg"></i> Laporan Donor Darah</a></li>
	<hr>
</ul>