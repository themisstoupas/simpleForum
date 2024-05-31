<?php

function isAdmin($conn, $userId) {
    $sql = "SELECT role FROM users WHERE user_id = '$userId' AND role = 'admin'";
    $result = $conn->query($sql);

    return ($result && $result->num_rows > 0);
}


function getUsersWithPostCount($conn) {
    $sql = "SELECT users.user_id, users.username, users.registration_date, COUNT(posts.post_id) AS post_count
            FROM users
            LEFT JOIN posts ON users.user_id = posts.user_id
            GROUP BY users.user_id, users.username, users.registration_date";
    $result = $conn->query($sql);

    return $result;
}
?>
