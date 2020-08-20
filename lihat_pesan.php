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
<div class="container">
	<div class="row">
		<div class="col-sm-3">
			<?php include("menu_admin.php");?>
		</div>
		<div class="col-sm-9" >
			<h3><i class="fa fa-envelope"></i> Pesan <a href="admin_hapus_pesan.php?id=<?php echo $_GET['id']; ?>" class="btn-sm pull-right">Hapus Pesan</a></h3>  	  <hr>  
	<?php 
				$sql="UPDATE pesan SET STATUS=0 WHERE ID=$_GET[id]";
				$result=$con->query($sql);
				$sql="SELECT * FROM pesan  WHERE ID=$_GET[id]";
				$result=$con->query($sql);
				if($result->num_rows>0)
				{
					if($row=$result->fetch_assoc())
					{
						echo "<h4>".$row['NAMA']." <small>".$row['EMAIL']."</small></h4>";
						echo "<p>".$row['PESAN']."</p>";echo"<b>Kontak ".$row['KONTAK']."</b>";
						echo"<p class='text-info pull-right'>Pesan Masuk Pada ".$row['WAKTU']."</p>";
						
					}
				}
			?>
		
		</div>
	</div>
</div>
	 <?php include("admin_footer.php"); ?>
	</body>
</html>