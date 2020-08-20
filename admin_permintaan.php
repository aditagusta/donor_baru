<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'config.php';
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
            <div class="col-sm-9 table-responsive">
                <h3 class="text-primary"> Data Permintaan Darah </h3>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama RS</th>
                            <th scope="col">Gol. Darah</th>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Tanggal Kebutuhan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td><a href="admin_permintaan_lihat.php" class="btn btn-primary btn-sm">Lihat</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <?php include("admin_footer.php"); ?>


</body>

</html>