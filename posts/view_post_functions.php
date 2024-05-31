<?php
// view_post_functions.php

// Function to check if the user is an admin
function isAdmin($conn, $userId) {
    $sql = "SELECT * FROM users WHERE user_id = '$userId' AND role = 'admin'";
    $result = $conn->query($sql);

    return ($result && $result->num_rows > 0);
}

// Function to fetch post and replies
function fetchPostAndReplies($conn, $post_id) {
    $post = [];
    $replies = [];

    $sqlPost = "SELECT posts.*, users.username 
                FROM posts 
                INNER JOIN users ON posts.user_id = users.user_id
                WHERE post_id = $post_id";

    $resultPost = $conn->query($sqlPost);

    if ($resultPost && $resultPost->num_rows > 0) {
        $post = $resultPost->fetch_assoc();
    }

    $sqlReplies = "SELECT post_replies.*, users.username 
                   FROM post_replies 
                   INNER JOIN users ON post_replies.user_id = users.user_id
                   WHERE post_replies.post_id = $post_id";

    $resultReplies = $conn->query($sqlReplies);

    if ($resultReplies && $resultReplies->num_rows > 0) {
        while ($row = $resultReplies->fetch_assoc()) {
            $replies[] = $row;
        }
    }

    return ['post' => $post, 'replies' => $replies];
}

// Function to process reply submission
function processReplySubmission($conn, $post_id) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reply_content'])) {
        $reply_content = $_POST['reply_content'];

        $insertReplySql = "INSERT INTO post_replies (post_id, user_id, reply_content, reply_date)
                          VALUES ($post_id, {$_SESSION['user_id']}, '$reply_content', NOW())";

        $conn->query($insertReplySql);

        // Redirect to the same page to avoid form resubmission on page refresh
        header("Location: {$_SERVER['REQUEST_URI']}");
        exit();
    }
}
?>
