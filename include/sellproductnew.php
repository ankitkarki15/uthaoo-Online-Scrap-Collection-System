<?php
// var_dump($_POST);


$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Connection failed');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Initialize variables with form data or empty strings
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone_no = $_POST['phone_no'] ?? '';
$address = $_POST['address'] ?? '';
$scrapname = $_POST['scrapname'] ?? '';
$description = $_POST['des'] ?? '';
$scraprate = $_POST['scraprate'] ?? '';
$scrapquantity = $_POST['scrapquantity'] ?? '';

$created_at = date('Y-m-d H:i:s');
    // Validate input
    if (empty($name) || empty($email) || empty($phone_no) || empty($address) || empty($scrapname) || empty($description) || empty($scraprate) || empty($scrapquantity)) {

        $errorMessage = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email format.";
    }

    if (empty($errorMessage)) {
        // Prepare and bind the SQL query
        $stmt = $conn->prepare("INSERT INTO scrap (name, email, phone_no, address, scrapname, `des`, scraprate, scrapquantity, image, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssdsss", $name, $email, $phone_no, $address, $scrapname, $description, $scraprate, $scrapquantity, $imagePath, $created_at);

        // Upload images and get image paths
        $imagePath = "";
        if (!empty($_FILES['images']['name'][0])) {
            $images = array();
            $files = $_FILES['images'];

            foreach ($files['tmp_name'] as $key => $tmp_name) {
                $filename = $files['name'][$key];
                $filetmp = $tmp_name;
                $destination = "C:/xampp/htdocs/Uthaoo/uploads/" . $filename;
                if (move_uploaded_file($filetmp, $destination)) {
                    $images[] = $filename;
                }
            }

            // Convert the images array to a comma-separated string
            $imagePath = implode(", ", $images);
        }

        // Update the image path
        if (!empty($images)) {
            $imagePaths = array();
            foreach ($images as $filename) {
                $imagePaths[] = "http://localhost/Uthaoo/uploads/" . $filename;
            }
            $imagePath = implode(", ", $imagePaths);
        }

        // Execute the SQL query
        if ($stmt->execute()) {
            $successMessage = "Form submitted successfully!";
            echo '<script>console.log("' . $successMessage . '");</script>';
        } else {
            $errorMessage = "Error: " . mysqli_error($conn);
            echo '<script>console.log("' . $errorMessage . '");</script>';
        }

        $stmt->close();
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
