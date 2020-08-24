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
        $sql_tambahan .= " AND tb_donor.id_darah = ".$id_darah;
    }

    if(!empty($_GET['tgl_akhir']))
    {
        $tgl_akhir = $_GET['tgl_akhir'];
    }

    if(!empty($_GET['status']))
    {
        $status = $_GET['status'];
        $sql_tambahan .= " AND tb_donor.status = '".$_GET['status']."'";
    }
    $data_donor = $con->query("Select tb_donor.*,
                ifnull(tb_darah.nama_darah, 'Belum Diatur') as nama_darah
            From
                tb_donor Left Join
                tb_darah On tb_donor.id_darah = tb_darah.id_darah WHERE tb_donor.tgl_donor >= DATE('".$tgl_awal."') AND tb_donor.tgl_donor <= DATE('".$tgl_akhir."') ".$sql_tambahan)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include("head.php"); ?>

</head>

<body>
    <?php include("menu_navigasi_atas.php"); ?>
	<div class="container" style='margin-top:70px'>
		<div class="row">
			<div class="col-sm-3 col-xs-12">
				<?php include("menu_admin.php"); ?>
			</div>
			<div class="col-sm-9 col-xs-12">
                <h3 class="text-primary"><i class="fa fa-envelope"></i> Data Donor Darah </h3>
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
                                <option value="Sudah Disalurkan">Sudah Disalurkan</option>
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
                <table class="table table-striped table-bordered" id="datatable">
                    <tr>
                        <th>No</th>
                        <th width="200">No Donor</th>
                        <th>Nama Pendonor</th>
                        <th>Tanggal Booking</th>
                        <th>Tanggal Donor</th>
                        <th>Darah</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>

                    <?php
                        foreach ($data_donor as $no => $donor)
                        {
                    ?>
                        <tr>
                            <td><?=$no+1?></td>
                            <td><?php echo "D".$donor['id_donor']."-".date("dmYHis", strtotime($donor['tgl_booking'])); ?></td>
                            <td><?php echo $donor['nama_lengkap']; ?></td>
                            <td><?php echo tanggal_indo($donor['tgl_booking']); ?></td>
                            <td><?php echo tanggal_indo($donor['tgl_donor'])." ".substr($donor['tgl_donor'], 10); ?></td>
                            <td><?php echo $donor['nama_darah']; ?></td>
                            <td><?php echo $donor['status']; ?></td>
                            <td><?php echo $donor['keterangan']; ?></td>
                            <td>
                                <?php if($donor['status'] == "Belum Diproses"): ?>
                                    <a href="admin_proses_pendonor.php?id_donor=<?=$donor['id_donor']?>" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Proses Donor</a>
                                    <br>
                                    <br>
                                <?php endif; ?>

                                <?php if($donor['status'] == "Sudah Diproses"): ?>
                                    <a href="admin_salurkan_donor.php?id_donor=<?=$donor['id_donor']?>" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Salurkan Darah Pendonor</a>
                                    <br>
                                    <br>
                                <?php endif; ?>

                                <a href="admin_lihat_donor.php?id_donor=<?=$donor['id_donor']?>" class="btn btn-sm btn-primary"><i class="fa fa-server"></i> Detail Donor</a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
            </div>
        </div>

			<?php include("admin_footer.php"); ?>

</body>

</html>