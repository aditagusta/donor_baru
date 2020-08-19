<?php
    session_start();
    require_once "functions.php";
    require_once "config.php";
    $con->update("tb_donor", array("status" => "Dibatalkan", "keterangan" => "Dibatalkan oleh pendonor"), array("id_donor" => $_GET['id_donor']));
    alertRedirect("Booking donor berhasil dibatalkan!", "user_history_booking.php");
?>