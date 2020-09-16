<?php
    session_start();
    require_once "config.php";
    require_once "functions.php";
    $id = $_GET['id'];
	$sql = $con->delete("tb_pesan", ["id_pesan" => $id]);
    
    if ($sql == TRUE) {
	    echo "
	    <script>
	    alert('Pesan Berhasil dihapus !!!')
	    window.location.href='admin_pesan.php'
	    </script>
	    ";
	} else {
	    echo "
	    <script>
	    alert('Pesan Gagal dihapus !!!')
	    window.location.href='admin_pesan.php'
	    </script>
	    ";
	}

 
?>