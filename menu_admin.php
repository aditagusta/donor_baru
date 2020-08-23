<?php
include 'config.php';
$banyak_pesan =  $con->count("tb_pesan", "*", ["status" => 0]);
if($banyak_pesan != 0)
{
	$mes = '<span class="badge pull-right">' . $banyak_pesan . ' Belum dibaca</spasql>';
}
else
{
	$mes = "";
}
?>
<h3 class="text-primary"><i class="glyphicon glyphicon-dashboard"></i> Menu</h3>
<hr>

<ul class="nav nav-stacked">
	<li><a href="admin_beranda.php"><i class="fa fa-home"></i> Beranda</a></li>
	<li><a href="admin_pesan.php"><i class="fa fa-envelope"></i> Pesan Masuk <?php echo $mes; ?></a></li>
	<li><a href="admin_darah.php"><i class="fa fa-search"></i> Data Darah</a></li>
	<li><a href="admin_permintaan.php"><i class="fa fa-users text-success"></i> Permintaan Darah</a></li>
	<li><a href="admin_donor.php"><i class="fa fa-users text-danger"></i> Donor Darah</a></li>
	<li><a href="admin_lap_permintaan.php"><i class="fa fa-book"></i> Laporan Permintaan Darah</a></li>
	<li><a href="admin_darah_laporan.php"><i class="fa fa-book"></i> Laporan Donor Darah</a></li>
	<hr>
</ul>