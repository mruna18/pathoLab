<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Include Bootstrap CSS and JavaScript libraries -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // This JavaScript code generates a unique invoice number
        function generateInvoiceNumber() {
            // Static prefix (you can customize this)
            var prefix = 'INV';

            // Generate a timestamp (or use the current date/time)
            var timestamp = Math.floor(Date.now() / 1000); // UNIX timestamp in seconds

            // Create a unique invoice number by combining the prefix and timestamp
            var invoiceNumber = prefix + '-' + timestamp;

            return invoiceNumber;
        }
    </script>
</head>
<body>

<!-- MAIN -->
<div class="container my-3">
<?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['usernameEdit']) && isset($_POST['emailEdit'])) {
        $username = $_POST['usernameEdit'];
        $email = $_POST['emailEdit'];
        $fee = $_POST['feeEdit'];
        $test_name = $_POST['test_nameEdit'];
        $appointmentDate = $_POST['appointmentDateEdit'];
       
        // Generate a unique invoice number using JavaScript
        echo '<script>';
        echo 'var invoiceNumber = generateInvoiceNumber();';
        echo '</script>';
    }
}
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['usernameEdit']) && isset($_POST['emailEdit'])) {
        $username = $_POST['usernameEdit'];
        $email = $_POST['emailEdit'];
        $fee = $_POST['feeEdit'];
        $test_name = $_POST['test_nameEdit'];
        $appointmentDate = $_POST['appointmentDateEdit'];
         // Retrieve the current date
        $currentDate = date('Y-m-d'); // You can customize the date format as needed
        // Retrieve the invoice number from the POST data
        $invoiceNumber = isset($_POST['invoiceNumber']) ? $_POST['invoiceNumber'] : '';
        // Email details
        $to_email = $email;
        $subject = "Payment Request - Invoice $invoiceNumber from ThePathoLab";
        $body = 
        "
        Dear $username,

        Please find the invoice details for pathology services provided by ThePathoLab:
        
        - Invoice Number: $invoiceNumber
        - Date Issued: $currentDate
        - Due Date: $appointmentDate
        - Total Amount Due: Rs. $fee.00
        
        Invoice Details:
        - Pathology Service 1: Rs. $fee.00
        ...
        Total Amount Due: Rs. $fee.00

        To settle the invoice, please visit the following URL: http://localhost/pathology/user/payment_page.php
        
        For any inquiries or additional information, please contact us at 789654321.
        
        Thank you for choosing ThePathoLab for your pathology needs.
        
        Best regards,
        ThePathoLab Team";
        $headers = "From: thepatholabmj@gmail.com";

        // Attempt to send the email
        if (mail($to_email, $subject, $body, $headers)) {
            echo "<div class='jumbotron'>
            <h1 class='display-4'>To, user $username!</h1>
            <p class='lead'><b>The Email successfully sent to $to_email...</b></p>
            <hr class='my-4'>
            <a class='btn btn-info btn-lg' href='apt_management.php' role='button'>Back</a>
            </div>";
        } else {
            echo "Email sending failed...";
        }
    }
}
?>
</div>

</body>
</html>
