<?php
session_start();
require_once('../database/db_connection.php');
require_once('login_functions.php');
require_once('login_css.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    
    handleLoginFormSubmission($conn, $username, $password);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to DeepThinkForum</title>
    <?php include 'login_css.php'; ?>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Welcome to DeepThinkForum</h2>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <label for="username">Username:</label>
                <input type="text" name="username" required><br>

                <label for="password">Password:</label>
                <input type="password" name="password" required><br>

                <input type="submit" value="Login">
                <br>
                <input type="button" value="Create Account" onclick="location.href='signup.php';">
            </form>
        </div>
    </div>
</body>
</html>

<?php

$conn->close();
?>
