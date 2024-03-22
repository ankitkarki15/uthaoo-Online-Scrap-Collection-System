<?php
include('include/navbar.php')?>
<br><br><br>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <title>Setting </title> -->
    <style>
        .cp-container {
            position: relative;
            font-family: 'Poppins', sans-serif;
            width: 20%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #888;
        }

        .close-button {
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
            font-size: 18px;
            /* color:red; */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
        }

        form {
            display: flex;
            flex-direction: column; 
        }

        label {
            margin-bottom: 10px;
        }

        input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1.5px solid #ccc;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #318216;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 auto;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="cp-container">
        <span class="close-button" onclick="closeForm()">&#10006;</span> <!-- Close button -->
        <h1>Change Password</h1>
        <form id="changePasswordForm" method="POST" action="include/changepass.php">
            <input type="password" id="currentPassword" name="opass" placeholder="Your current password" required>
            <input type="password" id="newPassword" name="npass" placeholder="Your new password" required>
            <input type="password" id="confirmPassword" name="cpass" placeholder="Confirm new password" required>
            <input type="submit" name="loginbtn" value="Change password">
        </form>
    </div>

    <script>
        function closeForm() {
            var container = document.querySelector('.cp-container');
            window.location.href = "home.php";
            container.style.display = 'none';
        }
    </script>
    <br><br><br>

   <?php
include('include/footer.php')?>

</body>
</html>
