
<!DOCTYPE html>
<html>
<head>
    <title>Scrap Pricing</title>
    <style>
        body{
            font-family:'Poppins', sans-serif;
        }
    input{
        font-size:16px;

    }
    
     table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
    }
    
    th, td {
        border: 1px solid black;    
        padding:10px;
        text-align: left;
    }
       
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .scrap-card {
    border: 1px solid #ccc;
    padding: 10px;
    margin: 10px 0;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

    </style>
</head>
<!-- <body>
<?php 
// include('include/navbar.php'); ?>
    <h1 style="margin:10px auto; font-size:24px;">Scrap Pricing</h1>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Scrap Name</th>
                <th>Scrap Category</th>
                <th>Scrap Rate</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            // $conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Database connection failed');

            // $query = "SELECT * FROM pricing";
            // $result = mysqli_query($conn, $query);

            // if (mysqli_num_rows($result) > 0) {
            //     while ($row = mysqli_fetch_assoc($result)) {
            //         echo "<tr>";
            //         echo "<td>" . $row['id'] . "</td>";
            //         echo "<td>" . $row['scrapname'] . "</td>";
            //         echo "<td>" . $row['scrapcategory'] . "</td>";
            //         echo "<td>" . $row['scraprate'] . "</td>";
            //         echo "</tr>";
            //     }
            // } else {
            //     echo "<tr><td colspan='4'>No scrap pricing found.</td></tr>";
            // }
            ?>
        </tbody>
    </table>-->
    
    <?php 
    // include('include/footer.php'); 
    ?>
<body>
    <?php include('include/navbar.php'); ?>

    <!-- for scrap rates -->
    <h1 style="color: rgb(39, 38, 38); text-align: center; font-weight: 700; letter-spacing: -.03rem; line-height: 250%; font-size: 50px;"><b>Scrap Rates</b></h1>

    <!-- Scrap rates section -->
    <?php
    // Establish database connection
    $conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Database connection failed');

    // Fetch data from pricing table
    $query = "SELECT * FROM pricing";
    $result = mysqli_query($conn, $query);

    // Initialize an array to hold the scrap categories and rates
    $scrapCategories = array();

    // Loop through the results and categorize scrap rates
    while ($row = mysqli_fetch_assoc($result)) {
        $scrapname = $row['scrapname'];
        $category = $row['scrapcategory'];
        $typeRateJson = $row['scraprate']; // Fetch JSON-encoded data

        // Decode the JSON data
        $typeRate = json_decode($typeRateJson, true);

        if (is_array($typeRate)) {
            if (!isset($scrapCategories[$category])) {
                $scrapCategories[$category] = array();
            }

            // Store the scrap name, type, and rate
            foreach ($typeRate as $type => $rate) {
                $scrapCategories[$category][] = array('scrapname' => $scrapname, 'type' => $type, 'rate' => $rate);
            }
        } else {
            echo "Invalid scraprate data for category " . $category . "<br>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <!-- Display categorized scrap rates -->
    <div class="scrap-rates">
    <?php
    foreach ($scrapCategories as $category => $scrapTypes) {
        echo '<div class="scrap-category">';
        echo '<h2 style="margin-bottom: 10px;">' . $category . '</h2>';
       
        echo '<div class="scrap-card">'; // Add a class for styling
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>' . $category . ' Type</th>';
        echo '<th>Scrap Name</th>';
        echo '<th>Rate (Rs/kg)</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($scrapTypes as $scrap) {
            echo '<tr>';
            echo '<td>' . $scrap['type'] . '</td>';
            echo '<td>' . $scrap['scrapname'] . '</td>';
            echo '<td>' . $scrap['rate'] . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>'; // Close the scrap card
        echo '</div>';
    }
    ?>
</div>


    <?php include('include/footer.php'); ?>
</body>


</html>
