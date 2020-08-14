<?php 
			include "config.php";
			if(!empty($_POST["str"]))
			{
				$sql="SELECT * FROM pendonor WHERE ({$_POST["STYPE"]} LIKE '%{$_POST["str"]}%'  AND GOLONGAN_DARAH='{$_POST["GOLONGAN_DARAH"]}' AND STATUS=1)";
				$result=$con->query($sql);
				if($result->num_rows>0)
				{
						$i=0;
					echo "<div class='table-responsive '><table class='table table-striped table-bordered'>
								<tr class='text-primary'>	
									<th>No</th>
									<th>Foto</th>
									<th>Golongan Darah</th>
									<th>Nama</th>
									<th>Area</th>
									<th>Kode Pos</th>
									<th>Kota</th>
									<th>Kecamatan</th>
									<th>Cell</th>
								</tr>
							";
						
					while($row=$result->fetch_assoc())
					{
						$sdate=$row["JADWAL_DONOR"];
						$n=null;
						$date2=date_create($sdate);
						$cdate=date_create(date("Y-m-d"));
						$days=date_diff($date2,$cdate);
						$n=$days->format("%R%a");
						if($n>90)
						{
							$i++;
							echo"<tr>";
							echo"<td>$i</td>";
							echo"<td><img src='{$row["FOTO"]}' class='don_img' height='50px' width='50px'></td>";
							echo"<td>{$row["GOLONGAN_DARAH"]}</td>";
							echo"<td>{$row["NAMA"]}</td>";
							echo"<td>{$row["AREA"]}</td>";
							echo"<td>{$row["KODE_POS"]}</td>";
							echo"<td>{$row["KOTA"]}</td>";
							echo"<td>{$row["KECAMATAN"]}</td>";
							echo"<td>{$row["KONTAK_1"]}</td>";
							echo"</tr>";
						}
						
					}
					echo "</table></div>";
					
					if($i==0)
					{
						
					echo "<div class='alert alert-danger'><i class='fa fa-users'></i> Pendonor sudah mendonorkan darah</div>";
					}
				}
				else
				{
					echo "<div class='alert alert-danger'><i class='fa fa-users'></i> Pendonor tidak ditemukan</div>";
				}
			}
			else
			{
				echo "<script>alert('Silahkan ketik teks pencarian..');</script>";
			}
			

?>
<div class="modal fade" id="Mymodal">
	<div class="modal-content">
		<div class="modal-body">
		<img src='' id="md_img" height="100%" width="100%">
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$(".don_img").click(function(){
			var a=$(this).attr("src");
			$("#md_img").attr("src",a);
			$("#Mymodal").modal();
		});
		
	});
</script>

