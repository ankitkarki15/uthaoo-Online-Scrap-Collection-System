
<!--  adcndcndcndmc -->
<?php
$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('connection failed');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if an ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $request_id = $_GET['id'];

    // Update the status to "Deleted"
    $update_query = "UPDATE scrap SET status = 'Deleted' WHERE id = $request_id";
    $update_result = $conn->query($update_query);

    if ($update_result) {
        // Delete the request
        $delete_query = "DELETE FROM scrap WHERE id = $request_id";
        $delete_result = $conn->query($delete_query);

        if ($delete_result) {
            // Request deleted successfully
            echo "<script>alert('Request deleted successfully.'); window.location.href = 'history.php';</script>";
        } else {
            echo "<script>alert('Error deleting request: " . $conn->error . "'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Error updating status: " . $conn->error . "'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request ID.'); window.history.back();</script>";
}

// Close the database connection
$conn->close();
?>