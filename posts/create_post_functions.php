<?php

function doesUserExist($conn, $user_id) {
    $checkUserQuery = "SELECT * FROM users WHERE user_id = $user_id";
    $result = $conn->query($checkUserQuery);

    return ($result->num_rows > 0);
}

function insertPost($conn, $user_id, $post_title, $post_content) {
    $date_posted = date("Y-m-d H:i:s");
    $views = 0;

    $insertPostQuery = "INSERT INTO posts (user_id, post_title, date_posted, content, views)
                        VALUES ('$user_id', '$post_title', '$date_posted', '$post_content', '$views')";

    return $conn->query($insertPostQuery);
}
?>
