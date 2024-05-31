<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "themisdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['reply_id'], $_GET['post_id']) && is_numeric($_GET['reply_id']) && is_numeric($_GET['post_id'])) {
    $reply_id = $_GET['reply_id'];

    $deleteReplySql = "DELETE FROM post_replies WHERE reply_id = $reply_id";

    $conn->query($deleteReplySql);

    header("Location: ../posts/view_post.php?post_id={$_GET['post_id']}");
    exit();
} else {
    header("Location: forum.php");
    exit();
}

$conn->close();
?>
