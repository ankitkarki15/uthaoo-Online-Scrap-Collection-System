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
    <title>Show Feedback Form</title>
  
        <style>
    /* Feedback table styles */
    table.feedback-tbl {
        border-collapse: collapse;
        width:90%;
    }
    
    table.feedback-tbl th, table.feedback-tbl td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    table.feedback-table th {
        background-color: #f2f2f2;
    }
    
    table.feedback-table tbody td[colspan="5"] {
        text-align: center;
        font-style: italic;
        color: rgb(235, 235, 31);
    }

    /* Other styles */
    .section {
        margin-bottom: 20px;
    }
    
    h2 {
        color: black;
        text-align: center;
    }
</style>
</head> 
<body>
 <!-- feedback table starts here -->
 <div class="section" id="feedbackContent" style="display: none;">
                    <div class="fb-container" id="feedbacktbl">
                    <br>
                    <h2 style="color: black; text-align: center;">Feedbacks</h2>
                    <br> <hr>
                    <table>
                        <tr>
                            <!-- <th>Date</th> -->
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Option</th>
                        </tr>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM feedback"; 
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    // echo "<td>" . $row['created_at'] . "</td>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['message'] . "</td>";
                                    echo "<td>
                                    <button type='button' class='remove-btn' onclick='deleteRequest(this)'>Delete</button>
                                </td>";
                                echo "</tr>";
                                   
                                }
                            } else {
                                echo "<tr><td colspan='5'>No feedbacks found.</td></tr>";
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
