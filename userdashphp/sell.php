<?php
// include('userprofile.php');
$conn = mysqli_connect('localhost','root','ankit','scrapx') or die('connection failed');
// Debugging code
// var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone_no'];
  $address = $_POST['address'];
  $scrapItems = $_POST['scrap_items'];
  $description = $_POST['des'];
  $rate = $_POST['rate'];
  $quantity = $_POST['quantity'];

  // Process the uploaded files, if any
  $images = array();
  if (!empty($_FILES['images'])) {
    $files = $_FILES['images'];

    foreach ($files['tmp_name'] as $key => $tmp_name) {
      $filename = $files['name'][$key];
      $filetmp = $tmp_name;
      $destination = "C:/xampp/htdocs/EcoScrap/uploads/" . $filename;

      if (move_uploaded_file($filetmp, $destination)) {
        $images[] = $filename;
      }
    }
  }

  // Convert the images array to a comma-separated string
  $image = implode(", ", $images);

  // Insert the form data into the database
  $stmt = $conn->prepare("INSERT INTO sell (name, email, phone_no,address, scrap_items, `des`, rate, quantity, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssdss", $name, $email, $phone, $address, $scrapItems, $description, $rate, $quantity, $image);

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
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User dashboard</title>
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <link rel="stylesheet" href="assets/css/sell3.css">
    <!-- <link rel="stylesheet" href="assets/css/cp.css"> -->
</head>
<body>

 <!-- sell products -->
 <div class="section" id="sell-scrap" style="display: none;">
                    <div class="sell-container" id="sellScrapForm">
                        <h1 style="color:#318216;margin-bottom: 20px; font-size: 30px; font-weight: 700; text-align: center;">Scrap Request Form</h1>
                        <!-- <form method="post" action="../include/sellproduct.php" enctype="multipart/form-data"> -->
                        <!-- <form method="post" action="../products.php" enctype="multipart/form-data"> -->
                        <form action="" method="post" enctype="multipart/form-data">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" placeholder="Your name.." value="<?php echo isset($name) ? $name : ''; ?>" readonly>

                            <div class="form-row">
                                <div>
                                    <label for="phone_no">Phone Number:</label>
                                    <input type="text" id="phone_no" name="phone_no" placeholder="Your phone number.." pattern="[0-9]{10}" value="<?php echo isset($phone_no) ? $phone_no : ''; ?>" readonly>
                                </div>
                                <div>
                                    <label for="email">Email:</label>
                                    <input type="text" id="email" name="email" placeholder="Your email.." value="<?php echo isset($email) ? $email : ''; ?>" readonly>
                                </div>
                            </div>

                            <label for="address">Pick up Location:</label>
                            <input type="text" id="address" name="address" required placeholder="Address">

                            <label for="scrap-items">Scrap Items:</label>
                            <select id="scrap-items" name="scrap_items" onchange="updateRate()" required>
                                <option value="">-- Select Scrap Items --</option>
                                <option value="Plastic" data-rate="10">Plastic</option>
                                <option value="Water Bottles" data-rate="5">Water Bottles (pcs)</option>
                                <option value="Plastic" data-rate="0.1">Plastic</option>
                                <option value="Newspapers" data-rate="3.5">Newspapers</option>
                                <option value="Copies/Books" data-rate="1.8">Copies/Books</option>
                                <option value="Cartons" data-rate="0.5">Cartons</option>
                                <option value="Battery" data-rate="0.1">Battery</option>
                                <option value="E-waste" data-rate="2.5">E-waste</option>
                                <option value="Mixed" data-rate="3.5">Mixed</option>
                            </select><br>

                            <label for="rate">Rate (Rs/kg or per pcs):</label>
                            <input type="number" id="rate" name="rate" required readonly>

                            <label for="quantity">Quantity (kg):</label>
                            <input type="number" id="quantity" name="quantity" required placeholder="Quantity in kg" onchange="calculateTotalAmount()">

                            <label for="product-description">Describe Your Product:</label>
                            <textarea id="product-description" name="des" rows="4" placeholder="Describe the scrap you have" required></textarea>

                            <label for="image-upload-input-1">Upload Images:</label><br>
                            <div class="image-upload">
                                <div id="image-preview-1" class="image-preview"></div>
                                <input type="file" id="image-upload-input-1" name="images[]" accept=".jpg, .jpeg, .png" multiple onchange="previewImages(event, 'image-preview-1')">
                            </div>

                            <div class="image-upload">
                                <div id="image-preview-2" class="image-preview"></div>
                                <input type="file" id="image-upload-input-2" name="images[]" accept=".jpg, .jpeg, .png" multiple onchange="previewImages(event, 'image-preview-2')">
                            </div>

                            <input type="submit" value="Submit">
                        </form>
                    </div>  
                </div>

<script>
        // function showHomeContent() {
        //     var homeContent = document.getElementById("homeContent");
        //     homeContent.style.display = "block";
        //     document.getElementById("sellScrapForm").style.display = "none";
        // }

        // function showSellScrapForm() {
        //     var sellScrapForm = document.getElementById("sellScrapForm");
        //     sellScrapForm.style.display = "block";
        //     document.getElementById("homeContent").style.display = "none";
        // }
   
    function validateForm() {
    var addressInput = document.getElementById("address");
    var quantityInput = document.getElementById("quantity");
    var quantityValue = parseFloat(quantityInput.value);

    if (addressInput.value.trim() === "") {
      alert("Please enter your pick up location.");
      addressInput.focus();
      return false;
    }

    if (isNaN(quantityValue) || quantityValue <= 0) {
      alert("Please enter a valid quantity value.");
      quantityInput.focus();
      return false;
    }

    var imageInput1 = document.getElementById("image-upload-input-1");
    var imageInput2 = document.getElementById("image-upload-input-2");

    if (imageInput1.files.length === 0 && imageInput2.files.length === 0) {
      alert("Please upload at least one image.");
      return false;
    }

    return true;
  }
  </script>
  </body>
  </html>