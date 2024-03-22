<?php
include('../include/userprofile.php');
include 'addscrap.php';
?>

<?php
$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Connection failed');
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
<html>
    <head>
        <title> Scrap List</title>
    </head>
    <body>
<div class="section" id="addScrapsContent" style="display: none;">
  <div class="add-container">
    <h2 style="color: black; text-align: center;">Scrap Lists</h2>
    <hr>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Rate/kg(rs)</th>  
          <th>Option</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT * FROM addscrap";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['scrapname'] . "</td>";
            echo "<td>" . $row['rate'] . "</td>";
            echo "<td>
              <button type='button' class='update-btn' onclick='updateRequest(this)'>Update</button>
              <button type='button' class='remove-btn' onclick='deleteRequest(this)'>Delete</button>
            </td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='4'>No scrap requests found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
<br>
    <button type='button' class='add-btn' onclick='showAddForm()' style="padding:10px; margin:0 auto;">Add Scraps</button>
  </div>
</div>
</body>
</html>