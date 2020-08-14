<?php include"config.php";?>
<!DOCTYPE html>
<html lang="en">
<?php include"head.php";?>
<body>

<?php
	 include"navigasi_atas.php";
?>
	
    <!-- Page Content -->
    <div class="container" style="margin-top:70px;">

			<div class="row">
				<div class="col-md-8">
				<?php
					if(isset($_POST["submit"]))
					{
					 $sql="INSERT INTO pesan (NAMA, KONTAK, EMAIL, PESAN, STATUS,WAKTU) VALUES ('{$_POST["name"]}', '{$_POST["phone"]}', '{$_POST["email"]}', '{$_POST["message"]}', 1,NOW());";
						if($con->query($sql))
				{
					echo '
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Sukses!</strong> Pesan Berhasil Dikirimkan.
					</div>
					
					
					';
				}
					}
				?>
		
				<h3 class='text-primary'>Kirimkan Pesan</h3>
                <form method="post" action="kontak.php" role="form" >
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Nama Lengkap:</label>
                            <input type="text" class="form-control" name="name" required>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Nomor Handphone:</label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Email :</label>
                            <input type="email" class="form-control" name="email"  >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Pesan:</label>
                            <textarea rows="5" cols="100" class="form-control" name="message" required maxlength="999" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button type="submit" class="btn btn-primary" name="submit"><i class='fa fa-send'></i> Kirim Pesan</button>
                </form>
				
			</div>
			
            <div class="col-md-4">
                <h3 class='text-primary'>Rincian Kontak</h3>
                <p>
                    Jl. Sawahan Dalam II No.12 kec. Padang Timur  <br>
					Kota Padang,<br>
					Sumatera Barat.<br>
					25121
                </p>
                <p><i class="fa fa-phone"></i> 
                    <abbr title="Phone"> </abbr>: (0751) 31795</p>
                <p><i class="fa fa-envelope-o"></i> 
                    <abbr title="Email"> </abbr>: <a href="#" >uddpmipadang@gmail.com</a>
                </p>
                <p><i class="fa fa-clock-o"></i> 
                    <abbr title="Hours"> </abbr>: 08.00 - 20.30</p>
				<p><i class="fa fa-globe"></i> 
                    <abbr title="Website"></abbr>: <a href="index.php">UDD PMI Kota Padang</a></p>
                <ul class="list-unstyled list-inline list-social-icons">
                    <li>
                        <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                    </li>
                </ul>
            </div>
        </div>


        <hr>
		<?php include"footer.php"; ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

   

</body>

</html>
