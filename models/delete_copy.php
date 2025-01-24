<?php


include_once("../config/config.php");
include_once("../config/database.php");

if (!isset($_SESSION['user_email'])) {
    header('Location: index.php');

}
$copy_no=$_POST['copy_no'];
$guid=$_POST['guid'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "delete from book_copies where copy_no='$copy_no' and book_guid='$guid'";
    $result['success']=$conn->query($sql);
    return $result['success'];
}

?>