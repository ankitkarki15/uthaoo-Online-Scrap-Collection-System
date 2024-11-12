  <?php
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
          $errors[] = "Please enter 10-digit number.";
      }

      if (count($errors) === 0) {

          $select = mysqli_query($conn, "SELECT * FROM user_tbl WHERE email = '$email'");

          if (mysqli_num_rows($select) > 0) {
        
              echo '<script>alert("User already exists!");</script>';
          } else {
     
              $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

              $sql = "INSERT INTO user_tbl (name, email, password, phone_no, role) 
                      VALUES ('$name', '$email', '$hashedPassword', '$phone_no', 'user')";

              $insert = mysqli_query($conn, $sql);

              if ($insert) {
                echo '<script>alert("Registered successfully");</script>';
                  header("Location: login.php");
                  exit;
              } else {
              
                echo '<script>alert("Registration failed");</script>';
                 
              }
          }
      }
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up form</title>

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
            background: #0a0a23;
            font-family: 'Poppins', sans-serif;
        }

        .form-container {
            padding: 25px;
            background: #0a0a23;
            color: white;
            border-radius: 7px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.05);
            max-width: 500px;
            width: 100%;
        }

        .form-container .form-group .error-text {
            color: #f91919;
            font-size: 14px;
        }

        .form-container .submit-btn input {
            background: #0a0a23;
            color: white;
            border: 1px solid white;
        }

        .form-container .submit-btn input:hover {
            background: grey;
        }

        .message {
            background: #f91919;
            color: white;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
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
    <div class="form-container">
        <form action="signup.php" method="post">
            <h2 class="text-center">Sign Up</h2>
            <div class="form-group fullname">
                <label for="fullname">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="name" placeholder="Enter your full name" value="<?php echo isset($name) ? $name : ''; ?>">
                <?php if (isset($errors) && in_array("Name is required", $errors)) echo '<p class="error-text">Name is required</p>'; ?>
            </div>
            
            <div class="form-group email">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" value="<?php echo isset($email) ? $email : ''; ?>">
                <?php
                if (isset($errors) && in_array("Email is required", $errors)) echo '<p class="error-text">Email address is required</p>';
                elseif (isset($errors) && in_array("Invalid email format", $errors)) echo '<p class="error-text">Invalid email format</p>';
                ?>
            </div>
            
            <div class="form-group password">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                <?php if (isset($errors) && in_array("Password is required", $errors)) echo '<p class="error-text">Password is required</p>'; ?>
            </div>
            
            <div class="form-group phone">
                <label for="phone_no">Phone Number</label>
                <input type="tel" class="form-control" id="phone_no" name="phone_no" placeholder="Enter your phone number" value="<?php echo isset($phone_no) ? $phone_no : ''; ?>">
                <?php
                if (isset($errors) && in_array("Phone number is required", $errors)) echo '<p class="error-text">Phone number is required</p>';
                elseif (isset($errors) && in_array("Please enter a 10-digit number.", $errors)) echo '<p class="error-text">Please enter a 10-digit number.</p>';
                ?>
            </div>

            <div class="form-group submit-btn">
                <input type="submit" class="btn btn-primary btn-block" name="submit" value="Submit">
            </div>

            <p class="text-center">Already have an account? <a href="login.php" style="color:red;">Login now</a></p>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
