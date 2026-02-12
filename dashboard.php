<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'] ?? $_COOKIE['username'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$showProfile = isset($_GET['profile']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
        }

        .navbar {
            background: #1f2937;
            padding: 15px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            text-decoration: none;
            color: white;
            padding: 8px 14px;
            border-radius: 4px;
            margin-left: 10px;
            transition: 0.3s;
        }

        .navbar a:hover {
            opacity: 0.8;
        }

        .profile-btn { background: #2563eb; }
        .edit-btn { background: #16a34a; }
        .logout-btn { background: #ef4444; }

        .container {
            padding: 40px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            max-width: 600px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h1 {
            margin-top: 0;
            color: #111827;
        }

        p {
            color: #4b5563;
            line-height: 1.6;
        }

        .success {
            color: green;
            margin-bottom: 15px;
        }

        .buttons {
            margin-bottom: 20px;
        }

        .buttons a {
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div>Welcome, <strong><?= htmlspecialchars($user['username']) ?></strong></div>
    <div>
        <a href="dashboard.php?profile=1" class="profile-btn">Profile Details</a>
        <a href="edit.php" class="edit-btn">Edit Profile</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<div class="container">

    <?php if (isset($_GET['success'])): ?>
        <div class="success">User details updated successfully!</div>
    <?php endif; ?>

    <div class="card">
        <h1>Hello, <?= htmlspecialchars($user['username']) ?> 👋</h1>
        <p>Welcome to your dashboard. Here you can view or edit your profile, and manage your account.</p>
    </div>

    <?php if ($showProfile): ?>
        <div class="card" style="margin-top:20px;">
            <h2>Profile Details</h2>
            <p><b>Name:</b> <?= htmlspecialchars($user['username']) ?></p>
            <p><b>Email:</b> <?= htmlspecialchars($user['email']) ?></p>
            <p><b>Gender:</b> <?= htmlspecialchars($user['gender']) ?></p>
            <p><b>Country:</b> <?= htmlspecialchars($user['country']) ?></p>
            <p><b>Hobbies:</b> <?= htmlspecialchars($user['hobbies']) ?></p>
            <p><b>About:</b> <?= htmlspecialchars($user['about']) ?></p>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
