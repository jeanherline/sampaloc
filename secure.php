<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION["loggedin"])) {
    header("location:index.php");
}

// Set the timeout value in seconds
$timeout = 600; // 5 minutes

// Check if the last activity time is set
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    // Last activity was more than $timeout seconds ago
    session_unset();     // Unset session variables
    session_destroy();   // Destroy the session
    header("Location: sessionTimeout.php"); // Redirect to timeout page
    exit();
}

// Update last activity time
$_SESSION['LAST_ACTIVITY'] = time();
?>