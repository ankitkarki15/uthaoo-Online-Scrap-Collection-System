<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include('include/connection.php');

function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

if (isset($_POST['submit'])) {
    $name = sanitizeInput($_POST["name"]);
    $email = sanitizeInput($_POST["email"]);
    $password = $_POST["password"];
    $phone_no = sanitizeInput($_POST["phone_no"]);

    // Server-side validation
    $errors = array();

    if (empty($name)) {
        $errors[] = "Name is required";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (empty($phone_no)) {
        $errors[] = "Phone number is required";
    } elseif (!preg_match("/^[0-9]{10}$/", $phone_no)) {
        $errors[] = "Please enter a 10-digit number.";
    }

    if (count($errors) === 0) {
        // Check if the user already exists
        $select = mysqli_query($conn, "SELECT * FROM user_tbl WHERE email = '$email'");

        if (mysqli_num_rows($select) > 0) {
            // $errors[] = "User already exists!";
            echo '<script>alert("User already exists!");</script>';
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO user_tbl (name, email, password, phone_no, role) 
                    VALUES ('$name', '$email', '$hashedPassword', '$phone_no', 'user')";

            $insert = mysqli_query($conn, $sql);

            if ($insert) {
              echo '<script>alert("Registered successfully");</script>';
                header("Location: front.php"); // Redirect to login page
                exit;
            } else {
             
              echo '<script>alert("Registration failed");</script>';
                // $errors[] = "Registration failed";
            }
        }
    }
}
?>

<!-- ... Your HTML form ... -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up form</title>
 
    <style>
     @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Poppins, sans-serif;
}

body {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  padding: 0 10px;
  background: #0a0a23;
}

form {
  padding: 25px;
  background: #0a0a23;
    background-size: cover;
    position: relative;
    overflow: hidden;
  max-width: 500px;
  width: 100%;
  border-radius: 7px;
  box-shadow: 0 10px 15px rgba(0, 0, 0, 0.05);
}

form h2 {
  color:white;
  font-size: 27px;
  text-align: center;
  margin: 0px 0 30px;
}

form .form-group {
  margin-bottom: 15px;
  position: relative;
}

form label {
  color:white;
  display: block;
  font-size: 15px;
  margin-bottom: 7px;
}

form input,
form select {
  color:WHITE;
  height: 45px;
  padding: 10px;
  width: 100%;
  font-size: 15px;
  outline: none;
  background: #0a0a23;
  border-radius: 3px;
  border: 1px solid #bfbfbf;
}

form input:focus,
form select:focus {
  border-color: #9a9a9a;
}

form input.error,
form select.error {
  border-color: #f91919;
  /* background: #f9f0f1; */
}

form small {
  font-size: 14px;
  margin-top: 5px;
  display: block;
  color: #f91919;
}

form .password i {
  position: absolute;
  right: 0px;
  height: 45px;
  top: 28px;
  font-size: 13px;
  line-height: 45px;
  width: 45px;
  cursor: pointer;
  color: #939393;
  text-align: center;
}

.submit-btn {

  margin-top: 30px;
  
}

.submit-btn input {
  color: white;
  border: none;
  height: auto;
  font-size: 16px;
  padding: 13px 0;
  border-radius: 5px;
  border:1px solid white;
  cursor: pointer;
  font-weight: 500;
  text-align: center;
  background: #0a0a23;
  transition: 0.2s ease;
}

.submit-btn input:hover {
  background:grey;
}

.error-text {
  position: absolute;
  bottom: -20px;
  left: 0;
  color: red;
  font-size: 12px;
}

form input.error,
form select.error {
  border-color: red;
}

form input.error + #pass-toggle-btn {
  color: red;
}
    </style>
</head>
<body>
    <?php  
   if (isset($message)) {
      foreach ($message as $msg) {
         echo '<div class="message" onclick="this.remove();">' . $msg . '</div>';
      }
   }

   ?>
    <form action="signup.php" method="post">
        <h2>Register here!!</h2>
        <div class="form-group fullname">
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="name" placeholder="Enter your full name">
            <?php if (isset($errors) && in_array("Email is required", $errors)) echo '<p class="error-text">full name is required</p>'; ?>
        
        </div>
        <div class="form-group email">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address">
              <?php if (isset($errors) && in_array("Email is required", $errors)) echo '<p class="error-text">Email address is required</p>'; ?>
        </div>
        <div class="form-group password">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password">
            <i id="pass-toggle-btn" class="fa-solid fa-eye"></i>
            <?php if (isset($errors) && in_array("Password is required", $errors)) echo '<p class="error-text"> Password is required</p>'; ?>
        
        </div>
        <div class="form-group phone">
            <label for="phone_no">Phone Number</label>
            <input type="tel" id="phone_no" name="phone_no" placeholder="Enter your phone number">
            <?php 
            // if (isset($errors) && in_array("Phone number is required", $errors)) echo '<p class="error-text">Phone number is required</p>'; ?>
            <?php
            if (isset($errors) && in_array("Phone number is required", $errors)) {
                echo '<p class="error-text">Phone number is required</p>';
            } elseif (isset($errors) && in_array("Invalid phone number format. Please enter a 10-digit number.", $errors)) {
                echo '<p class="error-text">Please enter a 10-digit number.</p>';
            }
            ?>
        </div>
        <div class="form-group submit-btn">
            <input type="submit" name="submit" value="Submit">
        </div>
        <p style="color:white;">Already have an account? <a href="front.php" style="color:red;">Login now</a></p>
    </form>

    <script>
      function goToLoginPage() {
         window.location.href = "front.php";
      }
   </script>
  </body>
  </html>
