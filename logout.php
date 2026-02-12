<?php
session_start();
session_unset();
session_destroy();

// Remove cookie if exists
if (isset($_COOKIE['username'])) {
    setcookie('username', '', time() - 3600, '/');
}

header("Location: index.php");
exit;
