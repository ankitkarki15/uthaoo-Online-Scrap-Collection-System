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
        $pricePerKg = $row['scraprate']; 
        $totalPrice = $quantity * $pricePerKg; // Total price
        // Assuming you have a column in your database table for price_per_kg
    } else {
        echo "Scrap request not found.";
    }

    $statement->close();
}$currentDate = date("Y-m-d");
?>
<!-- @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap'); -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scrap Bill</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
            /* background-color: #f5f5f5; */
        }
        .container {
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .billhead {
            text-align: center;
            margin-bottom: 20px;
        }
        .billhead img {
            max-width: 180px;
            height: auto;
        }
        h3, .subject, .signature p {
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
        table {
            width: 80%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total-price {
            font-weight: bold;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body><?php
    if(isset($_GET['id'])) {
        $scrap_id = $_GET['id'];
        echo "<a href='pdf.php?id=$scrap_id' download>Download Scrap Bill</a>";
    } else {
        echo "ID not specified.";
    }
    ?>
    <a class="download-link" href="pdf.php">Download PDF</a>
    <div class="container">
        <div class="billhead">
            <img src="images/logo/logo/main.png" alt="Company Logo">
        </div>
        
        <h3>Your Scrap Bill</h3>
        <tr>
        <td>Billno:</td> <td><?php echo '<b style="color:red;">' . $scrap_id . '</b>'; ?></td> <br>

                <td>Name of Customer:</td>
                <td><?php echo '<b>' . $name . '</b>'; ?></td><br>
                <td>Date:</td><td><?php echo $currentDate; ?></td>
            </tr>
        <table>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price Per Kg</th>
                <th>Total amount</th>
            </tr>
            
            <tr>
                <td><?php echo $productName; ?></td>
                <td><?php echo $quantity; ?> Kg</td>
                <td>Rs<b>&nbsp;</b><?php echo $pricePerKg; ?></td>
                <td class="total-price">Rs<b>&nbsp;</b><?php echo $totalPrice; ?></td>
            </tr>
        </table>
        
        <p>If you have any questions ,feel free to contact us at <span class="contact-info" style="color:red;">info@uthaoo.com</span> or at <span class="contact-info" style="color:red;">9812345678</span>.</p>
        
        <p>Thank you for choosing our services.<br>
        Sincerely,<br>
        Team Uthaoo</p>
    </div>
</body>
</html>

<?php
$conn->close();
?>
