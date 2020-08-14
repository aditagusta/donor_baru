<?php 
include("config.php");


if(isset($_POST['G_ID_KOTA']))
{
$sql="Select kecamatan.ID_KECAMATAN, kecamatan.NAMA_KECAMATAN, kota.NAMA_KOTA, kota.ID_KOTA
From kecamatan Inner Join
kota On kota.ID_KECAMATAN = kecamatan.ID_KECAMATAN
Where kota.ID_KOTA ={$_POST['G_ID_KOTA']}";

$result=$con->query($sql);
if($result->num_rows>0)
{
if($row=$result->fetch_assoc())
{
echo "<option value='{$row['NAMA_KECAMATAN']}'>{$row['NAMA_KECAMATAN']}</option>";
}
}

}
	
if(isset($_POST['G_ID_KECAMATAN']))
{
$sql="Select ID_KECAMATAN,NAMA_KECAMATAN FROM kecamatan WHERE ID_PROVINSI=".$_POST['G_ID_KECAMATAN'];

$result=$con->query($sql);
if($result->num_rows>0)
{
while($row=$result->fetch_assoc())
{
echo "<option value='{$row['ID_KECAMATAN']}'>{$row['NAMA_KECAMATAN']}</option>";
}
}

}
	
	
	


?>