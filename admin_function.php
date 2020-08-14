<?php 
function load_donor($sql,$con)
{
	echo '
				<table class="table table-striped">
				<tr>
				<th>No.</th>
				<th>Nama</th>
				<th>Jenis Kelamin</th>
				<th>Golongan Darah</th>
				<th>Kota</th>
				<th>Kecamatan</th>
				<th>Kontak 1</th>
				<th>Kontak 2</th>
				<th>Lihat</th>
				<th>Hapus</th>
				
				</tr>';
				
					
							$result=$con->query($sql);
							$n=0;
							if($result->num_rows>0)
							{
								while($row=$result->fetch_assoc())
								{   
									$n++;
									echo "<tr>";
									echo "<td>".$n."</td>";
									echo "<td>".$row['NAMA']."</td>";
									echo "<td>".$row['JENIS_KELAMIN']."</td>";
									echo "<td>".$row['GOLONGAN_DARAH']."</td>";
									echo "<td>".$row['KOTA']."</td>";
									echo "<td>".$row['KECAMATAN']."</td>";
									echo "<td>".$row['KONTAK_1']."</td>";
									echo "<td>".$row['KONTAK_2']."</td>";
										
									echo "<td><a href='admin_lihat_donor.php?id=".$row['ID_DONOR']."' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i> Lihat</a></td>";
									echo "<td><a href='admin_hapus_donor.php?id=".$row['ID_DONOR']."' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Hapus</a></td>";
									echo "</tr>";
								}
							}
							
						
				
			echo'</table>';

}

function load_patient($sql,$con)
{
	echo '
				<table class="table table-striped">
				<tr>
				<th>No.</th>
				<th>Nama</th>
				<th>Jenis Kelamin</th>
				<th>Golongan Darah</th>
				<th>Unit</th>
				<th>Rumah Sakit</th>
				<th>Tujuan</th>
				<th>Jadwal Butuh</th>
				<th>Status</th>
				<th>Update</th>
				
				</tr>';
				
					
							$result=$con->query($sql);
							$n=0;
							if($result->num_rows>0)
							{
								while($row=$result->fetch_assoc())
								{   
									$n++;
									echo "<tr>";
									echo "<td>".$n."</td>";
									echo "<td>".$row['NAMA']."</td>";
									echo "<td>".$row['JENIS_KELAMIN']."</td>";
									echo "<td>".$row['GOLONGAN_DARAH']."</td>";
									echo "<td>".$row['UNIT']."</td>";
									echo "<td>".$row['RUMAH_SAKIT']."</td>";
									echo "<td>".$row['TUJUAN']."</td>";
									echo "<td>".$row['JADWAL_BUTUH']."</td>";
										
									if($row["STATUS"]==0)
									{
									
									echo "<td><a href='#' class='btn btn-danger btn-xs'><i class='fa fa-bed'></i> Tertunda</a></td>";
									
									}
									else if($row["STATUS"]==2)
									{
										
									echo "<td><a href='#' class='btn btn-success btn-xs'><i class='fa fa-bed'></i> Lengkap</a></td>";
									
									}
									else if($row["STATUS"]==1)
									{
										
									echo "<td><a href='#' class='btn btn-warning btn-xs'><i class='fa fa-bed'></i> Tidak Lengkap </a></td>";
									
									}
									
									
									echo "<td><a href='admin_lihat_butuh.php?id={$row['ID']}' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i> Lihat</a></td>";
									
									
									echo "</tr>";
									
								}
							}
							else
							{
								echo "<div >Belum Ada Permintaan Darah</div>";
							}
						
				
			echo'</table>';

}


?>
