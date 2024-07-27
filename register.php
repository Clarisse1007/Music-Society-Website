<?php
    $message = ""; // Initialize the $message variable

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone_number = $_POST['phoneNumber'];
        $password = $_POST['password'];
        $status = $_POST['status']; // Retrieve status from the form
    
        require_once('mysql_connect.php');
        $mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die ("Could not connect to database: " . mysqli_connect_error() );
        
        $name = mysqli_real_escape_string($mysqli, $name);
        $email = mysqli_real_escape_string($mysqli, $email);
        $address = mysqli_real_escape_string($mysqli, $address);
        $phone_number = mysqli_real_escape_string($mysqli, $phone_number);
        $password = mysqli_real_escape_string($mysqli, $password);
        $status = mysqli_real_escape_string($mysqli, $status);
        
        $sql_insertRecord = "INSERT INTO users (name, email, address, phone_number, password, status)
                VALUES ('$name','$email','$address','$phone_number','$password','$status')";
        $result_insertRecord = mysqli_query($mysqli, $sql_insertRecord);
        
        if ($result_insertRecord) {
            $message = "<div class='succes-message'>Registration successful!</div>";
        } else {
            echo "Error: " . mysqli_error($mysqli);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <title>Register</title>
</head>
<body>

   <div class="form-box">
        <?php echo $message; ?>
       
        <div class="button-box">
            <div id="btn"></div>
            <button type="button" class="toggle-btn" onclick="leftClick()">Admin</button>
            <button type="button" class="toggle-btn" onclick="rightClick()">Member</button>
        </div>
        
        <form id="registerForm" action="register.php" method="POST">
            <div class="container">
                <h1>Register Form</h1>
                <hr>

                <label for="name"><b>Username:</b></label>
                <input type="text" placeholder="Enter Name" name="name" id="name" required>

                <label for="email"><b>Email:</b></label>
                <input type="text" placeholder="Enter Email" name="email" id="email" required>
                
                <label for="address"><b>Home Address:</b></label>
                <input type="text" placeholder="Enter Address" name="address" id="address" required>
                
                <label for="phone_number"><b>Phone Number (with dash):</b></label>
                <input type="text" placeholder="Enter Phone Number" name="phoneNumber" id="phone_number" required>
                
                <label for="password"><b>Password:</b></label>
                <input type="password" placeholder="Enter Password" name="password" id="password" required>
                <input type="checkbox" onclick="togglePassword()">Show Password
                
                <input type="hidden" name="status" id="status" value="">

                <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

                <button type="submit" class="registerbtn">Register</button>
                
                <div class="container signin">
                    <p>Already have an account? <a href="login.php">Log In</a>.</p>
                </div>
            </div>
        </form>
    </div>

    <script src="js/register.js"></script>
</body>
</html>
