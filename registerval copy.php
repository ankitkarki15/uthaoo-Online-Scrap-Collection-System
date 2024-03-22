<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Add this line

include('include/connection.php');

if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone_no = $_POST["phone_no"];

    // Check if the user already exists
    $select = mysqli_query($conn, "SELECT * FROM user_tbl WHERE email = '$email'");

    if (mysqli_num_rows($select) > 0) {
        echo '<script>alert("User already exists!");</script>';
    } else {
        $sql = "INSERT INTO user_tbl (name, email, password, phone_no, role) 
            VALUES ('$name', '$email', '$password', '$phone_no', 'user')";

        $insert = mysqli_query($conn, $sql);

        if ($insert) {
            echo '<script>alert("Registered successfully");</script>';
            echo '<script>window.location.href = "front.php";</script>';
            exit;
        
        } else {
            echo '<script>alert("Registered failed");</script>';
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
    <form action="registerval.php" method="post">
        <h2>Register here!!</h2>
        <div class="form-group fullname">
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="name" placeholder="Enter your full name">
        </div>
        <div class="form-group email">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address">
        </div>
        <div class="form-group password">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password">
            <i id="pass-toggle-btn" class="fa-solid fa-eye"></i>
        </div>
        <div class="form-group phone">
            <label for="phone_no">Phone Number</label>
            <input type="tel" id="phone_no" name="phone_no" placeholder="Enter your phone number">
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

    <script>
        // Selecting form and input elements
        const form = document.querySelector("form");
        const passwordInput = document.getElementById("password");
        const passToggleBtn = document.getElementById("pass-toggle-btn");

        // Rest of your client-side validation script
        const showError = (field, errorText) => {
        field.classList.add("error");
        const errorElement = document.createElement("small");
        errorElement.classList.add("error-text");
        errorElement.innerText = errorText;
        field.closest(".form-group").appendChild(errorElement);
    }

      const handleFormData = (e) => {
    // e.preventDefault();

      const fullnameInput = document.getElementById("fullname");
      const emailInput = document.getElementById("email");
      const passwordInput = document.getElementById("password");
      const phoneInput = document.getElementById("phone_no");
      
      const fullname = fullnameInput.value.trim();
      const email = emailInput.value.trim();
      const password = passwordInput.value.trim();
      const phone_no = phoneInput.value.trim();
      
      // Regular expression pattern for email validation
      var emailPattern = /^[a-zA-Z0-9._-]+@gmail\.com$/;
      const phonePattern = /^[0-9]{10}$/; // Exactly 10 digits


      document.querySelectorAll(".form-group .error").forEach(field => field.classList.remove("error"));
      document.querySelectorAll(".error-text").forEach(errorText => errorText.remove());

      if (fullname === "") {
          showError(fullnameInput, "Enter your full name");
      }
      if (!emailPattern.test(email)) {
          showError(emailInput, "Enter a valid email address");
      }
      if (password === "") {
          showError(passwordInput, "Enter your password");
      }
      if (phone_no === "") {
          showError(phoneInput, "Enter your phone number"); 
      } else if (!phonePattern.test(phone_no)) {
          showError(phoneInput, "Enter correct phone number");
      } else if (phone_no.length > 10) {
          showError(phoneInput, "Phone number must not be longer than 10 digits");
      } 
      
  }


          // Toggling password visibility
          passToggleBtn.addEventListener('click', () => {
              passToggleBtn.className = passwordInput.type === "password" ? "fa-solid fa-eye-slash" : "fa-solid fa-eye";
              passwordInput.type = passwordInput.type === "password" ? "text" : "password";
          });

          form.addEventListener("submit", handleFormData);
      </script>
  </body>
  </html>
