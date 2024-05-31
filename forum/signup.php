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


function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = hashPassword($_POST["password"]);
    
    
    $userType = isset($_POST["user_type"]) ? implode(",", $_POST["user_type"]) : "";

    
    $checkSql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        
        echo "Username or email already exists. Please choose a different one.";
    } else {
        
        $insertSql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$userType')";

        if ($conn->query($insertSql) === TRUE) {
            
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Signup</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('cybersecurity3.jpeg');  // Replace with your image URL
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: rgba(255, 255, 255, 0); /* Set alpha value for transparency */
            padding: 20px;
            border-radius: 8px;
            width: 300px; /* Set the desired width */
            text-align: center; /* Center align the content inside the form */
        }

        h2 {
            margin-bottom: 20px; /* Add margin to separate the title from the form */
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            padding: 10px;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #333;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2></h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Sign Up">
    </form>
</body>
</html>
