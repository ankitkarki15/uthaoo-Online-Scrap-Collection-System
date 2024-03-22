<!-- <div class="section" id="message" style="display: none;">
    <div class="msg-container" id="messageContainer">
        <h1 style="color: green;">Message Notification</h1> -->
        <?php
        $query = "SELECT * FROM scrap WHERE user_id = $userId"; // Replace $userId with the current user's ID
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Check if the scrap request is accepted
                if ($row['status'] == 'Accepted') {
                    echo "<div class='notification'>Your request has been accepted!</div>";
                }
            }
        } else {
            echo "<div class='notification'>No scrap requests found for the user.</div>";
        }
        ?>
    <!-- </div>
</div> -->
