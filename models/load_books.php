<?php
header('Content-Type: application/json');
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");


function getBooksByPage($conn, $limit, $offset, $keyword) {
    if($keyword=='')
        $query = "select b.*, c.name as cat_name from books b 
            left join categories c on c.id = b.category_id 
            limit $limit offset $offset";
    else
        $query = "select b.*, c.name as cat_name from books b 
            left join categories c on c.id = b.category_id 
            where b.title like '%$keyword%' or b.author like '%$keyword%' or b.isbn like '%$keyword%' 
            limit $limit offset $offset";
    return $conn->query($query);
}
$keyword=$_GET['keyword'];
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 100;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;



$books = getBooksByPage($conn, $limit, $offset, $keyword);
$result = [];

if ($books && $books->num_rows > 0) {
    while ($row = $books->fetch_assoc()) {
        $result[] = $row;
    }
}

echo json_encode($result);
?>
