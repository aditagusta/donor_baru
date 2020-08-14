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
<div class="container"  style='margin-top:70px;'>
	<div class="row">
		<div class="col-sm-3">
			<?php include("admin_navigasi.php");?>
		</div>
		<div class="col-sm-9" >
			<h3 class='text-primary'><i class="fa fa-bank"></i> Tambah Kecamatan </h3><hr>    
			<div class="row">
				<div class="col-md-6">
				<?php 
				if(isset($_POST["tambah_kecamatan"]))
				{
					$sql="INSERT INTO kecamatan (NAMA_KECAMATAN,ID_PROVINSI) VALUES ('".$_POST["namakecamatan"]."',".$_POST["PROVINSI"].")";
					$con->query($sql);
					
				}
				
				?>
				
					<p id='out' class='text-success'></p>
					<form role="form" action="admin_kecamatan.php" method="post">
					
						
						  <div class="form-group">
								<label class="control-label text-primary" for="PROVINSI">Provinsi</label>
                                <select name="PROVINSI" id="PROVINSI" required class="form-control">
								<option value="">Pilih Provinsi</option>
								<?php
									$sql="SELECT ID_PROVINSI,NAMA_PROVINSI FROM provinsi ORDER BY NAMA_PROVINSI ASC";
									$result=$con->query($sql);
									if($result->num_rows>0)
									{
										while($row=$result->fetch_assoc())
										{
											echo "<option value='{$row['ID_PROVINSI']}'>{$row['NAMA_PROVINSI']}	</option>";
										}
									}
								?>
								</select>
                          </div>
						<div class="form-group text-primary">
							<label for="kecamatan">Nama Kecamatan</label>
							<input id="kecamatan" required type="text" class="form-control" name="namakecamatan">
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name='tambah_kecamatan' value="Tambah Kecamatan">
						</div>
						
					</form>
					
				</div>
				<div class="col-md-6">
					<?php 
						$sql="Select provinsi.NAMA_PROVINSI, kecamatan.NAMA_KECAMATAN,kecamatan.ID_KECAMATAN
From kecamatan Inner Join
  provinsi On kecamatan.ID_PROVINSI = provinsi.ID_PROVINSI ORDER BY ID_KECAMATAN desc LIMIT 0,5 ";
						$result=$con->query($sql);
						if($result->num_rows>0)
						{
								echo "<table class='table table-striped' >";
									echo "<tr>
											<th>Sno</th>
											<th>Nama Provinsi</th>
											<th>Nama Kecamatan</th>
											<th>Hapus</th>
										</tr>";
										$i=0;
										while($row=$result->fetch_assoc())
										{
											$i++;
											echo"<tr>";
												echo "<td>$i</td>";
												echo "<td>".$row["NAMA_PROVINSI"]."</td>";
												echo "<td>".$row["NAMA_KECAMATAN"]."</td>";
												echo "<td><a href='admin_hapus_kecamatan.php?id=".$row["ID_KECAMATAN"]."' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a></td>";
											echo"</tr>";
										}
								echo "</table>";
						}
						
					?>
					
					<a href='admin_lihat_kecamatan.php' class='btn btn-primary'><i class='fa fa-edit'></i> Lihat Semua</a>
				</div>
			</div>
		
		
		</div>
	</div>
</div>
  
  
	 <?php include("admin_footer.php"); ?>
  
	</body>
</html>