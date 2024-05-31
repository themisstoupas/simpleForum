<?php
session_start();
require_once('../database/db_connection.php');
require_once('create_post_functions.php');
require_once('create_post_css.php');

if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    header("Location: ../forum/login.php");
    exit();
}

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $post_content = mysqli_real_escape_string($conn, $_POST['post_content']);

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if (doesUserExist($conn, $user_id)) {
        if (insertPost($conn, $user_id, $post_title, $post_content)) {
            header("Location: ../forum/forum.php");
            exit();
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Error: User not found!</div>';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <?php include 'create_post_css.php'; ?>
</head>
<body>
    <header>
        <div class="container-fluid p-2">
            <a href="../forum/forum.php" class="btn btn-warning text-white float-right btn-home">Home</a>
        </div>
        
    </header>
    <div class="container form-container">
        <h2 class="mb-4">Create Post</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="post_title">Post Title</label>
                <input type="text" class="form-control" id="post_title" name="post_title" placeholder="Enter your post title" required>
            </div>
            <div class="form-group">
                <label for="post_content">Post Content</label>
                <textarea class="form-control" id="post_content" name="post_content" placeholder="Write your post content" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Create Post</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
