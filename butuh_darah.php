<?php include("config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("head.php");?>

</head>
<body>
   
   
<?php
include("navigasi_atas.php");
?>
    <div class="container"  style='margin-top:70px;'>
        <div class="row">
            <div class="col-lg-12">
				 <h3 class=" text-primary">
					<i class='fa fa-heart'></i>  Butuh Darah Untuk Menyelamatkan Hidup
                </h3><hr>
            </div>
        </div>
		<?php  include("tampilan_menu.php"); ?>



		

       
		<div class="row centered-form">
		    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center" style="padding:5px;font-size:16px;font-weight:bold"><span class="fa fa-envelope "> </span> Butuh Darah Untuk Menyelamatkan Hidup</h3>
                    </div>
                    <div class="panel-body">
					<p id="errorBox"></p>
					
					<?php
						if(isset($_POST["submit"]))
						{
								$target_dir = "request_image/";
								$file_name=$_FILES["PIC"]["name"];
								if($file_name!="")
								{
									$target_file = $target_dir.rand(100,999). basename($_FILES["PIC"]["name"]);
									move_uploaded_file($_FILES["PIC"]["tmp_name"], $target_file);
									
								}
								else
								{
									$target_file ="request_image/no-image.jpg";	
								}
								
								 $sql="INSERT INTO butuh_darah(NAMA,JENIS_KELAMIN,GOLONGAN_DARAH,UNIT,RUMAH_SAKIT,KOTA,KODE_POS,NAMA_DOKTER,JADWAL_BUTUH,NAMA_KONTAK,EMAIL,KONTAK_1,KONTAK_2,TUJUAN,FOTO,ALAMAT)
								 VALUES('{$_POST["NAMA"]}','{$_POST["JENIS_KELAMIN"]}','{$_POST["GOLONGAN_DARAH"]}','{$_POST["BUNIT"]}','{$_POST["RUMAH_SAKIT"]}','{$_POST["KOTA"]}','{$_POST["PIN"]}','{$_POST["NAMA_DOKTER"]}','{$_POST["JADWAL_BUTUH"]}','{$_POST["NAMA_KONTAK"]}','{$_POST["EMAIL"]}','{$_POST["CON1"]}','{$_POST["CON2"]}','{$_POST["TUJUAN"]}','{$target_file}','{$_POST["ALAMAT"]}')";
									if($con->query($sql))
									{
										echo "<div class='alert alert-success fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Informasi : </strong>Permintaan darah anda telah terkirim, Admin akan memberitahu anda nanti</div>";
									}
									else
									{
										echo "<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error : </strong>Server sedang sibuk, silahkan coba lagi</div>";
									}
						}
						
					?>
					<form autocomplete="off" method="post"  action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
						<div class="form-group">
							<label class="control-label text-primary">Nama Pasien</label>
							<input type="text" placeholder="Nama Pasien" name="NAMA"  required id="NAMA" class="form-control input-sm">
						</div>
						
								<div class="form-group">
							<label class="control-label text-primary"  for="JENIS_KELAMIN">Jenis Kelamin</label>
								<select id="gen" name="JENIS_KELAMIN" required class="form-control input-sm">
									<option value="">Pilih Jenis Kelamin</option>
									<option value="Laki-Laki">Laki-Laki</option>
									<option value="Perempuan">Perempuan</option>
								</select>
						</div>
						
						
						<div class="form-group">
							<label class="control-label text-primary">Golongan Darah Yang Diperlukan</label>
								<select name="GOLONGAN_DARAH" id="GOLONGAN_DARAH" required  class="form-control input-sm">
							<option value="">Pilih Golongan Darah</option>
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
								<label class="control-label text-primary">Jumlah Darah</label>
                                <input type="text" required name="BUNIT" id="BUNIT" class="form-control" placeholder="Jumlah Darah">
                          </div>
						<div class="form-group">
								<label class="control-label text-primary">Alamat Rumah Sakit/Klinik </label>
                                <textarea required name="RUMAH_SAKIT" id="RUMAH_SAKIT" rows="5" style="resize:none;"class="form-control" placeholder="Alamat Rumah Sakit/Klinik"></textarea>
                          </div>
						 <div class="form-group">
								<label class="control-label text-primary">Kota</label>
                                <input type="text" required name="KOTA" id="KOTA" class="form-control" placeholder="Masukkan Kota">
                          </div>
						   <div class="form-group">
								<label class="control-label text-primary">Kode Pos</label>
                                <input type="text" required name="PIN" id="PIN" class="form-control" placeholder="Masukkan Kode Pos">
                          </div>
						  <div class="form-group">
							<label class="control-label text-primary">Nama Dokter</label>
							<input type="text" placeholder="Nama Dokter" class="form-control input-sm" name="NAMA_DOKTER" id="Nama Dokter">
						</div>
						<div class="form-group">
							<label class="control-label text-primary">Kapan Dibutuhkan</label>
							<input type="text" placeholder="MM/DD/YYYY" class="form-control input-sm DATES" name="JADWAL_BUTUH" id="JADWAL_BUTUH">
						</div>
						
						<div class="form-group">
							<label class="control-label text-primary">Nama Kontak</label>
							<input type="text" placeholder="Nama Kontak" class="form-control input-sm" name="NAMA_KONTAK" id="NAMA_KONTAK">
						</div>
						<div class="form-group">
								<label class="control-label text-primary">Alamat</label>
                                <textarea required name="ALAMAT" id="ALAMAT" rows="5" style="resize:none;"class="form-control" placeholder="Alamat "></textarea>
                          </div>
						<div class="form-group">
							<label class="control-label text-primary">Email</label>
							<input type="text" placeholder="Email" class="form-control input-sm" name="EMAIL" id="EMAIL">
						</div>
						<div class="form-group">
							<label class="control-label text-primary">Kontak No-1</label>
							<input type="text" placeholder="Nomor Kontak" class="form-control input-sm" name="CON1" id="CON1">
						</div>
							<div class="form-group">
							<label class="control-label text-primary">Kontak No-2</label>
							<input type="text" placeholder="Nomor Kontak" class="form-control input-sm" name="CON2" id="CON2">
						</div>
						<div class="form-group">
								<label class="control-label text-primary">Tujuan</label>
                                <textarea required name="TUJUAN" id="TUJUAN" rows="5" style="resize:none;"class="form-control" placeholder="Tuliskan Tujuan" name="TUJUAN" id="Alasan"></textarea>
                          </div>
						  	<div class="form-group">
							<label class="control-label text-primary" >Unggah Foto</label>
							<input type="file"  onChange="validate(this.value)" name="PIC" id="PIC">
						  </div>
						  
						  
						   <div class="form-group">
							<button class="btn btn-primary" id="BTN" name="submit"><i class="fa fa-send"></i> Pesan Sekarang</button>
						  </div>
						 </form>
                    </div>
                </div>
            </div>
            </div>
        
        </div>


 <?php include("footer.php"); ?>
<script>
	$(document).ready(
		function(){
		
		$("#BTN").click(function(){
			var NAME=$("#NAME").val();
			var BLOOD=$("#BLOOD").val();
			var BUNIT=$("#BUNIT").val();
			var HOSP=$("#HOSP").val();
			var CITY=$("#CITY").val();
			var PIN=$("#PIN").val();
			var DOC=$("#DOC").val();
			var RDATE=$("#RDATE").val();
			var CNAME=$("#CNAME").val();
			var EMAIL=$("#EMAIL").val();
			var CON1=$("#CON1").val();
			var CON2=$("#CON2").val();
			var REASON=$("#REASON").val();
			var PIC=$("#PIC").val();
			if($("#NAME").val() == "" )
				{
					$("#NAME").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Peringatan : </strong> Masukkan Nama Lengkap.</div>");
					return false;
				}
		
		if($("#BLOOD").val() == "" )
				{
					$("#BLOOD").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Peringatan : </strong> Masukkan Pilihan darah.</div>");
					return false;
				}
		
				if($("#BUNIT").val() == "")
				{
					$("#BUNIT").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Peringatan : </strong> Masukkan jumlah darah.</div>");
					return false;
				}
				
				if(isNaN($("#BUNIT").val()))
				{
					$("#BUNIT").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Peringatan : </strong> Jumlah Harus berupa angka.</div>");
					return false;
				}
				
				if($("#HOSP").val() == "")
				{
					$("#HOSP").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Peringatan : </strong> Masukkan nama rumah sakit dan alamat lengkap.</div>");
					return false;
				}
				
				if($("#CITY").val() == "")
				{
					$("#CITY").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Peringatan : </strong> Masukkan nama kotamu dengan benar.</div>");
					return false;
				}
				
				if($("#PIN").val() == "")
				{
					$("#PIN").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Peringatan : </strong> Masukkan kode pos anda.</div>");
					return false;
				}
					if(isNaN($("#PIN").val()))
				{
					$("#PIN").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Peringatan : </strong> Kode pos harus berupa angka.</div>");
					return false;
				}
				if($("#DOC").val() == "")
				{
					$("#DOC").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Peringatan : </strong> Masukkan nama dokter.</div>");
					return false;
				}
				
				if($("#RDATE").val() == "")
				{
					$("#RDATE").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Peringatan : </strong> Masukkan tanggal darah diperlukan.</div>");
					return false;
				}
				
				if($("#CNAME").val() == "")
				{
					$("#CNAME").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Peringatan : </strong> Masukkan nomor handphone.</div>");
					return false;
				}
				
				if($("#CADDRESS").val() == "")
				{
					$("#CADDRESS").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Peringatan : </strong> Masukkan alamat lengkap.</div>");
					return false;
				}
				if($("#CON1").val() == "")
				{
					$("#CON1").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Peringatan : </strong> Masukkan nomor handphone.</div>");
					return false;
				}
				
				if(isNaN($("#CON1").val()))
				{
					$("#CON1").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Peringatan : </strong> Masukkan nomor handphone dalam bentuk angka.</div>");
					return false;
				}
				
				if($("#CON2").val() == "")
				{
					$("#CON2").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Peringatan : </strong> Masukkan nomor handphone alternatif.</div>");
					return false;
				}
				
				if(isNaN($("#CON2").val()))
				{
					$("#CON2").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Peringatan : </strong> Masukkan nomor alternatif berbentuk angka.</div>");
					return false;
				}
				
				if($("#REASON").val() == "")
				{
					$("#REASON").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Peringatan : </strong> Masukkan alasan anda.</div>");
					return false;
				}
				
		
		});	
	});
	
	
	function validate(file) {
    var ext = file.split(".");
    ext = ext[ext.length-1].toLowerCase();      
    var arrayExtensions = ["jpg" , "jpeg", "png", "bmp", "gif"];
    if (arrayExtensions.lastIndexOf(ext) == -1) {
        alert("Please upload image file only.");
        $("#PIC").val("");
    }
}
</script>
	
</body>
</html>