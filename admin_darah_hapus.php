<?php
include 'config.php';
$id = $_GET['id'];
$sql = $con->delete("tb_darah", ["AND" => ["id_darah" => $id]]);
if ($sql == TRUE) {
    echo "
    <script>
    alert('Data Darah Berhasil dihapus !!!')
    window.location.href='admin_darah.php'
    </script>
    ";
} else {
    echo "
    <script>
    alert('Data Darah Gagal dihapus !!!')
    window.location.href='admin_darah.php'
    </script>
    ";
}
