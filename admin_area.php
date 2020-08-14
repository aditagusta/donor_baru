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
			<h3 class='text-primary'><i class="fa fa-bank"></i> Tambah Area </h3><hr>    
			<div class="row">
				<div class="col-md-6">
				<?php 
				if(isset($_POST["tambah_area"]))
				{
				 $sql="INSERT INTO area(ID_KOTA,ID_KECAMATAN,NAMA_AREA) VALUES ('".$_POST["namakecamatan"]."','".$_POST["namaarea"]."')";
					$con->query($sql);
					
				}
				
				?>
				
					<p id='out' class='text-success'></p>
					<form role="form" action="admin_area.php" method="post">
				
					<div class="form-group text-primary">
							<label for="KECAMATAN">Pilih Kecamatan</label>
							<select name="namakecamatan" id="KECAMATAN" required class="form-control">
								<option value="">Pilih Kecamatan</option>
								<?php
									$sql="SELECT ID_KECAMATAN,NAMA_KECAMATAN FROM kecamatan ORDER BY NAMA_KECAMATAN ASC";
									$result=$con->query($sql);
									if($result->num_rows>0)
									{
										while($row=$result->fetch_assoc())
										{
										echo "<option value='{$row['ID_KECAMATAN']}'>{$row['NAMA_KECAMATAN']}	</option>";
										}
									}
								?>
							</select>
						</div>
						
						
						<div class="form-group">
								
								<span id="city_feed"></span>
							

                          </div>
						  
						  <div class="form-group text-primary">
							<label for="area">Nama Area</label>
							<input id="area" required type="text" class="form-control" name="namaarea">
						</div>
						
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name='tambah_area' value="Tambah Area">
						</div>
						
					</form>
				</div>
				<div class="col-md-6">
					<?php 
						$sql="

Select kecamatan.NAMA_KECAMATAN, kota.NAMA_KOTA, area.NAMA_AREA, area.ID_AREA
From area Inner Join
kecamatan On area.ID_KECAMATAN = kecamatan.ID_KECAMATAN Inner Join
kota On area.ID_KOTA = kota.ID_KOTA
ORDER BY ID_AREA desc LIMIT 0,5";
						$result=$con->query($sql);
						if($result->num_rows>0)
						{
								echo "<table class='table table-striped' >";
									echo "<tr>
											<th>Sno</th>
											<th>Nama Kecamatan</th>
											<th>Nama Kota</th>
											<th>Nama Area</th>
											<th>Hapus</th>
										</tr>";
										$i=0;
										while($row=$result->fetch_assoc())
										{
											$i++;
											echo"<tr>";
												echo "<td>$i</td>";
												echo "<td>".$row["NAMA_KECAMATAN"]."</td>";
												echo "<td>".$row["NAMA_KOTA"]."</td>";
												echo "<td>".$row["NAMA_AREA"]."</td>";
												echo "<td><a href='admin_hapus_area.php?id=".$row["ID_AREA"]."' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a></td>";
											echo"</tr>";
										}
								echo "</table>";
						}
						
					?>
					<a href='admin_lihat_area.php' class='btn btn-primary'><i class='fa fa-edit'></i> Lihat Semua</a>
				</div>
			</div>
		
		
		</div>
	</div>
</div>
  
  
	 <?php include("admin_footer.php"); ?>
  <script>
  $(document).ready(function(){
	  
	  $("#STATE").change(function(){
		  var id= $("#STATE").val();
		  $.post('load_city.php',{sid:id},function(data){
			 // alert(data);
			  $("#city_feed").html(data);
		  });
	  });
  });
  </script>
	</body>
</html>