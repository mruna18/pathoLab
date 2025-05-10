<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'C:\xampp\htdocs\pathology\phpmailer\vendor\autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$email=$_POST["emailGenn"];
try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'thepatholabmj@gmail.com';                     //SMTP username
    $mail->Password   = 'jywtgjloqifuwefd';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('thepatholabmj@gmail.com', 'ThePathoLab');
    $mail->addAddress($email);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('thepatholabmj@gmail.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Pathology Report Generated';
    $mail->Body    = "Dear Client,
    <p>
    We hope this message finds you well. We wanted to inform you that your pathology report has been successfully generated. Kindly review it at your earliest convenience, and if you have any questions or require further assistance, please don't hesitate to contact us.
    </p><br>
    Thank you for choosing our services.
    <br>
    Best regards,
    <br>
    ThePathoLab,
    thepatholabmj@gmail.com
    +91 7892-234-567";
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

