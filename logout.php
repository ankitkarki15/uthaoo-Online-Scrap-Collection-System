    <?php
    session_start();
    // Unset(remove) all session variables from session using unset() function
     unset($_SESSION['email']);
    // header("location:login.php");
    header("location:login.php");
    
    exit;
    ?>