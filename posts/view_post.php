<?php
session_start();
require_once('../database/db_connection.php');
require_once('view_post_functions.php');
require_once('view_post_css.php');

if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    header("Location: ../forum/login.php");
    exit();
}

if (isset($_GET['post_id']) && is_numeric($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $data = fetchPostAndReplies($conn, $post_id);

    if (empty($data['post'])) {
        // Redirect to the forum page if the post is not found
        header("Location: ../forum/forum.php");
        exit();
    }

    // Check if the logged-in user is an admin
    $isAdmin = isAdmin($conn, $_SESSION["user_id"]);

    processReplySubmission($conn, $post_id);
} else {
    // Redirect to the forum page if post_id is not set or invalid
    header("Location: ../forum/forum.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
    <link rel="stylesheet" href="https://cdn.tiny.cloud/1/mc9km726iuu35yu11zsxl3wd0l8n9n7d762b7cf1qudt3mjj/tinymce/5/skins/ui/oxide/skin.min.css">
    <?php include 'view_post_css.php'; ?>
    <script src="https://cdn.tiny.cloud/1/mc9km726iuu35yu11zsxl3wd0l8n9n7d762b7cf1qudt3mjj/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 300,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family: Arial, sans-serif; font-size: 14px; }'
        });
    </script>
</head>
<body>
    <header>
        <a href="../forum/forum.php" class="btn">Home</a>
        <?php if ($isAdmin) : ?>
            <a href="delete_post.php?post_id=<?php echo $post_id; ?>" class="btn-delete">Delete Post</a>
        <?php endif; ?>
    </header>

    <div class="container">
        <h2>View Post</h2>
        <div class="post-content">
            <p><strong>Title:</strong> <?php echo $data['post']['post_title']; ?></p>
            <p><strong>Posted by:</strong> <?php echo $data['post']['username']; ?></p>
            <p><strong>Date Posted:</strong> <?php echo $data['post']['date_posted']; ?></p>
            <p><strong>Content:</strong></p>
            <p><?php echo $data['post']['content']; ?></p>
        </div>

        <!-- Replies Section -->
        <div class="reply-box">
            <h3>Replies:</h3>
            <?php if (!empty($data['replies'])) : ?>
                <ul>
                    <?php foreach ($data['replies'] as $reply) : ?>
                        <li>
                            <p><strong>Reply by:</strong> <?php echo $reply['username']; ?></p>
                            <p><strong>Date:</strong> <?php echo $reply['reply_date']; ?></p>
                            <p><?php echo $reply['reply_content']; ?></p>
                            <?php if ($isAdmin) : ?>
                                <a href="../forum/delete_reply.php?reply_id=<?php echo $reply['reply_id']; ?>&post_id=<?php echo $post_id; ?>" class="btn-delete">Delete Reply</a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>No replies yet.</p>
            <?php endif; ?>
        </div>

        <!-- Reply Form -->
        <?php if (isset($_SESSION['user_id'])) : ?>
            <form method="post" action="">
                <label for="reply_content">Your Reply:</label>
                <textarea id="reply_content" name="reply_content" rows="4" cols="50"></textarea>
                <br>
                <button type="submit" class="btn btn-green">Reply to Post</button>
            </form>
        <?php else : ?>
            <p>Please log in to post a reply.</p>
        <?php endif; ?>
    </div>
</body>
</html>
