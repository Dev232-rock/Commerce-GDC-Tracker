<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>

<h2>Signup</h2>

<form method="post">
    Username: <input type="text" name="username" required><br><br>
    Email: <input type="text" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit" name="signup">Signup</button>
</form>

<?php
if (isset($_POST['signup'])) {

    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // REGEX email validation
    if (!preg_match("/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/", $email)) {
        echo "Invalid email format";
        exit;
    }
    // Save to file (simple storage)
    $userData = "$username|$email\n";
    file_put_contents("users.txt", $userData, FILE_APPEND);

    echo "Signup successful! <a href='login.php'>Login here</a>";
}
?>

</body>
</html>

