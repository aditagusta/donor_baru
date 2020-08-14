<?php
include("config.php");
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$sql="DELETE FROM provinsi WHERE ID_PROVINSI=$id";
	$con->query($sql);
	echo "<script>
		alert('Provinsi Dihapus');
		window.open('admin_provinsi.php','_self');
	</script>";
}
?>