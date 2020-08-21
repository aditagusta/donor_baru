<?php
    session_start();
    require_once "config.php";
    require_once "functions.php";
    $tgl_awal = date("Y-m-01");
    $tgl_akhir = date("Y-m-t");
    $id_darah = null;
    $status = "";
    $sql_tambahan = "";

    if(!empty($_GET['tgl_awal']))
    {
        $tgl_awal = $_GET['tgl_awal'];
    }

    if($_GET['id_darah'] != "")
    {
        $id_darah = $_GET['id_darah'];
        $sql_tambahan .= " AND tb_permintaan.id_darah = ".$id_darah;
    }

    if(!empty($_GET['tgl_akhir']))
    {
        $tgl_akhir = $_GET['tgl_akhir'];
    }

    if(!empty($_GET['status']))
    {
        $status = $_GET['status'];
        $sql_tambahan .= " AND tb_permintaan.status = '".$_GET['status']."'";
    }

    $sql = "Select tb_permintaan.*,
            tb_rs.*,
            tb_darah.nama_darah
        From
            tb_permintaan Left Join tb_darah On tb_permintaan.id_darah = tb_darah.id_darah 
            Join tb_rs ON tb_permintaan.id_rs = tb_rs.id_rs WHERE tb_permintaan.tgl_butuh >= DATE('".$tgl_awal."') AND tb_permintaan.tgl_butuh <= DATE('".$tgl_akhir."') ".$sql_tambahan." ORDER BY tb_permintaan.tgl_butuh";

    $data_permintaan = $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "head.php"; ?>
</head>

<body>

    <?php include("menu_navigasi_atas.php"); ?>
    <div class="container" style='margin-top:70px'>
        <div class="row">
            <div class="col-sm-3">
                <?php include("menu_admin.php"); ?>
            </div>

            <div class="col-sm-9 col-xs-12">
                <h3 class="text-primary"><i class="fa fa-envelope"></i> Data Permintaan Darah </h3>
                <hr>

                <form method="GET">
                    <div class="col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Tanggal Awal</label>
                            <input type="date" name="tgl_awal" value="<?=$tgl_awal?>" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <input type="date" name="tgl_akhir" value="<?=$tgl_akhir?>" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Golongan Darah</label>
                            <select name="id_darah" class="form-control">
                                <option value="">Semua Golongan Darah</option>
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
                            <script>
                                document.getElementsByName("id_darah")[0].value = "<?=$id_darah?>";
                            </script>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Status Permintaan</label>
                            <select name="status" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="Belum Diproses">Belum Diproses</option>
                                <option value="Sudah Diproses">Sudah Diproses</option>
                                <option value="Dibatalkan">Dibatalkan</option>
                            </select>
                            <script>
                                document.getElementsByName("status")[0].value = "<?=$status?>";
                            </script>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <button type="submit" class="btn bt-sm btn-primary btn-block">Filter</button>
                        <br>
                        <br>
                    </div>
                </form>
                <br>
                <br>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>No</th>
                        <th width="200">No Permintaan</th>
                        <th>Rumah Sakit</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal</th>
                        <th>Tanggal Butuh</th>
                        <th>Darah</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>

                    <?php
                        foreach ($data_permintaan as $no => $permintaan)
                        {
                    ?>
                        <tr>
                            <td><?=$no+1?></td>
                            <td><?php echo "P".$permintaan['id_permintaan']."-".date("dmYHis", strtotime($permintaan['tgl_permintaan'])); ?></td>
                            <td><?php echo $permintaan['nama_rs']; ?></td>
                            <td><?php echo $permintaan['nama_pasien']; ?></td>
                            <td><?php echo tanggal_indo($permintaan['tgl_permintaan']); ?></td>
                            <td><?php echo tanggal_indo($permintaan['tgl_butuh']); ?></td>
                            <td><?php echo $permintaan['nama_darah']; ?></td>
                            <td><?php echo $permintaan['status']; ?></td>
                            <td><?php echo $permintaan['keterangan']; ?></td>
                            <td>
                                <?php if($permintaan['status'] == "Belum Diproses"): ?>
                                    <a href="admin_proses_permintaan_donor.php?id_permintaan=<?=$permintaan['id_permintaan']?>" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Cari Pendonor</a>
                                    <br>
                                    <br>
                                <?php endif; ?>
                                <a href="admin_detail_permintaan_darah.php?id_permintaan=<?=$permintaan['id_permintaan']?>" class="btn btn-sm btn-primary"><i class="fa fa-server"></i> Detail Permintaan</a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </table>

            </div>
        </div>

            <?php include("admin_footer.php"); ?>
</body>

</html>