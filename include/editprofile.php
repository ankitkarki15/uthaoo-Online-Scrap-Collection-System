<?php
include('include/navbar.php');   
include('include/connection.php');

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM user_tbl WHERE id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("i", $user_id);
    $statement->execute();

    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone_no = $_POST['phone_no'];

            $update_query = "UPDATE user_tbl SET name = ?, email = ?, phone_no = ? WHERE id = ?";
            $update_statement = $conn->prepare($update_query);
            $update_statement->bind_param("sssi", $name, $email, $phone_no, $user_id);
            $update_result = $update_statement->execute();

            if ($update_result) {
                echo '<script>alert("Profile updated successfully!");</script>';
                header("Location: profile.php");
                exit();
            } else {
                echo '<script>alert("Error updating profile: ' . $update_statement->error . '");</script>';
            }
        }

    } else {
        echo "No user found.";
    }

    $statement->close();
} else {
    echo "User not logged in.";
}

$conn->close();
?>
