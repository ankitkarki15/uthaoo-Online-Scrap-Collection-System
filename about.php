<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Uthaoo || SCS</title>
    <link rel="stylesheet" href="style/style.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <style>
        body {
            font-family:"poppins",sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 45%;
            margin: 0 auto;
            padding: 50px;
            background-color: #f5f5f5;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-size: 35px;
            /* font-weight: bold; */
            margin-bottom: 15px;    
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 25px;
            text-align: justify;
        }

        a {
            text-decoration: none;
            color: green;
            
        }

        a:hover {
            color:red;
        }

    </style>
</head>

<body>
    <?php include('include/navbar.php') ?>
    <br><br>
    <div class="container">
        <h2>About Us</h2>
        <p>
            uthaoo is a system that empowers individuals to sell unused and waste materials like plastic and paper.
            Our platform makes selling scrap easy, giving items a second life. 
            Join Uthaoo to contribute to a cleaner, greener planet. 
            <br><br>
            We provide the best value for your scrap letting you earn while helping the environment.
                Doorstep pickup according to user's date & time.
            <br><br>
            Join us in making a difference! Together we can create a better future by recycling and protecting our
            environment.
            </p>
            <p>
            <a href="products.php" style=" font-weight: bold;">Sell</a> your plastic and paper scraps to uthaoo. 
            <a href="scraprate.php" style=" font-weight: bold;">Check Rate List</a>.
        </p>
    </div>

    <!-- footer -->
    <?php include('include/footer.php') ?>
</body>

</html>
