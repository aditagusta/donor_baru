<?php
    session_start();
    require_once "functions.php";
    require_once "config.php";
    use Dompdf\Dompdf;

    $donor = $con->query("Select
    tb_donor.*,
    IFNULL(tb_darah.nama_darah, 'Belum Diketahui') AS nama_darah,
    tb_rs.nama_rs,
    tb_rs.lokasi,
    tb_rs.kontak
From
    tb_donor Left Join
    tb_darah On tb_donor.id_darah = tb_darah.id_darah Left Join
    tb_rs On tb_donor.id_rs = tb_rs.id_rs WHERE tb_donor.id_donor = :id_donor", array("id_donor" => $_GET['id_donor']))->fetch(PDO::FETCH_ASSOC);
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("admin_head.php"); ?>
</head>

<body>

        <div class="row">
            <div class="col-xs-12">
                <h1 class="text-center">UDD PMI Kota Padang</h1>
                <p class="text-center">Jl. Sawahan Dalam II No.12, Sawahan Tim., Kec. Padang Tim., Kota Padang, Sumatera Barat 25121</p>
                <h3>Bukti Booking Jadwal Donor Darah</h3>
                <hr>
                    <div class="col-xs-12">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Foto</th>
                                <td><img src="images/<?=$donor['foto']?>" width="100" /></td>
                            </tr>
                            <tr>
                                <th>No Donor</th>
                                <td><?=date("d-m-Y-His".$donor['id_donor'], strtotime($donor['tgl_booking']))?></td>
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
                        </table>
                    </div>
            </div>
</body>

</html>

<?php
  $content = ob_get_clean();
  // instantiate and use the dompdf class
  $dompdf = new Dompdf();
  $dompdf->loadHtml($content);
  
  // (Optional) Setup the paper size and orientation
  $dompdf->setPaper('A4', 'portrait');
  
  // Render the HTML as PDF
  $dompdf->render();
  
  $dompdf->stream("bukti-booking-".date("d-m-Y-His".$donor['id_donor'], strtotime($donor['tgl_booking'])).".pdf", array("Attachment" => false));
  exit(0);

?>