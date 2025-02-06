<?php
include_once("../config/config.php");

if(isset($_POST['bookNo']) && isset($_POST['check'])){
    $copyId=$_POST['bookNo'];
    $sql = "SELECT borrowed_date, returned_date 
            FROM book_tran 
            WHERE copy_id = ? 
            ORDER BY created_at 
            LIMIT 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $copyId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode([
            "borrowed_date" => $row["borrowed_date"] ?? null,
            "returned_date" => $row["returned_date"] ?? null
        ]);
    } else {
        echo json_encode([
            "borrowed_date" => null,
            "returned_date" => null
        ]);
    }
    $stmt->close();
    $conn->close();
}
?>