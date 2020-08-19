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
        if ($_SESSION['level'] == "admin") {
            echo "<script>window.location='index.php'</script>";
        } elseif ($_SESSION['level'] == "user") {
            echo "<script>window.location='user_beranda.php'</script>";
        } else {
            echo "<script>window.location='rumah_sakit_history_permintaan_darah.php'</script>";
        }
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
                        <li><a href="rumah_sakit_history_permintaan_darah.php"><i class="fa fa-home"></i> Permintaan Darah</a></li>
                        <li><a href="logout.php">LogOut</a></li>
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
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label text-primary">Username</label>
                        <input type="text" placeholder="Username" name="username" required class="form-control input-sm">
                    </div>
                    <div class="form-group">
                        <label class="control-label text-primary">Password</label>
                        <input type="password" placeholder="Password" name="password" required class="form-control input-sm">
                    </div>
                    <div class="form-group">
                        <label class="control-label text-primary">Nama</label>
                        <input type="text" placeholder="Nama Lengkap" name="nama_lengkap" required class="form-control input-sm">
                    </div>
                    <div class="form-group">
                        <label class="control-label text-primary" for="JENIS_KELAMIN">Jenis Kelamin</label>
                        <select id="gen" name="jenis_kelamin" required class="form-control input-sm">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label text-primary">Data Lahir</label>
                        <input type="date" required name="tgl_lahir" class="form-control input-sm DATES">
                    </div>
                    <div class="form-group">
                        <label class="control-label text-primary" for="EMAIL">Email</label>
                        <input type="email" required name="email" id="EMAIL" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label class="control-label text-primary" for="ALAMAT">Alamat</label>
                        <textarea required name="alamat" id="ALAMAT" rows="5" style="resize:none;" class="form-control" placeholder="Alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label text-primary" for="KONTAK_1">Kontak</label>
                        <input type="text" required name="kontak" class="form-control" placeholder="Kontak">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label text-success">Unggah Foto</label>
                        <input type="file" class="form-control" name="foto">
                    </div>
                    <div class="form-group">
                        <label class="control-label text-success"><input type="checkbox" checked id="c2">&nbsp; Saya telah memenuhi persyaratan donor darah dan mengisi data diri dengan benar.</label>
                        <label class="control-label text-success"><input type="checkbox" checked id="c3">&nbsp; Saya setuju dengan syarat dan ketentuan yang berlaku serta menyetujui bahwa informasi dan darah saya akan diberikan kepada calon penerima darah.</label>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="submit">Daftar</button>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="">Jika Sebagai <b>Rumah Sakit</b> Silahkan Klik Tombol dibawah ini :</label>
                            <div class="form-group">
                                <a href="register_rs.php" class="btn btn-sm btn-primary">Register Rumah Sakit</a>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $namafoto = $_FILES['foto']['name'];
                    $lokasifoto = $_FILES['foto']['tmp_name'];

                    move_uploaded_file($lokasifoto, "images/" . $namafoto);
                    $sql = $con->insert("tb_user", [
                        "username" => $_POST['username'],
                        "password" => $_POST['password'],
                        "nama_lengkap" => $_POST['nama_lengkap'],
                        "jenis_kelamin" => $_POST['jenis_kelamin'],
                        "tgl_lahir" => $_POST['tgl_lahir'],
                        "email" => $_POST['email'],
                        "alamat" => $_POST['alamat'],
                        "kontak" => $_POST['kontak'],
                        "foto" => $namafoto
                    ]);
                }
                ?>
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