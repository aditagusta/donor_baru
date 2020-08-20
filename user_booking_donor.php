<?php
    session_start();
    require_once "functions.php";
    require_once "config.php";
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $nama_foto = fileUpload($_FILES['foto'], "images/");
        $con->insert("tb_donor", array(
            "id_user"   => $_SESSION['id_user'],
            "id_darah"  => $_POST['id_darah'],
            "tgl_donor"  => $_POST['tgl_donor']." ".$_POST['jam_donor'],
            "tgl_booking"  => date("Y-m-d H:i:s"),
            "nama_lengkap"  => $_POST['nama_lengkap'],
            "nama_ortu"  => $_POST['nama_ortu'],
            "jenis_kelamin"  => $_POST['jenis_kelamin'],
            "tgl_lahir"  => $_POST['tgl_lahir'],
            "berat_badan"  => $_POST['berat_badan'],
            "alamat"  => $_POST['alamat'],
            "nohp"  => $_POST['nohp'],
            "foto"  => $nama_foto
        ));

        if(!is_null($con->error()[1]))
        {
            alert("Tidak dapat melakukan booking jadwal!".addslashes($con->error()[2]));
        }
        else
        {
            alertRedirect("Booking jadwal berhasil dilakukan!", "user_history_booking.php");
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
            <div class="col-sm-2 col-xs-12">
                <?php include("menu_pendonor.php"); ?>
            </div>
            <div class="col-sm-10 col-xs-12">
                <h3 class="text-primary"><i class="fa fa-envelope"></i> Booking Jadwal Donor </h3>
                <hr>
                <small><b>*Silahkan isi data dibawah ini dengan benar!</b></small>
                <br>
                <br>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Tanggal Melakukan Donor</label>
                                <input type="date" name="tgl_donor" class="form-control" />
                                
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Jam Melakukan Donor</label>
                                <input type="time" name="jam_donor" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Nama Lengkap Pendonor</label>
                                <input type="text" name="nama_lengkap" class="form-control" max="100" required />
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Nama Orang Tua Pendonor</label>
                                <input type="text" name="nama_ortu" class="form-control" max="100" required />
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Jenis Kelamin Pendonor</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option selected disabled>-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Tanggal Lahir Pendonor</label>
                                <input type="date" name="tgl_lahir" class="form-control"  required />
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Berat Badan Pendonor (Kg)</label>
                                <input type="number" name="berat_badan" class="form-control" max="200" min="1" required />
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Golongan Darah Pendonor</label>
                                <select name="id_darah" class="form-control">
                                    <option selected disabled>-- Pilih Golongan Darah --</option>
                                    <option value="0">Tidak Tahu</option>
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
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat">
                                    
                                </textarea>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Nohp Pendonor</label>
                                <input type="text" name="nohp" class="form-control" max="17" required />
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Foto Pendonor</label>
                                <input type="file" name="foto" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <small>*Harap bawa bukti booking donor saat datang ke PMI. <br> *Bukti booking donor dapat dicetak sesudah proses booking.</small>
                    <button class="btn btn-sm btn-success btn-block" type="submit">Booking Jadwal Donor</button>
                </form>
            </div>
        </div>
    </div>
    <?php include("admin_footer.php"); ?>
</body>

</html>