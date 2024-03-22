<?php
session_start();
include('connection.php');

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM user_tbl WHERE id = ?";
    $statement = $conn->prepare($query);     
    $statement->bind_param("i", $user_id);
    $statement->execute();

    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Fetch the image from the database
        $name = $row['name'];
        $email = $row['email'];
        $phone_no = $row['phone_no'];
    } else {
        echo "No user found.";
    }

    $statement->close();
} else {
    echo "User not logged in.";
}

$conn->close();
?>


  