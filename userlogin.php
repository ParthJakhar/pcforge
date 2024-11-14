<?php
// Database connection details (replace with your actual credentials)
$servername = "localhost";
$username = "root";
$password = "sql123";
$dbname = "user";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve username and password from the form
$username = $_POST['username'];
$password = $_POST['password'];

// SQL query to check if the user exists
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Successful login
    session_start();
    $_SESSION['username'] = $username;
    header("Location: welcome.php");
    exit();
} else {
    // Login failed
    echo "Invalid username or password.";
}

$conn->close();
?>