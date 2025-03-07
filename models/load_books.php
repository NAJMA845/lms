<?php
header('Content-Type: application/json');
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");


function getBooksByPage($conn, $limit, $offset) {
    $query = "select b.*, c.name as cat_name from books b 
        left join categories c on c.id = b.category_id 
        limit $limit offset $offset";
    return $conn->query($query);
}

$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 100;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

$books = getBooksByPage($conn, $limit, $offset);
$result = [];

if ($books && $books->num_rows > 0) {
    while ($row = $books->fetch_assoc()) {
        $result[] = $row;
    }
}

echo json_encode($result);
?>
