
<!DOCTYPE html>
<html>
<head>
    <title>Scrap Pricing</title>
    <style>

        body{
            background-color:white;

        }
    .scrap-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        
    }

    .scrap-card {
        border: 1px solid #ccc;
        border-radius: 8px;
        width: 250px;
        /* height:100px; */
        padding: 10px;
        margin: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background-color:whitesmoke ;
        text-align: center;
        cursor: pointer;
    }

    .scrap-rate {
        font-size: 24px;
        margin-bottom: 8px;
    }

    .scrap-name {
        font-size: 16px;
        color: #666;
    }
    .scrap-card:hover {
        border:1px solid green;
    }
    </style>

</head>
<body>
    <?php include('include/navbar.php'); ?>
    <div container="note" style="background-color:#87ceeb; text-align: left; padding-left: 40px; margin:50px; border-radius: 5px;">
        <h2 style="font-size: 20px; color: green; display: inline;">Notes</h2>
        <ol style="list-style-type: disc; display: inline;font-size: 14px; margin-left: 10px; color:black;">
            <li>The price may be different in the scrap market.</li>
            <li>We donot deal with others scrap items except platic and paper.</li>
            <li>For bulk pickup,contact us at +9779820572057.</li>
        </ol>
    </div>

    <!-- scrap pricing starts from here -->
    <?php
    $conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Database connection failed');

    $query = "SELECT * FROM pricing";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $scrapCategories = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $category = $row['scrapcategory'];

            if (!isset($scrapCategories[$category])) {
                $scrapCategories[$category] = array();
            }

            $scrapCategories[$category][] = array(
                'scrapname' => $row['scrapname'],
                'scraprate' => $row['scraprate']
            );
        }

        foreach ($scrapCategories as $category => $scrapList) {
            echo "<h2 style='text-align: center;'>$category</h2>";

            echo '<div class="scrap-container">';

            foreach ($scrapList as $scrap) {
                echo '<div class="scrap-card">';
                echo "<div class='scrap-rate' style='font-size: 14px; color:Green;'>RS " . $scrap['scraprate'] . "/kg</div>"; // Display the scrap rate

                echo "<div class='scrap-name'>" . $scrap['scrapname'] . "</div>"; // Display the scrap name
                echo "</div>";
            }

            echo "</div>";
            echo "<br>"; 
            echo "<br>";
            // echo "<hr>"; 
            echo "<br>"; 
        }
    } else {
        echo "<p style='text-align: center;'>No scrap pricing found.</p>";
    }

    mysqli_close($conn);
    ?>
    
    <?php include('include/footer.php'); ?>
</body>




</html>
