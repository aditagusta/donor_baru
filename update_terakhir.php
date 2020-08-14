<?php
session_start();
include("config.php");
 if(!isset($_SESSION['usertype']))
 {
	 header("location:admin.php");
 }
 $id=$_POST["id"];
 $ldate=$_POST["ldata"];
 echo $sql="UPDATE pendonor SET JADWAL_DONOR='{$ldate}' WHERE  ID_DONOR='{$id}'";
 $con->query($sql);
 header("location:admin_lihat_donor.php?id={$id}");
 
?>