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

<!-- MAIN  -->
<div class="container my-3">
<?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['usernameEdit']) && isset($_POST['emailEdit'])) {
        $username = $_POST['usernameEdit'];
        $email = $_POST['emailEdit'];
        $fee = $_POST['feeEdit'];
        $extra_charge = $_POST['extra_chargeEdit'];
        $test_name = $_POST['test_nameEdit'];
        $appointmentDate = $_POST['appointmentDateEdit'];
        $total=$fee+$extra_charge;
        // Generate a unique invoice number using JavaScript
        echo '<script>';
        echo 'var invoiceNumber = generateInvoiceNumber();';
        echo '</script>';

        // Email details
        $to_email = $email;
        $subject = "Payment Request - Invoice $invoiceNumber from ThePathoLab";
        $body = 
        "
        Dear $username,

        We are sending you a simulated payment request on behalf of ThePathoLab. Designed to demonstrate the payment process related to your recent pathology services.

        - Invoice Number: $invoiceNumber
        - Date Issued: $appointmentDate
        - Due Date: [Due Date]
        - Fee of Test Rs. $fee.00
        - Extra Charges Rs. $extra_charge.00
        - Total Amount Due: Rs. $total.00

        Invoice Details:
        - Pathology Service 1: Rs. $total.00
        ...
        Total Amount Due: Rs. $total.00

        Payment Instructions:
        This is a simulated payment request for educational purposes, and no actual payment is required. You can simply acknowledge this email as a demonstration of a payment request in the context of pathology services provided by ThePathoLab.

        If you have any questions or need further information about our pathology services or this educational project, please don't hesitate to contact us at 789654321.

        Thank you for your participation in our educational initiative and your interest in ThePathoLab.

        Best regards,
        ThePathoLab
        ";
        $headers = "From: thepatholabmj@gmail.com";

        // Attempt to send the email
        if (mail($to_email, $subject, $body, $headers)) {
            echo "<div class='jumbotron'>
            <h1 class='display-4'>To, user $username!</h1>
            <p class='lead'><b>The Email successfully sent to $to_email...</b></p>
            <hr class='my-4'>
            <a class='btn btn-info btn-lg' href='apt_managementHome.php' role='button'>Back</a>
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
