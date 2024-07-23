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
    width: 90%;
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
    <h1 style="background-color:#87ceeb;" >UTHAOO || Herp Details </h1>
    <p style="color:red;"><a href="adminpanel.php">Go back </a><p>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Generated Email</th>
            <th>Phone Number</th>
            <th>Vehicle</th>
            <th>license_number</th>
            <th>Location</th>
        
        </tr>
        
        <?php

        $connection = mysqli_connect('localhost','root','ankit','scrapx') or die('Connection failed');
        
        // Check if the connection was successful
        if (!$connection) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        
        // Fetch hero details
      
      // $sql = "SELECT hero_id, name, email, phone_no, vehicle_type, license_number, location FROM hero";
      $sql = "SELECT hero_id, name, email, phone_no, vehicle_type, 
      license_number, location, CONCAT(LEFT(name, 3), hero_id, '@hero.uthaoo.com') AS generated_email FROM hero";
      $result = mysqli_query($connection, $sql); // Use $sql instead of $query
      $result = mysqli_query($connection, $sql); // Use $sql instead of $query
        
        if (!$result) {
            die("Database query failed.");
        }
        
        // Display user details in a table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
    echo "<td>" . $row['hero_id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['generated_email'] . "</td>";
    echo "<td>" . $row['phone_no'] . "</td>";
    echo "<td>" . $row['vehicle_type'] . "</td>";
    echo "<td>" . $row['license_number'] . "</td>";
    echo "<td>" . $row['location'] . "</td>";
    
    echo "</tr>";
        }
        
        mysqli_free_result($result);
        mysqli_close($connection);
        ?>
    </table>
</body>
</html>
