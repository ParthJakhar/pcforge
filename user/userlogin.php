<?php
// Database connection details (replace with your actual credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdetails";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Retrieve and sanitize username and password from the form
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = $_POST['password'];

// SQL query to check if the user exists with prepared statements
$stmt = $conn->prepare("SELECT setpass FROM register WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['setpass'])) {
        // Successful login
        session_start();
        session_regenerate_id(true); // Prevent session fixation
        $_SESSION['email'] = $email;
        header("Location: welcome.php");
        exit();
    } else {
        // Login failed: wrong password
        echo "Invalid username or password.";
    }
} else {
    // Login failed: user not found
    echo "Invalid username or password.";
}

$conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="/css/userlogin.css">
</head>
<body>

    <div class="login-container">
        <div class="login-form">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <div class="remember-forgot">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Remember Me</label>
                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit">Login</button>
                <button type="button" onclick="window.location.href='register.html'">Register</button>
            </form>
        </div>
    </div>

</body>
</html>
