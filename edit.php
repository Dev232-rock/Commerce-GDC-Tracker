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

$hobbies = explode(",", $user['hobbies']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .box {
            background: white;
            padding: 30px;
            width: 450px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 4px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            height: 80px;
        }

        .options {
            margin-bottom: 12px;
        }

        /* Fix alignment of checkboxes and radio buttons */
        input[type="checkbox"],
        input[type="radio"] {
            vertical-align: middle;
            margin-right: 6px;
            margin-top: 0; /* remove top margin */
        }

        .option-label {
            display: inline-block;
            margin-right: 15px;
            vertical-align: middle;
            font-weight: normal;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #1e40af;
        }

    </style>
</head>
<body>

<div class="box">
    <h2>Edit Profile</h2>

    <form action="update.php" method="POST">

        <label for="username">Name:</label>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

        <label>Gender:</label>
        <div class="options">
            <label class="option-label">
                <input type="radio" name="gender" value="Male" <?= ($user['gender']=="Male")?"checked":"" ?>> Male
            </label>
            <label class="option-label">
                <input type="radio" name="gender" value="Female" <?= ($user['gender']=="Female")?"checked":"" ?>> Female
            </label>
        </div>

        <label for="country">Country:</label>
        <select name="country">
            <option value="India" <?= ($user['country']=="India")?"selected":"" ?>>India</option>
            <option value="USA" <?= ($user['country']=="USA")?"selected":"" ?>>USA</option>
            <option value="UK" <?= ($user['country']=="UK")?"selected":"" ?>>UK</option>
            <option value="UK" <?= ($user['country']=="UK")?"selected":"" ?>>Canada</option>
            <option value="UK" <?= ($user['country']=="UK")?"selected":"" ?>>China</option>
            <option value="UK" <?= ($user['country']=="UK")?"selected":"" ?>>Austraila</option>
        </select>

        <label>Hobbies:</label>
        <div class="options">
            <label class="option-label">
                <input type="checkbox" name="hobbies[]" value="Reading" <?= in_array("Reading",$hobbies)?"checked":"" ?>> Reading
            </label>
            <label class="option-label">
                <input type="checkbox" name="hobbies[]" value="Traveling" <?= in_array("Traveling",$hobbies)?"checked":"" ?>> Traveling
            </label>
            <label class="option-label">
                <input type="checkbox" name="hobbies[]" value="Sports" <?= in_array("Sports",$hobbies)?"checked":"" ?>> Sports
            </label>
        </div>

        <label for="about">About:</label>
        <textarea name="about"><?= htmlspecialchars($user['about']) ?></textarea>

        <button type="submit">Update Profile</button>

    </form>
</div>

</body>
</html>
