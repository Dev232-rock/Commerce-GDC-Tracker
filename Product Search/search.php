<?php
header("Content-Type: application/json");
include 'db.php';

// Minimum 3 characters required
if (!isset($_GET['query']) || strlen($_GET['query']) < 3) {
    echo json_encode([]);
    exit;
}

// Added a wildcards for LIKE safely
$search = "%" . $_GET['query'] . "%";

// Prepare statement
$stmt = $conn->prepare("
    SELECT id, name, sku, category, price 
    FROM products 
    WHERE name LIKE ? OR sku LIKE ? OR category LIKE ? 
    LIMIT 10
");

$stmt->bind_param("sss", $search, $search, $search);

// Execute and get results
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);

$stmt->close();
$conn->close();
?>