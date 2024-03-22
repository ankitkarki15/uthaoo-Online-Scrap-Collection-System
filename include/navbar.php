<?php
// include 'userprofile.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Your Page Title</title>
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <style>
    /* User icon */
    .user-icon {
      margin-right: 20px;
    }

    .user-icon button {
      background-color: transparent;
      border: none;
      cursor: pointer;
      outline: none;
      padding: 0;
    }

    .user-icon button ion-icon {
      font-size: 40px;
      height: 40px;
      width: 40px;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #fff;
      min-width: 130px;
      right: 20px;
      box-shadow: 0px 8px 12px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    .dropdown-content.show {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }

    .dropdown-content a {
      color: black;
      display: flex;
      align-items: center;
      margin-bottom: 5px;
    }

    .dropdown-content a ion-icon {
      font-size: 18px;
      margin-right: 5px;
    }
    /* Ends user icon */
  </style>
</head>
<body>
  <nav>
    <!-- <a href="home.php"><img src="images/logo/recikal111.png" alt="Logo"></a> -->
    <a href="home.php"><img src="images/logo/uthaoo333.png" alt="Logo"></a>
    <ul class="nav-link">
      <li><a href="home.php">Home</a></li>
      <li><a href="products.php">Sell Scraps</a></li>
      <li><a href="scraprate.php">Check Rate</a></li>
      <li><a href="about.php">About Us</a></li>
      <!-- <li><a href="feedback.php">Feedback</a></li> -->
      <li><a href="fb.php">Feedback</a></li>
    </ul>
    <ul>
      <li class="dropdown">
        <div class="user-icon">
          <button type="button" onclick="toggleDropdown()">
            <ion-icon name="person-circle-outline"></ion-icon>
          </button>
          <div class="dropdown-content" id="dropdown-content">
            <!-- <h3 style="color: black; text-align:center;"> -->
            <?php 
            // echo $row["name"];
             ?></h3>
            <hr>
            <!-- <a href="profile.php" id="edit-profile"><ion-icon name="person-circle-outline"></ion-icon><?php echo isset($name) ? $name : ''; ?></a> -->
            <a href="profile.php" id="edit-profile"><ion-icon name="person-circle-outline"></ion-icon> My Profile</a>
            <!-- <a href="userdashphp/userpanel.php" id="settings"> <ion-icon name="grid-outline"></ion-icon>My Dashboard</a> -->
            <a href="history.php" id="notification"> <ion-icon name="notifications-circle-outline" style="color:black;"></ion-icon>My History</a>
            <!-- <a href="#" id="about-us"><ion-icon name="help-circle-outline"></ion-icon>Help and Support</a> -->
            <a href="login.php" id="logout"><ion-icon name="log-out-outline"></ion-icon>Log Out</a>
          </div>
        </div>
      </li>
    </ul>
  </nav>

  <script>
    function toggleDropdown() {
      var dropdownContent = document.getElementById("dropdown-content");
      dropdownContent.classList.toggle("show");
    }

    window.onclick = function(event) {
      if (!event.target.matches(".user-icon") && !event.target.matches(".user-icon ion-icon")) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains("show")) {
            openDropdown.classList.remove("show");
          }
        }
      }
    }
  </script>
</body>
</html>
