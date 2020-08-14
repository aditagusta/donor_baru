<?php
session_start();
include("config.php");
include("admin_function.php");
 if(!isset($_SESSION['usertype']))
 {
	 header("location:admin.php");
 }
 
 $sql="Select kota.NAMA_KOTA, kecamatan.NAMA_KECAMATAN, kota.ID_KOTA
From kecamatan Inner Join
kota On kota.ID_PROVINSI = kecamatan.ID_PROVINSI  ORDER BY kota.ID_KOTA";
$result=$con->query($sql);
$rows=$result->num_rows;
$page_rows=5;

$last=ceil($rows/$page_rows);

if($last<1)
{
	$last=1;
}
$pagenum=1;
if(isset($_GET['pn']))
{
	$pagenum=preg_replace('#[^0-9]#','',$_GET['pn']);
}

if($pagenum<1){
	$pagenum=1;
}
elseif($pagenum>$last)
{
	$pagenum=$last;
}
$limit='LIMIT '.($pagenum-1)*$page_rows.','.$page_rows;

$sql="Select kota.NAMA_KOTA, kecamatan.NAMA_KECAMATAN, kota.ID_KOTA
From kecamatan Inner Join
kota On kota.ID_PROVINSI = kecamatan.ID_PROVINSI  ORDER BY kota.ID_KOTA DESC  $limit";

 $textline1="Total Area : $rows";
 $textline2="Halaman  <b>$pagenum</b> dari <b>$last</b>";
 
 $paginationctrls='<ul class="pagination">';
 if($last!=1)
 {
		 if($pagenum>1)
		 {
			 $previous=$pagenum-1;
			 $paginationctrls.=' <li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Sebelumnya</a></li>';
			 for($i=$pagenum-4;$i<$pagenum;$i++)
			 {
				 if($i>0)
				 {
					 $paginationctrls.='<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a></li>';
				 }
			 }
		 }
	 

	 $paginationctrls.='<li class="active" 	><a href="#"  >'.$pagenum.'</a></li> ';
	 
	 for($i=$pagenum+1;$i<=$last;$i++)
	 {
		 $paginationctrls.='<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> </li>';
		 if($i>=$pagenum+4)
		 {
			 break;
		 }
	 }
	 
	 if($pagenum!=$last)
	 {
		 $next=$pagenum+1;
		 $paginationctrls.='<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Selanjutnya</a></li></ul>';
	 }
	 
 }
 
 
 $list='';
 $result=$con->query($sql);
						if($result->num_rows>0)
						{
								$list.= "<table class='table table-striped' >";
									$list.= "<tr>
											<th>No</th>
											<th>Kota</th>
											<th>Kecamatan</th>
											<th>Hapus</th>
										</tr>";
										$i=0;
										while($row=$result->fetch_assoc())
										{
											$i++;
											$list.="<tr>";
												$list.= "<td>$i</td>";
												$list.= "<td>".$row["NAMA_KOTA"]."</td>";
												$list.= "<td>".$row["NAMA_KECAMATAN"]."</td>";
												$list.= "<td><a href='admin_hapus_kota.php?id=".$row["ID_KOTA"]."' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a></td>";
											$list.="</tr>";
										}
								$list.= "</table>";
						}

 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
			<?php include("admin_head.php");?>
	</head>
	<body>

<?php include("admin_navigasiatas.php"); ?>
<div class="container">
	<div class="row">
		<div class="col-sm-3">
			<?php include("admin_navigasi.php");?>
		</div>
		<div class="col-sm-9" >
			<h3><i class="fa fa-bank"></i> Lihat Rincian Kota </h3><hr>    
		
				<div class="col-md-12">

				<p><?php echo $textline1; ?></p>
				<p><?php echo $textline2; ?></p>
				<?php echo $list; ?>
				<?php echo $paginationctrls; ?>

				
				</div>
			</div>
		
		
		</div>
	</div>
</div>
  
  
	 <?php include("admin_footer.php"); ?>
  
	</body>
</html>