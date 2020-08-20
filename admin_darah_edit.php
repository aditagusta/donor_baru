<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'config.php';
    $id = $_GET['id'];
    $data = $con->get('tb_darah', '*', ['id_darah' => $id]);
    include("head.php");
    ?>

</head>

<body>

    <?php include("menu_adminatas.php"); ?>
    <div class="container" style='margin-top:70px'>
        <div class="row">
            <div class="col-sm-3">
                <?php include("menu_admin.php"); ?>
            </div>
            <div class="col-sm-9">
                <h3 class="text-primary"><i class="fa fa-plus"></i>Tambah Data Darah </h3>
                <hr>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">Golongan Darah</label>
                        <!-- <input type="hidden" value="<?php echo $data['id_darah'] ?>" name="id"> -->
                        <input type="text" class="form-control" name="golongan" value="<?php echo $data['nama_darah'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea name="ket" id="" cols="30" rows="10" class="form-control"><?php echo $data['ket'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Stok</label>
                        <input type="text" class="form-control" name="stok" value="<?php echo $data['stok'] ?>">
                    </div>
                    <button name="ubah" type="submit" class="btn btn-sm btn-primary">Ubah Data</button>
                </form>
                <?php
                if (isset($_POST['ubah'])) {
                    $ubah = $con->update("tb_darah", [
                        "nama_darah" => $_POST['golongan'],
                        "ket" => $_POST['ket'],
                        "stok" => $_POST['stok']
                    ], [
                        "id_darah" => $id
                    ]);
                    if ($ubah == TRUE) {
                        echo "
                        <script>
                        alert('Data Darah Berhasil diubah !!!')
                        window.location.href='admin_darah.php'
                        </script>
                        ";
                    } else {
                        echo "
                        <script>
                        alert('Data Darah Gagal diubah !!!')
                        window.location.href='admin_darah_edit.php'
                        </script>
                        ";
                    }
                }
                ?>
            </div>


            <?php include("admin_footer.php"); ?>


</body>

</html>