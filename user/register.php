<?php

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdetails";

// Create connection using mysqli_connect
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize it
    $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $setpassword = mysqli_real_escape_string($conn, $_POST['set_password']);
    
    // Hash the password for security
    $hashed_password = password_hash($setpassword, PASSWORD_DEFAULT);
    
    // SQL query to insert the data into the register table
    $sql = "INSERT INTO register (fname, lname, email, setpass) 
            VALUES ('$fname', '$lname', '$email', '$hashed_password');";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
    } else {
        // Return the error message in case of failure
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/register.css">
    <title>Register</title>
</head>
<body>
    <div class="register-container">
        <div class="register-form">
            <h2>Register</h2>
            <form action="register.php" method="POST">
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" required>
                <br>

                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" required>
                <br>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <br>

                <label for="set_password">Set Password:</label>
                <input type="password" id="set_password" name="set_password" required>
                <br>

                <button type="submit">Register</button>
            </form>
        </div>
    </div>
</body>
</html>