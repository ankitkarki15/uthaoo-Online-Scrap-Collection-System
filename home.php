<!DOCTYPE html>
<html lang="en">
<head>
    <title>Uthaoo || SCS</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/font.css">
    <style>
         .content {
            /* display: flex; */
            justify-content: space-between;
        }

        .text-content {
            animation-duration: 1s;
            animation-name: fadeInLeft;
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .home-buttons {
            animation-duration: 1s;
            animation-name: fadeInRight;
        }

        @keyframes fadeInRight{
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>
<?php include('include/navbar.php'); ?>
    <div class="content">
    <div class="text-content">
    <h1 style="font-family:'Shadows Into Light';">#Got</span> <span style=" font-family:'Shadows Into Light', cursive; color: #318216;">Scrap?</span></h1>
           <h3>uthaoo is here to <span  style="font-family:'Shadows Into Light',cursive; color: #fc1010;">rescue</span></h3>
           <p style="font-family:'Poppins', sans-serif;">
                Turn your unwanted scrap into cash
            </p>

        <br>
        <div class="home-buttons" >
                <p style="font-family:'Roboto';">
                <a href="products.php">Start Earning with your scrap!!</a>
                </div>
        </div>
        <div class="img-content">
            <img src="images/imgcat/papers.jpg" alt="scrapimage">
            
        </div>
    </div>

    <section class="home-section">
        <h2>For more Information</h2>
        <p>Check out our latest rates and Conatct us.</p>
        <div class="home-buttons">
            <a href="Products.php">Sell Scrap</a>
            <a href="scraprate.php">View Rates</a>
        </div>
    </section>
<!--  -->
<div class="content2">
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
<!-- <script src="dropdown.js"></script> -->
    <?php include('include/footer.php'); ?>
</body>

</html>