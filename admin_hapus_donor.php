<?php
session_start();
include("config.php");
 if(!isset($_SESSION['usertype']))
 {
	 header("location:admin.php");
 }
 if(isset($_GET["id"]))
 {
	 $id=$_GET["id"];
	 echo $sql="DELETE FROM pendonor WHERE ID_DONOR=$id";
	 $con->query($sql);
	 header("location:admin_donor.php?mes=Data Pendonor Dihapus");
 }
 else
 {
	 header("location:admin_customer.php");
 }
 
?>