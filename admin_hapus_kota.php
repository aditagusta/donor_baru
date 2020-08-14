<?php
include("config.php");
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$sql="DELETE FROM kota WHERE ID_KOTA=$id";
	$con->query($sql);
	echo "<script>
		alert('Kota Dihapus');
		window.open('admin_kota.php','_self');
	</script>";
}
?>