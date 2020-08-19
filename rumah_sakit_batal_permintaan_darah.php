<?php
    session_start();
    require_once "functions.php";
    require_once "config.php";
    $con->update("tb_permintaan", array("status" => "Dibatalkan", "keterangan" => "Dibatalkan oleh pihak rumah sakit"), array("id_permintaan" => $_GET['id_permintaan']));
    alertRedirect("Permintaan darah berhasil dibatalkan!", "rumah_sakit_history_permintaan_darah.php");
?>