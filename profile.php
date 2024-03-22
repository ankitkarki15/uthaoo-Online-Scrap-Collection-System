
<?php
// include('include/navbar.php');
include('include/userprofile.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Profile Page</title>
    <style>
        .profile, 
        .update{
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .update{
            display: none;
        }
        .profile img,
        .update img {
            display: block;
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            border-radius: 50%;
        }

        .profile h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .profile p {
            color: #666;
            margin-bottom: 5px;
        }

        .profile p:last-child {
            margin-bottom: 0;

        }
        input[type="text"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 16px;
}

input[type="text"]:focus {
  outline: none;
  border-color: #2196F3;
}
/* <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> */

    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        $(document).ready(function() {
            Show update form when "Edit Profile" is clicked
            $(".edit-link").click(function() {
                $(".profile").hide();
                $(".update").show();
            });
        });
    </script>
</head>
<body>
<?php 
include('include/navbar.php'); ?>
<br><br><br>
<div class="profile">
<ion-icon name="person-circle" style="font-size: 120px;"></ion-icon><br><br>

    <h1 style="color: black;"><strong>Name:</strong> <?php echo $row["name"]; ?></h1>
    <p style="color: black;"><strong>Email:</strong> <?php echo $row["email"]; ?></p>
    <p style="color: black;"><strong>Phone Number:</strong> <?php echo $row["phone_no"]; ?></p>
    <br>
    <hr>
    <a href="editprofile.php" class="edit-link">Edit Profile</a>
</div>
<br><br><br>
<?php
include('include/footer.php');
?>

</body>
</html>
