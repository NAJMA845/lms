<?php
// Start the session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page or home page
header("Location: ../index.php"); // Replace with your actual login page URL
exit();
?>