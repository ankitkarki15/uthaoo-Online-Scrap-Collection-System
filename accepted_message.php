<?php
include('include/userprofile.php');
$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Connection failed: ' . mysqli_connect_error());

// Check if admin decides to accept a request
if ($admin_decides_to_accept_request) {
    // Update the status in the database
    $update_query = "UPDATE scrap SET status = 'Accepted' WHERE id = ?";
    $update_statement = $conn->prepare($update_query);
    $update_statement->bind_param("i", $scrap_row['id']);
    $update_statement->execute();

    // Add a message to the 'messages' column
    $new_message = "Your request has been accepted.";
    $existing_messages = json_decode($scrap_row['messages'], true) ?: array();
    array_push($existing_messages, $new_message);
    $updated_messages = json_encode($existing_messages);

    $update_messages_query = "UPDATE scrap SET messages = ? WHERE id = ?";
    $update_messages_statement = $conn->prepare($update_messages_query);
    $update_messages_statement->bind_param("si", $updated_messages, $scrap_row['id']);
    $update_messages_statement->execute();
}

// Close the database connection
mysqli_close($conn);
?>
