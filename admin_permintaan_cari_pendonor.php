<?php
    session_start();
    require_once "functions.php";
    require_once "config.php";

    $permintaan = $con->query("SELECT tb_permintaan.*, tb_darah.nama_darah FROM tb_permintaan INNER JOIN tb_darah ON tb_permintaan.id_darah = tb_darah.id_darah WHERE tb_permintaan.id_permintaan = :id_permintaan", array("id_permintaan" => $_GET['id_permintaan']))->fetch(PDO::FETCH_ASSOC);

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $donor = $con->query("Select
                                tb_donor.*,
                                IFNULL(tb_darah.nama_darah, 'Belum Diketahui') AS nama_darah,
                                tb_rs.nama_rs,
                                tb_rs.lokasi,
                                tb_rs.kontak,
                                tb_user.email,
                                tb_user.nama_lengkap 
                            From
                                tb_donor Left Join
                                tb_darah On tb_donor.id_darah = tb_darah.id_darah Left Join
                                tb_rs On tb_donor.id_rs = tb_rs.id_rs Join 
                                tb_user On tb_donor.id_user = tb_user.id_user 
                                WHERE tb_donor.id_donor = :id_donor", array("id_donor" => $_POST['id_donor']))->fetch(PDO::FETCH_ASSOC);
	
		$permintaan = $con->query("Select tb_permintaan.*,
            tb_rs.*,
            tb_darah.nama_darah
        From
            tb_permintaan Left Join tb_darah On tb_permintaan.id_darah = tb_darah.id_darah 
            Join tb_rs ON tb_permintaan.id_rs = tb_rs.id_rs WHERE tb_permintaan.id_permintaan = :id_permintaan", array("id_permintaan" => $_POST['id_permintaan']))->fetch(PDO::FETCH_ASSOC);
		
        $keterangan_donor = "Darah pendonor sudah disalurkan ke pasien bernama ".$permintaan['nama_pasien'].", pasien rumah sakit ".$permintaan['nama_rs']." pada tanggal ".tanggal_indo($_POST['tgl_catatan'])." dengan kode permintaan P".$permintaan['id_permintaan']."-".date("dmYHis", strtotime($permintaan['tgl_permintaan']));

        $keterangan_permintaan = "Darah sudah didapatkan dari pendonor bernama ".$donor['nama_lengkap']." jenis kelamin ".$donor['jenis_kelamin']." pada tanggal ".tanggal_indo($_POST['tgl_catatan'])." dengan kode donor D".$donor['id_donor']."-".date("dmYHis", strtotime($donor['tgl_booking']));

        $con->update("tb_donor", array("id_rs" => $permintaan['id_rs'],"status" => "Sudah Disalurkan", "keterangan" => $keterangan_donor, "tgl_diberikan" => $_POST['tgl_catatan'], "id_permintaan" => $_POST['id_permintaan']), array("id_donor" => $_POST['id_donor']));

        $con->update("tb_permintaan", array("status" => "Sudah Diproses", "keterangan" => $keterangan_permintaan), array("id_permintaan" => $_POST['id_permintaan']));

        $con->query("UPDATE tb_darah SET stok = stok - 1 WHERE id_darah = :id_darah",  array('id_darah' => $donor['id_darah']));

        $con->insert("tb_histori_darah", array(
            "id_darah" => $donor['id_darah'],
            "jumlah" => -1,
            "tgl_catatan" => $_POST['tgl_catatan'],
        ));
        
        $nama_pengirim = 'UDD PMI Kota Padang';
    	$from = 'noreply@uddpmikotapadang.org';
    	$to = $data_donor['email'];
    	$subject = 'Pembaruan status donor darah Anda - UDD PMI Kota Padang';
    	$message  = "<b>Selamat, donor darah Anda sudah disalurkan ke salah satu pasien rumah sakit</b> <br>";
		$message .= "Berikut adalah detail donor darah Anda : <br> ";
		$message .= "No. Donor : D".$donor['id_donor']."-".date("dmYHis", strtotime($donor['tgl_booking']))." <br>";
		$message .= "Nama Lengkap : ".$donor['nama_lengkap']." <br>";
		$message .= "Nama Orang Tua : ".$donor['nama_ortu']." <br>";
		$message .= "Jenis Kelamin : ".$donor['jenis_kelamin']." <br>";
		$message .= "Tanggal Lahir : ".tanggal_indo($donor['tgl_lahir'])." <br>";
		$message .= "Golongan Darah : ".$donor['nama_darah']." <br>";
		$message .= "Berat Badan : ".$donor['berat_badan']." Kg <br>";
		$message .= "Alamat : ".$donor['alamat']." <br>";
		$message .= "Nohp : ".$donor['nohp']." <br>";
		$message .= "_______________________________________________________ <br>";
		$message .= "<br> <br> <br>";
		$message .= "Berikut adalah detail penerima donor darah Anda <br> :";
		$message .= "No. Permintaan : P".$permintaan['id_permintaan']."-".date("dmYHis", strtotime($permintaan['tgl_permintaan']))." <br>";
		$message .= "Rumah Sakit : ".$permintaan['nama_rs']." <br>";
		$message .= "Nama Pasien : ".$permintaan['nama_pasien']." <br>";
		$message .= "Tanggal Lahir : ".tanggal_indo($permintaan['tgl_lahir'])." <br>";
		$message .= "Golongan Darah : ".$permintaan['nama_darah']." <br>";
		$message .= "_______________________________________________________";
		$message .= "<br> <br> <br>";

    	$kirim_notifikasi = kirimEmail($nama_pengirim, $from, $to, $subject, $message);
        if($kirim_notifikasi['terkirim'])
		{
		    alertRedirect("Darah pendonor berhasil disalurkan!", "admin_permintaan.php");
		}
		else
		{
			alertRedirect("Darah pendonor berhasil disalurkan! Notifikasi gagal dikirim! ".$$kirim_notifikasi['error'], "admin_permintaan.php");
		}
		exit;
    }

    $data_donor = $con->query("Select
        tb_donor.*,
        IFNULL(tb_darah.nama_darah, 'Belum Diketahui') AS nama_darah,
        tb_rs.nama_rs,
        tb_rs.lokasi,
        tb_rs.kontak 
    From
        tb_donor Left Join
        tb_darah On tb_donor.id_darah = tb_darah.id_darah Left Join
        tb_rs On tb_donor.id_rs = tb_rs.id_rs WHERE tb_donor.status = 'Sudah Diproses' AND tb_donor.id_darah = :id_darah", array("id_darah" => $permintaan['id_darah']))->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php';?>
</head>

<body>

    <?php include("menu_navigasi_atas.php"); ?>
    <div class="container" style='margin-top:70px'>
        <div class="row">
            <div class="col-sm-3 col-xs-12">
                <?php include("menu_admin.php"); ?>
            </div>
            <div class="col-sm-9 col-xs-12">
            <h3 class="text-primary"><i class="fa fa-envelope"></i> Cari Pendonor</h3>
            <hr>
            <div class="col-xs-12">
                <div class="text-right" style="margin-bottom: 7px;">
                    <a href="admin_permintaan.php" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <form action="" method="POST">
                    <input type="hidden" name="id_permintaan" value="<?=$_GET['id_permintaan']?>" />
                    <div class="form-group">
                        <label>Pilih Pendonor</label>
                        <select name="id_donor" class="form-control select-dua">
                            <?php
                                foreach ($data_donor as $donor)
                                {
                            ?>
                                    <option value="<?=$donor['id_donor']?>"><?php echo "D".$donor['id_donor']."-".date("dmYHis", strtotime($donor['tgl_booking'])); ?> - <?=$donor['nama_lengkap']?> - <?=$donor['jenis_kelamin']?> - Gol. Darah (<?=$donor['nama_darah']?>)</option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Disalurkan</label>
                        <input type="date" value="<?=date("Y-m-d")?>" class="form-control" name="tgl_catatan" />
                    </div>
                    <br>
                    <button type="submit" class="btn btn-sm btn-primary btn-block">Proses Pendonor</button>
                    <br>
                    <br>
                    <br>
                    </div>
                </form>
                
                <h4>Detail Pasien</h4>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>No Permintaan</th>
                        <td><?php echo "P".$permintaan['id_permintaan']."-".date("dmYHis", strtotime($permintaan['tgl_permintaan'])); ?></td>
                    </tr>
                    <tr>
                        <th>Nama Pasien</th>
                        <td><?=$permintaan['nama_pasien']?></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td><?=$permintaan['jenis_kelamin']?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td><?=tanggal_indo($permintaan['tgl_lahir'])?></td>
                    </tr>
                    <tr>
                        <th>Golongan Darah</th>
                        <td><?=$permintaan['nama_darah']?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?=tanggal_indo($permintaan['tgl_permintaan'])." ".substr($permintaan['tgl_permintaan'], 10)?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Butuh</th>
                        <td><?=tanggal_indo($permintaan['tgl_butuh'])." ".substr($permintaan['tgl_butuh'], 10)?></td>
                    </tr>
                    <tr>
                        <th>Status Permintaan</th>
                        <td><?=$permintaan['status']?></td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td><?=$permintaan['keterangan']?></td>
                    </tr>
                </table>
            </div>
            </div>
        </div>
        <?php include("admin_footer.php"); ?>
</body>

</html>