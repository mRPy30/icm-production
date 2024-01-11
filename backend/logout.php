<?php
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {
    session_unset();     // Unset session variables
    session_destroy();   // Destroy the session
}
$_SESSION['LAST_ACTIVITY'] = time(); 
?>
