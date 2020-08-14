<!DOCTYPE html>
<html lang="en">

<head>
	<?php include("admin_head.php"); ?>
</head>

<body>

	<?php include("admin_navigasiatas.php"); ?>
	<div class="container" style='margin-top:70px;'>
		<div class="row">
			<div class="col-sm-3">
				<?php include("admin_navigasi.php"); ?>
			</div>
			<div class="col-sm-9">
				<h3 class="text-primary"><i class="fa fa-envelope"></i> Pesan Masuk </h3>
				<hr>

				<?php
				$sql = $con->select("tb_pesan", "*");
				?>

				<?php foreach ($sql as $key => $data) { ?>

				<?php } ?>




				<!-- <?php
						$sql = "SELECT * FROM pesan ORDER BY ID DESC";
						$result = $con->query($sql);
						if ($result->num_rows > 0) {
							echo '<ul class="list-group">';
							while ($row = $result->fetch_assoc()) {
								if ($row['STATUS'] == '1') {
									echo '<li class="list-group-item active">
						<span>
							<b><i class="fa fa-envelope-square"> </i>      	' . $row["NAMA"] . '</b>: ' . substr($row["PESAN"], 0, 50) . '....
						</span>
						<span   class="pull-right">
							<i>' . $row['WAKTU'] . '</i>&nbsp;
							<a href="lihat_pesan.php?id=' . $row['ID'] . '" class="btn btn-primary  btn-xs">Lihat</a>
							<a href="admin_hapus_pesan.php?id=' . $row['ID'] . '"  class="btn btn-danger btn-xs">Hapus</a>
						</span>

					</li>';
								} else {
									echo '<li class="list-group-item">
						<span>
							<b><i class="fa fa-envelope-square
"></i> ' . $row["NAMA"] . '</b>: ' . substr($row["PESAN"], 0, 50) . '....
						</span>
						<span   class="pull-right">
							<i>' . $row['WAKTU'] . '</i>&nbsp;
							<a href="lihat_pesan.php?id=' . $row['ID'] . '" class="btn btn-primary btn-xs">Lihat</a>
							<a href="admin_hapus_pesan.php?id=' . $row['ID'] . '"  class="btn btn-danger btn-xs">Hapus</a>
						</span>
				</li>';
								}
								echo "<br>";
							}
							echo '</ul>';
						} else {
							echo "<div class='alert alert-info mess'>Tidak Ada Lagi Pesan</div>";
						}
						?> -->
			</div>
		</div>
	</div>
	<?php include("admin_footer.php"); ?>
</body>

</html>