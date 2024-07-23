<?php
session_start();
include('include/connection.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Server-side validation
    $errors = array();
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email Format";
        echo "<script>alert('$message');</script>";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (empty($errors)) {
        // Prepare and execute the query
        $query = "SELECT * FROM user_tbl WHERE email = ?";
        $statement = $conn->prepare($query);
        $statement->bind_param("s", $email);
        $statement->execute();

        // Get the result
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                if ($row['role'] == 'admin') {
                    // Admin login successful
                    header("Location:admindashphp/adminpanel.php");
                    exit;
                } else {
                    // Regular user login successful
                    header("Location:home.php");
                    // header("Location:userdashphp/userpanel.php");
                    exit;
                }
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
   <title>Login</title>
   <!-- Bootstrap CSS -->
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

   <!-- Poppins Font -->
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">

   <style>
      body {
         display: flex;
         align-items: center;
         justify-content: center;
         min-height: 100vh;
         background: white;
         font-family: 'Poppins', sans-serif;
      }

      .logo-container {
         text-align: center;
         margin-bottom: 20px;
      }
      
      .logo-container img {
         height: 100px;
      }

      .form-container {
         padding: 25px;
         background: white; 
         border-radius: 7px;
         /* box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.05); */
         max-width: 500px;
         width: 100%;
      }

      .form-container h2 {
         color: #0a0a23; 
         font-size: 27px;
         text-align: center;
         margin-bottom: 30px;
      }

      .form-container .form-group label {
         color: #0a0a23;
         font-size: 15px;
         margin-bottom: 7px;
      }

      .form-container .form-group input,
      .form-container .form-group select {
         color: #0a0a23;
         background: #f0f0f0; 
      }

      .form-container .submit-btn input {
         color: white;
         border: none;
         font-size: 16px;
         padding: 13px 0;
         border-radius: 5px;
         background: #0a0a23;
         transition: 0.2s ease;
      }

      .form-container .submit-btn input:hover {
         background: grey;
      }

      .error-text {
         color: red;
         font-size: 14px;
         margin-top: 5px;
      }

      .message {
         background: #0a0a23;
         color: red;
         padding: 10px 15px;
         margin-bottom: 10px;
         border-radius: 5px;
         cursor: pointer;
      }

      .message:hover {
         opacity: 0.8;
      }
   </style>
</head>
<body>
   <div class="form-container">
      <div class="logo-container">
         <a href="#"><img src="images/logo/logo/1.png" alt="Logo"></a>
      </div>
      <form id="loginForm" action="" method="post">
         <h2>Login here</h2>
         <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
            <?php if (isset($errors) && in_array("Email is required", $errors)) echo '<p class="error-text">Email address is required</p>'; ?>
            <?php if (isset($errors) && in_array("Invalid email format", $errors)) echo '<p class="error-text">Invalid email format</p>'; ?>
         </div>
         <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
            <?php if (isset($errors) && in_array("Password is required", $errors)) echo '<p class="error-text">Password is required</p>'; ?>
         </div>
         <div class="form-group submit-btn">
            <input type="submit" class="btn btn-primary btn-block" name="login" value="Login">
         </div>
         <hr>
         <p class="text-center">New User? <a href="signup.php">Register here</a></p>
         <p class="text-center"><a href="front.php">Go back</a></p>
      </form>
   </div>

   <!-- Bootstrap JS and dependencies -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
