<?php
include("config.php");
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$sql="DELETE FROM kecamatan WHERE ID_KECAMATAN=$id";
	$con->query($sql);
	echo "<script>
		alert('Kecamatan Dihapus');
		window.open('admin_kecamatan.php','_self');
	</script>";
}
?>