<?php
//include('include/connection.php');
include('include/userprofile.php');
$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('connection failed');
// Debugging code
// var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $name = $_POST['name'];
    // $email = $_POST['email'];
    // $phone_no = $_POST['phone_no']; 
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
    $image = implode(", ", $images);


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


</html> 
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Scrap request form</title>
  <style>
    .error-message {
      
      color: red;
      border-color: red;
      /* font-size: 16px; */
    }

    * {
  box-sizing: border-box;
}

body {
  background-color: #fff;
  font-family: "poppins", sans-serif;
}

.container {
  background-color: white;
  border-radius: 10px;
  padding: 20px;
  width: 60%;
  margin: 0 auto;
  margin-top: 50px;
  /* box-shadow: 2px 0px 10px #888888; */
}

h1 {
  color: #318216;
  margin-bottom: 20px;
  font-size: 24px;
  font-weight: 700;
  text-align: center;
}

label {
  /* font-weight: bold; */
}

input[type="text"],
input[type="number"],
select {

  width: 100%;
  height: 50px;
  padding: 12px;
  font-size:18px;
  border: 1px solid #0c0c0c;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

.form-row {
  display: flex;
  gap: 22px;
}

.form-row div {
  flex: 1;
}

textarea {
  width: 100%;
  height: 100px;
  padding: 12px;
  border: 1px solid #0c0c0c;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

.image-upload {
  
  display:inline-block;
    position: relative;
    width: 150px;
    height: 150px;
    background-color: #f1f1f1;
    /* background-color: #cccccc; */
    border: 2px dashed #ccc;
    overflow: hidden;
  }

  .image-upload img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .image-upload input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
  }
  .image-preview {
    max-width: 100%;
    max-height: 100%;
  }

  .preview-container {
  position: relative;
  width: 200px;
  height: 200px;
  background-color: #f5f5f5;
  border: 2px dashed #ccc;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* .upload-icon {
  font-size: 90px;
  color: #888;
} */

input[type="submit"] {
  display: block;
  margin: 20px auto 0;
  font: 18px sans-serif;
  padding: 10px 20px;
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


  </style>
</head>
<body>
    <?php include('include/navbar.php'); ?>
<div class="container"> 
  <h3 style="color:#318216;margin-bottom: 20px; font-size: 30px; font-weight: 700; text-align: center;">
Scrap Request Form</h3> 

<form method="post" action="products.php" enctype="multipart/form-data" onsubmit="return validateForm()">


Pick up Location:
<input type="text" id="address" name="address" placeholder="eg: Lokanthali, Bhaktapur near NIST School">
<span id="address-error-message" class="error-message"></span>
<br>
Scrap Items:
<select id="scrapname" name="scrapname" onchange="updatescrapRate()">
        <option value="">-- Select Scrap Items --</option>
        <?php
        $query = "SELECT scrapname, scraprate FROM pricing ORDER BY scrapname ASC" ; 
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['scrapname'] . '" data-rate="' . $row['scraprate'] . '">' . $row['scrapname'] . '</option>';
            }
        }
        ?>
    </select>
    
      <span id="scrap-name-error-message" class="error-message"></span>
      <br>
Rate (Rs/kg or per pcs): <input type="number" id="scraprate" name="scraprate" readonly>

Quantity (kg): <input type="number" id="quantity" name="scrapquantity" placeholder="Quantity in kg" onchange="calculateTotalAmount()">
<span id="quantity-error-message" class="error-message"></span>
<br>
Describe Your Product:<br>
<textarea name="message" id="product-description" name="des" rows="3" placeholder="Describe the scrap you have" style="height: 90px; font-size:18px;" ></textarea>
<span class="error-message" id="product-description-error-message"></span>
<br>
Upload your Scrap Images: <br><br>
<div class="image-upload">
    <div id="image-preview-1" class="image-preview"></div>
    <input type="file" id="image-upload-input-1" name="images[]" accept=".jpg, .jpeg, .png" onchange="previewImage('image-upload-input-1', 'image-preview-1')">
</div><br>
<span id="image-upload-error-message" class="error-message"></span><br>

<input type="submit" value="Submit">
</form>
</div>

<!-- validation  -->
<script>
  // Function to preview selected image
function previewImage(inputId, previewId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Image Preview" class="image-preview">`;
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<!-- validation -->
<script>
    // Sell product form validation
    function validateForm() {
        const address = document.getElementById('address').value.trim();
        const quantity = document.getElementById('quantity').value.trim();
        const scrapname = document.getElementById('scrapname').value.trim();
        const productDescription = document.getElementById('product-description').value.trim();
        const imageUploadInput = document.getElementById('image-upload-input-1');

        let isValid = true;

        const addressErrorMessage = document.getElementById('address-error-message');
        const scrapnameErrorMessage = document.getElementById('scrap-name-error-message');
        const quantityErrorMessage = document.getElementById('quantity-error-message');
        const productDescriptionErrorMessage = document.getElementById('product-description-error-message');
        const imageUploadErrorMessage = document.getElementById('image-upload-error-message');

        addressErrorMessage.textContent = '';
        scrapnameErrorMessage.textContent = '';
        quantityErrorMessage.textContent = '';
        productDescriptionErrorMessage.textContent = '';
        imageUploadErrorMessage.textContent = '';

        if (address === '') {
            addressErrorMessage.textContent = 'Pick up location is required';
            isValid = false;
        }

        if (scrapname === '') {
            scrapnameErrorMessage.textContent = 'Please select a scrap item';
            isValid = false;
        }

        if (isNaN(quantity) || Number(quantity) <100) {
            quantityErrorMessage.textContent = 'Please enter a valid quantity equal or more than 100kg';
            isValid = false;
        }

        if (productDescription === '') {
            productDescriptionErrorMessage.textContent = 'Product description is required';
            isValid = false;
        }

        if (imageUploadInput.files.length === 0) {
            imageUploadErrorMessage.textContent = 'Please select an image';
            isValid = false;
        }

        return isValid;
    }
</script>
    <!-- update scrap rate -->
    <script>
      function updatescrapRate() {
    const selectedScrapItem = document.getElementById('scrapname').value;
    const selectedScrapRate = document.querySelector(`option[value="${selectedScrapItem}"]`).getAttribute('data-rate');
    document.getElementById('scraprate').value = selectedScrapRate;
}

    </script>
    <?php 
   include('include/footer.php'); ?>
</body>

</html>
