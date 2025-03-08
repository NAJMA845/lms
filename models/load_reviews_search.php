<?php
header('Content-Type: application/json');
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");


function getReviewsByPage($conn, $limit, $offset,$isbn,$rating) {
    $query = "SELECT isbn, review, rating FROM book_review WHERE 1=1 ";

    if (!empty($rating)) {
        $query .= " AND rating = $rating  limit $limit offset $offset";
    }
    else if (!empty($isbn)) {
        $query .= " AND isbn like '%$isbn%' " ;
    }
    else if (empty($isbn) && empty($rating)) {
        $query .= " limit $limit offset $offset";
    }

    return $conn->query($query);
}

$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 100;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$isbn = $_GET['isbn'];
$rating = $_GET['rating'];
$reviews = getReviewsByPage($conn, $limit, $offset,$isbn,$rating);
$result = [];

if ($reviews && $reviews->num_rows > 0) {
    while ($row = $reviews->fetch_assoc()) {
        $result[] = $row;
    }
}

echo json_encode($result);
?>
