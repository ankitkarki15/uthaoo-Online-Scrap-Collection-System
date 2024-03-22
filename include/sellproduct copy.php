<?php
// Enable error reporting
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Connection failed');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form data
    $name = $_POST['name'];
    $phone_no = $_POST['phone_no'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $scrap_Items = $_POST['scrapname'];
    $rate = $_POST['rate'];
    $quantity = $_POST['quantity'];
    $description = $_POST['des'];
    $created_at = date('Y-m-d H:i:s');

    // Validate input
    if (empty($name) || empty($email) || empty($phone_no) || empty($address) || empty($scrap_Items) || empty($description) || empty($rate) || empty($quantity)) {
        $errorMessage = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email format.";
    }

    if (empty($errorMessage)) {
       
        $images = array();
        if (!empty($_FILES['images']['name'][0])) {
            $files = $_FILES['images'];

            foreach ($files['tmp_name'] as $key => $tmp_name) {
                $filename = $files['name'][$key];
                $filetmp = $tmp_name;
                $destination = "C:/xampp/htdocs/Uthaoo/uploads/" . $filename;
                if (move_uploaded_file($filetmp, $destination)) {
                    $images[] = $filename;
                }
            }
        }

        // Convert the images array to a comma-separated string
        $image = implode(", ", $images);


$stmt = $conn->prepare("INSERT INTO scrap (name, email, phone_no, address, scrap_items, `des`, rate, quantity, image, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssdsss", $name, $email, $phone_no, $address, $scrap_Items, $description, $rate, $quantity, $image, $created_at);


        if ($stmt->execute()) {
            $successMessage = "Form submitted successfully!";
            echo '<script>console.log("' . $successMessage . '");</script>';
        } else {
            $errorMessage = "Error: " . mysqli_error($conn);
            echo '<script>console.log("' . $errorMessage . '");</script>';
        }

        $stmt->close();

        // Update the image path
        if (!empty($images)) {
            $imagePaths = array();
            foreach ($images as $filename) {
                $imagePaths[] = "http://localhost/Uthaoo/uploads/" . $filename;
            }
            $imagePath = implode(", ", $imagePaths);
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
