<?php
    session_start();
    require_once "functions.php";
    require_once "config.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $con->update("tb_donor", array("status" => "Sudah Diproses", "keterangan" => "Pendonor sudah melakukan donor", "id_darah" => $_POST['id_darah']), array("id_donor" => $_POST['id_donor']));

        $con->query("UPDATE tb_darah SET stok = stok + 1 WHERE id_darah = :id_darah",  array('id_darah' => $_POST['id_darah']));

        $con->insert("tb_histori_darah", array(
            "id_darah" => $_POST['id_darah'],
            "jumlah" => 1,
            "tgl_catatan" => $_POST['tgl_catatan'],
        ));
        alertRedirect("Pendonor berhasil diproses", "admin_donor.php");
    }

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
            <h3 class="text-primary"><i class="fa fa-envelope"></i> Apakah Anda yakin ingin memproses pendonor ini?</h3>
            <hr>
            <div class="col-xs-12">
                <div class="text-right" style="margin-bottom: 7px;">
                    <a href="admin_donor.php" class="btn btn-sm btn-primary"><i class="fa fa-server"></i> Kembali</a>
                </div>
                <form action="" method="POST">
                    <input type="hidden" name="id_donor" value="<?=$_GET['id_donor']?>" />
                    <div class="form-group">
                        <label>Atur Golongan Darah Pendonor</label>
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
                            <script>
                                document.getElementsByName("id_darah")[0].value = "<?=$donor['id_darah']?>";
                            </script>
                        </select>
                    <div class="form-group">
                        <label>Tanggal Melakukan Donor</label>
                        <input type="date" value="<?=date("Y-m-d")?>" class="form-control" name="tgl_catatan" />
                    </div>
                        <br>
                        <button type="submit" class="btn btn-sm btn-primary">Proses Pendonor</button>
                    </div>
                </form>
                <br>
                <br>
                <h4>Detail Pendonor</h4>
                <img src="images/<?=$donor['foto']?>" width="250" />
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
        <?php include("admin_footer.php"); ?>


</body>

</html>