<!DOCTYPE html>
<html>
<head>
    <title>View Users </title>
    <style>
        body{
            font-family: 'Poppins', sans-serif;
            background:#fff9;
        }
        h1 {
            font-size:24px;
            text-align: center;
            flex: 1;
        }

        p {
            text-align: right;
            margin: 0;
        }
        
        table {
    width: 80%;
    border-collapse: collapse;
    margin: 20px auto;
    font-family: 'Poppins', sans-serif;
}


    th, td {
        border: 1px solid black;    
        padding:10px;
        text-align: left;
    }


tr:hover {
    background-color: #ddd;
}

    </style>
</head>
<body>
    <h1 style="background-color:#87ceeb;" >UTHAOO || User Details </h1>
    <p style="color:red;"><a href="adminpanel.php">Go back </a><p>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
        </tr>
        
        <?php

        $connection = mysqli_connect('localhost','root','ankit','scrapx') or die('Connection failed');
        
        // Check if the connection was successful
        if (!$connection) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        
        // Fetch user details with role 'user'
        $query = "SELECT id, name, email, phone_no FROM user_tbl WHERE role = 'user'";
        $result = mysqli_query($connection, $query);
        
        if (!$result) {
            die("Database query failed.");
        }
        
        // Display user details in a table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone_no'] . "</td>";
            echo "</tr>";
        }
        
        mysqli_free_result($result);
        mysqli_close($connection);
        ?>
    </table>
</body>
</html>
