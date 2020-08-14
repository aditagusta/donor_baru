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
	 echo $sql="DELETE FROM pesan WHERE ID=$id";
	 $con->query($sql);
	 header("location:admin_pesan.php?mes=Pesan Dihapus");
 }
 else
 {
	 header("location:admin_pesan.php");
 }
 
?>