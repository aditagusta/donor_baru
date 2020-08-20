<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'config.php';
    include("head.php");
    ?>

</head>

<body>

    <?php include("menu_admin.php"); ?>
    <div class="container" style='margin-top:70px'>
        <div class="row">
            <div class="col-sm-3">
                <?php include("menu_admin.php"); ?>
            </div>
            <div class="col-sm-9">
                <h3 class="text-primary"><i class="fa fa-search"></i> Data Donor Darah </h3>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pendonor</th>
                            <th scope="col">Gol. Darah</th>
                            <th scope="col">Tanggal Donor</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal Booking</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
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
						tb_darah On tb_donor.id_darah = tb_darah.id_darah");
                        foreach ($sql as $no => $data) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $no + 1; ?></th>
                                <td><?php echo $data['nama_lengkap'] ?></td>
                                <td><?php echo $data['nama_darah'] ?></td>
                                <td><?php echo $data['tgl_donor'] ?></td>
                                <td><?php echo $data['status'] ?></td>
                                <td><?php echo $data['tgl_booking'] ?></td>
                                <td><a href="admin_donor_lihat.php?id=<?php echo $data['id_donor'] ?>" class="btn btn-primary btn-sm">Lihat</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>


            <?php include("admin_footer.php"); ?>
</body>

</html>