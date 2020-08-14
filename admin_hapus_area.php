<?php
include("config.php");
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$sql="DELETE FROM area WHERE ID_AREA=$id";
	$con->query($sql);
	echo "<script>
		alert('Area Dihapus');
		window.open('admin_area.php','_self');
	</script>";
}
?>