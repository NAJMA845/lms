<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
include_once("../../models/media_room.php");

if (isset($_GET['guid'])) {
    $guid = $_GET['guid'];
    $res = deleteMultimediaBooking($conn, $guid);

    if (isset($res['success'])) {
        $_SESSION['success'] = $res['success'];
    } else {
        $_SESSION['error'] = $res['error'];
    }
}

header("LOCATION:" . ADMIN_BASE_URL . "multimedia");
?>
