<?php
// Assuming you have already established a database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pricing'])) {
    $scrapName = $_POST['scrapname'];
    $scrapCategory = $_POST['scrapcategory'];
    $scrapRate = $_POST['scraprate'];

    // Assuming you have a table named 'scraps' with columns 'name', 'category', and 'rate'
    $insertQuery = "INSERT INTO pricing (name, category, rate) VALUES ('$scrapName', '$scrapCategory', '$scrapRate')";

    // Execute the query
    if (mysqli_query($connection, $insertQuery)) {
        echo "Scrap added successfully!";
    } else {
        echo "Error adding scrap: " . mysqli_error($connection);
    }
}
?>
