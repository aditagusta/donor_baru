<?php
session_start();
include "config.php";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $tabel = "";
    switch ($level) {
        case "admin":
            $tabel = "tb_admin";
            break;
        case "rs":
            $tabel = "tb_rs";
            break;
        case "user":
            $tabel = "tb_user";
            break;
    }

    $data_login = $con->get($tabel, "*", array("username" => $username, "password" => $password));
    if (!empty($data_login)) {
        $_SESSION = $data_login;
        unset($_SESSION['password']);
        $_SESSION['level'] = $level;
    } else {
        echo "<script>
        alert('Login Gagal')
        </script>";
    }
}
?>


<!-- Navigation -->
<nav class="navbar navbar-default 	 navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Berpindah Navigasi</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><i class="fa fa-heartbeat fa-lg"></i> UDD PMI Kota Padang</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <!-- <li><a href="tentang.php"><i class="fa fa-users"></i> Tentang Kami</a></li> -->
                <!-- <li><a href="registrasi_donor.php"><i class="fa fa-briefcase"></i> Pelayanan</a></li> -->
                <!-- <li><a href="admin.php"><i class="fa fa-user-md"></i> Admin</a></li> -->

                <?php
                if (empty($_SESSION['level'])) {
                ?>
                    <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="kontak.php"><i class="fa fa-envelope"></i> Hubungi Kami</a></li>
                    <li><a href="" data-toggle="modal" data-target="#myModal">Register</a></li>
                    <li><a href="" data-toggle="modal" data-target="#login">LogIn</a></li>
                    <?php
                } else {
                    if ($_SESSION['level'] == "admin") { ?>
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="admin_pesan.php"><i class="fa fa-home"></i> Data Program</a></li>
                        <li><a href="logout.php">LogOut</a></li>
                    <?php
                    } elseif ($_SESSION['level'] == "rs") {
                    ?>
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                    <?php
                    } elseif ($_SESSION['level'] == "user") {
                    ?>
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="user_beranda.php"><i class="fa fa-home"></i> Data Program</a></li>
                        <li><a href="logout.php">LogOut</a></li>
                <?php
                    }
                }
                ?>



            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content Register-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form Registrasi</h4>
            </div>
            <div class="modal-body">
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
                        <label class="control-label text-primary" for="ALAMAT">Alamat</label>
                        <textarea required name="ALAMAT" id="ALAMAT" rows="5" style="resize:none;" class="form-control" placeholder="Alamat"></textarea>
                    </div>





                    <div class="form-group">
                        <label class="control-label text-primary" for="KONTAK_1">Kontak</label>
                        <input type="text" required name="KONTAK_1" class="form-control" placeholder="Kontak">
                    </div>

                    <hr>


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

<!-- Modal -->
<div id="login" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content Login-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Silahkan Login !!!</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="text" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Level</label>
                        <select name="level" id="" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="rs">Rumah Sakit</option>
                            <option value="user">Pendonor</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit" name="login">LogIn</button>
                </form>
            </div>
        </div>

    </div>
</div>