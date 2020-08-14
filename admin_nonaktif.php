<?php 
session_start();
include("config.php");
 if(!isset($_SESSION['usertype']))
 {
	 header("location:admin.php");
 }
 
 if(isset($_GET["id"])&&!empty($_GET["id"]))
 {
	 $sql="UPDATE pendonor SET STATUS='0' WHERE ID_DONOR=".$_GET["id"];
	 $con->query($sql);
	 header("location:admin_lihat_donor.php?id={$_GET["id"]}"); 
 }
 else
 {
	 header("location:admin_lihat_donor.php"); 
 }

?>