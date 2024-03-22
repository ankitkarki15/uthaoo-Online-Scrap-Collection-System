<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <style>
        .cp-container {
            font-family: 'Poppins', sans-serif;
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #888;
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
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        #popupOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
        }

        #popupContent {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Change Password</h1>
        <form id="changePasswordForm">
            <input type="password" id="currentPassword" name="currentPassword" placeholder="Your current password" required>
            <input type="password" id="newPassword" name="newPassword" placeholder="Your new password" required>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm new password" required>
            <input type="submit" value="Change password">
        </form>
    </div>
    
</body>
</html>
