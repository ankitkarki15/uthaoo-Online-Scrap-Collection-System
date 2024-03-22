<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Scrap Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .section {
            margin: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .add-container2 {
            max-width: 400px;
            margin: 0 auto;
        }

        h2 {
            margin-left: 20px;
            color: black;
        }

        .form-field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .error-message {
            color: #ff0000;
            font-size: 14px;
            margin-top: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Add scrap Form -->
    <div class="section" id="addFormContent">
        <div class="add-container2">
            <h2>Add New Scraps</h2>
            <form id="addScrapForm" action="#" method="POST">
                <div class="form-field">
                    <label for="scrapName">Scrap Name:</label>
                    <input type="text" id="scrapName" name="scrapname" placeholder="Scrap Name">
                    <?php if (!empty($errorMsg) && isset($_POST['scrapname'])): ?>
                        <div class="error-message"><?php echo $errorMsg; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-field">
                    <label for="scrapCategory">Scrap Category:</label>
                    <select id="scrapCategory" name="scrapcategory">
                        <option value="">-- Select Scrap Category --</option>
                        <option value="Plastic">Plastic</option>
                        <option value="Paper">Paper</option>
                        <option value="Mixed">Mixed</option>
                    </select>
                    <?php if (!empty($errorMsg) && isset($_POST['scrapcategory'])): ?>
                        <div class="error-message"><?php echo $errorMsg; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-field">
                    <label for="scrapRate">Scrap Rate:</label>
                    <input type="number" id="scrapRate" name="scraprate" placeholder="Scrap Rate">
                    <?php if (!empty($errorMsg) && isset($_POST['scraprate'])): ?>
                        <div class="error-message"><?php echo $errorMsg; ?></div>
                    <?php endif; ?>
                </div>
                <input type="submit" name="pricing" value="Add">
            </form>
        </div>
    </div>
      <?php
      // Establish database connection
      $conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('Database connection failed');

      // Check if the form is submitted
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          if (isset($_POST['pricing'])) {
              $scrapName = mysqli_real_escape_string($conn, $_POST['scrapname']);
              $scrapRate = mysqli_real_escape_string($conn, $_POST['scraprate']);
              $scrapCategory = mysqli_real_escape_string($conn, $_POST['scrapcategory']);

              $error = false; // Flag to track errors
              $errorMsg = ''; // Error message

              // Server-side validation
              if (empty($scrapName)) {
                  $error = true;
                  $errorMsg = 'Scrap Name is required.';
              }

              if (empty($scrapRate) || !is_numeric($scrapRate) || $scrapRate <= 0) {
                  $error = true;
                  $errorMsg = 'Invalid scrap rate! Please enter a valid number greater than zero.';
              }

              if (empty($scrapCategory)) {
                  $error = true;
                  $errorMsg = 'Scrap Category is required.';
              }

              if (!$error) {
                  // Insert data into the pricing table
                  $query = "INSERT INTO pricing (scrapname, scraprate, scrapcategory) VALUES ('$scrapName', '$scrapRate', '$scrapCategory')";
                  $result = mysqli_query($conn, $query);

                  if ($result) {
                      echo '<script>alert("Scrap added successfully!");</script>';
                  } else {
                      echo '<script>alert("Error adding scrap: ' . mysqli_error($conn) . '");</script>';
                  }
              }
          }
      }
      ?>
</body>
</html>
