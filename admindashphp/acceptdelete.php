 <!-- Scrap Request-->
 <div class="section" id="scrapRequestContent" style="display: none;">
    <br>
    <div class="request-container">
        <h2 style="color: black; text-align: center;">Scrap Requests</h2>
        <br>
        <hr>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Location</th>
                <th>Items</th>
                <th>Description</th>
                <th>Rate</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            <tbody>
                <?php
                $query = "SELECT * FROM scrap";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['phone_no'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['scrapname'] . "</td>";
                        // echo "<td>" . $row['des'] . "</td>"; 
                        // echo "<td>" . $row['scraprate'] . "</td>";
                        echo "<td>" . $row['scrapquantity'] . "</td>";
                        echo "<td>" . $row['image'] . "</td>";
                        // echo "<td>" . $row['created_at'] . "</td>";
                        echo "<td>
                            <form method='post' action=''>
                                <input type='hidden' name='scrapId' value='" . $row['id'] . "'>";
                                if (isset($row['status']) && $row['status'] == 'Pending') {
                                    echo "<button type='submit' name='acceptScrap' class='pending-btn' 
                                    onclick='return confirm(\"Do you want to accept this request?\");'>Pending</button>";
                                    echo "<span style='margin-right: 10px;'></span>";  
                                } elseif (isset($row['status']) && $row['status'] == 'Accepted') {
                                    echo "<button type='button' class='accepted-btn'>Accepted</button>";
                                    echo "<span style='margin-right: 10px;'></span>";
                                }
                            
                                echo "<button type='submit' name='deleteScrap' class='remove-btn' onclick='return confirm(\"Do you want to delete this request?\");'>Delete</button>";
                        echo "</form>
                        </td>";
                        echo "</tr>";   
                    }
                } else {
                    echo "<tr><td colspan='11'>No scrap requests found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

                    <?php
                    // Check if the accept or delete scrap form is submitted
                    if (isset($_POST['acceptScrap'])) {
                        $scrapId = $_POST['scrapId'];

                        $query = "UPDATE scrap SET status = 'Accepted' WHERE id = '$scrapId'";
                        $result = mysqli_query($conn, $query);

                    }

                    if (isset($_POST['deleteScrap'])) {
                        $scrapId = $_POST['scrapId'];

                        // Delete scrap from the sell table
                        $query = "DELETE FROM scrap WHERE id = '$scrapId'";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            echo '<script>alert("request deleted successfully!");</script>';
                        } else {
                            echo '<script>alert("Error deleting request: ' . mysqli_error($conn) . '");</script>';
                        }
                    }
                    ?>

            <!-- scrap requests ends on here -->
        