  
                      <!-- Add scraps,pricing -->
                      <div class="section" id="addScrapsContent">
                 <div class="add-container"><br>
                            <h2 style="margin-left:20px; color:Black;">Scrap Lists</h2>
                            <button type="button" class="add-btn" onclick="showAddForm()" style="margin-left:20px; padding:10px;">Add Scraps</button>
                            <hr>
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Rate(Rs)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Establish database connection
                                    $conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Database connection failed');

                                    $query = "SELECT * FROM pricing";
                                    $result = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['scrapname'] . "</td>";
                                            echo "<td>" . $row['scrapcategory'] . "</td>";
                                            echo "<td>" . $row['scraprate'] . "</td>";
                                            echo "<td>
                                                <button type='button' name='updateScrap' class='update-btn' onclick='showUpdateForm(" . $row['id'] . ", \"" . $row['scrapname'] . "\", \"" . $row['scraprate'] . "\", \"" . $row['scrapcategory'] . "\")'>Update</button>
                                                <button type='button' name='deleteScrap' class='remove-btn' onclick='deleteRequest(" . $row['id'] . ")'>Delete</button>
                                                </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No scrap requests found.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            
                            <br>
                 </div>
             </div>

                    <!-- Add scrap Form -->
                    <div class="section" id="addFormContent" style="display: none;">
                        <br>
                        <div class="add-container2">
                        <h2 style="margin-left:20px; color:black;">Add New Scraps</h2>
                            <form id="addScrapForm" action="#" method="POST">
                                <label for="scrapName">Scrap Name:</label>
                                <input type="text" id="scrapName" name="scrapname" required placeholder="Scrap Name">
                                <label for="scrapCategory">Scrap Category:</label>
                                <select id="scrapCategory" name="scrapcategory" style="height:40px; font-size:16px;">
                                    <!-- <option value="">-- Select Scrap Category --</option> -->
                                    <option value="Plastic" style="height:30px;">Plastic</option>
                                    <option value="Paper" style="height:30px;">Paper</option>
                                    <option value="Mixed" style="height:30px;">Mixed</option>
                                </select><br>

                                <label for="scrapRate">Scrap Rate:</label>
                                <input type="number" id="scrapRate" name="scraprate" required placeholder="Scrap Rate">

                                <input type="submit" name="pricing" value="Add">
                            </form>
                        </div>
                    </div>

                    <!-- Update scraps -->
                    <div class="section" id="updateFormContent" style="display: none;">
                        <br>
                        <div id="updateScrapForm" class="add-container2">
                            <h2>Update Scrap Items</h2>
                            <form id="updateScrapForm" action="#" method="POST">
                                <label for="updateScrapId">Scrap ID:</label>
                                <input type="text" id="updateScrapId" name="scrapid" readonly>
                                <label for="updateScrapName">Scrap Name:</label>
                                <input type="text" id="updateScrapName" name="scrapname" required>

                                <label for="updateScrapRate">Scrap Rate:</label>
                                <input type="text" id="updateScrapRate" name="scraprate" required>

                                <label for="updateScrapCategory">Scrap Category:</label>
                                <select id="updateScrapCategory" name="scrapcategory" style="height:40px; font-size:16px;">
                                    <!-- <option value="">-- Select Scrap Items --</option> -->
                                    <option value="Plastic">Plastic</option>
                                    <option value="Paper">Paper</option>
                                    <option value="Mixed">Mixed</option>
                                </select><br>

                                <input type="submit" name="updateScrap" value="Update Scrap"><br>
                                <button type="button" class="cancel-btn" onclick="showScrapList()" 
                                style="height:40px; font-size:16px;">Cancel</button>
                            </form>
                        </div>
                    </div>
                    <!-- Delete form -->
                    <!-- <form id="deleteForm" action="#" method="POST" style="display: none;">
                        <input type="hidden" id="deleteScrapId" name="scrapid">
                    </form> -->

                     <?php
                    // Establish database connection
                    $conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Database connection failed');

                    // Check if the form is submitted
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Add Scrap Form Submission
                        if (isset($_POST['pricing'])) {
                            $scrapName = mysqli_real_escape_string($conn, $_POST['scrapname']);
                            $scrapRate = mysqli_real_escape_string($conn, $_POST['scraprate']);
                            $scrapCategory = mysqli_real_escape_string($conn, $_POST['scrapcategory']);

                            $error = false; // Flag to track errors
                            $errorMsg = ''; // Error message

                            // Server-side validation
                            if (empty($scrapName) || empty($scrapRate) || empty($scrapCategory)) {
                                $error = true;
                                $errorMsg = '<ion-icon name="close-circle"></ion-icon> All fields are required!';
                            } elseif (!is_numeric($scrapRate) || $scrapRate <= 0) {
                                $error = true;
                                $errorMsg = '<ion-icon name="close-circle"></ion-icon> Invalid scrap rate! Please enter a valid number greater than zero.';
                            }

                            if (!$error) {
                                // Insert data into the pricing table
                                $query = "INSERT INTO pricing (scrapname, scraprate, scrapcategory) VALUES ('$scrapName', '$scrapRate', '$scrapCategory')";
                                $result = mysqli_query($conn, $query);

                                if ($result) {
                                    $successMsg = '<ion-icon name="checkmark-circle"></ion-icon> Scrap added successfully!';
                                } else {
                                    $errorMsg = '<ion-icon name="close-circle"></ion-icon> Error adding scrap: ' . mysqli_error($conn);
                                }
                            }
                        }

                                            // Update Scrap Form Submission
                        if (isset($_POST['updateScrap'])) {
                            $scrapId = mysqli_real_escape_string($conn, $_POST['scrapid']);
                            $scrapName = mysqli_real_escape_string($conn, $_POST['scrapname']);
                            $scrapRate = mysqli_real_escape_string($conn, $_POST['scraprate']);
                            $scrapCategory = mysqli_real_escape_string($conn, $_POST['scrapcategory']);

                            $error = false; // Flag to track errors
                            $errorMsg = ''; // Error message

                            // Server-side validation
                            if (empty($scrapName) || empty($scrapRate) || empty($scrapCategory)) {
                                $error = true;
                                $errorMsg = '<ion-icon name="close-circle"></ion-icon> All fields are required!';
                            } elseif (!is_numeric($scrapRate) || $scrapRate <= 0) {
                                $error = true;
                                $errorMsg = '<ion-icon name="close-circle"></ion-icon> Invalid scrap rate! Please enter a valid number greater than zero.';
                            }

                            if (!$error) {
                                // Update scrap
                                $query = "UPDATE pricing SET scrapname = '$scrapName', scraprate = '$scrapRate', scrapcategory = '$scrapCategory' WHERE id = '$scrapId'";
                                $result = mysqli_query($conn, $query);

                                if ($result) {
                                    $successMsg = '<ion-icon name="checkmark-circle"></ion-icon> Scrap updated successfully!';
                                } else {
                                    $errorMsg = '<ion-icon name="close-circle"></ion-icon> Error updating scrap: ' . mysqli_error($conn);
                                }
                            }
                        }

                        // Check if the delete scrap form is submitted
                        if (isset($_POST['deleteScrapId'])) {
                            $scrapId = mysqli_real_escape_string($conn, $_POST['deleteScrapId']);

                            $query = "DELETE FROM pricing WHERE id = '$scrapId'";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                echo '<script>alert("Scrap deleted successfully!");</script>';
                            } else {
                                echo '<script>alert("Error deleting scrap: ' . mysqli_error($conn) . '");</script>';
                            }
                        }
                        }

                    ?>
                    <script>
                    function showAddForm() {
                        document.getElementById("addScrapsContent").style.display = "none";
                        document.getElementById("addFormContent").style.display = "block";
                    }

                    function showUpdateForm(scrapId, scrapName, scrapRate, scrapCategory) {
                        document.getElementById("updateScrapId").value = scrapId;
                        document.getElementById("updateScrapName").value = scrapName;
                        document.getElementById("updateScrapRate").value = scrapRate;
                        document.getElementById("updateScrapCategory").value = scrapCategory;
                        document.getElementById("addScrapsContent").style.display = "none";
                        document.getElementById("updateFormContent").style.display = "block";
                    }

                    function showScrapList() {
                        document.getElementById("updateFormContent").style.display = "none";
                        document.getElementById("addScrapsContent").style.display = "block";
                    }
                    function deleteRequest(scrapId) {
                            if (confirm("Are you sure you want to delete this scrap?")) {
                                // Create a form element dynamically
                                var form = document.createElement("form");
                                form.action = "#";
                                form.method = "post";

                                // Create an input element for the scrapId
                                var input = document.createElement("input");
                                input.type = "hidden";
                                input.name = "deleteScrapId";
                                input.value = scrapId;

                                // Append the input element to the form
                                form.appendChild(input);

                                // Append the form to the document and submit it
                                document.body.appendChild(form);
                                form.submit();
                            }
                        }

                    </script>
