<?php
    session_start();
    require_once "config.php";
    require_once "functions.php";
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
            <div class="col-sm-3">
                <?php include("menu_admin.php"); ?>
            </div>
            <div class="col-sm-9">
                <h3 class="text-primary"><i class="fa fa-search"></i> Data Darah </h3>
                <hr>
                <a href="admin_darah_tambah.php" class="btn btn-sm btn-primary">+ Data Darah</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Golongan Darah</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'config.php';
                        $sql = $con->select("tb_darah", "*");
                        foreach ($sql as $no => $data) :
                        ?>
                            <tr>
                                <th scope="row"><?php echo $no + 1; ?></th>
                                <td><?php echo $data['nama_darah'] ?></td>
                                <td><?php echo $data['ket'] ?></td>
                                <td><?php echo $data['stok'] ?></td>
                                <td><a href="admin_darah_edit.php?id=<?php echo $data['id_darah'] ?>" class="btn btn-sm btn-danger">Edit</a> | <a href="admin_darah_hapus.php?id=<?php echo $data['id_darah'] ?>" class="btn btn-sm btn-primary">Hapus</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>


            <?php include("admin_footer.php"); ?>


</body>

</html>