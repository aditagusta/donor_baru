<?php
include("config.php");
//include("functions.php"); 

error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include("head.php"); ?>
</head>

<body>

	<?php
	include("navigasi_atas.php");
	?>
	<div class="container" style='margin-top:70px;'>
		<div class="row">
			<div class="col-md-12">
				<h3 class=" text-primary">
					<i class='fa fa-users'></i> Pendaftaran Pendonor Baru
				</h3>
				<hr>
				<?php include("tampilan_menu.php"); ?>

			</div>
		</div>


		<div class="row centered-form ">
			<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				<?php
				if (isset($_POST["submit"])) {


					$target_dir = "donor_image/";
					$img = "donor_image/noimage.jpg";
					$target_file = $target_dir . rand(100, 999) . basename($_FILES["fileToUpload"]["name"]);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image

					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if ($check !== false) {
						echo "";
						$uploadOk = 1;
					} else {
						//  echo "File is not an image.";
						$uploadOk = 0;
					}

					// Check if file already exists
					if (file_exists($target_file)) {
						// echo "Sorry, file already exists.";
						$uploadOk = 0;
					}
					// Check file size
					if ($_FILES["fileToUpload"]["size"] > 5000000000) {
						// echo "Sorry, your file is too large.";
						$uploadOk = 0;
					}
					// Allow certain file formats
					if (
						$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
						&& $imageFileType != "gif"
					) {
						// echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						$uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						// echo "Sorry, your file was not uploaded.";
						// if everything is ok, try to upload file
					} else {
						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
							$img = $target_file;
						} else {
							//   echo "Sorry, there was an error uploading your file.";
						}
					}
					$provinsi = "";
					$kecamatan = "";

					$qry = "SELECT NAMA_PROVINSI FROM provinsi WHERE ID_PROVINSI={$_POST["PROVINSI"]}";
					$res = $con->query($qry);
					if ($res->num_rows > 0) {
						if ($row = $res->fetch_assoc()) {
							$provinsi = $row["NAMA_PROVINSI"];
						}
					}

					$qry = "SELECT NAMA_KECAMATAN FROM kecamatan WHERE ID_KECAMATAN={$_POST["KECAMATAN"]}";
					$res = $con->query($qry);
					if ($res->num_rows > 0) {
						if ($row = $res->fetch_assoc()) {
							$kecamatan = $row["NAMA_KECAMATAN"];
						}
					}



					$namakota = $_POST["KOTA"];

					$sql = "
INSERT INTO pendonor 
(NAMA, NAMA_ORTU, JENIS_KELAMIN, DATA_LAHIR, GOLONGAN_DARAH, BERAT_BADAN, EMAIL, ALAMAT, AREA, KOTA, KODE_POS, KECAMATAN, KONTAK_1, KONTAK_2, RELAWAN, KELOMPOK_RELAWAN, PENDONOR_BARU, JADWAL_DONOR, FOTO,PROVINSI)
 VALUES 
 ('{$_POST["NAMA"]}', '{$_POST["NAMA_ORTU"]}', '{$_POST["JENIS_KELAMIN"]}', '{$_POST["DATA_LAHIR"]}', '{$_POST["GOLONGAN_DARAH"]}', '{$_POST["BERAT_BADAN"]}', '{$_POST["EMAIL"]}', '{$_POST["ALAMAT"]}', '{$_POST["AREA"]}', '$namakota', '{$_POST["KODE_POS"]}', '{$kecamatan}', '{$_POST["KONTAK_1"]}', '{$_POST["KONTAK_2"]}', '{$_POST["RELAWAN"]}', '{$_POST["KELOMPOK_RELAWAN"]}', '{$_POST["PENDONOR_BARU"]}','{$_POST["JADWAL_DONOR"]}', '{$img}','{$provinsi}');";
					if ($con->query($sql)) {
						echo '
								<div class="alert alert-success">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Sukses!</strong> Terima kasih telah mendaftar sebagai pendonor.
								</div>
								';
					}
				}
				?>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title text-center" style="padding:5px;font-size:16px;font-weight:bold"><span class="fa fa-user "> </span> Bergabung sebagai Pendonor Darah</h3>
					</div>

					<div class="panel-body">
						<form method="post" action="registrasi_donor.php" autocomplete="off" role="form" enctype="multipart/form-data">
							<div class="form-group">
								<label class="control-label text-primary" for="NAMA">Nama</label>
								<input type="text" placeholder="Nama Lengkap" id="NAMA" name="NAMA" required class="form-control input-sm">
							</div>
							<div class="form-group">
								<label class="control-label text-primary" for="NAMA_ORTU">Nama Orang Tua</label>
								<input type="text" placeholder="Nama Orang Tua" id="NAMA_ORTU" name="NAMA_ORTU" required class="form-control input-sm">
							</div>

							<div class="form-group">
								<label class="control-label text-primary" for="JENIS_KELAMIN">Jenis Kelamin</label>
								<select id="gen" name="JENIS_KELAMIN" required class="form-control input-sm">
									<option value="">Pilih Jenis Kelamin</option>
									<option value="Pria">Pria</option>
									<option value="Perempuan">Perempuan</option>
								</select>
							</div>

							<div class="form-group">
								<label class="control-label text-primary" for="DATA_LAHIR">Data Lahir</label>
								<input type="text" placeholder="YYYY/MM/DD" required id="DATA_LAHIR" name="DATA_LAHIR" class="form-control input-sm DATES">
							</div>


							<div class="form-group">
								<label class="control-label text-primary" for="GOLONGAN_DARAH">Golongan Darah</label>
								<select id="GOLONGAN_DARAH" name="GOLONGAN_DARAH" required class="form-control input-sm">
									<option value="">Pilih Golongan</option>
									<option value="A+">A+</option>
									<option value="B+">B+</option>
									<option value="O+">O+</option>
									<option value="AB+">AB+</option>
									<option value="A1+">A1+</option>
									<option value="A2+">A2+</option>
									<option value="A1B+">A1B+</option>
									<option value="A2B+">A2B+</option>
									<option value="A-">A-</option>
									<option value="B-">B-</option>
									<option value="O-">O-</option>
									<option value="AB-">AB-</option>
									<option value="A1-">A1-</option>
									<option value="A2-">A2-</option>
									<option value="A1B">A1B-</option>
									<option value="A2B">A2B-</option>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label text-primary" for="BERAT_BADAN">Berat Badan</label>
								<input type="text" required placeholder="Berat Badan" name="BERAT_BADAN" id="BERAT_BADAN" class="form-control input-sm">
							</div>
							<div class="form-group">
								<label class="control-label text-primary" for="EMAIL">Email</label>
								<input type="email" required name="EMAIL" id="EMAIL" class="form-control" placeholder="Email">
							</div>

							<div class="form-group">
								<label class="control-label text-primary" for="PROVINSI">Provinsi</label>
								<select name="PROVINSI" id="PROVINSI" required class="form-control">
									<option value="">Pilih Provinsi</option>
									<?php
									$sql = "SELECT ID_PROVINSI,NAMA_PROVINSI FROM provinsi ORDER BY NAMA_PROVINSI ASC";
									$result = $con->query($sql);
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
											echo "<option value='{$row['ID_PROVINSI']}'>{$row['NAMA_PROVINSI']}	</option>";
										}
									}
									?>
								</select>
							</div>

							<div class="form-group">
								<label class="control-label text-primary" for="KECAMATAN">Kecamatan</label>
								<select name="KECAMATAN" id="KECAMATAN" required class="form-control">
									<option value="">Pilih Kecamatan</option>
									<?php
									$sql = "SELECT ID_KECAMATAN,NAMA_KECAMATAN FROM kecamatan ORDER BY NAMA_KECAMATAN ASC";
									$result = $con->query($sql);
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
											echo "<option value='{$row['ID_KECAMATAN']}'>{$row['NAMA_KECAMATAN']}	</option>";
										}
									}

									?>
								</select>
							</div>


							<div class="form-group">
								<label class="control-label text-primary" for="KOTA">Kota</label>
								<select name="KOTA" id="KOTA" required class="form-control">
									<option value="">Pilih Kota</option>
									<?php

									$sql = "SELECT ID_KOTA,NAMA_KOTA FROM kota ORDER BY NAMA_KOTA";
									$result = $con->query($sql);
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
											echo "<option value='{$row['ID_KOTA']}'>{$row['NAMA_KOTA']}	</option>";
										}
									}

									?>
								</select>
							</div>

							<div class="form-group">
								<label class="control-label text-primary" for="AREA">Area</label>
								<input type="text" required name="AREA" id="AREA" class="form-control" placeholder="Area">
							</div>

							<div class="form-group">
								<label class="control-label text-primary" for="ALAMAT">Alamat</label>
								<textarea required name="ALAMAT" id="ALAMAT" rows="5" style="resize:none;" class="form-control" placeholder="Alamat"></textarea>
							</div>

							<div class="form-group">
								<label class="control-label text-primary" for="KODE_POS">Kode Pos</label>
								<input type="text" required name="KODE_POS" id="KODE_POS" class="form-control" placeholder="Kode Pos">
							</div>





							<div class="form-group">
								<label class="control-label text-primary" for="KONTAK_1">Kontak 1</label>
								<input type="text" required name="KONTAK_1" id="KONTAK_1" class="form-control" placeholder="Kontak 1">
							</div>
							<div class="form-group">
								<label class="control-label text-primary" for="KONTAK_2">Kontak 2</label>
								<input type="text" required name="KONTAK_2" id="KONTAK_2" class="form-control" placeholder="Kontak 2">
							</div>
							<hr>
							<div class="form-group">
								<label class="control-label text-primary"><input type="checkbox" id="c1">&nbsp; Relawan Donor</label>
							</div>
							<div id="volu">
								<div class="form-group">

									<select name="RELAWAN" id="RELAWAN" class="form-control input-sm">
										<option value="">Pilih</option>
										<option value="Ya">Ya</option>
										<option selected value="Tidak">Tidak</option>

									</select>

								</div>
								<div class="form-group">
									<input type="text" name="KELOMPOK_RELAWAN" id="KELOMPOK_RELAWAN" class="form-control" placeholder="Kelompok Relawan" value="">
								</div>
								<div class="form-group">
									<label class="control-label text-primary" for="JADWAL_DONOR">Jadwal Donor</label>
									<input type="text" name="JADWAL_DONOR" value="0000/00/00" id="JADWAL_DONOR" placeholder="YYYY/MM/DD" class="form-control input-sm DATES">
								</div>
							</div>
							<hr>
							<div class="form-group" id="new">
								<label class="control-label text-primary" for="PENDONOR_BARU">Pendonor Baru</label>
								<select name="PENDONOR_BARU" id="PENDONOR_BARU" class="form-control input-sm">
									<option value="">Pilih</option>
									<option value="Ya">Ya</option>
									<option value="Tidak" selected>Tidak</option>

								</select>
							</div>

							<div class="form-group">
								<label class="control-label text-success" for="fileToUpload">Unggah Foto</label>
								<input type="file" class="form-control" name="fileToUpload">
							</div>

							<div class="form-group">
								<label class="control-label text-success"><input type="checkbox" checked id="c2">&nbsp; Saya telah memenuhi persyaratan donor darah dan mengisi data diri dengan benar.</label>
								<label class="control-label text-success"><input type="checkbox" checked id="c3">&nbsp; Saya setuju dengan syarat dan ketentuan yang berlaku serta menyetujui bahwa informasi dan darah saya akan diberikan kepada calon penerima darah.</label>
							</div>



							<div class="form-group">
								<button class="btn btn-primary" type="submit" name="submit">Daftar</button>
							</div>
						</form>
					</div>
				</div>
			</div>


		</div>


	</div>

	<?php include("footer.php"); ?>




	</script>

</body>

</html>