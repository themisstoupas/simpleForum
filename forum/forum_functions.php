<?php

function getUserInfo($conn, $userId) {
    $sql = "SELECT * FROM users WHERE user_id = '$userId'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}


function getRecentPosts($conn) {
    $sql = "SELECT posts.post_id, posts.post_title, posts.date_posted, COUNT(post_replies.reply_id) AS reply_count, users.username
            FROM posts
            LEFT JOIN users ON posts.user_id = users.user_id
            LEFT JOIN post_replies ON posts.post_id = post_replies.post_id
            GROUP BY posts.post_id
            ORDER BY posts.date_posted DESC
            LIMIT 10";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}


function isAdmin($conn, $userId) {
    $sql = "SELECT role FROM users WHERE user_id = '$userId' AND role = 'admin'";
    $result = $conn->query($sql);

    return ($result && $result->num_rows > 0);
}
?>
