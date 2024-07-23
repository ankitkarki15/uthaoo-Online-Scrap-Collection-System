<?php
session_start();

include('../include/connection.php');

function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

if (isset($_POST['submit'])) {
    // Sanitize inputs
    $name = sanitizeInput($_POST["name"]);
    $providedEmail = sanitizeInput($_POST["email"]); // Email provided by the user during signup
    $password = $_POST["password"];
    $phone_no = sanitizeInput($_POST["phone_no"]);
    $vehicle_type = isset($_POST["vehicle_type"]) ? sanitizeInput($_POST["vehicle_type"]) : ''; // Initialize $vehicle_type with a default value
    $location = isset($_POST["location"]) ? sanitizeInput($_POST["location"]) : '';
    $license_number = sanitizeInput($_POST["license_number"]);

    // Server-side validation
    $errors = array();

    if (empty($name)) {
        $errors[] = "Name is required";
    }

    if (empty($providedEmail)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($providedEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (empty($phone_no)) {
        $errors[] = "Phone number is required";
    } elseif (!preg_match("/^[0-9]{10}$/", $phone_no)) {
        $errors[] = "Please enter a 10-digit number.";
    }

    if (empty($location)) {
        $errors[] = "Location is required";
    }

    if (empty($vehicle_type)) {
        $errors[] = "Vehicle type is required";
    }

    if (!empty($vehicle_type) && $vehicle_type !== 'bicycle' && empty($license_number)) {
        $errors[] = "License number is required for selected vehicle type";
    }

    // Check if hero photo is uploaded
    if (empty($_FILES['hero_photo']['name'])) {
        $errors[] = "Hero photo is needed";
    } else {
        $hero_photo = $_FILES['hero_photo']['name'];

        // Handle file upload
        $target_dir = "../uploads/hero/";
        $target_file = $target_dir . basename($_FILES["hero_photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES["hero_photo"]["name"], PATHINFO_EXTENSION));

        // Check file type
        if ($imageFileType != "jpg" && $imageFileType != "jpeg") {
            $errors[] = "Sorry, only JPG and JPEG files are allowed.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["hero_photo"]["size"] > 500000) {
            $errors[] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $errors[] = "File upload failed due to the above errors.";
        } else {
            if (!move_uploaded_file($_FILES["hero_photo"]["tmp_name"], $target_file)) {
                $errors[] = "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Proceed with database insertion if no errors
    if (empty($errors)) {
        $_SESSION['message'][] = "The file " . htmlspecialchars(basename($_FILES["hero_photo"]["name"])) . " has been uploaded.";

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Generate email based on name
        $nameParts = explode(" ", strtolower($name));
        $firstThreeLetters = strtolower(substr($nameParts[0], 0, 3)); // Convert to lowercase before taking the substring

        $sql = "INSERT INTO hero (name, email, password, phone_no, vehicle_type, license_number, location, hero_photo) 
                VALUES ('$name', '$providedEmail', '$hashedPassword', '$phone_no', '$vehicle_type', '$license_number', '$location', '$hero_photo')";
        $insert = mysqli_query($conn, $sql);

        // Check if insertion was successful
        if ($insert) {
            // Retrieve the auto-generated hero_id
            $hero_id = mysqli_insert_id($conn);

            // Generate email based on name and hero_id
            $generatedEmail = $firstThreeLetters . $hero_id . "@hero.uthaoo.com";

            // Update the record with the generated email
            $updateSql = "UPDATE hero SET generated_email = '$generatedEmail' WHERE hero_id = '$hero_id'";
            $updateResult = mysqli_query($conn, $updateSql);

            // Check if update was successful
            if ($updateResult) {
                // Registration successful
                $_SESSION['message'][] = "Thank you for registering!!! Your generated email is " . $generatedEmail;

                // Redirect to signup page
                header("Location: signuphero.php");
                exit;
            } else {
                $_SESSION['message'][] = "Registration failed!";
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
    <title>Hero Sign up form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Light gray background */
            color: #333; /* Dark text color */
        }

        .container {
            max-width: 840px; /* Limit the width of the form */
            margin: 20px auto; /* Center the form horizontally */
            padding: 20px; /* Add some padding */
            background-color: #fff; /* White background */
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a shadow */
        }

        .center-heading {
            font-family: 'Poppins', sans-serif;
            text-align: center; /* Center the heading */
            color: #007bff; /* Blue heading color */
        }

        .form-group {
            margin-bottom: 20px; /* Add space between form groups */
        }

        .error-text {
            color: #dc3545; /* Red error text color */
        }

        .submit-btn input[type="submit"] {
            background-color: #007bff; /* Blue submit button */
            color: #fff; /* White text color */
            border: none; /* No border */
            padding: 10px 20px; /* Add some padding */
            border-radius: 3px; /* Rounded corners */
            cursor: pointer; /* Show pointer cursor on hover */
            transition: background-color 0.3s; /* Smooth transition */
        }

        .submit-btn input[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        /* Optional: Style for links */
        a {
            color: #007bff; /* Blue link color */
            text-decoration: none; /* Remove underline */
        }

        a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="herosignup.php" method="post" enctype="multipart/form-data">
            <h2 class="center-heading">Register as Hero</h2>

            <!-- Full Name and Phone Number -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fullname">Full Name</label>
                    <input type="text" class="form-control" id="fullname" name="name" placeholder="Enter your full name" value="<?php echo isset($name) ? $name : ''; ?>">
                    <?php if (isset($errors) && in_array("Name is required", $errors)) echo '<p class="error-text">Name is required</p>'; ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="phone_no">Phone Number</label>
                    <input type="tel" class="form-control" id="phone_no" name="phone_no" placeholder="Enter your phone number" value="<?php echo isset($phone_no) ? $phone_no : ''; ?>">
                    <?php if (isset($errors) && in_array("Phone number is required", $errors)) echo '<p class="error-text">Phone number is required</p>';
                          elseif (isset($errors) && in_array("Please enter a 10-digit number.", $errors)) echo '<p class="error-text">Please enter a 10-digit number.</p>'; ?>
                </div>
            </div>

            <!-- Email and Password -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" value="<?php echo isset($providedEmail) ? $providedEmail : ''; ?>">
                    <?php if (isset($errors) && in_array("Email is required", $errors)) echo '<p class="error-text">Email address is required</p>';
                          elseif (isset($errors) && in_array("Invalid email format", $errors)) echo '<p class="error-text">Invalid email format</p>'; ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    <?php if (isset($errors) && in_array("Password is required", $errors)) echo '<p class="error-text">Password is required</p>'; ?>
                </div>
            </div>

            <!-- Vehicle Type, License Number, and Location -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="vehicle_type">Vehicle Type</label>
                    <select class="form-control" id="vehicle_type" name="vehicle_type">
                        <option value="">Select Vehicle Type</option>
                        <option value="bicycle" <?php echo isset($vehicle_type) && $vehicle_type == 'bicycle' ? 'selected' : ''; ?>>Bicycle</option>
                        <option value="motorcycle" <?php echo isset($vehicle_type) && $vehicle_type == 'motorcycle' ? 'selected' : ''; ?>>Motorcycle</option>
                        <option value="car" <?php echo isset($vehicle_type) && $vehicle_type == 'car' ? 'selected' : ''; ?>>Car</option>
                    </select>
                    <?php if (isset($errors) && in_array("Vehicle type is required", $errors)) echo '<p class="error-text">Vehicle type is required</p>'; ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="license_number">License Number</label>
                    <input type="text" class="form-control" id="license_number" name="license_number" placeholder="Enter your license number" value="<?php echo isset($license_number) ? $license_number : ''; ?>" <?php echo isset($vehicle_type) && $vehicle_type == 'bicycle' ? 'disabled' : ''; ?>>
                    <?php if (isset($errors) && in_array("License number is required for selected vehicle type", $errors)) echo '<p class="error-text">License number is required for selected vehicle type</p>'; ?>
                </div>
            </div>

            <!-- Location -->
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="Enter your location" value="<?php echo isset($location) ? $location : ''; ?>">
                <?php if (isset($errors) && in_array("Location is required", $errors)) echo '<p class="error-text">Location is required</p>'; ?>
            </div>

            <!-- Hero Photo -->
            <div class="form-group">
                <label for="hero_photo">Hero Photo</label>
                <input type="file" class="form-control-file" id="hero_photo" name="hero_photo">
                <?php if (isset($errors) && in_array("Hero photo is needed", $errors)) echo '<p class="error-text">Hero photo is needed</p>';
                      elseif (isset($errors) && in_array("Sorry, only JPG and JPEG files are allowed.", $errors)) echo '<p class="error-text">Sorry, only JPG and JPEG files are allowed.</p>';
                      elseif (isset($errors) && in_array("Sorry, your file is too large.", $errors)) echo '<p class="error-text">Sorry, your file is too large.</p>';
                      elseif (isset($errors) && in_array("Sorry, there was an error uploading your file.", $errors)) echo '<p class="error-text">Sorry, there was an error uploading your file.</p>'; ?>
            </div>

            <!-- Submit Button -->
            <div class="submit-btn">
                <input type="submit" name="submit" value="Register">
            </div>
        </form>

        <?php
        // Display error messages
        if (isset($errors) && !empty($errors)) {
            echo '<div class="alert alert-danger" role="alert">';
            foreach ($errors as $error) {
                echo $error . '<br>';
            }
            echo '</div>';
        }

        // Display session messages
        if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
            echo '<div class="alert alert-success" role="alert">';
            foreach ($_SESSION['message'] as $message) {
                echo $message . '<br>';
            }
            echo '</div>';

            // Clear the session message
            unset($_SESSION['message']);
        }
        ?>
    </div>
</body>
</html>
