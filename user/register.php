<?php
if (isset($_POST['firstname'])) {
    $servername = "localhost";
    $username = "root";
    $password = "sql123";
    $dbname = "userdetails";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error);
    }

    $lname = $_POST['firstname']; 

    $fname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['set_password'], PASSWORD_DEFAULT); // Hash the password

    $sql = "INSERT INTO `register` ( `fname`, `lname`, `email`, `password`, `dt`) VALUES ($fname, $lname, $email, $password, current_timestamp())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fname, $lname, $email, $password);

    if ($stmt->execute()) {
        echo "Inserted successfully";
        $insert = true;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/register.css">
    <title>register</title>
</head>
<body>
    <div class="register-container">
        <div class="register-form">
            <h2>Register</h2>
            <?php
            if($insert==true){
                echo "successfull";

            }
           
            ?>
            <form>
                <label for="firstname">First Name:</label>
                <input type="firstname" id="firstname" name="firstname" required>
                <br>

                <label for="Lastname">Last Name:</label>
                <input type="Lastname" id="Lastname" name="Lastname" required>

               
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="set_password">Set Password:</label>
                <input type="set_password" id="set_password" name="set_password" required>

                

                <button type="submit">Register</button>
               
            </form>
        </div>
    </div>
    

    
</body>
</html>