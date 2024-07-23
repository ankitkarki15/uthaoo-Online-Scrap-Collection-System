<?php
require_once('tcpdf_include.php');

// Database connection
$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('connection failed');

if(isset($_GET['id'])) {
    $scrap_id = $_GET['id'];

    // Fetch necessary data from the database based on the ID
    $query = "SELECT * FROM scrap WHERE id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("i", $scrap_id);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $productName = $row['scrapname'];
        $quantity = $row['scrapquantity'];
        $pricePerKg = $row['scraprate'];
        $totalPrice = $quantity * $pricePerKg;
    } else {
        die('Scrap request not found.');
    }

    $statement->close();
} else {
    die('ID not specified.');
}

$currentDate = date("Y-m-d");

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Company');
$pdf->SetTitle('Scrap Bill');
$pdf->SetSubject('Scrap Bill');
$pdf->SetKeywords('TCPDF, PDF, bill, scrap');

// Add a page
$pdf->AddPage();

// Set some content to print
$html = <<<EOD
<h3>Your Scrap Bill</h3>
<table border="1" cellpadding="4">
    <tr>
        <td>Billno:</td>
        <td><b style="color:red;">{$scrap_id}</b></td>
    </tr>
    <tr>
        <td>Name of Customer:</td>
        <td><b>{$name}</b></td>
    </tr>
    <tr>
        <td>Date:</td>
        <td>{$currentDate}</td>
    </tr>
    <tr>
        <th>Item</th>
        <th>Quantity</th>
        <th>Price Per Kg</th>
        <th>Total amount</th>
    </tr>
    <tr>
        <td>{$productName}</td>
        <td>{$quantity} Kg</td>
        <td>Rs<b>&nbsp;</b>{$pricePerKg}</td>
        <td>Rs<b>&nbsp;</b>{$totalPrice}</td>
    </tr>
</table>

<p>If you have any questions, feel free to contact us at <span style="color:red;">info@uthaoo.com</span> or at <span style="color:red;">9812345678</span>.</p>

<p>Thank you for choosing our services.<br>
Sincerely,<br>
Team Uthaoo</p>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Close and output PDF document
$pdf->Output('scrap_bill.pdf', 'D');

// Close database connection
$conn->close();
?>
