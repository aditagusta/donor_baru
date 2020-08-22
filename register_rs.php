<?php
    session_start();
    require_once "config.php";
    require_once "functions.php";
    if (isset($_POST['simpan'])) {
        $sql = $con->insert("tb_rs", [
            "username" => $_POST['username'],
            "password" => $_POST['password'],
            "nama_rs" => $_POST['nama_rs'],
            "lokasi" => $_POST['lokasi'],
            "kontak" => $_POST['kontak']
        ]);
        if ($sql == TRUE) {
            echo "
        <script>
        alert('Data Rumah Sakit Berhasil disimpan !!!')
        window.location.href='index.php'
        </script>
        ";
        } else {
            echo "
        <script>
        alert('Data Rumah Sakit Gagal disimpan !!!')
        window.location.href='register_rs.php'
        </script>
        ";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
</head>

<body>
    <?php include 'menu_navigasi_atas.php'; ?>
    <div class="row centered-form ">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center" style="padding:5px;font-size:16px;font-weight:bold"><i class="fa fa-plus"></i> Registrasi Rumah Sakit</h3>
                </div>

                <div class="panel-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Rumah Sakit</label>
                            <input type="text" class="form-control" name="nama_rs">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <textarea name="lokasi" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Kontak</label>
                            <input type="text" class="form-control" name="kontak">
                        </div>
                        <button name="simpan" class="btn btn-primary" type="submit">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "registrasi_pendonor.php"; ?>
    <?php include("footer.php"); ?>
</body>

</html>