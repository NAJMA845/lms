<?php
include_once("../../config/config.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete the late fee record from the database
    $delete_query = "DELETE FROM late_fees WHERE id = $id";

    if (mysqli_query($conn, $delete_query)) {
        $_SESSION['success'] = "Late fee deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting late fee: " . mysqli_error($conn);
    }

    header("Location: index.php"); // Redirect to the manage page
    exit();
}
?>
