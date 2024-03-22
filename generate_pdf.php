<?php
require_once('tcpdf/tcpdf.php');
// Include TCPDF library

// Function to generate PDF
function generatePDF($name, $productName, $quantity, $collectionDates) {
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Acceptance Letter');
    $pdf->SetSubject('Acceptance of Scrap Collection Request');
    $pdf->SetKeywords('Scrap, Acceptance, Collection, PDF');

    // Set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 011', PDF_HEADER_STRING);

    // Set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Add a page
    $pdf->AddPage();

    // Set some content to display
    $content = '<h2 style="text-align: center;">Acceptance Letter</h2>';
    $content .= '<p>Dear '.$name.',</p>';
    $content .= '<p>We are pleased to inform you that your scrap collection request has been accepted.</p>';
    $content .= '<p>The details of your scrap collection are as follows:</p>';
    $content .= '<ul><li>Product Name: '.$productName.'</li><li>Quantity: '.$quantity.' Kg</li></ul>';
    $content .= '<p>The scrap will be collected on the following dates:</p>';
    $content .= '<ul>';
    foreach ($collectionDates as $date) {
        $content .= '<li>'.$date.'</li>';
    }
    $content .= '</ul>';
    $content .= '<p>Please ensure that the scrap is ready for collection on the specified dates.</p>';
    $content .= '<p>If you have any questions or concerns, feel free to contact us at uthaoonepal@gmail.com or at 9812345678.</p>';
    $content .= '<p>Thank you for choosing our services.</p>';
    $content .= '<p>Sincerely,</p>';
    $content .= '<p>Team Uthaoo</p>';

    // Write the content to the PDF
    $pdf->writeHTML($content, true, false, true, false, '');

    // Close and output PDF
    $pdf->Output('acceptance_letter.pdf', 'D');
}

// Database connection
$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrapx') or die('connection failed');

// Fetch data from the database based on the ID
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
        $name = $row['name']; // User name
        $productName = $row['scrapname']; // Scrap product name
        $quantity = $row['scrapquantity']; // Quantity of scrap
        $collectionDates = array("March 15, 2024", "March 16, 2024"); // Scrap collection dates (example)

        // Call the function to generate PDF
        generatePDF($name, $productName, $quantity, $collectionDates);
    } else {
        echo "Scrap request not found.";
    }

    $statement->close();
} else {
    echo "Invalid request.";
}

// Close database connection
$conn->close();
?>
