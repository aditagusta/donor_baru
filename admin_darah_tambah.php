<?php
    session_start();
    require_once "config.php";
    require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("head.php");
    ?>

</head>

<body>
    <?php include("menu_navigasi_atas.php"); ?>
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
                        <input type="text" class="form-control" name="golongan">
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea name="ket" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Stok</label>
                        <input type="text" class="form-control" name="stok">
                    </div>
                    <button name="simpan" type="submit" class="btn btn-sm btn-primary">Simpan Data</button>
                </form>
                <?php
                if (isset($_POST['simpan'])) {
                    $sql = $con->insert("tb_darah", [
                        "nama_darah" => $_POST['golongan'],
                        "ket" => $_POST['ket'],
                        "stok" => $_POST['stok']
                    ]);
                    if ($sql == TRUE) {
                        echo "
                        <script>
                        alert('Data Darah Berhasil disimpan !!!')
                        window.location.href='admin_darah.php'
                        </script>
                        ";
                    } else {
                        echo "
                        <script>
                        alert('Data Darah Gagal disimpan !!!')
                        window.location.href='admin_darah_tambah.php'
                        </script>
                        ";
                    }
                }

                ?>
            </div>


            <?php include("admin_footer.php"); ?>


</body>

</html>