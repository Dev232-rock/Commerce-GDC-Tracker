<?php
include 'db.php';
$sql = "SELECT * FROM products LIMIT 1";
$result = $conn->query($sql);
if (!$result) {
    die(json_encode(["error" => $conn->error]));
}
echo json_encode($result->fetch_assoc());
$conn->close();
?>