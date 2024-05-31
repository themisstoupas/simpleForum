<?php

echo "
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #add8e6;
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #d3d3d3;
        color: white;
        padding: 10px;
        text-align: center;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }

    h1 {
        color: #800080;
    }

    .user-info {
        display: flex;
        align-items: flex-end;
    }

    .user-info p {
        margin: 0;
        color: #800080;
        font-size: 1.9em;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .btn {
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .logout-btn {
        background-color: #cc0000;
        color: white;
    }

    .create-post-btn {
        background-color: #28a745;
        color: white;
    }

    .users-btn {
        background-color: #333;
        color: white;
    }

    .container {
        padding: 20px;
    }

    .recent-posts {
        margin-top: 20px;
    }

    .post-item {
        background-color: #f5f5dc;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        position: relative;
    }

    .delete-btn,
    .view-btn {
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 10px;
        position: absolute;
        top: 10px;
    }

    .delete-btn {
        background-color: #cc0000;
        color: white;
        right: 100px;
    }

    .view-btn {
        background-color: #28a745;
        color: white;
        right: 10px;
    }

    .spacer {
        width: 10px;
        display: inline-block;
    }
</style>";
?>
