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

input{
        font-size:16px;
    }
    input {
    font-size: 16px;
}

/* Global styles */
body {
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
}

.dashboard {
    display: flex;
    flex-direction: column;
    height: 100vh;
}

/* Sidebar styles */
.sidebar {
    width: 180px;
    /* height: 100px; */
    background-color: #0A2558;
    color: #fff;
    margin-top: -80px;
}

.sidebar h2 {
    margin-top: 0;
    margin-bottom: 20px;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.sidebar li {
    margin-bottom: 10px;
}

.sidebar a {
    color: #fff;
    text-decoration: none;
    display: block;
    padding: 8px;
}

.sidebar a:hover {
    background-color: #ccc;
}

/* Main content styles */
.main-content {
    flex: 1;
    display: flex;
}

/* Header styles */
.header {
    background-color:grey;
    border-radius:4px;
    margin-top:2px;
    margin-right:5px;
    margin-left:100px;
    color: #fff;
    display: flex;
    align-items: center;
}

.header .welcome {
    margin-left: auto;
    text-align: right;
}

.header .go-back {
    margin-left: 10px;
}

.header .go-back a {
    color: #fff;
    text-decoration: none;
    padding: 5px 10px;
    border: 1px solid #fff;
    border-radius: 4px;
}

.header .go-back a:hover {
    background-color: #fff;
    color: #555;
}

/* Logo styles */
.sidebar .logo {
    width: 140px;
    height: auto;
}

    </style>
    
    
</head>
<body>
    <div class="dashboard">
        <div class="header">
            <div class="welcome">
                <h2 style="font-size:18px;">Welcome, <?php echo $row["name"]; ?></h2>
            </div>
            <div class="go-back">
                <a href="../front.php">Go Back</a>
            </div>
        </div>

        <div class="main-content">
            <div class="sidebar">
            <div class="logo">
                <a href="adminpanel111.php"><img src="assets/images/uthaoo3333.png" alt="Logo" style="width:140px;height:auto;"></a>
            </div><ul>
                <li><a href="#" class="active" onclick="openSection('home')"><i class="ion-ios-home"></i> Home</a></li><hr>
                <li><a href="#" onclick="openSection('add-scraps')"><i class="ion-ios-plus"></i> Add Scraps</a></li><hr>
                <li><a href="#" onclick="openSection('scrap-request')"><i class="ion-ios-list"></i> View Requests</a></li><hr>
                <li><a href="#" onclick="openSection('feedback')"><i class="ion-ios-chatboxes"></i> View Feedbacks</a></li><hr>
                <li><a href="../front.php" onclick="openSection('logout')" style="color:red;"><ion-icon name="log-out-outline"></ion-icon></i> Logout</a></li>
            </ul>
            </div>  
            <!--section container  -->
         <  
                    
                   <!-- Add scrap Form -->
                    <div class="section" id="addFormContent" style="display: none;">
                        <br>
                        <div class="add-container2">
                            <h2>Add New Items</h2>
                            <form id="addScrapForm" action="#" method="POST">
                                <label for="scrapName">Scrap Name:</label>
                                <input type="text" id="scrapName" name="scrapname" required placeholder="Scrap Name">
                                <label for="scrapCategory">Scrap Category:</label>
                                <select id="scrapCategory" name="scrapcategory" style="height:35px; font-size:16px;">
                                    <!-- <option value="">-- Select Scrap Category --</option> -->
                                    <option value="Plastic">Plastic</option>
                                    <option value="Paper">Paper</option>
                                 </select><br>  

                                <label for="scrapRate">Scrap Rate:</label>
                                <input type="number" id="scrapRate" name="scraprate" required placeholder="Scrap Rate">

                                <input type="submit" name="pricing" value="Add"> <!-- Changed the name attribute to "pricing" -->
                            </form>
                        </div>
                    </div>
                    <!-- update new items -->
                                <div class="section" id="updateFormContent" style="display: none;">
                                    <br>
                                    <div class="add-container2">
                                        <h2>Update Scrap Items</h2>
                                        <form action="process_update_scrap.php" method="post">
                                            <label for="updateScrapId">Scrap ID:</label>
                                            <input type="text" id="updateScrapId" name="updateScrapId"><br>

                                            <label for="updateScrapName">Scrap Name:</label>
                                            <input type="text" id="updateScrapName" name="updateScrapName"><br>

                                            <label for="updateScrapRate">Scrap Rate:</label>
                                            <input type="text" id="updateScrapRate" name="updateScrapRate"><br>

                                            <label for="updateScrapCategory">Scrap Category:</label>
                                            <select id="updateScrapCategory" name="updateScrapCategory">
                                                <option value="">-- Select Scrap Items --</option>
                                                <option value="Plastic">Plastic</option>
                                                <option value="Paper">Paper</option>
                                            </select><br>

                                            <input type="submit" name="updateScrap" value="Update Scrap">
                                            <button type="button" class="cancel-btn" onclick="showScrapList()">Cancel</button>
                                        </form>
                                    </div>
                                </div>

                        <?php
                        // Establish database connection
                        $conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Database connection failed');

                        // Check if the form is submitted
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if (isset($_POST['pricing'])) { 
                                $scrapName = $_POST['scrapname'];
                                $scrapRate = $_POST['scraprate']; 
                                $scrapCategory = $_POST['scrapcategory'];

                                // Insert data into the addscrap table
                                $query = "INSERT INTO pricing (scrapname, scraprate,scrapcategory) VALUES ('$scrapName', '$scrapRate','$scrapCategory')";
                                $result = mysqli_query($conn, $query);

                                if ($result) {
                                    echo '<script>alert("Scrap added successfully!");</script>';
                                } else {
                                    echo '<script>alert("Error adding scrap: ' . mysqli_error($conn) . '");</script>';
                                }
                            }
                        }

                        // Check if the update scrap form is submitted
                        if (isset($_POST['updateScrap'])) {
                            $scrapId = $_POST['scrapId'];
                            $scrapName = $_POST['scrapName'];
                            $scrapRate = $_POST['scrapRate'];
                            $scrapCategory = $_POST['scrapCategory'];

                            // Update scrap 
                            $query = "UPDATE pricing SET scrapname = '$scrapName', scraprate = '$scrapRate', scrapcategory = '$scrapCategory' WHERE id = '$scrapId'";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                echo '<script>alert("Scrap updated successfully!");</script>';
                            } else {
                                echo '<script>alert("Error updating scrap: ' . mysqli_error($conn) . '");</script>';
                            }
                        }

                        // Check if the delete scrap form is submitted
                        if (isset($_POST['deleteScrap'])) {
                            $scrapId = $_POST['scrapId'];

                            // Delete scrap 
                            $query = "DELETE FROM pricing WHERE id = '$scrapId'";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                echo '<script>alert("Scrap deleted successfully!");</script>';
                            } else {
                                echo '<script>alert("Error deleting scrap: ' . mysqli_error($conn) . '");</script>';
                            }
                        }

                        ?>

                    <script>
                    function showAddForm() {
                        document.getElementById("addScrapsContent").style.display = "none";
                        document.getElementById("addFormContent").style.display = "block";
                    }
                    </script>



<!-- ===================================================================================================== -->


            <!-- Scrap Request-->
            <div class="section" id="scrapRequestContent" style="display: none;">
    <br>
    <div class="request-container">
        <h2 style="color: black; text-align: center;">Scrap Requests</h2>
        <br>
        <hr>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Location</th>
                <th>Items</th>
                <!-- <th>Description</th> -->
                <th>Rate</th>
                <th>Quantity</th>
                <th>Image</th>
                <!-- <th>Created At</th> -->
                <th>Action</th>
            </tr>
            <tbody>
                <?php
                $query = "SELECT * FROM scrap";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['phone_no'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['scrapname'] . "</td>";
                        // echo "<td>" . $row['des'] . "</td>"; 
                        echo "<td>" . $row['scraprate'] . "</td>";
                        echo "<td>" . $row['scrapquantity'] . "</td>";
                        echo "<td><img src='http://localhost/Uthaoo/uploads/" . $row['image'] . "' alt='Scrap Image' style='max-width: 100px;'></td>";
                        // echo "<td>" . $row['created_at'] . "</td>";
                        echo "<td>
                            <form method='post' action=''>
                                <input type='hidden' name='scrapId' value='" . $row['id'] . "'>";
                                if (isset($row['status']) && $row['status'] == 'Pending') {
                                    echo "<button type='submit' name='acceptScrap' class='pending-btn' 
                                    onclick='return confirm(\"Do you want to accept this request?\");'>Pending</button>";
                                    echo "<span style='margin-right: 10px;'></span>";  
                                } elseif (isset($row['status']) && $row['status'] == 'Accepted') {
                                    echo "<button type='button' class='accepted-btn'>Accepted</button>";
                                    echo "<span style='margin-right: 10px;'></span>";
                                }
                            
                                echo "<button type='submit' name='deleteScrap' class='remove-btn' onclick='return confirm(\"Do you want to delete this request?\");'>Delete</button>";
                        echo "</form>
                        </td>";
                        echo "</tr>";   
                    }
                } else {
                    echo "<tr><td colspan='11'>No scrap requests found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

                    <?php
                    // Check if the accept or delete scrap form is submitted
                    if (isset($_POST['acceptScrap'])) {
                        $scrapId = $_POST['scrapId'];

                        $query = "UPDATE scrap SET status = 'Accepted' WHERE id = '$scrapId'";
                        $result = mysqli_query($conn, $query);

                    }

                    if (isset($_POST['deleteScrap'])) {
                        $scrapId = $_POST['scrapId'];

                        // Delete scrap from the sell table
                        $query = "DELETE FROM scrap WHERE id = '$scrapId'";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            echo '<script>alert("reques deleted successfully!");</script>';
                        } else {
                            echo '<script>alert("Error deleting request: ' . mysqli_error($conn) . '");</script>';
                        }
                    }
                    ?>

            <!-- scrap requests ends on here -->
        

            <!-- feedback table starts here -->
                 <div class="section" id="feedbackContent" style="display: none;">
                    <div class="fb-container" id="feedbacktbl">
                            <br>
                            <h2 style="color: black; text-align: center;">Feedbacks</h2>
                            <br>
                            <hr>
                            <table>
                            <thead>
                                <tr>
                                <!-- <th>Date</th> -->
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM feedback";
                                $result = mysqli_query($conn, $query);

                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    // echo "<td>" . $row['created_at'] . "</td>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['message'] . "</td>";
                                    echo "<td>
                                    <button type='button' class='remove-btn' onclick='deleteFeedback(this)'>Delete</button>
                                    </td>";
                                    echo "</tr>";
                                }
                                } else {
                                echo "<tr><td colspan='5'>No feedbacks found.</td></tr>";
                                }
                                ?>
                            </tbody>
                            </table>
                        </div>
                        </div>

                        <!-- Delete PHP -->
                        <?php
                        $conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Connection failed');
                        // deleteFeedback="";
                        // Check if the delete feedback form is submitted
                        if (isset($_POST['deleteFeedback'])) {
                        $feedbackId = $_POST['feedbackId'];

                        $query = "DELETE FROM feedback WHERE id = '$feedbackId'";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            echo '<script>alert("Feedback deleted successfully!");</script>';
                        } else {
                            echo '<script>alert("Error deleting feedback: ' . mysqli_error($conn) . '");</script>';
                        }
                        }
                        ?>  
                </div>
    </div>
    
    <script>
        
        function acceptRequest(button) {
            alert("Request Accepted!");
            button.classList.add("accepted");
        }
    </script> 

    <!-- <script>
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
    </script> -->
    
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
