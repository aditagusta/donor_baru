<?php 
include("config.php");
	
if(isset($_POST['G_ID_KECAMATAN']))
{
$sql="Select ID_KOTA,NAMA_KOTA FROM kota WHERE ID_PROVINSI=".$_POST['G_ID_KECAMATAN'];

$result=$con->query($sql);
if($result->num_rows>0)
{
	echo '<option value="">Pilih Kota</option>';
while($row=$result->fetch_assoc())
{
echo "<option value='{$row['NAMA_KOTA']}'>{$row['NAMA_KOTA']}</option>";
}
}

}
	
	
	


?>