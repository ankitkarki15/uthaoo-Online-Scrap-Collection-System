<?php
include('../include/userprofile.php');
include('../include/sellproduct.php');
include('../include/feedback.php');
// include('../include/notify.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User dashboard</title>
    <link rel="stylesheet" href=".../asset/css/style.css">
    <link rel="stylesheet" href=".../asset/css/feedback.css">
    <link rel="stylesheet" href=".../asset/css/cp.css">
   <style>
     input{
        font-size:16px;
    }
    
     table {
        width: 96%;
        margin-left: 20px;
        border-collapse: collapse;
    }
    
    th, td {
        border: 1px solid black;    
        padding:10px;
        text-align: left;
    }

    
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    /* Style for the entire form container */
.sell-container {
  max-width: 660px;
  margin: 0 auto;
  padding: 20px;
  /* background-color: #f4f4f3; */
  border-radius: 10px;
  /* box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); */
}

/* Style for form labels */
.sell-container label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

/* Style for input fields */
.sell-container input[type="text"],
.sell-container input[type="number"],
.sell-container textarea {
  width:100%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
}

.sell-container input[type="submit"] {
  background-color: #318216;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  font-size: 18px;
  cursor: pointer;
}

.sell-container input[type="submit"] :hover{
  background-color: #f2f2f2;
  color: #fff;
  
}

/* Style for select dropdown */
.sell-container select {
  width:100%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
  /* background-color: #fff; */
}

/* Style for form rows */
.form-row {
  display: flex;
  gap: 22px;
}

.form-row div {
  flex:4;
}

/* Style for error messages */
.error-message {
    color: red;
    font-size: 14px;
    margin-top: 5px;
}


/* Style for image upload */
.image-upload {
  margin-top: 10px;
}

.image-preview {
  max-width: 100%;
  height: auto;
  margin-bottom: 10px;
}

/* Optional: Add more styling to the section */
.section {
  padding: 20px;
}


   </style>
</head>
<body>
    <div class="dashboard">
        <div class="header">
            <div class="logo">
                <a href="userpanel.php"><img src="asset/images/logo/uthaoo3333.png" alt="Logo" style="width:140px;height:auto;"></a>
            </div>
            <div class="welcome">
                <h2 style="font-size:16px;">welcome, <?php echo $row["name"]; ?></h2>
            </div>
            <div class="go-back">
                <a href="../home.php">Go Back</a>
            </div>
        </div>
        <div class="main-content">
            <div class="sidebar">
            <ul>
            <li><a href="#" class="active" onclick="openSection('home');"> Home</a></li>
            <li><a href="#" onclick="openSection('sell-scrap')"> Sell Scrap</a></li>
            <li><a href="#" onclick="openSection('feedback')"> Give Feedbacks</a></li>
            <!-- <li><a href="#" onclick="openSection('message')">Messages</a></li> -->
            <li><a href="#" onclick="openSection('notification')">Notifications</a></li>

            <!-- <li><a href="#" onclick="openSection('changepassword')"> Change Password</a></li> -->
            <li><a href="../front.php" onclick="openSection('logout')" style="color:red;">Logout</a></li>
            </ul>

            </div>
            <div class="section-container" id="sections">
                <div class="section" id="home">
                    <div class="data-info">
                        <div class="total-sold">
                            <h2>Total sold (kg)</h2>
                            <h1>0</h1>
                        </div>
                        <div class="total-requests">
                            <h2>Total Requests</h2>
                            <h1>0</h1>
                        </div>
                        <div class="pending-requests">
                            <h2>Total Pending</h2>
                            <h1>0</h1>
                        </div>
                    </div>
                </div>



                <!-- Sell products -->
                <div class="section" id="sell-scrap" style="display: none;">
                    <div class="sell-container" id="sellScrapForm">
                             <form method="post" action="../include/sellproduct.php" enctype="multipart/form-data" onsubmit="return validateForm()">

                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" placeholder="Your name.." value="<?php echo isset($name) ? $name : ''; ?>" readonly><br>
                            <span id="name-error-message" class="error-message"></span>

                            <!-- <div class="form-row">
                                <div> -->
                                    Phone Number:
                                    <input type="text" id="phone_no" name="phone_no" placeholder="Your phone number.." pattern="[0-9]{10}" value="<?php echo isset($phone_no) ? $phone_no : ''; ?>" readonly>
                                    <span id="phone_no-error-message" class="error-message"></span>
                                <!-- </div>
                                <div> -->
                                    Email: <input type="text" id="email" name="email" placeholder="Your email .." value="<?php echo isset($email) ? $email : ''; ?>" readonly>
                                    <span id="email-error-message" class="error-message"></span>
                                <!-- </div>
                            </div> -->

                            Pick up Location:
                            <input type="text" id="address" name="address" placeholder="eg: Lokanthali, Bhaktapur near NIST School">
                            <span id="address-error-message" class="error-message"></span><br>

                            Scrap Items:
                            <select id="scrapname" name="scrapname" onchange="updatescrapRate()">
                                <option value="">-- Select Scrap Items --</option>
                                            <option value="Plastic" data-rate="15">Plastic</option>
                                            <option value="water Bottles" data-rate="10">Water Bottles(pcs)</option>
                                            <option value="Plastic Jar" data-rate="20">Plastic Jar</option>
                                            <option value="Polythene Bags" data-rate="10">Polythene Bags</option>
                                            <option value="long Polythene Bags" data-rate="14">Long Polythene Bags</option>
                                            <option value="Plastic Kitchen items" data-rate="15">Plastic Kitchen items</option>
                                            <option value="Hard Plastic" data-rate="16">Hard Plastic</option>
                                            <option value="Newspapers" data-rate="15">Newspapers</option>
                                            <option value="Copies/Books" data-rate="17">Copies/Books</option>
                                            <option value="Cartoons" data-rate="14">Cartons</option>
                                            <option value="Mixed" data-rate="25">Mixed</option>
                                        </select><br>
                            <span id="scrap-name-error-message" class="error-message"></span>

                                        Rate (Rs/kg or per pcs): <input type="number" id="scraprate" name="scraprate" readonly><br>

                            Quantity (kg): <input type="number" id="quantity" name="scrapquantity" placeholder="Quantity in kg" onchange="calculateTotalAmount()">
                            <span id="quantity-error-message" class="error-message"></span>
                            Describe Your Product:<br>
                            <textarea name="message" id="product-description" name="des" rows="3" placeholder="Describe the scrap you have" style="height: 90px; font-size:18px;" ></textarea>
                            <span class="error-message" id="product-description-error-message"></span>

                            Upload your Scrap Images:
                            <div class="image-upload">
                                <div id="image-preview-1" class="image-preview"></div>
                                <input type="file" id="image-upload-input-1" name="images[]" accept=".jpg, .jpeg, .png" onchange="previewImage('image-upload-input-1', 'image-preview-1')">
                            </div>
                            <span id="image-upload-error-message" class="error-message"></span><br>

                            <input type="submit" value="Submit">
                            </form>
                            </div>
                           <script src="asset/js/sp.js"></script>
               
               
                            <!-- Feedback Form Section -->
                            <div class="section" id="feedback">
                                <div class="fb-container">
                                    <h1 style="color:#318216;margin-bottom: 20px; font-size: 30px; font-weight: 700; text-align: center;">Give Feedback</h1>
                                    <form action="feedback.php" method="POST" onsubmit="return validateForm();">
                                        <!-- Name: -->
                                        <input type="text" name="name" placeholder="Your name.." value="<?php echo isset($name) ? $name : ''; ?>" readonly>
                                        <!-- Email: -->
                                        <input type="text" name="email" placeholder="Your email.." value="<?php echo isset($email) ? $email : ''; ?>" readonly>
                                        
                                        <!-- Message: -->
                                        <textarea name="message" placeholder="Give your feedback.." style="height: 90px;" class="<?php echo !empty($errorMessage) ? 'error-indicator' : ''; ?>"></textarea>
                                        <p class="error" id="error-message"><?php echo $errorMessage; ?></p>
                                        <input type="submit" name="submit" value="Submit">
                                    </form>
                                    <?php if (!empty($successMessage)) : ?>
                                        <script>
                                            alert("<?php echo $successMessage; ?>");
                                        </script>
                                    <?php endif; ?>
                                </div>
                            </div>  
                            <script src="asset/js/fb.js"></script>      


                <!-- notification section -->
             <div class="section" id="notification" style="display: none;">
                    <div class="notification-container" id="notificationContainer">
                        <h1>Notifications</h1>
                        <table>
                            <tr>
                                <th>Date</th>
                                <th>Scrap items</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </table>
                    </div>
                </div>
               
                
            </div>
            </div>
    </div>
    

    <script>
         function openSection(sectionName) {
            var sections = document.getElementsByClassName("section");
            for (var i = 0; i < sections.length; i++) {
                if (sections[i].id === sectionName) {
                    sections[i].style.display = "block";
                } else {
                    sections[i].style.display = "none";
                }
            }
        }
    </script>
    
</body>
</html>