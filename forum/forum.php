<?php
session_start();
require_once('../database/db_connection.php');
require_once('forum_functions.php');
require_once('forum_css.php');

if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

function displayRecentPosts($recentPosts, $isAdmin) {
    foreach ($recentPosts as $post) {
        echo "
        <div class='post-item'>
            <p><strong>Title:</strong> {$post['post_title']}</p>
            <p><strong>Posted by:</strong> {$post['username']}</p>
            <p><strong>Date Posted:</strong> {$post['date_posted']}</p>
            <p><strong>Replies:</strong> {$post['reply_count']}</p>";

        if ($isAdmin) {
            echo "
            <a href='../posts/delete_post.php?post_id={$post['post_id']}' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this post?\")'>Delete Post</a>";
        }

        echo "
            <span class='spacer'></span>
            <a href='../posts/view_post.php?post_id={$post['post_id']}' class='view-btn'>View Post</a>
        </div>";
    }
}

$userInfo = getUserInfo($conn, $_SESSION["user_id"]);
$recentPosts = getRecentPosts($conn);
$isAdmin = isAdmin($conn, $_SESSION["user_id"]);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeepThinkForum</title>
    <?php include 'forum_css.php'; ?>
</head>
<body>
    <header>
        <h1>DeepThinkForum</h1>

        <div class="user-info">
            <p>Hello, <?php echo $userInfo['username']; ?>!</p>
        </div>

        <div class="buttons">
            <a href="../posts/create_post.php" class="btn create-post-btn">Create a Post</a>
            <a href="users.php" class="btn users-btn">Users</a>
            <a href="logout.php" class="btn logout-btn">Logout</a>
        </div>
    </header>

    <div class="container">
        <h2>Recent Posts</h2>
        <div class="recent-posts">
            <?php displayRecentPosts($recentPosts, $isAdmin); ?>
        </div>
    </div>
</body>
</html>
