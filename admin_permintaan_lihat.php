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
                <h3 class="text-primary"> Detail Permintaan Darah </h3>
                <hr>
                <table class="table">
                    <table class="table table-striped">
                        <tr>
                            <th scope="col">Nama Rumah Sakit</th>
                            <td>:</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <th scope="col">Golongan Darah</th>
                            <td>:</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <th scope="col">Nama Pasien</th>
                            <td>:</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <th scope="col">Tanggal Lahir</th>
                            <td>:</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <th scope="col">Jenis Kelamin</th>
                            <td>:</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <th scope="col">Tanggal Permintaan</th>
                            <td>:</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <th scope="col">Tanggal Kebutuhan</th>
                            <td>:</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <th scope="col">Status</th>
                            <td>:</td>
                            <td style="width: 50%;">
                                <div class="row">

                                    <div class="col-sm-9"><select name="" id="" class="form-control">
                                            <option value="">Belum Diproses</option>
                                            <option value="">Selesai Diproses</option>
                                            <option value="">Dibatalkan</option>
                                            <option value="">Ditunda</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <button class="btn btn-success">Simpan</button>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Keterangan</th>
                            <td>:</td>
                            <td>-</td>
                        </tr>
                    </table>
                </table>
            </div>


            <?php include("admin_footer.php"); ?>


</body>

</html>