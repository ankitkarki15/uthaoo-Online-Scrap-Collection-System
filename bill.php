<?php
// Database connection
$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('connection failed');

// Check if ID is set in the URL
if(isset($_GET['id'])) {
    $scrap_id = $_GET['id'];
    
    // Fetch necessary data from the database based on the ID
    $query = "SELECT * FROM scrap WHERE id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("i", $scrap_id);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name']; // User name
        $productName = $row['scrapname']; // Scrap product name
        $quantity = $row['scrapquantity']; // Quantity of scrap
        $collectionDates = array("March 15, 2024", "March 16, 2024"); // Scrap collection dates (example)
    } else {
        echo "Scrap request not found.";
    }

    $statement->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceptance Letter</title>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"> -->
    <style>
        body {
            font-family: 'Cambria';
            margin: 0;
            padding: 20px;
            line-height: 2;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 750px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 2px solid #ccc;
            /* border-radius: 10px; */
        }
        .letterhead {
            text-align: center;
            margin-bottom: 20px;
        }
        .letterhead img {
            max-width: 200px;
            height: auto;
        }
        h2, .subject, .signature p {
            text-align: center;
        }
        .subject {
            font-weight: bold;
            color: #007bff;
            margin-top: 10px;
        }
        .body-content {
            margin-bottom: 20px;
        }
        .contact-info span {
            color: #ff0000;
        }
        .download-link {
            position: absolute;
            top: 10px;
            right: 10px;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .download-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body> <a class="download-link" href="generate_pdf.php">Download PDF</a>
    <div class="container">
        <div class="letterhead">
            <img src="images/logo/uthaoo333.png" alt="Company Logo">
        </div>
        
        <p>Dear <?php echo $name; ?>,</p>
        <p>We are pleased to inform you that your scrap collection request has been accepted.</p>
        <p>The details of your scrap collection are as follows:</p>
        <ul>
            <li>Product Name: <?php echo $productName; ?></li>
            <li>Quantity: <?php echo $quantity; ?> Kg</li>
        </ul>
        <p>The scrap will be collected on the following dates:</p>
        <ul>
            <?php foreach ($collectionDates as $date) {
                echo "<li>$date</li>";
            } ?>
        </ul>
        <p>Please ensure that the scrap is ready for collection on the specified dates.</p>
        <p>If you have any questions or concerns, feel free to contact us at <span class="contact-info" style="color:red";>uthaoonepal@gmail.com</span> or at <span class="contact-info" style="color:red">9812345678</span>.</p>
        
        <p>Thank you for choosing our services.</p>
        <p>Sincerely,</p>
        <p>Team Uthaoo</p>
    </div>
</body>
</html>


<?php
// Close database connection
$conn->close();
?>
