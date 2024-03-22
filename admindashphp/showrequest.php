<?php
$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Connection failed');

// Check if the connection was successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Show Scrap Requests</title>
   <link rel="stylesheet" href="assets/css/showreq.css">

    <script>
        // JavaScript function to handle accepting the request
        function acceptRequest(button) {
            // Perform necessary operations for accepting the request
            alert("Request Accepted!");
            // Change the background color of the button to indicate acceptance
            button.classList.add("accepted");
        }
    </script>
</head>
<body>
<div class="section" id="scrapRequestContent" style="display: none;">
                <div class="request-container">
                <h2 style="color: black; text-align: center;">Scrap Requests</h2>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th>Items</th>
                            <!-- <th>Description</th> -->
                            <th>Rate</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <!-- <th>Created At</th> -->
                            <th>Option</th>
                        </tr>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM sell";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['phone_no'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                echo "<td>" . $row['scrap_items'] . "</td>";
                                // echo "<td>" . $row['des'] . "</td>"; 
                                echo "<td>" . $row['rate'] . "</td>";
                                echo "<td>" . $row['quantity'] . "</td>";
                                echo "<td>" . $row['image'] . "</td>";
                                // echo "<td>" . $row['created_at'] . "</td>";
                                echo "<td>
                                    <button type='button' class='accept-btn' onclick='acceptRequest(this)'>Accept</button> <br><br>
                                <button type='button' class='remove-btn'>Delete</button>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='11'>No scrap requests found.</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
