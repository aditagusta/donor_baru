<?php
session_start();
include("config.php");
 if(!isset($_SESSION['usertype']))
 {
	 header("location:admin.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
			<?php include("head.php");?>
	</head>
	<body>

<?php include("menu_adminatas.php"); ?>
<div class="container"  style='margin-top:70px'>
	<div class="row">
		<div class="col-sm-3">
			<?php include("menu_admin.php");?>
		</div>
		<div class="col-sm-9" >
			<h3 class='text-primary'><i class="fa fa-users"></i> Detail Pendonor </h3><hr>    
		<div class="row">
		<?php 
		if(isset($_GET["id"]))
		{
			$sql="SELECT * FROM Pendonor WHERE ID_DONOR=".$_GET["id"];
			$result=$con->query($sql);
			if($result->num_rows>0)
			{
				$row=$result->fetch_assoc();
				
		?>
		<div class="col-md-4">
					<div class="panel">
					<div class="panel-body">
					<img src="<?php echo $row["FOTO"];?>" class="image-rounded" height="300px" width="100%">
			</div>
			</div>
			
		</div>
		<div class="col-md-8">
		<table class="table table-striped">
			<tr>
				<th>Nama</th>
				<td><?php echo $row["NAMA"];?></td>
			</tr>
			<tr>
				<th>Nama Orang Tua</th>
				<td><?php echo $row["NAMA_ORTU"];?></td>
			</tr>
			<tr>
				<th>Jenis Kelamin</th>
				<td><?php echo $row["JENIS_KELAMIN"];?></td>
			</tr>
			<tr>
				<th>Data Lahir</th>
				<td><?php echo $row["DATA_LAHIR"];?></td>
			</tr>
			<tr>
				<th>Golongan Darah</th>
				<td><?php echo $row["GOLONGAN_DARAH"];?></td>
			</tr>
			<tr>
				<th>Berat Badan</th>
				<td><?php echo $row["BERAT_BADAN"];?></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><?php echo $row["EMAIL"];?></td>
			</tr>
			<tr>
				<th>Alamat</th>
				<td><?php echo $row["ALAMAT"];?></td>
			</tr>
			<tr>
				<th>Area</th>
				<td><?php echo $row["AREA"];?></td>
			</tr>
			<tr>
				<th>Kota</th>
				<td><?php echo $row["KOTA"];?></td>
			</tr>
			<tr>
				<th>Kode Pos </th >
				<td><?php echo $row["KODE_POS"];?></td>
			</tr>
			<tr>
				<th>Kecamatan</th>
				<td><?php echo $row["KECAMATAN"];?></td>
			</tr>
			<tr>
				<th>Kontak-1</th>
				<td><?php echo $row["KONTAK_1"];?></td>
			</tr>
			<tr>
				<th>Kontak-2</th>
				<td><?php echo $row["KONTAK_2"];?></td>
			</tr>
			<tr>
				<th>Relawan</th>
				<td><?php echo $row["RELAWAN"];?></td>
			</tr>
			<tr>
				<th>Kelompok Relawan</th>
				<td><?php echo $row["KELOMPOK_RELAWAN"];?></td>
			</tr>
			<tr>
				<th>Apakah Pendonor Baru</th>
				<td><?php echo $row["PENDONOR_BARU"];?></td>
			</tr>
			
			<tr>
				<th>Tanggal Donor Darah Dipilih</th>
				<td><?php echo $row["JADWAL_DONOR"];?></td>
			</tr>
			
			<tr>
				<th>Status</th>
				<td><?php 
				
					$status=$row["STATUS"];
					if($status==0)
					{
						echo'<a href="admin_aktif.php?id='.$row["ID_DONOR"].'" class="btn btn-sm btn-danger">Aktif</a>';
					}
					else
					{
							echo'<a href="admin_nonaktif.php?id='.$row["ID_DONOR"].'" class="btn btn-sm btn-success">Tidak Aktif</a>';
					}
				
				?></td>
			</tr>
			
		</table>
		</div>
	
		
		<?php
			}
		}	
		else
		{
		echo "<script>window.open('admin_donor.php','_self');</script>";
		}

		?>	
			
		<form class="col-md-6" method="post" action="update_terakhir.php">
			<div class="form-group">
				<label class="control-label text-primary" for="ldata">Tanggal Donor Darah Dipilih</label>
				<input type="text"  placeholder="YYYY/MM/DD" required id="ldata" name="ldata"  class="form-control input-sm DATES">
			</div>
			<input type="hidden" name="id" value="<?php echo $_GET["id"];?>">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan </button>
						
		</form>
			
		</div>
		</div>
	</div>
</div>
  
  
	 <?php include("admin_footer.php"); ?>
  <script>
  </script>

	</body>
</html>