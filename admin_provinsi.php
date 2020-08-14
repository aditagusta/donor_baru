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
<div class="container"  style='margin-top:70px' >
	<div class="row">
		<div class="col-sm-3">
			<?php include("admin_navigasi.php");?>
		</div>
		<div class="col-sm-9" >
			<h3 class='text-primary'><i class="fa fa-bank"></i> Tambah Provinsi </h3><hr>    
			<div class="row">
				<div class="col-md-6">
				<?php 
				if(isset($_POST["tambah_provinsi"]))
				{
					$sql="INSERT INTO provinsi (NAMA_PROVINSI) VALUES ('".$_POST["namaprovinsi"]."')";
					$con->query($sql);
					
				}
				
				?>
				
					<p id='out' class='text-success'></p>
					<form role="form" action="admin_provinsi.php" method="post">
						<div class="form-group text-primary">
							<label for="namaprovinsi">Nama Provinsi</label>
							<input id="namaprovinsi" required type="text" class="form-control" name="namaprovinsi">
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name='tambah_provinsi' value="Tambah Provinsi">
						</div>
						
					</form>
				</div>
				<div class="col-md-6">
					<?php 
						$sql="SELECT * FROM provinsi ORDER BY ID_PROVINSI desc LIMIT 0,5 ";
						$result=$con->query($sql);
						if($result->num_rows>0)
						{
								echo "<table class='table table-striped' >";
									echo "<tr>
											<th>No</th>
											<th>Nama Provinsi</th>
											<th>Hapus</th>
										</tr>";
										$i=0;
										while($row=$result->fetch_assoc())
										{
											$i++;
											echo"<tr>";
												echo "<td>$i</td>";
												echo "<td>".$row["NAMA_PROVINSI"]."</td>";
												echo "<td><a href='admin_hapus_provinsi.php?id=".$row["ID_PROVINSI"]."' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a></td>";
											echo"</tr>";
										}
								echo "</table>";
						}
						
					?>
					
					<a href='admin_lihat_provinsi.php' class='btn btn-primary'><i class='fa fa-edit'></i> Lihat Semua</a>
				</div>
			</div>
		
		
		</div>
	</div>
</div>
  
  
	 <?php include("admin_footer.php"); ?>
  
	</body>
</html>