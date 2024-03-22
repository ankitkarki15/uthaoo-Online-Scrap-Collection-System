<?php
// include("include/userprofile.php");
$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Connection failed');

$errorMessage = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  // $phone_no = $_POST['phone_no'];
  $message = $_POST['message'];
  $errorMessage = '';

  if (empty($message)) {
    $errorMessage = "Please write something!";
  } else {
    $stmt = mysqli_prepare($conn, "INSERT INTO `feedback` (`name`, `email`, `phone_no`, `message`) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
      die("Error preparing statement: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone_no, $message);

    if (mysqli_stmt_execute($stmt)) {
      $successMessage = "Form submitted successfully!";
      echo '<script>console.log("Feedback form submitted successfully!");</script>';
    } else {
      $errorMessage = "Error submitting form: ". mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
  }
}
?>  

<script>
 function validateForm() {
  var errorMessage = document.getElementById('error-message');
  var messageInput = document.getElementsByName('message')[0];

  if (messageInput.value.length < 5) {
    errorMessage.innerText = 'Message must contain at least 2 define words and mustnot start with number';
    errorMessage.style.color = 'red';
    messageInput.classList.add('error');
    return false;
  } else {
    errorMessage.innerText = '';
    messageInput.classList.remove('error');
    return true;
  }
}
</script>
</body>
</html>
