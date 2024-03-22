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
   <title>front</title>
   <!-- <link rel="stylesheet" href="style/front.css"> -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

/* * @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap'); */

* {
   font-family: 'Poppins', sans-serif;
   margin: 0;
   padding: 0;
   outline: none;
   border: none;
   text-decoration: none;
   
}



body {
background:  #0a0a23;
background-size: cover;
position: relative;
overflow: hidden;
}




.container {
  padding: 20px;
  margin: 0 auto;
  max-width: 1200px;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
}

.column {
  flex: 1;
  padding: 40px;
  padding-top: 0px;
}

.h2-column {
  flex-direction: column;
  text-align: center;
  justify-content: center;
}

.h2-column h1 {
  color: white;
  font-size: 50px;
  text-align: left;
  margin-bottom: 10px;
}

.h2-column p {
  font-size: 24px;
  text-align: left;
  color: white;
}

.form-container {   
  min-height: 10vh;
  padding: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
}


form {
  width: 350px;
  padding: 50px;
  /* background-color: #fff; */
  border-radius:10px;
  text-align: center;
}

h2 {
  font-size: 24px;
  /* margin-bottom: 20px; */
  /* margin-top: 10px; */
  color: #333;
}

input[type="email"],
input[type="password"],
input[type="submit"] {
  color:#fff;
  display: block;
  width: 95%;
  padding: 12px 14px;
  margin: 20px auto;
  font-size: 14px;
  border-radius: 6px;
  border: 1px solid #ccc;
  background-color: #0a0a23;
}

input[type="submit"] {
  padding: 12px 8px;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 45%;
  max-width: 180px;
  margin: 20px auto 0;
  background-color: #0A2558;
  border: none;
  color: white;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #333;
}

p {
  font-size: 18px;
  color: black;
}

p a {
  color: crimson;
}

.form-group {
  position: relative;
}

.error-text {
  position: absolute;
  bottom: -20px;
  left: 0;
  color: red;
  font-size: 14px;
}

form input.error,
form select.error {
  border-color: red;
}

form input.error + #pass-toggle-btn {
  color: red;
}

</style></head>
<body>
   <div class="form-container">
      <section class="home-section" id="home">
         <div class="container">
            <div class="column h2-column">
               <h1 style="font-family:'Poppins', sans-serif;">uthaoo</h1>
               <p>Turn your unwanted scraps into cash</p><br>
            </div>
            <div class="column form-column">
               <?php
                //   if (isset($message)) {
                //      echo '<div class="message">' . $message . '</div>';
                //   }
               ?>
               <?php
                //   Display errors
    
               ?>
               <div class="form-container">
                    <form id="loginForm" action="" method="post">
                        
                    <h3 style="font-family:'Poppins', sans-serif; color:white;">Login here!</h3>
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
                     <p style="color:white;">New User? <a href="signup.php">Register</a></p>
                  </form>
               </div>
            </div>
         </div>
      </section>
   </div>
  </body>
</html>