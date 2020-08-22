<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content Register-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registrasi Akun Pendonor</h4>
            </div>
            <div class="modal-body">
                <label for="">Pihak <b>Rumah Sakit</b> Silahkan Klik Tombol dibawah ini :</label>
                <div class="form-group">
                    <a href="register_rs.php" class="btn btn-sm btn-primary">Registrasi Rumah Sakit</a>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label text-primary">Username</label>
                        <input type="text" placeholder="Username" name="username" required class="form-control input-sm">
                    </div>
                    <div class="form-group">
                        <label class="control-label text-primary">Password</label>
                        <input type="password" placeholder="Password" name="password" required class="form-control input-sm">
                    </div>
                    <div class="form-group">
                        <label class="control-label text-primary">Nama Lengkap</label>
                        <input type="text" placeholder="Nama Lengkap" name="nama_lengkap" required class="form-control input-sm">
                    </div>
                    <div class="form-group">
                        <label class="control-label text-primary" for="JENIS_KELAMIN">Jenis Kelamin</label>
                        <select id="gen" name="jenis_kelamin" required class="form-control input-sm">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label text-primary">Email</label>
                        <input type="email" placeholder="Email" name="email" required class="form-control input-sm">
                    </div>
                    <div class="form-group">
                        <label class="control-label text-primary">Nohp</label>
                        <input type="text" placeholder="Nohp" name="nohp" required class="form-control input-sm">
                    </div>
                    <div class="form-group">
                        <label class="control-label text-success"><input type="checkbox" id="c2" onclick="setujuRegistrasi()">&nbsp; Saya telah memenuhi persyaratan donor darah dan mengisi data diri dengan benar.</label>
                        <label class="control-label text-success"><input type="checkbox" id="c3" onclick="setujuRegistrasi()">&nbsp; Saya setuju dengan syarat dan ketentuan yang berlaku serta menyetujui bahwa informasi dan darah saya akan diberikan kepada calon penerima darah.</label>
                        <button class="btn btn-primary" type="submit" name="registrasi_pendonor" id="submit" disabled>Daftar</button>        
                    </div>
                </form>
                <script>
                    function setujuRegistrasi()
                    {
                        if(document.getElementById("c2").checked && document.getElementById("c3").checked)
                        {
                            document.getElementById("submit").disabled = false;
                        }
                        else
                        {
                            document.getElementById("submit").disabled = true;
                        }
                    }
                </script>
                <?php
                if (isset($_POST['registrasi_pendonor']))
                {
                    $con->insert("tb_user", [
                        "username" => $_POST['username'],
                        "password" => md5($_POST['password']),
                        "nama_lengkap" => $_POST['nama_lengkap'],
                        "jenis_kelamin" => $_POST['jenis_kelamin'],
                        "email" => $_POST['email'],
                        "nohp" => $_POST['nohp']
                    ]);
                    if(is_null($con->error()[1]))
                    {
                        alert("Akun pendonor berhasil dibuat. Anda sudah bisa login sekarang");
                    }
                }
                ?>
            </div>
        </div>

    </div>
</div>