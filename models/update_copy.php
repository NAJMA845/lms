<?php

include_once("../config/config.php");
include_once("../config/database.php");

if (!isset($_SESSION['user_email'])) {
    header('Location: index.php');
    exit;
}

$datetime = date("Y-m-d H:i:s");
$copy_no = $_POST['copy_no'];
$updated_value = $_POST['updatedValue'];
$guid = $_POST['guid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the record exists
    $check_sql = "SELECT 1 FROM book_copies WHERE copy_no = '$copy_no' AND book_guid = '$guid'";
    $check_result = $conn->query($check_sql);
    //Check record is already available
    if ($check_result && $check_result->num_rows > 0) {
        $sql = "UPDATE book_copies 
                SET copy_no = '$updated_value', 
                    updated_at = '$datetime' 
                WHERE copy_no = '$copy_no' AND book_guid = '$guid'";
    } else {
        $sql = "INSERT INTO book_copies (copy_no, book_guid, created_at, updated_at) 
                VALUES ('$updated_value', '$guid', '$datetime', '$datetime')";
    }

    $result['success'] = $conn->query($sql);
    return $result;
}

?>
