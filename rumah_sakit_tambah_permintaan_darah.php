<?php
    session_start();
    require_once "functions.php";
    require_once "config.php";
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $con->insert("tb_permintaan", array(
            "id_rs"   => $_SESSION['id_rs'],
            "id_darah"  => $_POST['id_darah'],
            "tgl_permintaan"  => date("Y-m-d H:i:s"),
            "tgl_butuh"  => $_POST['tgl_butuh'],
            "nama_pasien"  => $_POST['nama_pasien'],
            "jenis_kelamin"  => $_POST['jenis_kelamin'],
            "tgl_lahir"  => $_POST['tgl_lahir']
        ));

        if(!is_null($con->error()[1]))
        {
            alert("Tidak dapat melakukan permintaan darah!".addslashes($con->error()[2]));
        }
        else
        {
            alertRedirect("Permintaan darah berhasil ditambahkan!", "rumah_sakit_history_permintaan_darah.php");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php"); ?>
</head>

<body>

    <?php include("menu_navigasi_atas.php"); ?>
    <div class="container" style='margin-top:70px;'>
        <div class="row">
            <div class="col-sm-3 col-xs-12">
                <?php include("menu_rumah_sakit.php"); ?>
            </div>
            <div class="col-sm-9 col-xs-12">
                <h3 class="text-primary"><i class="fa fa-envelope"></i> Booking Jadwal Donor </h3>
                <hr>
                <small><b>*Silahkan isi data dibawah ini dengan benar!</b></small>
                <br>
                <br>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Tanggal Butuh Darah</label>
                                <input type="date" name="tgl_butuh" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Nama Lengkap Pasien</label>
                                <input type="text" name="nama_pasien" class="form-control" max="100" required />
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Jenis Kelamin Pasien</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option selected disabled>-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Tanggal Lahir Pasien</label>
                                <input type="date" name="tgl_lahir" class="form-control"  required />
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Golongan Darah Pasien</label>
                                <select name="id_darah" class="form-control">
                                    <option selected disabled>-- Pilih Golongan Darah --</option>
                                    <?php
                                        $data_darah = $con->select("tb_darah", "*");
                                        foreach ($data_darah as $darah)
                                        {
                                    ?>
                                            <option value="<?=$darah['id_darah']?>"><?=$darah['nama_darah']?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-success btn-block" type="submit">Tambah Permintaan Darah</button>
                </form>
            </div>
        </div>
    </div>
    <?php include("admin_footer.php"); ?>
</body>

</html>