<!DOCTYPE html>
<html lang="en">
<head>
<?php include("head.php");?>
</head>
<body>
    
   
<?php
include("navigasi_atas.php");
?>

    <!-- Page Content -->
    <div class="container-fluid"  style='margin-top:70px;'>
        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
			 <h3 class=" text-primary">
					<i class='fa fa-search'></i>   Cari Ketersediaan Darah
                </h3><hr>
            </div>    
        </div>

			<?php  include("tampilan_menu.php"); ?>

		
       
		  
		  		<div class="row  centered-form ">
		    <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center" style="padding:5px;font-size:16px;font-weight:bold"><span class="fa fa-search "> </span>  Cari Ketersediaan Darah</h3>
                    </div>
                    <div class="panel-body">
					<form  name="frm" id="frm" >
						<div class="form-group">
							<label class="control-label text-primary">Cari Berdasarkan</label>
								<select name="STYPE"  id="STYPE" required class="form-control input-sm">
									<option value="KODE_POS">Kode Pos</option>
									<option value="AREA">Area</option>
									<option value="KOTA">Kota</option>
									<option value="KECAMATAN">Kecamatan</option>
								</select>
						</div>
						<div class="form-group">
							<label class="control-label text-primary">Golongan Darah Yang Dibutuhkan</label>
								<select name="GOLONGAN_DARAH" id="GOLONGAN_DARAH" required  class="form-control input-sm">
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
							<label class="control-label text-primary">Cari </label>
							<input type="text" name="str" id="str" required placeholder="Ketik disini" class="form-control input-sm">
						</div>
						
						 <div class="form-group">
							<button class="btn btn-primary" name="submit" type="button" id="submit"><i class='fa fa-search'></i> Cari Darah</button>
						  </div>
						
                    </div>
                </div>
            </div>
			 <div class="col-xs-12 col-sm-12 col-md-6" id="feedback">
			 <p>
				Silahkan isi secara baik dan cari data darah terdekat, untuk pertanyaan lebih lanjut silahkan hubungi admin kami.
			 </p>
			  </div>
			
			
			
            </div>
		  
           </div>


 <?php include("footer.php"); ?>

 <script>
	$(document).on('click','#submit',function(){
		
		$.ajax({
					url:"cari_don.php",
					method:"POST",
					data:$("#frm").serialize(),
					success:function(data)
					{
						$("#feedback").html(data);
						
					}
				});
		
	});
 </script>
	
</body>
</html>