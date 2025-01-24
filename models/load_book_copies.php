<?php
header('Content-Type: application/json');
include_once("../config/config.php");


function getBookCopies($conn, $guid) {
    $query = "select copy_no,status from book_copies where book_guid='$guid'";
    return $conn->query($query);
}

$guid = isset($_GET['guid']) ? $_GET['guid'] : '';

$copies = getBookCopies($conn, $guid) ;
$result = [];

if ($copies && $copies->num_rows > 0) {
    while ($row = $copies->fetch_assoc()) {
        $result[] = $row;
    }
}

echo json_encode($result);
?>
