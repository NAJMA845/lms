<?php
header('Content-Type: application/json');
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");


function getReviewsByPage($conn, $limit, $offset) {
    $query = "select isbn,review,rating from book_review
        limit $limit offset $offset";
    return $conn->query($query);
}

$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 100;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

$reviews = getReviewsByPage($conn, $limit, $offset);
$result = [];

if ($reviews && $reviews->num_rows > 0) {
    while ($row = $reviews->fetch_assoc()) {
        $result[] = $row;
    }
}

echo json_encode($result);
?>
