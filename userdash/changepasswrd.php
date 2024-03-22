<?php
include("include/userprofile.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
        echo 'Please fill in all the fields.';
    } elseif ($newPassword !== $confirmPassword) {
        echo 'New password and confirm password must match.';
    } else {
        $conn = mysqli_connect('your_db_hostname', 'your_db_username', 'your_db_password', 'your_db_name');

        if (!$conn) {
            die('Database connection failed: ' . mysqli_connect_error());
        }

        $userId = 1; // Replace 1 with the actual user ID
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE your_users_table SET password = '$hashedPassword' WHERE id = $userId";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo 'Password changed successfully.';
        } else {
            echo 'Error updating password: ' . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>
