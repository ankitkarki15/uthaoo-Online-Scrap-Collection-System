<?php
include('include/login.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <title>front</title>
   <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

      * {
         font-family: 'Poppins', sans-serif;
         margin: 0;
         padding: 0;
         outline: none;
         border: none;
         text-decoration: none;
         
      }

      /* body {
   background-color: #e0f2f3; } */
   /* Light blue background color */

   body {
   /* /* background: linear-gradient(280deg, #0A2558, #0A2558); */
   background: linear-gradient(280deg,  #0a0a23,  #0a0a23);
   /* background:#3C3D42; */
   background-size: cover;
   position: relative;
   overflow: hidden;
}

      body::before {
         content: "";
         position: absolute;
         top: -50%;
         left: -50%;
         transform: translate(-47%, -20%);
         width: 200%;
         height: 200%;
         background: #ffffff;
         border-radius: 60% 60% ;
         z-index: -1;
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

      /* making two columns in the container  */
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
         color: #318216;
         font-size: 50px;
         /* font-weight: bold; */
         text-align: left;
         justify-content: center;
      }

      .h2-column p {
         font-size: 24px;
         text-align: left;
         justify-content: center;
         color: black;
      }

      .form-container {
         min-height: 85vh;
         padding: 20px;
         display: flex;
         align-items: center;
         justify-content: center;
         
      }

      form {
         width: 220px;
         padding: 50px;
        
         border-radius: 2px;
         /* border-color:white; */
      
         /* border: 1px solid #ccc; */
         text-align: center;
      }

      h3 {
         font-size: 24px;
         margin-bottom: 20px;
         margin-top: 10px;
         /* text-transform: uppercase; */
         color: #333;
      }

      input[type="email"],
      input[type="password"],
      input[type="submit"] {
         display: block;
         width:140%;
         padding: 12px 14px;
         margin: 20px auto;
         font-size: 14px;
         color:#ccc;
         border-radius: 6px;
         border: 1px solid #ccc;
           background-color: #0a0a23;
      }

      input[type="submit"] {
         padding: 12px 8px;
         /* display: flex; */
         justify-content: center;
         align-items: center;
         width: 40%;
         max-width: 200px;
         /* margin: 20px auto 0; */
         /* background-color: #0A2558; */
         background-color: #0a0a23;
         border: 1px solid #ccc;
         color: white;
         cursor: pointer;
         margin: 20px auto 10px;
         /* display: block; */
      }

      input[type="submit"]:hover {
         background-color: #ccc;
         color:black;
      }

      p {
         /* margin-top: 20px; */
         font-size: 16px;
         color: white;
      }

      p a {
         color: red;
      }

      .message {
         position: sticky;
         top: 0;
         left: 0;
         right: 0;
         padding: 15px 10px;
         background-color: #fff;
         box-shadow: 2px 5px 10px rgba(0, 0, 0, 0.1);
         color: #333;
         font-size: 20px;
         cursor: pointer;
         z-index: 1000;
         text-align: center;
      }
   </style>
</head>
<body>

<!-- ... (your PHP code above) ... -->

<div class="form-container">
    <section class="home-section" id="home">
        <div class="container">
            <div class="column h2-column">
                <h1 style="font-family:'Poppins', sans-serif; color:black;">uthaoo</h1>
                <p>Turn your unwanted items into cash.</p><br>
            </div>
            <div class="column form-column">
                <?php
                if (isset($message)) {
                    echo '<div class="message">' . $message . '</div>';
                }
                ?>

                <div class="form-container">
                <form action="" method="post" onsubmit="return validateForm();">
                
                        <h3 style="font-family:'Poppins', sans-serif; color:white;">Login here!</h3>

                        <input type="email" name="email" required placeholder="Enter your Email">
                        <span id="emailError" style="color: red;"></span>

                        <input type="password" name="password" required placeholder="Enter your Password">
                        <span id="passwordError" style="color: red;"></span>

                        <input type="submit" name="login" value="Login">
                        <p style="color:white;"> New User ? <a href="registerval.php">Register</a></p>
                    </form>

                </div>
            </div>
        </div>
    </section>
</div>

<!-- ... your HTML code ... -->

<script>
    function validateForm() {
        console.log("Validating form...");

        var email = document.forms[0].email.value;
        var password = document.forms[0].password.value;

        var emailError = document.getElementById("emailError");
        var passwordError = document.getElementById("passwordError");

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) { 
            console.log("Invalid email");
            emailError.textContent = "Please enter a valid email address";
            return false;
        } else {
            emailError.textContent = "";
        }

        // Simplified password validation: Minimum 5 characters
        if (password.length < 5) {
            console.log("Invalid password");
            passwordError.textContent = "Please enter a password of at least 5 characters";
            return false;
        } else {
            passwordError.textContent = "";
        }

        console.log("Form validation passed");
        return true; 
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var form = document.querySelector("form");
        form.addEventListener("submit", function(event) {
            if (!validateForm()) {
                event.preventDefault(); // Prevent form submission
            }
        });
    });
</script>
</body>
</html>





