<?php
session_start();
require 'db.php';

// Check if user is logged in properly or not
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location: index.php");
    exit;
}

// prevent direct access without form submission
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: dashboard.php");
    exit;
}

$currentUser = $_SESSION['username'] ?? $_COOKIE['username'];

// TO get Get form data safely
$username = trim($_POST['username']);
$email    = trim($_POST['email']);
$gender   = $_POST['gender'] ?? '';
$country  = $_POST['country'] ?? '';
$about    = trim($_POST['about']) ?? '';
$hobbies  = isset($_POST['hobbies']) ? implode(",", $_POST['hobbies']) : '';

try {

    $stmt = $conn->prepare("
        UPDATE users 
        SET 
            username = :username,
            email    = :email,
            gender   = :gender,
            country  = :country,
            hobbies  = :hobbies,
            about    = :about
        WHERE username = :currentUser
    ");

    $stmt->execute([
        'username'     => $username,
        'email'        => $email,
        'gender'       => $gender,
        'country'      => $country,
        'hobbies'      => $hobbies,
        'about'        => $about,
        'currentUser'  => $currentUser
    ]);

// Update session & cookie if username changed 
    $_SESSION['username'] = $username;

    if (isset($_COOKIE['username'])) {
        setcookie('username', $username, time() + (86400 * 30), "/");
    }

    header("Location: dashboard.php?success=1");
    exit;

} catch (PDOException $e) {
    die("Update failed: " . $e->getMessage());
}
?>
