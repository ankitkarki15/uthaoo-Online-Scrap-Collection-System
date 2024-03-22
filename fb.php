<?php
include("include/userprofile.php");
$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Connection failed');

$errorMessage = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // $name = $_POST['name'];
  // $email = $_POST['email'];
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
<!-- php script ends here -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Give your feedback</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #fff;
    }

    .container {
      background-color: white;
      border-radius: 10px;
      padding: 10px;
      width: 40%;
      margin: 0 auto;
      margin-top: 30px;
      /* box-shadow: 0px 0px 10px #888888; */
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    input[type=text], textarea {
      width: 100%;
      padding: 12px;
      font: 15px 'Poppins', sans-serif;
      border: 1px solid #0c0c0c;
      border-radius: 4px;
      box-sizing: border-box;
      margin-top: 6px;
      margin-bottom: 16px;
    }

    input[type="submit"] {
      display: block;
      margin: 18px auto 0;
      font: 18px 'Poppins', sans-serif;
      padding: 10px 20px;
      background-color: #4caf50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #47474b;
    }

    .error {
      border-color: red;
      border-width: 2px;
    }

    .error-indicator::after {
      content: "*";
      color: red;
      margin-left: 5px;
    }
  </style>
</head>
<body>
  <?php include('include/navbar.php'); ?>
  <div class="container">
    <h2 style="color: green;">Have Your Say</h2>
    <form action="" method="POST" onsubmit="return validateForm();">
      <!-- Name:
      <input type="text" name="name" placeholder="Your name.." value="<?php 
      // echo isset($name) ? $name : ''; ?>" readonly>
      Email:
      <input type="text" name="email" placeholder="Your email.." value="<?php 
      // echo isset($email) ? $email : ''; ?>" readonly> -->
      <!-- Contact Number:
      <input type="text" name="phone_no" placeholder="Your phone number.." pattern="[0-9]{10}" value="<?php echo isset($phone_no) ? $phone_no : ''; ?>" readonly> -->
      Message:
      <textarea name="message" placeholder="Give your feedbacks.." style="height: 90px;" class="<?php echo !empty($errorMessage) ? 'error-indicator' : ''; ?>"></textarea>
      <p class="error" id="error-message"><?php echo $errorMessage; ?></p>
      <input type="submit" name="submit" value="Submit">
    </form>
    <?php if (!empty($successMessage)) : ?>
    <script>
      alert("<?php echo $successMessage; ?>");
    </script>
  <?php endif; ?>
  </div>

 
<script>
//  function validateForm() {
//   var errorMessage = document.getElementById('error-message');
//   var messageInput = document.getElementsByName('message')[0];

//   if (messageInput.value.length < 5) {
//     errorMessage.innerText = 'Message must contain at least 2 define words';
//     errorMessage.style.color = 'red';
//     messageInput.classList.add('error');
//     return false;
//   } else {
//     errorMessage.innerText = '';
//     messageInput.classList.remove('error');
//     return true;
//   }
// }

function validateForm() {
  var errorMessage = document.getElementById('error-message');
  var messageInput = document.getElementsByName('message')[0];

  var message = messageInput.value.trim();

  if (message.length < 6) {
    errorMessage.innerText = 'Message must contain at least 6 characters';
    errorMessage.style.color = 'red';
    messageInput.classList.add('error');
    return false;
  } else if (/^\d/.test(message)) { // Check if message starts with a digit
    errorMessage.innerText = 'Message cannot start with a number';
    errorMessage.style.color = 'red';
    messageInput.classList.add('error');
    return false;
  } else {
    var words = message.split(/\s+/); // Split message into words
    var definedWordCount = 0;

    for (var i = 0; i < words.length; i++) {
      if (/^[A-Za-z]+$/.test(words[i])) { // Check if word contains only letters
        definedWordCount++;
      }
    }

    if (definedWordCount < 2) {
      errorMessage.innerText = 'Message must contain at least two defined words';
      errorMessage.style.color = 'red';
      messageInput.classList.add('error');
      return false;
    } else {
      errorMessage.innerText = '';
      messageInput.classList.remove('error');
      return true;
    }
  }
}

</script>
  <?php 
  include('include/footer.php'); ?>
</body>
</html>
 