<?php
include('../include/userprofile.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User dashboard</title>
    <!-- <link rel="stylesheet" href="assets/css/admindash.css"> -->
    <link rel="stylesheet" href="asset/css/style.css">
    <!-- <link rel="stylesheet" href="asset/css/sell3.css"> -->
    <link rel="stylesheet" href="asset/css/cp.css">
</head>
<body>
    <div class="dashboard">
        <div class="header">
            <div class="logo">
            <a href="userdash.php"><img src="asset/images/logo/uthaoo3333.png" alt="Logo" style="width:140px;height:auto;"></a>
            </div>
            <div class="welcome">
                <h2 style="font-size:18px;">Welcome, <?php echo $row["name"]; ?></h2>
            </div>
            <div class="go-back">
                <a href="../front.php">Go Back</a>
            </div>
        </div>
        <div class="main-content">
            <div class="sidebar">
                <ul>
                    <li><a href="#" class="active" onclick="openSection('home')">Home</a></li>
                    <li><a href="#" onclick="openSection('sellrequest')">Sell request</a></li>
                    <li><a href="#" onclick="openSection('feedback')">Give Feedback</a></li>
                    <li><a href="#" onclick="openSection('myhistory')">My history</a></li>
                    <li><a href="../front.php" onclick="openSection('logout')" style="color:red;">Logout</a></li>
                </ul>
            </div>



            <div class="section-container">
                <div class="section" id="home">
                    <div class="data-info">

                        <div class="total-requests">
                            <h2>Total Requests</h2>
                            <h1>0</h1>
                        </div>
                        <div class="total-accepted">
                            <h2>Total Accepted</h2>
                            <h1>0</h1>
                        </div>
                        <div class="pending-requests">
                            <h2>Total Pending</h2>
                            <h1>0</h1>
                        </div>
                    </div>
                </div>

                <!-- sell products-->
                <div class="section" id="sellrequest" style="display: none;">
                <?php include('products.php'); ?>
                </div>
             
                <!-- feedback -->
             <div class="section" id="feedback" style="display: none;">
                    <?php 
                    include('feedback.php'); ?>
                </div> 

                <!-- sell products-->
                <div class="section" id="myhistory" style="display: none;">
                <?php include('history.php'); ?>
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
    <script src="assets/js/style.js"></script>
    <script>
        function showHomeContent() {
            var homeContent = document.getElementById("homeContent");
            homeContent.style.display = "block";
            document.getElementById("showScrap-request").style.display = "none";
        }

        function showScrap-request() {
            var sellScrapForm = document.getElementById("scrap-request");
            sellScrapForm.style.display = "block";
            document.getElementById("homeContent").style.display = "none";
        }
        </script>
</body>
</html>
