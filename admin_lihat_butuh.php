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
			<h3 class='text-primary'><i class="fa fa-bed"></i> Rincian Pasien </h3><hr>    
		<div class="row">
		<?php 
		
			if(isset($_POST["submit"]))
			{
				$id=$_GET['id'];
				$cdate=$_POST["CDATE"];
				$status=$_POST["STATUS"];
				if($cdate=="")
				{
					$cdate="0000-00-00";
					$status=1;
				}
			$sql="UPDATE butuh_darah SET WAKTU='{$cdate}',STATUS='{$status}' WHERE ID='{$id}'";
				if($con->query($sql))
				{
					
					$s= "<div class='alert alert-success fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Sukses : </strong> Pembaruan Status Berhasil.</div>";
				}
			
			}
			
		
		if(isset($_GET["id"]))
		{
			$sql="SELECT * FROM butuh_darah WHERE ID=".$_GET["id"];
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
				<th>Golongan Darah</th>
				<td><?php echo $row["GOLONGAN_DARAH"];?></td>
			</tr>
			<tr>
				<th>Jumlah</th>
				<td><?php echo $row["UNIT"];?></td>
			</tr>
			<tr>
				<th>Rumah Sakit/Klinik</th>
				<td><?php echo $row["RUMAH_SAKIT"];?></td>
			</tr>
			<tr>
				<th>Kota</th>
				<td><?php echo $row["KOTA"];?></td>
			</tr>
			<tr>
				<th>Kode Pos</th>
				<td><?php echo $row["KODE_POS"];?></td>
			</tr>
			<tr>
				<th>Nama Dokter</th>
				<td><?php echo $row["NAMA_DOKTER"];?></td>
			</tr>
			<tr>
				<th>Tanggal Permintaan</th>
				<td><?php echo $row["JADWAL_BUTUH"];?></td>
			</tr>
			<tr>
				<th>Nama Kontak</th>
				<td><?php echo $row["NAMA_KONTAK"];?></td>
			</tr>
			<tr>
				<th>Alamat</th>
				<td><?php echo $row["ALAMAT"];?></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><?php echo $row["EMAIL"];?></td>
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
				<th>Status</th>
				<td><?php 
				if($row["STATUS"]==0)
				{
					echo "<b>Tertunda</b>";
				}
				else if($row["STATUS"]==1)
				{
					echo "<b>Belum Selesai</b>";
				}	
				else if($row["STATUS"]==2)
				{
					echo "<b>Selesai</b>";
				}
					
					
					?></td>
			</tr>
			<tr>
				<th>Tanggal Selesai</th>
				<td><?php echo $row["WAKTU"];?></td>
			</tr>
		</table>
		</div>
		<div class="col-md-6">
		<h3 class='text-primary'>Perbaruan Terbaru</h3>
		<hr>
		<?php if(isset($s)){echo $s;}?>
		<form method='post' action="<?php echo $_SERVER['PHP_SELF']."?id=".$_GET["id"];?>">
			<div class="form-group">
				<label for="CDATE">Tanggal Selesai</label>
				<input type="text" name="CDATE"  id="CDATE" class="form-control DATES">
			</div>
			
			<div class="form-group">
				<label for="STATUS">Status</label>
				<select name="STATUS" required  id="STATUS" class="form-control">
					<option value="">Pilih Status</option>
					<option value="0">Tertunda </option>
					<option value="1">Belum Selesai</option>
					<option value="2">Selesai</option>
				</select>
			</div>
			<button type='submit' class='btn btn-success ' name='submit'><i class='fa fa-edit'></i> Perbarui Sekarang</button>
			<a href='admin_butuh_darah.php' class='btn btn-primary '>Kembali Ke Halaman</a>
		</form>
		</div>
		<?php
			}
		}	
		else
		{
		echo "<script>window.open('admin_donor.php','_self');</script>";
		}

		?>	
					
		</div>
		</div>
	</div>
</div>
  
  
	 <?php include("admin_footer.php"); ?>
  

	</body>
</html>