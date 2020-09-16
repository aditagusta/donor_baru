<?php
if (isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $tabel = "";
    switch ($level) {
        case "admin":
            $tabel = "tb_admin";
            break;
        case "rs":
            $tabel = "tb_rs";
            break;
        case "user":
            $tabel = "tb_user";
            break;
    }

    $data_login = $con->get($tabel, "*", array("username" => $username, "password" => md5($password)));
    if (!empty($data_login))
    {
        $_SESSION = $data_login;
        unset($_SESSION['password']);
        $_SESSION['level'] = $level;
        if ($_SESSION['level'] == "admin")
        {
        	alertRedirect("Anda Berhasil Login", "admin_beranda.php");
        }
        elseif($_SESSION['level'] == "user")
        {
        	alertRedirect("Anda Berhasil Login", "user_history_booking.php");
        }
        else
        {
        	alertRedirect("Anda Berhasil Login", "rumah_sakit_history_permintaan_darah.php");
        }
    }
    else
    {
        alertRedirect("Username atau Password salah!", "index.php");
    }
    exit;
}
?>

<!-- Modal -->
<div id="login" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content Login-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Silahkan Login !!!</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Level</label>
                        <select name="level" id="" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="rs">Rumah Sakit</option>
                            <option value="user">Pendonor</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit" name="login">LogIn</button>
                </form>
            </div>
        </div>

    </div>
</div>