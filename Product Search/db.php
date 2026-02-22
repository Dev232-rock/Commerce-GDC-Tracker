<?php

$host = "127.0.0.1";
$user = "phpuser";
$pass = "Dev@1234@5678";
$db   = "Product_Search";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die(json_encode([
        "error" => "Database connection failed",
        "details" => $conn->connect_error
    ]));
}
?>