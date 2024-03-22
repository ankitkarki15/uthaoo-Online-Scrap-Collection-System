<?php
session_start();
include('include/connection.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $query = "SELECT * FROM user_tbl WHERE email = ? AND password = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("ss", $email, $password);
    $statement->execute();

    // Get the result
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        if ($row['role'] == 'admin') {
            // Admin login successful
            header("Location:admindashphp/adminpanel.php");
            exit;
        } else {
            // Regular user login successful
            header("Location:home.php");
            exit;
        }
    } else {
        // $message = "Invalid email or password";
        echo '<script>alert("Invalid email or password");</script>';
    }

    $statement->close();
}

$conn->close();
?>
