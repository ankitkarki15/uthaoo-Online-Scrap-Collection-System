<?php

$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('connection failed');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no']; 
    $address = $_POST['address'];
    $scrapname = $_POST['scrapname']; 
    // $productDescription = $_POST['des']; 
    $scraprate = $_POST['scraprate']; 
    $scrapquantity = $_POST['scrapquantity']; 
    $created_at = date('Y-m-d H:i:s');

    // Process the uploaded files, if any
    $images = array();
    if (!empty($_FILES['images'])) {
        $files = $_FILES['images'];

        foreach ($files['tmp_name'] as $key => $tmp_name) {
            $filename = $files['name'][$key];
            $filetmp = $tmp_name;
            $destination = "C:/xampp/htdocs/uthaoo/uploads/" . $filename;

            if (move_uploaded_file($filetmp, $destination)) {
                $images[] = $filename;
            }
        }
    }

    // Convert the images array to a comma-separated string
    $image = implode(", ", $images);

    // Insert the form data into the database
    $stmt = $conn->prepare("INSERT INTO scrap (name, email, phone_no, address, scrapname, `des`, scraprate, scrapquantity, image, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssdsss", $name, $email, $phone_no, $address, $scrapname, $productDescription, $scraprate, $scrapquantity, $image, $created_at);

    if (mysqli_stmt_execute($stmt)) {
        $successMessage = "Form submitted successfully!";
        echo '<script>alert("Your sell product form submitted successfully!");</script>';
    } else {
        $errorMessage = "Error submitting form: " . mysqli_stmt_error($stmt);
    }

    // Close the prepared statement
    $stmt->close();
}
?>
