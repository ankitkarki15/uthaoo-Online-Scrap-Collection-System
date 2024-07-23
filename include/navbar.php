<!DOCTYPE html>
<html>
<head>
  <title>Your Page Title</title>
  <!-- <link rel="stylesheet" href="style/style.css"> -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

html {
    height: 100%;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: inherit;
    
}
body{
    font-family:'Poppins', sans-serif;
    /* background-color: #0a0a23; */
    
}

/* nav {

    display: flex;
    width: 100%;
    align-items: right;
    justify-content: space-between;
    background-color: #fff;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
    z-index: 1000;
} */
nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #000;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
    z-index: 1000;
    

}
nav img {
    height: 50px;
    margin-right: 30px;
    padding-left: 10px;
    align-items: right;
    size: 30px;
    padding-right: 5px;
}

nav ul {
    /* font-weight: bold; */
    size: 10px;
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
}

nav li {
    size: 10px;
    margin-right: 20px;
}

nav a {
    color: #0a0909;
    text-decoration: none;
}

nav li a {
    display: block; 
    font-size:16px;
    color: rgb(10, 9, 9);
    text-align: center;
    padding: 12px 8px;
    text-decoration: none;
}

nav li a:hover {
    /* border: 4px solid green; */
    /* background-color: #747874; */
    /* border-radius: 8px; */
    color:#31b106;
    transition: 0.1s;
}

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
    <a href="home.php"><img src="images/logo/logo/main.png" alt="Logo"></a>
    <ul class="nav-link">
      <li><a href="home.php">Home</a></li>
      <li><a href="products.php">Sell Scraps</a></li>
      <li><a href="scraprate.php">Check Rate</a></li>
      <li><a href="about.php">About Us</a></li>
      <li><a href="fb.php">Feedback</a></li>
    </ul>
    <ul>
      <li class="dropdown">
        <div class="user-icon">
          <button type="button" onclick="toggleDropdown()">
            <ion-icon name="person-circle-outline"></ion-icon>
          </button>
          <div class="dropdown-content" id="dropdown-content">
            <?php 
            // echo $row["name"];
             ?></h3>
            <hr>
            <a href="profile.php" id="edit-profile"><ion-icon name="person-circle-outline"></ion-icon> My Profile</a>
            <a href="history.php" id="notification"> <ion-icon name="notifications-circle-outline" style="color:black;"></ion-icon>My History</a>
            <a href="front.php" id="logout"><ion-icon name="log-out-outline"></ion-icon>Log Out</a>
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
