<?php
session_start();


if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    header("Location: ../forum/login.php");
    exit();
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "themisdb";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['post_id']) && is_numeric($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    
    $sqlReplies = "SELECT * FROM post_replies WHERE post_id = $post_id";
    $resultReplies = $conn->query($sqlReplies);

    if ($resultReplies && $resultReplies->num_rows > 0) {
        // Delete replies associated with the post
        $deleteRepliesSql = "DELETE FROM post_replies WHERE post_id = $post_id";
        $conn->query($deleteRepliesSql);
    }

    
    $deletePostSql = "DELETE FROM posts WHERE post_id = $post_id";
    $conn->query($deletePostSql);

    
    header("Location: ../forum/forum.php");
    exit();
} else {
    
    header("Location: ../forum/forum.php");
    exit();
}

$conn->close();
?>
