<?php
// Establish database connection
$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Database connection failed');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the pricing form is submitted
    if (isset($_POST['addScrap'])) {
        $scrapName = $_POST['scrapName'];
        $scrapRate = $_POST['scrapRate']; 
        $scrapCategory = $_POST['scrapCategory'];

        // Insert data 
        $query = "INSERT INTO pricing (scrapname, scraprate, scrapcategory) 
        VALUES ('$scrapName', '$scrapRate', '$scrapCategory')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo '<script>alert("Scrap added successfully!");</script>';
        } else {
            echo '<script>alert("Error adding scrap: ' . mysqli_error($conn) . '");</script>';
        }
    }

    // Check if the delete scrap form is submitted
    if (isset($_POST['deleteScrap'])) {
        $scrapId = $_POST['scrapId'];

        // Delete scrap 
        $query = "DELETE FROM pricing WHERE id = '$scrapId'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo '<script>alert("Scrap delete successfully!");</script>';
        } else {
            echo '<script>alert("Error deleting scrap: ' . mysqli_error($conn) . '");</script>';
        }
    }

    // Check if the update scrap form is submitted
    if (isset($_POST['updateScrap'])) {
        $scrapId = $_POST['scrapId'];
        $scrapName = $_POST['scrapName'];
        $scrapRate = $_POST['scrapRate'];
        $scrapCategory = $_POST['scrapCategory'];

        // Update scrap 
        $query = "UPDATE pricing SET scrapname = '$scrapName', scraprate = '$scrapRate', scrapcategory = '$scrapCategory' WHERE id = '$scrapId'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo '<script>alert("Scrap updated successfully!");</script>';
        } else {
            echo '<script>alert("Error updating scrap: ' . mysqli_error($conn) . '");</script>';
        }
    }
}
// Close the database connection
mysqli_close($conn);
?>

<!-- Add Form -->
                    <!-- Add Form -->
                    <div class="section" id="addFormContent" style="display: none;">
                        <br>
                        <div class="add-container2">
                            <h2>Add New Items</h2>
                            <form action="" method="post">
                                <label for="scrapName">Scrap Name:</label>
                                <input type="text" id="scrapName" name="scrapName">

                                <label for="scrapCategory">Scrap Category:</label>
                                <select id="scrapCategory" name="scrapCategory">
                                    <option value="">--Select Scrap Items--</option>
                                    <option value="Plastic">Plastic</option>
                                    <option value="Paper">Paper</option>
                                </select>
                                <label for="scrapRate">Scrap Rate:</label>
                                <input type="number" id="scrapRate" name="scrapRate"><br>

                                <input type="submit" name="addScrap" value="Add Scrap">
                                <button type="button" class="cancel-btn" onclick="showScrapList()">Cancel</button>
                            </form>
                        </div>
                    </div>


                  
                                                    <!-- Update Scrap Form -->
                                    