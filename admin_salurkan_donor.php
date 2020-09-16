<?php
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    require_once "functions.php";
    require_once "config.php";
    
   
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    $donor = $con->query("Select
    tb_donor.*,
    IFNULL(tb_darah.nama_darah, 'Belum Diketahui') AS nama_darah,
    tb_rs.id_rs,
    tb_rs.nama_rs,
    tb_rs.lokasi,
    tb_rs.kontak
From
    tb_donor Left Join
    tb_darah On tb_donor.id_darah = tb_darah.id_darah Left Join
    tb_rs On tb_donor.id_rs = tb_rs.id_rs WHERE tb_donor.id_donor = :id_donor", array("id_donor" => $_GET['id_donor']))->fetch(PDO::FETCH_ASSOC);

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $data_permintaan = $con->query("Select tb_permintaan.*,
                                                    tb_rs.*,
                                                    tb_darah.nama_darah
                                                From
                                                    tb_permintaan Left Join tb_darah On tb_permintaan.id_darah = tb_darah.id_darah 
                                                    Join tb_rs ON tb_permintaan.id_rs = tb_rs.id_rs WHERE tb_permintaan.id_permintaan = :id_permintaan", array("id_permintaan" => $_POST['id_permintaan']))->fetch(PDO::FETCH_ASSOC); 

        $keterangan_donor = "Darah pendonor sudah disalurkan ke pasien bernama ".$data_permintaan['nama_pasien'].", pasien rumah sakit ".$data_permintaan['nama_rs']." pada tanggal ".tanggal_indo($_POST['tgl_catatan'])." dengan kode permintaan P".$data_permintaan['id_permintaan']."-".date("dmYHis", strtotime($data_permintaan['tgl_permintaan']));

        $keterangan_permintaan = "Darah sudah didapatkan dari pendonor bernama ".$donor['nama_lengkap']." jenis kelamin ".$donor['jenis_kelamin']." pada tanggal ".tanggal_indo($_POST['tgl_catatan'])." dengan kode donor D".$donor['id_donor']."-".date("dmYHis", strtotime($donor['tgl_booking']));


        $con->update("tb_donor", array("id_rs" => $donor['id_rs'], "status" => "Sudah Disalurkan", "keterangan" => $keterangan_donor, "tgl_diberikan" => $_POST['tgl_catatan'], "id_permintaan" => $_POST['id_permintaan']), array("id_donor" => $_POST['id_donor']));

        $con->update("tb_permintaan", array("status" => "Sudah Diproses", "keterangan" => $keterangan_permintaan), array("id_permintaan" => $_POST['id_permintaan']));

        $con->query("UPDATE tb_darah SET stok = stok - 1 WHERE id_darah = :id_darah",  array('id_darah' => $_POST['id_darah']));

        $con->insert("tb_histori_darah", array(
            "id_darah" => $_POST['id_darah'],
            "jumlah" => -1,
            "tgl_catatan" => $_POST['tgl_catatan'],
        ));

        $data_donor = $con->query("Select
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
                                WHERE tb_donor.id_donor = :id_donor", array("id_donor" => $donor['id_donor']))->fetch(PDO::FETCH_ASSOC);
        

        $permintaan = $con->query("Select tb_permintaan.*,
            tb_rs.*,
            tb_darah.nama_darah
        From
            tb_permintaan Left Join tb_darah On tb_permintaan.id_darah = tb_darah.id_darah 
            Join tb_rs ON tb_permintaan.id_rs = tb_rs.id_rs WHERE tb_permintaan.id_permintaan = :id_permintaan", array("id_permintaan" => $_POST['id_permintaan']))->fetch(PDO::FETCH_ASSOC);

        if(!is_null($con->error()[1]))
        {
            alert("Tidak dapat melakukan booking jadwal!".addslashes($con->error()[2]));
        }
        else
        {
            // KIRIM DATA BOOKING KE EMAIL PENDONOR
            if(!$_DEBUG)
            {
            	$nama_pengirim = 'UDD PMI Kota Padang';
	        	$from = 'noreply@uddpmikotapadang.org';
	        	$to = $data_donor['email'];
	        	$subject = 'Pembaruan status donor darah Anda - UDD PMI Kota Padang';
	        	$message  = "<b>Selamat, donor darah Anda sudah disalurkan ke salah satu pasien rumah sakit</b> <br>";
				$message .= "Berikut adalah detail donor darah Anda : <br> ";
				$message .= "No. Donor : D".$data_donor['id_donor']."-".date("dmYHis", strtotime($data_donor['tgl_booking']))." <br>";
				$message .= "Nama Lengkap : ".$data_donor['nama_lengkap']." <br>";
				$message .= "Nama Orang Tua : ".$data_donor['nama_ortu']." <br>";
				$message .= "Jenis Kelamin : ".$data_donor['jenis_kelamin']." <br>";
				$message .= "Tanggal Lahir : ".tanggal_indo($data_donor['tgl_lahir'])." <br>";
				$message .= "Golongan Darah : ".$data_donor['nama_darah']." <br>";
				$message .= "Berat Badan : ".$data_donor['berat_badan']." Kg <br>";
				$message .= "Alamat : ".$data_donor['alamat']." <br>";
				$message .= "Nohp : ".$data_donor['nohp']." <br>";
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
				    alertRedirect("Darah pendonor berhasil disalurkan!", "admin_donor.php");
				}
				else
				{
					alertRedirect("Darah pendonor berhasil disalurkan! Notifikasi gagal dikirim! ".$$kirim_notifikasi['error'], "admin_donor.php");
				}
            }
            else
            {
                alertRedirect("Darah pendonor berhasil disalurkan!", "admin_donor.php");
            }
            exit;
        }
    }

    
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
                <div class="col-xs-12">
                <h3 class="text-primary"><i class="fa fa-envelope"></i> Apakah Anda yakin ingin memproses pendonor ini?</h3>
                <hr>
                <div class="text-right" style="margin-bottom: 7px;">
                    <a href="admin_donor.php" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <form action="" method="POST">
                    <input type="hidden" name="id_donor" value="<?=$_GET['id_donor']?>" />
                    <input type="hidden" name="id_darah" value="<?=$_GET['id_darah']?>" />
                    <div class="form-group">
                        <label>Pilih Tujuan Penerima Donor</label>
                        <select name="id_permintaan" class="form-control">
                            <?php
                                $data_permintaan = $con->query("Select
                                                    tb_permintaan.*,
                                                    tb_rs.*,
                                                    tb_darah.nama_darah
                                                From
                                                    tb_permintaan Left Join tb_darah On tb_permintaan.id_darah = tb_darah.id_darah 
                                                    Join tb_rs ON tb_permintaan.id_rs = tb_rs.id_rs WHERE tb_permintaan.status = 'Belum Diproses' AND tb_permintaan.id_darah = :id_darah ORDER BY tb_permintaan.tgl_butuh", array("id_darah" => $donor['id_darah']))->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($data_permintaan as $darah)
                                {
                            ?>
                                    <option value="<?=$darah['id_permintaan']?>"><?php echo "P".$darah['id_permintaan']."-".date("dmYHis", strtotime($darah['tgl_permintaan'])); ?> - <?=$darah['nama_pasien']?> - Gol. Darah (<?=$darah['nama_darah']?>) - <?=$darah['nama_rs']?></option>
                            <?php
                                }
                            ?>
                            <script>
                                document.getElementsByName("id_darah")[0].value = "<?=$donor['id_darah']?>";
                            </script>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Disalurkan</label>
                        <input type="date" value="<?=date("Y-m-d")?>" class="form-control" name="tgl_catatan" />
                    </div>
                    <div class="form-group">
                        <br>
                        <button type="submit" class="btn btn-sm btn-primary">Proses Penyaluran Darah Pendonor</button>
                    </div>
                </form>
                <br>
                <br>
                    <h4>Detail Pendonor</h4>
                    <img src="images/<?=$donor['foto']?>" width="250" />
                    <br>
                    <br>
                    <br>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>No Donor</th>
                            <td><?="D".$donor['id_donor']."-".date("dmYHis", strtotime($donor['tgl_booking']))?></td>
                        </tr>
                        <tr>
                            <th>Nama Pendonor</th>
                            <td><?=$donor['nama_lengkap']?></td>
                        </tr>
                        <tr>
                            <th>Golongan Darah</th>
                            <td><?=$donor['nama_darah']?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Booking</th>
                            <td><?=tanggal_indo($donor['tgl_booking'])." ".substr($donor['tgl_booking'], 10)?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Melakukan Donor</th>
                            <td><?=tanggal_indo($donor['tgl_donor'])." ".substr($donor['tgl_donor'], 10)?></td>
                        </tr>
                        <tr>
                            <th>Status Booking</th>
                            <td><?=$donor['status']?></td>
                        </tr>
                        <tr>
                            <th>Nama Orang Tua Pendonor</th>
                            <td><?=$donor['nama_ortu']?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?=$donor['jenis_kelamin']?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td><?=tanggal_indo($donor['tgl_lahir'])?></td>
                        </tr>
                        <tr>
                            <th>Berat Badan</th>
                            <td><?=$donor['berat_badan']?> Kg</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><?=$donor['alamat']?></td>
                        </tr>
                        <tr>
                            <th>Nohp</th>
                            <td><?=$donor['nohp']?></td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td><?=$donor['keterangan']?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include("admin_footer.php"); ?>
</body>

</html>
