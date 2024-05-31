<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "themisdb";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    
    $deleteUserSQL = "DELETE FROM users WHERE user_id = '$user_id'";
    $deletePostsSQL = "DELETE FROM posts WHERE user_id = '$user_id'";

    $conn->query($deleteUserSQL);
    $conn->query($deletePostsSQL);

    
    header("Location: users.php");
    exit();
} else {
    
    header("Location: users.php");
    exit();
}


$conn->close();
?>
