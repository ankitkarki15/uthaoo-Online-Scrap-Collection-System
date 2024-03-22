<?php
$isFormSubmitted = false;
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form data
    $fields = ['name', 'email', 'phone_no', 'address', 'scrap_items', 'des', 'rate', 'quantity'];
    $data = [];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $data[$field] = $_POST[$field];
        } else {
            $errorMessage = "Please fill in all fields.";
            break;
        }
    }

    if (empty($errorMessage) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email format.";
    }

    if (empty($errorMessage)) {
        // Process the uploaded files, if any
        $images = [];
        if (!empty($_FILES['images']['name'][0])) {
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                $filename = $_FILES['images']['name'][$key];
                $destination = "uploads/" . $filename;

                if (move_uploaded_file($tmp_name, $destination)) {
                    $images[] = $filename;
                }
            }
        }

        // Convert the images array to a comma-separated string
        $image = implode(", ", $images);

        // Insert the form data into the database
        $conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('connection failed');
        
        $stmt = $conn->prepare("INSERT INTO sell (name, email, phone_no, address, scrap_items, `des`, rate, quantity, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        if ($stmt) {
          $stmt->bind_param("ssssssdss", $data['name'], $data['email'], $data['phone_no'], $data['address'], $data['scrap_items'], $data['des'], $data['rate'], $data['quantity'], $image);

            if ($stmt->execute()) {
                $isFormSubmitted = true;
            } else {
                $errorMessage = "Error: " . mysqli_error($conn);
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            $errorMessage = "Error: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }
}
?>
