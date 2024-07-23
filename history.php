<?php
    session_start();
    include('include/navbar.php');
    $conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('connection failed');

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM user_tbl WHERE id = ?";
        $statement = $conn->prepare($query);     
        $statement->bind_param("i", $user_id);
        $statement->execute();

        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_email = $row['email'];

            $scrap_query = "SELECT * FROM scrap WHERE email = ?";
            $scrap_statement = $conn->prepare($scrap_query);
            $scrap_statement->bind_param("s", $user_email);
            $scrap_statement->execute();

            $scrap_result = $scrap_statement->get_result();
        } else {
            echo "No user found.";
        }

        $statement->close();
    } else {
        echo "User not logged in.";
    }

    $conn->close();
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>My Scrap History</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');
         
        body {
            font-family: 'Poppins', sans-serif;
        }

        table {
            width: 96%;
            margin-left: 20px;
            border-collapse: collapse;
        }
    
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        .delete-btn {
            color: black;
            border: 1px solid black;
            padding: 5px 10px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .delete-btn:hover {
            background-color: grey;
            color: white;
        }
        
        .status-btn {
            padding: 5px 10px;
            font-weight: bold;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .status-accepted {
            color: green;
        }

        .status-pending {
            color: red;
        }

        .message-box {
        position: fixed;
        top: 50%;
        left: 20px; 
        transform: translateY(-50%);
        background-color: rgba(0, 128, 0, 0.8); 
        color: white;
        padding: 10px;
        border-radius: 5px;
        display: none; /* Hidden by default */
    }
    
    .message-list {
        position: fixed;
        top: 50%;
        left: 20px; /* Adjust the value to position the message list */
        transform: translateY(-50%);
        display: none; /* Hidden by default */
    }
    </style>
    <script>
    // Show the message box and list when admin accepts the request
    function showMessage() {
        var messageBox = document.querySelector('.message-box');
        var messageList = document.querySelector('.message-list');
        messageBox.style.display = 'block';
        messageList.style.display = 'block';
    }
</script>
</head>
<body>

    <div class="container">
        <h3 style="color: black; margin-bottom: 20px; margin-top: 30px; 
        font-size: 24px; font-weight: 700; 
        text-align: center;">My Request For Pickup History</h3>
        
            <!-- Message box -->
    <!-- <div class="message-box">
        <?php
       
        // if ($admin_decides_to_accept_request) {
        //     echo "Your request has been accepted.";
        // }
        ?>
    </div> -->
    
    <!-- Message list -->
    <!-- <div class="message-list"> -->
        <?php
        // $messages = json_decode($scrap_row['messages'], true);
        // if ($messages) {
        //     foreach ($messages as $message) {
        //         echo "<div>$message</div>";
        //     }
        // }
        ?>
                <?php 
                // include 'accepted_message.php'; ?>

    </div>
    
        <table>
            <tr>
                <th>Scheduled Date</th>
                <th>Pickup Address</th>
                <th>Title</th>
                <th>Quantity(Kg)</th>
                <th>Rate(Rs/kg)</th>
                <th>Images</th>
                <th>Status</th>
                <!-- <th>Messages</th> -->
                <th>Action</th>
                <th>Reaction</th>
            </tr>

            <?php
                 if ($scrap_result->num_rows > 0) {
                while ($scrap_row = $scrap_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$scrap_row['scheduled_date']}</td>";
                    echo "<td>{$scrap_row['address']}</td>";
                    echo "<td>{$scrap_row['scrapname']}</td>";
                    echo "<td>{$scrap_row['scrapquantity']} kg</td>";
                    echo "<td>{$scrap_row['scraprate']}</td>";
                   

                    echo "<td>";
                    $images = explode(", ", $scrap_row['image']);
                    foreach ($images as $image) {
                        echo "<img src='uploads/$image' alt='Image' width='80'>";
                    }
                    echo "</td>";

                    $statusClass = $scrap_row['status'] === 'Accepted' ? 'status-accepted' : 'status-pending';
                    echo "<td><button class='status-btn $statusClass'>{$scrap_row['status']}</button></td>";

                    echo "<td>";
                    if ($scrap_row['status'] === 'Pending') {
                        echo "<a href='delete_request.php?id={$scrap_row['id']}' class='delete-btn'>Delete</a>";
                    }
                    else 
                   
                    echo "<td><a href='bill.php?id={$scrap_row['id']}'
                     class='view-btn'>View</a></td>";
                   
                    echo "</td>";

                    echo "</tr>";
                }
                }else {
                    echo "<tr><td colspan='8'>Your history is empty.</td></tr>";
                }
                ?>

        </table>
    </div>

    <?php
    include('include/footer.php');
    ?>
</body>
</html>
