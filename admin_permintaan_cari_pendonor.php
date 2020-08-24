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
            tb_rs.kontak
        From
            tb_donor Left Join
            tb_darah On tb_donor.id_darah = tb_darah.id_darah Left Join
            tb_rs On tb_donor.id_rs = tb_rs.id_rs WHERE tb_donor.id_donor = :id_donor", array("id_donor" => $_POST['id_donor']))->fetch(PDO::FETCH_ASSOC);

        $keterangan_donor = "Darah pendonor sudah disalurkan ke pasien bernama ".$permintaan['nama_pasien'].", pasien rumah sakit ".$permintaan['nama_rs']." pada tanggal ".tanggal_indo($_POST['tgl_catatan'])." dengan kode permintaan P".$permintaan['id_permintaan']."-".date("dmYHis", strtotime($permintaan['tgl_permintaan']));

        $keterangan_permintaan = "Darah sudah didapatkan dari pendonor bernama ".$donor['nama_lengkap']." jenis kelamin ".$donor['jenis_kelamin']." pada tanggal ".tanggal_indo($_POST['tgl_catatan'])." dengan kode donor D".$donor['id_donor']."-".date("dmYHis", strtotime($donor['tgl_booking']));

        $con->update("tb_donor", array("status" => "Sudah Disalurkan", "keterangan" => $keterangan_donor, "tgl_diberikan" => $_POST['tgl_catatan'], "id_permintaan" => $_POST['id_permintaan']), array("id_donor" => $_POST['id_donor']));

        $con->update("tb_permintaan", array("status" => "Sudah Diproses", "keterangan" => $keterangan_permintaan), array("id_permintaan" => $_POST['id_permintaan']));

        $con->query("UPDATE tb_darah SET stok = stok - 1 WHERE id_darah = :id_darah",  array('id_darah' => $donor['id_darah']));

        $con->insert("tb_histori_darah", array(
            "id_darah" => $donor['id_darah'],
            "jumlah" => -1,
            "tgl_catatan" => $_POST['tgl_catatan'],
        ));

        alertRedirect("Darah pendonor berhasil disalurkan!", "admin_permintaan.php");
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
                    <a href="admin_permintaan.php" class="btn btn-sm btn-primary"><i class="fa fa-server"></i> Kembali</a>
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
                                    <option value="<?=$donor['id_donor']?>"><?php echo "D".$donor['id_donor']."-".date("dmYHis", strtotime($donor['tgl_booking'])); ?> - <?=$donor['nama_lengkap']?> - <?=$donor['jenis_kelamin']?></option>
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