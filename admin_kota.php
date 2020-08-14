<?php
session_start();
include("config.php");
include("admin_function.php");
 if(!isset($_SESSION['usertype']))
 {
	 header("location:admin.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
			<?php include("admin_head.php");?>
	</head>
	<body>

<?php include("admin_navigasiatas.php"); ?>
<div class="container" style="margin-top:70px;">
	<div class="row">
		<div class="col-sm-3">
			<?php include("admin_navigasi.php");?>
		</div>
		<div class="col-sm-9" >
			<h3 class='text-primary'><i class="fa fa-bank"></i> Tambah Kota </h3><hr>    
			<div class="row">
				<div class="col-md-6">
				<?php 
				if(isset($_POST["tambah_kota"]))
				{
					$sql="INSERT INTO kota (NAMA_KOTA,ID_PROVINSI) VALUES ('".$_POST["namakota"]."',".$_POST["namakecamatan"].")";
					$con->query($sql);
					
				}
				
				?>
				
					<p id='out' class='text-success'></p>
					<form role="form" action="admin_kota.php" method="post">
						<div class="form-group text-primary">
							<label for="Kota">Nama Kota</label>
							<input id="Kota" required type="text" class="form-control" name="namakota">
						</div>
						<div class="form-group text-primary">
							<label for="kecamatan">Pilih Kecamatan</label>
							<select name="namakecamatan" required class="form-control">
								<option value="">Pilih Kecamatan</option>
								<?php
									$sql="SELECT ID_PROVINSI,NAMA_KECAMATAN FROM kecamatan ORDER BY NAMA_KECAMATAN ASC";
									$result=$con->query($sql);
									if($result->num_rows>0)
									{
										while($row=$result->fetch_assoc())
										{
										echo "<option value='{$row['ID_PROVINSI']}'>{$row['NAMA_KECAMATAN']}	</option>";
										}
									}
								?>
							</select>
						</div>
						
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name='tambah_kota' value="Tambah Kota">
						</div>
						
					</form>
				</div>
				<div class="col-md-6">
					<?php 
						$sql="Select kota.NAMA_KOTA, kecamatan.NAMA_KECAMATAN, kota.ID_KOTA
From kecamatan Inner Join
  kota On kota.ID_PROVINSI = kecamatan.ID_PROVINSI  ORDER BY kota.ID_KOTA DESC  LIMIT 0,5";
						$result=$con->query($sql);
						if($result->num_rows>0)
						{
								echo "<table class='table table-striped' >";
									echo "<tr>
											<th>No</th>
											<th>Kota</th>
											<th>Kecamatan</th>
											<th>Hapus</th>
										</tr>";
										$i=0;
										while($row=$result->fetch_assoc())
										{
											$i++;
											echo"<tr>";
												echo "<td>$i</td>";
												echo "<td>".$row["NAMA_KOTA"]."</td>";
												echo "<td>".$row["NAMA_KECAMATAN"]."</td>";
												echo "<td><a href='admin_hapus_kota.php?id=".$row["ID_KOTA"]."' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a></td>";
											echo"</tr>";
										}
								echo "</table>";
						}
						
					?>
					<a href='admin_lihat_kota.php' class='btn btn-primary'><i class='fa fa-edit'></i> Lihat Semua</a>
				</div>
			</div>
		
		
		</div>
	</div>
</div>
  
  
	 <?php include("admin_footer.php"); ?>
  
	</body>
</html>