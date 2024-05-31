<?php
// view_post_css.php

echo "
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #add8e6;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: beige;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .post-content {
        background-color: #d3d3d3;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .btn {
        padding: 10px 15px;
        background-color: #333;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-right: 10px;
        cursor: pointer;
    }

    .btn-delete {
        padding: 5px 10px;
        background-color: #ff0000;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 5px;
        display: inline-block;
    }

    .reply-box {
        margin-top: 20px;
        margin-bottom: 20px;
        background-color: #d3d3d3;
        padding: 10px;
        border-radius: 5px;
    }

    header {
        background-color: #add8e6;
        padding: 10px;
        text-align: right;
    }
</style>";
?>
