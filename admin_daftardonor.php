<?php 
include("config.php");
include("admin_function.php");

if(isset($_POST["q"])&&$_POST["q"]!="")
{
	$key=$_POST["q"];
	 $sql="SELECT * FROM pendonor WHERE NAMA LIKE '%".$key."%' OR NAMA_ORTU LIKE '%".$key."%' OR JENIS_KELAMIN LIKE '%".$key."%' OR GOLONGAN_DARAH LIKE '%".$key."%' OR BERAT_BADAN LIKE '%".$key."%' OR EMAIL LIKE '%".$key."%' OR ALAMAT LIKE '%".$key."%' OR AREA LIKE '%".$key."%' OR KOTA LIKE '%".$key."%' OR KODE_POS LIKE '%".$key."%' OR KECAMATAN LIKE '%".$key."%' OR KONTAK_1 LIKE '%".$key."%' OR KONTAK_2 LIKE '%".$key."%' OR RELAWAN LIKE '%".$key."%' OR KELOMPOK_RELAWAN LIKE '%".$key."%'";
	load_donor($sql,$con);
	
}
else if($_POST["q"]=="")
{
	$sql="Select * from pendonor";
				load_donor($sql,$con);
}

?>


