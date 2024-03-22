<?php
include('../include/userprofile.php');
include('../include/sellproductnew.php');

$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Connection failed');
if (!$conn) {
die("Database connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="assets/css/admindash.css">
    <link rel="stylesheet" href="assets/css/showreq.css">
    <link rel="stylesheet" href="assets/css/addscrap.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

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

    
   /* Style for the container */
.add-container2 {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    /* background-color: #f4f4f4; */
    border-radius: 10px;
    /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
}

/* Style for the form headings */
.add-container2 h2 {
    margin-left: 20px;
    color: black;
}

/* Style for the form labels */
.add-container2 label {
    display: block;
    margin-top: 10px;
    font-size: 16px;
    font-weight: bold;
    color: #333;
}

/* Style for the form input fields */
.add-container2 input[type="text"],
.add-container2 input[type="number"],
.add-container2 input[type="select"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Style for the form submit button */
.add-container2 input[type="submit"] {
    width: 100%;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.add-container2 input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Style for the form cancel button */
.add-container2 .cancel-btn {
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #ccc;
    color: #333;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.add-container2 .cancel-btn:hover {
    background-color: #999;
}

    </style>
</head>
<body>
    <div class="dashboard">
        <div class="header">
            <div class="logo">
                <a href="adminpanel.php"><img src="assets/images/uthaoo3333.png" alt="Logo" style="width:140px;height:auto;"></a>
            </div>
            <div class="welcome">
                <h2 style="font-size:18px; color:white;">welcome, <?php echo $row["name"]; ?></h2>
            </div>
            <div class="go-back">
                <a href="../front.php">Go Back</a>
            </div>
        </div>

        <div class="main-content">
            <div class="sidebar">
            <ul>
                <li><a href="#" class="active" onclick="openSection('home')"><i class="ion-ios-home"></i> Home</a></li><hr>
                <li><a href="#" onclick="openSection('add-scraps')"><i class="ion-ios-plus"></i> Add Scraps</a></li><hr>
                <li><a href="#" onclick="openSection('scrap-request')"><i class="ion-ios-list"></i> View Requests</a></li><hr>
                <li><a href="#" onclick="openSection('feedback')"><i class="ion-ios-chatboxes"></i> View Feedbacks</a></li><hr>
                <li><a href="viewusers.php" onclick="openSection('viewusers')"><i class="ion-ios-list"></i> View Users</a></li><hr>
                <li><a href="../front.php" onclick="openSection('logout')" style="color:red;"><ion-icon name="log-out-outline"></ion-icon></i> Logout</a></li>
            </ul>
            </div>  
            <!--section container  -->
            <div class="section-container" id="sections">
             <!-- home starts here -->
                <div class="section" id="homeContent">
                <br>
                <h2 style="margin-left:20px; color:black;">Home</h2>
                    <?php
                        // Establish database connection
                        $conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Database connection failed');

                        // Fetch and calculate the counts
                        $queryTotalRequests = "SELECT COUNT(*) AS total_requests, 
                                                    SUM(status = 'Accepted') AS total_accepted,
                                                    SUM(status = 'Pending') AS total_pending,
                                                    SUM(scrapquantity) AS total_scrapquantity
                                            FROM scrap";

                        $resultTotal = mysqli_query($conn, $queryTotalRequests);
                        $rowTotal = mysqli_fetch_assoc($resultTotal);

                        $totalRequests = $rowTotal['total_requests'];
                        $totalAccepted = $rowTotal['total_accepted'];
                        $totalPending = $rowTotal['total_pending'];
                        $totalScrapquantity = $rowTotal['total_scrapquantity'];
                        ?>

                        <div class="data-info">
                            <div class="card" style="background-color: #f0a8a8;">
                                <div class="card-body">
                                    <h2><ion-icon name="bookmarks-outline"></ion-icon> Total Requests</h2>
                                    <h1><?php echo $totalRequests; ?></h1>
                                </div>
                            </div>

                            <div class="card" style="background-color: #a8d7f0;">
                                <div class="card-body">
                                    <h2><ion-icon name="checkmark-circle-outline"></ion-icon> Total Accepted</h2>
                                    <h1><?php echo $totalAccepted; ?></h1>
                                </div>
                            </div>

                            <div class="card" style="background-color: #f0f0a8;">
                                <div class="card-body">
                                    <h2><ion-icon name="hourglass-outline"></ion-icon> Total Pending</h2>
                                    <h1><?php echo $totalPending; ?></h1>
                                </div>
                            </div>

                            <div class="card" style="background-color: #a8e7f0;">
                                <div class="card-body">
                                    <h2><ion-icon name="hourglass-outline"></ion-icon> Total quantity</h2>
                                    <h1><?php echo $totalScrapquantity; ?>kg</h1>
                                </div>
                            </div>
                        </div>

                </div>

            
                <!-- ========================================================================================= -->
                <!-- add scraps -->
                      <!-- Add scraps,pricing -->
                      <div class="section" id="addScrapsContent">
                 <div class="add-container"><br>
                            <h2 style="margin-left:20px; color:Black;">Scrap Lists</h2>
                            <button type="button" class="add-btn" onclick="showAddForm()" style="margin-left:20px; padding:10px;">Add Scraps</button>
                            <hr>
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Rate(Rs)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Establish database connection
                                    $conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Database connection failed');

                                    $query = "SELECT * FROM pricing";
                                    $result = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['scrapname'] . "</td>";
                                            echo "<td>" . $row['scrapcategory'] . "</td>";
                                            echo "<td>" . $row['scraprate'] . "</td>";
                                            echo "<td>
                                                <button type='button' name='updateScrap' class='update-btn' onclick='showUpdateForm(" . $row['id'] . ", \"" . $row['scrapname'] . "\", \"" . $row['scraprate'] . "\", \"" . $row['scrapcategory'] . "\")'>Update</button>
                                                <button type='button' name='deleteScrap' class='remove-btn' onclick='deleteRequest(" . $row['id'] . ")'>Delete</button>
                                                </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No scrap requests found.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            
                            <br>
                 </div>
             </div>

                    <!-- Add scrap Form -->
                    <div class="section" id="addFormContent" style="display: none;">
                        <br>
                        <div class="add-container2">
                        <h2 style="margin-left:20px; color:black;">Add New Scraps</h2>
                            <form id="addScrapForm" action="#" method="POST" onsubmit="return validateForm()">
                                <label for="scrapName">Scrap Name:</label>
                                <input type="text" id="scrapName" name="scrapname"  placeholder="Scrap Name">
                                <label for="scrapCategory">Scrap Category:</label>
                                <select id="scrapCategory" name="scrapcategory" placeholder="Select Scrap Category"style="height:40px; font-size:16px;">
                                    <option value="">Select Scrap Category </option>
                                    <option value="Plastic" style="height:30px;">Plastic</option>
                                    <option value="Paper" style="height:30px;">Paper</option>
                                    <option value="Mixed" style="height:30px;">Mixed</option>
                                </select><br>

                                <label for="scrapRate">Scrap Rate:</label>
                                <input type="number" id="scrapRate" name="scraprate"  placeholder="Scrap Rate">

                                <input type="submit" name="pricing" value="Add">
                                <button type="button" class="cancel-btn" onclick="showScrapList()" 
                                style="height:40px; font-size:16px;">Cancel</button>
                            </form>
                        </div>
                    </div>
                    <script>
                            function validateForm() {
                                var scrapName = document.getElementById("scrapName").value;
                                var scrapRate = document.getElementById("scrapRate").value;
                                var scrapCategory = document.getElementById("scrapCategory").value;
                                var errorMsg = "";

                                if (scrapName === "" || scrapRate === "" || scrapCategory === "") {
                                    errorMsg = "All fields are required!";
                                } else if (isNaN(scrapRate) || parseFloat(scrapRate) <= 0) {
                                    errorMsg = "Invalid scrap rate! Please enter a valid number greater than zero.";
                                }

                                if (errorMsg !== "") {
                                    alert(errorMsg);
                                    return false; 
                                }

                                return true; 
                            }
                        </script>




                    <!-- Update scraps -->
                    <div class="section" id="updateFormContent" style="display: none;">
                        <br>
                        <div id="updateScrapForm" class="add-container2">
                            <h2>Update Scrap Items</h2>
                            <form id="updateScrapForm" action="#" method="POST">
                                <label for="updateScrapId">Scrap ID:</label>
                                <input type="text" id="updateScrapId" name="scrapid" readonly>
                                <label for="updateScrapName">Scrap Name:</label>
                                <input type="text" id="updateScrapName" name="scrapname" required>

                                <label for="updateScrapRate">Scrap Rate:</label>
                                <input type="text" id="updateScrapRate" name="scraprate" required>

                                <label for="updateScrapCategory">Scrap Category:</label>
                                <select id="updateScrapCategory" name="scrapcategory" style="height:40px; font-size:16px;">
                                    <!-- <option value="">-- Select Scrap Items --</option> -->
                                    <option value="Plastic">Plastic</option>
                                    <option value="Paper">Paper</option>
                                    <option value="Mixed">Mixed</option>
                                </select><br>

                                <input type="submit" name="updateScrap" value="Update Scrap"><br>
                                <button type="button" class="cancel-btn" onclick="showScrapList()" 
                                style="height:40px; font-size:16px;">Cancel</button>
                            </form>
                        </div>
                    </div>
                    <!-- Delete form -->
                    <!-- <form id="deleteForm" action="#" method="POST" style="display: none;">
                        <input type="hidden" id="deleteScrapId" name="scrapid">
                    </form> -->

                    <?php
$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Database connection failed');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add Scrap Form Submission
    if (isset($_POST['pricing'])) {
        $scrapName = mysqli_real_escape_string($conn, $_POST['scrapname']);
        $scrapRate = mysqli_real_escape_string($conn, $_POST['scraprate']);
        $scrapCategory = mysqli_real_escape_string($conn, $_POST['scrapcategory']);

        $error = false; // Flag to track errors
        $errorMsg = ''; // Error message

        // Server-side validation
        if (empty($scrapName) || empty($scrapRate) || empty($scrapCategory)) {
            $error = true;
            $errorMsg = 'All fields are required!';
        } elseif (!is_numeric($scrapRate) || $scrapRate <= 0) {
            $error = true;
            $errorMsg = 'Invalid scrap rate! Please enter a valid number greater than zero.';
        }

        if (!$error) {
            // Insert data into the pricing table
            $query = "INSERT INTO pricing (scrapname, scraprate, scrapcategory) VALUES ('$scrapName', '$scrapRate', '$scrapCategory')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo '<script>alert("Scrap added successfully!");</script>';
            } else {
                echo '<script>alert("Error adding scrap: ' . mysqli_error($conn) . '");</script>';
            }
        }
    }


    // Update Scrap Form Submission
if (isset($_POST['updateScrap'])) {
    $scrapId = mysqli_real_escape_string($conn, $_POST['scrapid']);
    $scrapName = mysqli_real_escape_string($conn, $_POST['scrapname']);
    $scrapRate = mysqli_real_escape_string($conn, $_POST['scraprate']);
    $scrapCategory = mysqli_real_escape_string($conn, $_POST['scrapcategory']);

    $error = false; // Flag to track errors
    $errorMsg = ''; // Error message

    // Server-side validation
    if (empty($scrapName) || empty($scrapRate) || empty($scrapCategory)) {
        $error = true;
        $errorMsg = 'All fields are required!';
    } elseif (!is_numeric($scrapRate) || $scrapRate <= 0) {
        $error = true;
        $errorMsg = 'Invalid scrap rate! Please enter a valid number greater than zero.';
    }

    if (!$error) {
        // Update scrap
        $query = "UPDATE pricing SET scrapname = '$scrapName', scraprate = '$scrapRate', scrapcategory = '$scrapCategory' WHERE id = '$scrapId'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo '<script>alert("Scrap updated successfully!");</script>';
        } else {
            echo '<script>alert("Error updating scrap: ' . mysqli_error($conn) . '");</script>';
        }
    } else {
        echo '<script>alert("' . $errorMsg . '");</script>';
    }
}


     // Check if the delete scrap form is submitted
     if (isset($_POST['deleteScrapId'])) {
        $scrapId = mysqli_real_escape_string($conn, $_POST['deleteScrapId']);

        $query = "DELETE FROM pricing WHERE id = '$scrapId'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo '<script>alert("Scrap deleted successfully!");</script>';
        } else {
            echo '<script>alert("Error deleting scrap: ' . mysqli_error($conn) . '");</script>';
        }
    }
    }

?>


                       
                    

                    <script>
                    function showAddForm() {
                        document.getElementById("addScrapsContent").style.display = "none";
                        document.getElementById("addFormContent").style.display = "block";
                    }

                    function showUpdateForm(scrapId, scrapName, scrapRate, scrapCategory) {
                        document.getElementById("updateScrapId").value = scrapId;
                        document.getElementById("updateScrapName").value = scrapName;
                        document.getElementById("updateScrapRate").value = scrapRate;
                        document.getElementById("updateScrapCategory").value = scrapCategory;
                        document.getElementById("addScrapsContent").style.display = "none";
                        document.getElementById("updateFormContent").style.display = "block";
                    }

                    function showScrapList() {
                        document.getElementById("updateFormContent").style.display = "none";
                        document.getElementById("addScrapsContent").style.display = "block";
                    }
                    function deleteRequest(scrapId) {
                            if (confirm("Are you sure you want to delete this scrap?")) {
                                // Create a form element dynamically
                                var form = document.createElement("form");
                                form.action = "#";
                                form.method = "post";

                                // Create an input element for the scrapId
                                var input = document.createElement("input");
                                input.type = "hidden";
                                input.name = "deleteScrapId";
                                input.value = scrapId;

                                // Append the input element to the form
                                form.appendChild(input);

                                // Append the form to the document and submit it
                                document.body.appendChild(form);
                                form.submit();
                            }
                        }

                    </script>

<!-- ===================================================================================================== -->
            <!-- Scrap Request-->
            <div class="section" id="scrapRequestContent" style="display: none;">
                <br>
                <div class="request-container">
                <h2 style="margin-left:20px; color:Black;">Scrap Requests</h2>
                    
               
                </div>
                </div>
            
                <!-- Add a form for delete operation -->
                <form id="deleteFeedbackForm" action="#" method="POST" style="display: none;">
                    <input type="hidden" id="feedbackId" name="feedbackId">
                </form>
                </div>
                </div>
                </div>
                </div>

                
<!-- feedback section ends here -->
                    
                    <script>
                    function openSection(sectionName) {
                        var homeContent = document.getElementById("homeContent");
                        var addScrapsContent = document.getElementById("addScrapsContent");
                        var scrapRequestContent = document.getElementById("scrapRequestContent");
                        var feedbackContent = document.getElementById("feedbackContent");

                        if (sectionName === "home") {
                            homeContent.style.display = "block";
                            addScrapsContent.style.display = "none";
                            scrapRequestContent.style.display = "none";
                            feedbackContent.style.display = "none";
                        } else if (sectionName === "add-scraps") {
                            homeContent.style.display = "none";
                            addScrapsContent.style.display = "block";
                            scrapRequestContent.style.display = "none";
                            feedbackContent.style.display = "none";
                        } else if (sectionName === "scrap-request") {
                            homeContent.style.display = "none";
                            addScrapsContent.style.display = "none";
                            scrapRequestContent.style.display = "block";
                            feedbackContent.style.display = "none";
                        } else if (sectionName === "feedback") {
                            homeContent.style.display = "none";
                            addScrapsContent.style.display = "none";
                            scrapRequestContent.style.display = "none";
                            feedbackContent.style.display = "block";
                        }
                    }
                </script>
              
                </body>
                </html>