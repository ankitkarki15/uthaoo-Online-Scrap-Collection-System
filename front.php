<!DOCTYPE html>
<html lang="en">
<head>
    <title>Uthaoo || SCS</title>

   <style>
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

nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #fff;
    padding: 10px;

}

/* nav {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #fff; 
        z-index: 1000;     box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
    
} */

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
    size: 18px;
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
}

nav li {
    size: 10px;
    margin-right: 2px;
}

nav a {
    color: #0a0909;
    text-decoration: none;
}

nav li a {
    display: block;
    font-size:14px;
    color: rgb(10, 9, 9);
    text-align: center;
    padding: 10px 16px;
    text-decoration: none;
}

nav li a:hover {
    border: none;
    /* background-color: #747874; */
    border-radius: 30px;
    color:#318216;
    transition: 0.1s;
}

.button {
    margin: 10px 10px;
    background-color: #318216;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 30px;
    cursor: pointer;
    font-weight: bold;
}

.button:hover {
    background-color: #393a39;
}




/* -------------------------------------------------------------------- */
/* -------------------------------------------------------------------- */
/* Content starts from here */
        .content {
            display: flex;
            align-items: center;
        }

        .text-content {
            flex: 1;
            text-align: left;
            padding-left: 100px;
            font-size: 30px;
        }

        .text-content p {
            flex: 1;
            text-align: left;
            padding-left: 5px;
            font-size: 18px;
        }

        .img-content {
            padding-top: 60px;
            padding-right: 90px;
            flex: 1;
            text-align: right;
        }

        .img-content img {
            max-width: 100%;
            height: auto;
            border-radius: 5%;
        }

        .content2 {
            display: flex;
            align-items: center;
            border-color: #003e7c 2px;
        }

        .img-content2 {
            padding-top: 60px;
            padding-left: 100px;
            flex: 1;
            text-align: left;
        }

        .img-content2 img {
            max-width: 100%;
            height: auto;
            border-radius: 5%;
        }

        .text-content2 {
            flex: 1;
            text-align: right;
            padding-right: 150px;
        }

        .text-content2 h3 {
            font-size: 30px;
            font-weight: bold;
        }

        .text-content2 ul {
            padding-left: 0;
            list-style: none;
        }

        .text-content2 ul li {
            font-size: 16px;
            margin-bottom: 10px;
            text-indent: -15px;
            padding-left: 15px;
        }

        .home-section {
            background-color: #f2f2f2;
            margin: 90px;
            padding: 80px;
            text-align: center;
        }

        .home-section h2 {
            color: rgb(16, 16, 16);
            font-size: 36px;
            margin-bottom: 22px;
        }

        .home-section p {
            color: rgb(6, 6, 6);
            font-size: 18px;
            margin-bottom: 40px;
        }

        .home-buttons {
            display: flex;
            justify-content: center;
            /* border-radius: 18px; */
        }

        .home-buttons a {
            /* background-color: #45a049; */
            background-color: #073207;
            color: #fff;
            font-size: 16px;
            /* font-weight: bold; */
            /* padding: 12px 24px; */
            border-radius: 8px;
            margin: 0 10px;
            text-decoration: none;
            transition: background-color 0.2s ease-in-out;
        }

        .home-buttons a:hover {
         background-color: red; /* Change the color to red */
          color: #fff; /* Optionally, you can adjust the text color for better contrast */
        }

        /* footer starts from here */
        footer {
            background-color: #212525;
            padding: 40px;
            text-align: center;
            margin-top: auto;
        }

        .footer-icons {
            list-style-type: none;
            padding: 0;
        }

        footer li {
            list-style: none;
            display: inline-block;
            margin: 10px;
        }

        .footer-icons a {
            background: rgb(96, 91, 91);
            color: #272727;
            padding: 15px;
            border-radius: 100px;
            display: flex;
            font-size: 25px;
        }

        .footer-icons a:hover {
            color: #ebfceee2;
        }

        hr {
            border-color: #8888;
        }

        .foot-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .left-section {
            flex-basis: 40%;
            color: wheat;
        }

        .right-section {
            flex-basis: 40%;
            color: wheat;
        }
    </style>
</head>

<body>
    <nav>
    <a href="front.php"><img src="images/logo/logo/main.png" alt="Logo"></a>
    <!-- <a href="front.php"><img src="images/logo/davis/2.png" alt="Logo"></a>  -->
        <ul>
            <li><a href="#whyuthaoo">Why uthaoo? </a></li>
            <li><a href="#whatwebuy">What we buy? </a></li>
           
            <li><a href="login.php">User</a></li>
            <li><a href="hero/herologin.php">Hero</a></li>
            <li><a href="login.php">Admin</a></li>
        </ul>
    </nav>
    <br><br>
    <div class="content">
        <div class="text-content">
            
            <h3><b>#Got Scrap ?<br>
            Uthaoo is here to rescue </b>
            </h3>
            <p style="text-align:justify;">
                Turn your unwanted scrap into cash
            </p>
            <br>
                <div class="home-buttons">
                <p style="font-family:'Poppins', sans-serif;">
                <a href="hero/herologin.php">Earn as Hero(Scrap Collector)</a>
                </div>
        </div>
        <div class="img-content">
            <img src="images/imgcat/papers.jpg" alt="scrapimage">
        </div>
    </div>
    <section class="home-section" >
        <h2>For more Information</h2>
        <p>Check out our latest rates and Contact us.</p>
        <div class="home-buttons">
            <a href="login.php">Sell Scrap</a>
            <a href="login.php">View Rates</a>
        </div>
    </section>
<br>
    <div class="content2" id="whyuthaoo">
        <div class="img-content2">
            <img src="images/imgcat/plastic.jpeg" alt="scrapimage">
        </div>
        <div class="text-content2">
            <h3>#Earn with your scraps</h3>
            <ul>
                <li>1.We collect your scrap materials hassle-free.</li>
                <li>2.Turn your unwanted items into cash.</li>
                <li>3.Accuracy in weighing(digital machine)</li>
                <li>4.Make money while helping the environment.</li>
            </ul>
        </div>
    </div>
    </div>
    <div class="footer">
    <?php include('include/footer.php'); ?>
    </div>
</body>
</html>
