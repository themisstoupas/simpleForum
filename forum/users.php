<?php
session_start();
require_once('../database/db_connection.php');
require_once('users_functions.php');
require_once('users_css.php');

if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$result = getUsersWithPostCount($conn);


$isAdmin = isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]) && isAdmin($conn, $_SESSION["user_id"]);


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <?php include 'users_css.php'; ?>
</head>
<body>
    <header>
        <h1>Users</h1>
        <div>
            <?php if ($isAdmin) : ?>
                <a href="signupadmin.php" class="create-btn">Create User</a>
            <?php endif; ?>
            <a href="forum.php" class="home-btn">Home</a>
        </div>
        <div class="create-form">
            
        </div>
    </header>

    <div class="container">
        <ul class="user-list">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <li class="user-list-item">
                    <div class="user-details">
                        <p><strong>Username:</strong> <?php echo $row['username']; ?></p>
                        <p><strong>Posts:</strong> <?php echo $row['post_count']; ?></p>
                        <p><strong>Registration Date:</strong> <?php echo $row['registration_date']; ?></p>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>
