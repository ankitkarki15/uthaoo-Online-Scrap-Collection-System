<?php
include('include/userprofile.php');
$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('connection failed');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$request_type = $_POST['request_type']; 
$address = $_POST['address'];
$scrapname = $_POST['scrapname']; 
$scraprate = $_POST['scraprate']; 
$scrapquantity = $_POST['scrapquantity']; 
$created_at = date('Y-m-d H:i:s');
$scheduled_date = $_POST['scheduled_date']; // Assuming 'scheduled_date' is the name attribute of your input field
$district = $_POST['district']; // Assuming 'district' is the name attribute of your input field

    $images = array();
    if (!empty($_FILES['images'])) {
        $files = $_FILES['images'];

        foreach ($files['tmp_name'] as $key => $tmp_name) {
            $filename = $files['name'][$key];
            $filetmp = $tmp_name;
            $destination = "C:/xampp/htdocs/uthaoo/uploads/scrappickuprequest/" . $filename;

            if (move_uploaded_file($filetmp, $destination)) {
                $images[] = $filename;
            }
        }
    }
    $image = implode(", ", $images);

   $stmt = $conn->prepare("INSERT INTO scrap (name, email, phone_no, request_type, address, scrapname, `des`, scraprate, scrapquantity, image, created_at, scheduled_date, district) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
   $stmt->bind_param("ssssssdssssss", $name, $email, $phone_no, $request_type, $address, $scrapname, $productDescription, $scraprate, $scrapquantity, $image, $created_at, $scheduled_date, $district);


    if (mysqli_stmt_execute($stmt)) {
        $successMessage = "Form submitted successfully!";
        echo '<script>alert("The request for pickup has been submitted successfully!");</script>';
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
  font-size: 14px;
}

body {
  background-color: #f5f5f5;    
  font-family: "Poppins", sans-serif;
}

.container {
  /* background-color: #fff; */
  border-radius: 10px;
  padding: 20px;
  width: 80%;
  margin: 0 auto;
  margin-top: 50px;
  /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
}

h3 {
  color: #318216;
  margin-bottom: 20px;
  font-size: 24px;
  font-weight: 700;
  text-align: center;
}

label {
  font-weight: 500;
}

input[type="text"],
input[type="number"],
select,
textarea {
  width: 100%;
  height: 40px;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #000000;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

textarea {
  height: 80px;
  resize: vertical;
}

.image-upload {
  position: relative;
  width: 150px;
  height: 150px;
  background-color: #f1f1f1;
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

input[type="submit"] {
  display: block;
  width:100%;
  margin: 20px auto 0;
  font-size: 20px;
  font-weight: 600px;
  padding: 12px 24px;
  background-color: #318216;
  color: white;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  transition: background-color 0.5s ease;
}

input[type="submit"]:hover {
    background-color: #393a39;
}
</style>
</head>
<body>
    <?php include('include/navbar.php'); ?>
<div class="container"> 
  <h3 style="color:#318216;margin-bottom: 20px; font-size: 30px; font-weight: 500; text-align: center;">
            Be a hero,be a Recycler</h3> 
            <form method="post" action="products.php" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div style="text-align: center; font-weight: bold; font-size:20px;">
            <input type="radio" id="sell" name="request_type" value="sell">
            <label for="sell">Sell</label>
            <input type="radio" id="donate" name="request_type" value="donate">
            <label for="donate">Donate</label>
            <input type="radio" id="sell_and_donate" name="request_type" value="sell_and_donate">
            <label for="sell_and_donate">Sale and Donate</label>
            <br>
            <span id="request-type-error-message" class="error-message">
                <?php if(isset($errors['request_type'])) echo $errors['request_type']; ?>
            </span>
        </div>
        <br>
    Scheduled Date:
    <input type="date" id="scheduled_date" name="scheduled_date"><br>
    <span id="scheduled-date-error-message" class="error-message">
        <?php if(isset($errors['scheduled_date'])) echo $errors['scheduled_date']; ?>
    </span>
    <br>
    District:
    <select id="district" name="district">
        <option value="">-- Select your District --</option>
        <option value="Kathmandu">Kathmandu</option>
        <option value="Bhaktapur">Bhaktapur</option>
        <option value="Lalitpur">Lalitpur</option>
    </select>
    <span id="district-error-message" class="error-message">
        <?php if(isset($errors['district'])) echo $errors['district']; ?>
    </span><br>

   Pick up Location:
    <input type="text" id="address" name="address" placeholder="eg: Lokanthali, Bhaktapur near NIST School">
    <span id="address-error-message" class="error-message"></span>
    <br>

    Scrap Items<p style="color:#318216;font-size: 14px;">
    Incase of mixed scrap,choose Mixed Scrap.
    Rate will be vary as per product</p>
    <select id="scrapname" name="scrapname" onchange="updatescrapRate()">
        <option value="">-- Select Scrap Items --</option>
        <?php
        $query = "SELECT scrapname, scraprate FROM pricing ORDER BY scrapname ASC"; 
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

    Upload your Scrap Images: <br><br>
    <div class="image-upload">
        <div id="image-preview-1" class="image-preview"></div>
        <input type="file" id="image-upload-input-1" name="images[]" accept=".jpg, .jpeg, .png" onchange="previewImage('image-upload-input-1', 'image-preview-1')">
    </div><br>
    <span id="image-upload-error-message" class="error-message"></span><br>

    <input type="submit" value="Confirm"><br>

<hr>
    <div style="text-align: center; font-weight: bold; font-size: 18px; margin-top: 20px;">
    Or,Contatct us at <br>
    <a href="tel:+9779812345678">+9779812345678</a>
</div>
<br>
<hr>

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
<!-- Validation Script -->
<script>
    // Sell product form validation
    function validateForm() {
        const address = document.getElementById('address').value.trim();
        const quantity = document.getElementById('quantity').value.trim();
        const scrapname = document.getElementById('scrapname').value.trim();
        const productDescription = document.getElementById('product-description').value.trim();
        const imageUploadInput = document.getElementById('image-upload-input-1');
        const requestType = document.querySelector('input[name="request_type"]:checked');
        const scheduledDate = document.getElementById('scheduled_date').value.trim();
        const district = document.getElementById('district').value.trim();
        
        // Reset error messages
        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(message => message.textContent = '');

        let isValid = true;

        if (!requestType) {
            setError('request_type', 'Please select a request type');
            isValid = false;
        }

        if (address === '') {
            setError('address', 'Pick up location is required');
            isValid = false;
        }

        if (district === '') {
            setError('district', 'Please select a district');
            isValid = false;
        }

        if (scrapname === '') {
            setError('scrap-name', 'Please select a scrap item');
            isValid = false;
        }

        if (isNaN(quantity) || Number(quantity) < 100) {
            setError('quantity', 'Please enter a valid quantity equal to or more than 100kg');
            isValid = false;
        }

        if (productDescription === '') {
            setError('product-description', 'Product description is required');
            isValid = false;
        }

        if (scheduledDate === '') {
            setError('scheduled-date', 'Scheduled date is required');
            isValid = false;
        }

        if (imageUploadInput.files.length === 0) {
            setError('image-upload', 'Please select an image');
            isValid = false;
        }

        return isValid;
    }

    // Function to set error messages
    function setError(elementId, errorMessage) {
        const errorElement = document.getElementById(elementId + '-error-message');
        if (errorElement) {
            errorElement.textContent = errorMessage;
        }
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
