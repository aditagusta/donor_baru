<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'config.php';
    include("admin_head.php");
    ?>

</head>

<body>

    <?php include("admin_navigasiatas.php"); ?>
    <div class="container" style='margin-top:70px'>
        <div class="row">
            <div class="col-sm-3">
                <?php include("admin_navigasi.php"); ?>
            </div>
            <h3 class="text-primary text-center"> Detail Pendonor Darah </h3>
            <hr>
            <div class="col-sm-3">
                <img src="images/contact.jpeg" style="width: 100%;" alt="">
            </div>
            <div class="col-sm-6 table-responsive">

                <table class="table">
                    <table class="table table-striped">
                        <?php
                        include 'config.php';
                        $id = $_GET['id'];
                        $sql = $con->query("Select
						tb_donor.id_donor,
						tb_donor.id_user,
    					tb_donor.id_darah,
    					tb_donor.id_rs,
    					tb_donor.tgl_donor,
    					tb_donor.status,
    					tb_donor.tgl_booking,
    					tb_donor.nama_lengkap,
    					tb_donor.nama_ortu,
    					tb_donor.jenis_kelamin,
    					tb_donor.tgl_lahir,
    					tb_donor.berat_badan,
    					tb_donor.alamat,
    					tb_donor.nohp,
    					tb_donor.foto,
						tb_donor.keterangan,
						tb_darah.nama_darah,
						tb_rs.nama_rs
					From
						tb_donor Left Join
						tb_user On tb_donor.id_user = tb_user.id_user Left Join
						tb_rs On tb_donor.id_rs = tb_rs.id_rs Left Join
						tb_darah On tb_donor.id_darah = tb_darah.id_darah where tb_donor.id_donor='$id'");
                        foreach ($sql as $no => $data) {
                        ?>
                            <tr>
                                <th scope="col">Nama Pendonor</th>
                                <td>:</td>
                                <td><?php echo $data['nama_lengkap'] ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Nama Rumah Sakit</th>
                                <td>:</td>
                                <td><?php echo $data['nama_rs'] ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Golongan Darah</th>
                                <td>:</td>
                                <td><?php echo $data['nama_darah'] ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Nama Pasien</th>
                                <td>:</td>
                                <td>
                                    <select name="" id="" class="form-control">
                                        <?php
                                        $data_pasien = $con->select("tb_permintaan", "*");
                                        foreach ($data_pasien as $dp) {
                                        ?>
                                            <option value="<?php echo $dp['id_permintaan'] ?>"><?php echo $dp['nama_pasien'] ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Tanggal Booking</th>
                                <td>:</td>
                                <td><?php echo $data['tgl_booking'] ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Status</th>
                                <td>:</td>
                                <td style="width: 50%;">
                                    <div class="row">

                                        <div class="col-sm-8">
                                            <select name="status" class="form-control">
                                                <option value="Belum Diproses">Belum Diproses</option>
                                                <option value="Selesai Diproses">Selesai Diproses</option>
                                                <option value="Dibatalkan">Dibatalkan</option>
                                                <option value="Ditunda">Ditunda</option>
                                            </select>
                                        </div>
                                        <script>
                                            document.getElementsByName('status')[0].value = "<?php echo $data['status'] ?>"
                                        </script>
                                        <div class="col-sm-4">
                                            <button class="btn btn-success">Simpan</button>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Nama Orang Tua</th>
                                <td>:</td>
                                <td><?php echo $data['nama_ortu'] ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Jenis Kelamin</th>
                                <td>:</td>
                                <td><?php echo $data['jenis_kelamin'] ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Tanggal Lahir</th>
                                <td>:</td>
                                <td><?php echo $data['tgl_lahir'] ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Berat Badan</th>
                                <td>:</td>
                                <td><?php echo $data['berat_badan'] ?> Kg</td>
                            </tr>
                            <tr>
                                <th scope="col">Alamat</th>
                                <td>:</td>
                                <td><?php echo $data['alamat'] ?></td>
                            </tr>
                            <tr>
                                <th scope="col">NoHP</th>
                                <td>:</td>
                                <td><?php echo $data['nohp'] ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Keterangan</th>
                                <td>:</td>
                                <td><?php echo $data['keterangan'] ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </table>
            </div>

        </div>
        <?php include("admin_footer.php"); ?>


</body>

</html>