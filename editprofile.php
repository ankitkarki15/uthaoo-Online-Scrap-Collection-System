<?php
include('include/userprofile.php');
include('include/navbar.php');
include('include/connection.php');

$errors = [];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM user_tbl WHERE id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("i", $user_id);
    $statement->execute();

    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone_no = $_POST['phone_no'];

            // Name validation
            if (empty($name)) {
                $errors[] = "Name is required.";
            } elseif (is_numeric(substr($name, 0, 1))) {
                $errors[] = "Name cannot start with a numeric value.";
            }

            // Email validation
            if (empty($email)) {
                $errors[] = "email is required.";
            }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }

         
            // Phone number validation
            if (empty($phone_no)) {
                $errors[] = "Phone number is required.";
            }elseif (!preg_match('/^\d{10}$/', $phone_no)) {
                $errors[] = "Phone number should be exactly 10 digits.";
            }


            if (empty($errors)) {
                $update_query = "UPDATE user_tbl SET name = ?, email = ?, phone_no = ? WHERE id = ?";
                $update_statement = $conn->prepare($update_query);
                $update_statement->bind_param("sssi", $name, $email, $phone_no, $user_id);
                $update_result = $update_statement->execute();
            
                if ($update_result) {
                    echo '<script>alert("Profile updated successfully!");</script>';
                    header("Location:./profile.php");
                    exit();
                } else {
                    echo '<script>alert("Error updating profile: ' . $update_statement->error . '");</script>';
                }
            }
            
        }
    } else {
        echo "No user found.";
    }

    $statement->close();
} else {
    echo "User not logged in.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit Profile</title>
    <style>
    body {
        font-family:'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #fff;
    }

    .update {
        max-width: 300px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        /* border:1px solid black; */
        border-radius: 5px; 
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
    }

    h2 {
        margin-top: 0;
        font-size: 20px;
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    input[type="file"],
    input[type="text"] {
        /* width: 100%; */
        margin-bottom: 5px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    
input[type="submit"] {
  display: block;
  margin: 20px auto 0;
  font: 18px sans-serif;
  padding: 10px 20px;
  /* background-color:; */
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
  background-color: #47474b;
}
.error-messages {
    color: red;
    margin-bottom: 10px;
}

.error-field {
    border: 1px solid red;
}

</style>
</head>
<body>
<div class="update"> 
    <h2>Edit Profile</h2>
        <form method="POST" action="">
      
                <?php
                if (!empty($errors)) {
                    echo '<div class="error-messages">';
                    foreach ($errors as $error) {
                        echo '<p class="error">' . $error . '</p>';
                    }
                    echo '</div>';
                }
                ?>
  Name:<input type="text" name="name" class="<?php echo !empty($errors) && !empty($errors['name']) ? 'error-field' : ''; ?>" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : htmlspecialchars($row['name']); ?>"><br>
    Email:<input type="text" name="email" class="<?php echo !empty($errors) && !empty($errors['email']) ? 'error-field' : ''; ?>" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : htmlspecialchars($row['email']); ?>"><br>
    Phone Number:<input type="text" name="phone_no" class="<?php echo !empty($errors) && !empty($errors['phone_no']) ? 'error-field' : ''; ?>" value="<?php echo isset($_POST['phone_no']) ? htmlspecialchars($_POST['phone_no']) : htmlspecialchars($row['phone_no']); ?>">
    <!-- Add input field for image upload if needed -->
    <input type="submit" value="Update Profile">
    <br><a href="profile.php">Go Back</a>
</form>

</div>
<?php
include('include/footer.php')?>

</body>

</html>