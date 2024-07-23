<?php
session_start();
include('../include/connection.php');

if (isset($_POST['login'])) {
    $generatedemail = $_POST['email'];
    $password = $_POST['password'];

    // Server-side validation
    $errors = array();
    
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (empty($errors)) {
        // Prepare and execute the query
        $query = "SELECT * FROM hero WHERE generated_email = ?";

        $statement = $conn->prepare($query);
        $statement->bind_param("s", $generatedemail);
        $statement->execute();

        // Get the result
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['hero_id'] = $row['id'];
                // Hero login successful
                header("Location:herodash.php");
                exit;
            } else {
                $message = "Invalid password";
                echo "<script>alert('$message');</script>";
            }
        } else {
            $message = "Invalid email or password";
            echo "<script>alert('$message');</script>";
        }

        $statement->close();
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hero Login</title>
    <link rel="stylesheet" href="style/herologin.css">
    <style>
 
      </style>
</head>
<body>
  

<div class="form-container">
                    <form id="loginForm" action="" method="post">
                        
                    <h2 style="font-family:'Poppins', sans-serif;">
                    Hero Login</h2>
                        <div class="form-group email">
                            <input type="email" id="email" name="email" placeholder="Email address">
                            <?php if (isset($errors) && in_array("Email is required", $errors)) echo '<p class="error-text">Email address is required</p>'; ?>
                            <?php 
                            // if (isset($errors) && in_array("Invalid email format", $errors)) echo '<p class="error-text">Invalid email format</p>'; ?>
                        </div>
                        <div class="form-group password">
                            <input type="password" id="password" name="password" placeholder="Your password">
                            <?php if (isset($errors) && in_array("Password is required", $errors)) echo '<p class="error-text">Password is required</p>'; ?>
                            <!-- <ion-icon name="eye-outline"></ion-icon> -->
                        </div>
                     <div class="form-group submit-btn">
                        <input type="submit" name="login" value="Login"><br>
                     </div>
                     <hr> 
                     <p>Don't have an account? <a href="herosignup.php">Register here</a></p>
                     <a href="../front.php">Go back</a></p>
                  </form>
               </div>
            </div>
         </div>
      </section>
   </div>
  </body>
</html>