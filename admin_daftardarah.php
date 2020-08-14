<?php 
include("config.php");
include("admin_function.php");

if(isset($_POST["q"])&&$_POST["q"]!="")
{
	$key=$_POST["q"];
	 $sql="SELECT * FROM butuh_darah WHERE NAMA LIKE '%".$key."%' OR GOLONGAN_DARAH LIKE '%".$key."%' OR RUMAH_SAKIT LIKE '%".$key."%' OR KOTA LIKE '%".$key."%' OR KODE_POS LIKE '%".$key."%' OR NAMA_DOKTER LIKE '%".$key."%' OR JADWAL_BUTUH LIKE '%".$key."%' OR NAMA_KONTAK LIKE '%".$key."%' OR EMAIL LIKE '%".$key."%' OR KONTAK_1 LIKE '%".$key."%' OR KONTAK_2 LIKE '%".$key."%' OR TUJUAN LIKE '%".$key."%' OR WAKTU LIKE '%".$key."%'";
	load_patient($sql,$con);
	
}
else if($_POST["q"]=="")
{
	$sql="Select * from butuh_darah";
				load_patient($sql,$con);
}

?>


