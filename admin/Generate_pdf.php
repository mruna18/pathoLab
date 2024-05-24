<?php
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;
// require 'C:\xampp\htdocs\pathology\vendor\autoload.php';
require ('C:\xampp\htdocs\pathology\admin\dompdf\vendor\autoload.php ');

use Dompdf\Dompdf;
use Dompdf\Options;

// if(isset($_POST["action"]))
// {
$v_id = $_POST['v_idGen'];
$email=$_POST["emailGen"];
$test_name=$_POST["test_nameGen"];
  $fname=$_POST["fnameGen"];
  $lname=$_POST['lnameGen'];
  $gender=$_POST['genderGen'];
  $sample_collected_at=$_POST['sample_collected_atGen'];
  $patient_id=$_POST['patient_idGen'];
  $dob=$_POST['dobGen'];
  $reg_date=$_POST['reg_dateGen'];
  $reg_time=$_POST['reg_timeGen'];
  $investigation = $_POST['investigationGen'];
  $observed_value = $_POST['observed_valueGen'];
  $unit = $_POST['unitGen'];
  $biological_ref = $_POST['biological_refGen'];

  $file_name= 'MedicalReport.pdf';
  $encoding='base64';
  $type='application/pdf';

  

$options = new Options;
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);
// $options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

$dompdf->setPaper("A4", "potrait");

/**
 * Load the HTML and replace placeholders with values from the form
 */
//$dompdf->loadHtmlFile("report_template.html");
$html = file_get_contents("report_template.html");
$html = str_replace(["{{ test_name }}","{{ fname }}", "{{ lname }}","{{ gender }}","{{ sample_collected_at }}","{{ patient_id }}","{{ dob }}","{{ reg_date }}","{{ reg_time }}","{{ investigation }}","{{ observed_value }}", "{{ unit }}","{{ biological_ref }}"], [$test_name,$fname,$lname, $gender,$sample_collected_at,$patient_id,$dob,$reg_date,$reg_time,$investigation,$observed_value,$unit,$biological_ref ], $html);
$dompdf->loadHtml($html);

/**
 * Create the PDF and set attributes
 */
$dompdf->render();
$dompdf->addInfo("Title", "Medical Report");
/**
 * Send the PDF to the browser
 */
$dompdf->stream("invoice.pdf", ["Attachment" => 0]);
/**y
 * Save the PDF file locally
 */
$output = $dompdf->output();
file_put_contents($file_name, $output);

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

//Create an instance; passing `true` enables exceptions
// $mail = new PHPMailer(true);

// try {
//     //Server settings
//     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
//     $mail->isSMTP();                                            //Send using SMTP
//     $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//     $mail->Username   = 'thepatholabmj@gmail.com';                     //SMTP username
//     $mail->Password   = 'jywtgjloqifuwefd';                               //SMTP password
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
//     $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//     //Recipients
//     $mail->setFrom('thepatholabmj@gmail.com', 'Mailer');
//     $mail->addAddress('janhavi1102singh@gmail.com', 'Joe User');     //Add a recipient
//     // $mail->addAddress('ellen@example.com');               //Name is optional
//     $mail->addReplyTo('thepatholabmj@gmail.com', 'Information');
//     // $mail->addCC('cc@example.com');
//     // $mail->addBCC('bcc@example.com');

//     //Attachments
//     $mail->addAttachment($file_name);         //Add attachments
//     $mail->addStringAttachment($output,$file_name,$encoding,$type);    //Optional name

//     //Content
//     $mail->isHTML(true);                                  //Set email format to HTML
//     $mail->Subject = 'Here is the subject';
//     $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//     $mail->send();
//     echo 'Message has been sent';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }
// require 'C:\xampp\htdocs\pathology\vendor\phpmailer\phpmailer\src\PHPMailer.php';
//  $mail = new PHPMailer;
//  $mail->IsSMTP();        //Sets Mailer to send message using SMTP
//  $mail->Host = 'smtpout.secureserver.net';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
//  $mail->Port = '80';        //Sets the default SMTP server port
//  $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
//  $mail->Username = 'thepatholabmj@gmail.com';     //Sets SMTP username
//  $mail->Password = 'jywtgjloqifuwefd';     //Sets SMTP password
//  $mail->SMTPSecure = '';       //Sets connection prefix. Options are "", "ssl" or "tls"
//  $mail->From = 'thepatholabmj@gmail.com';   //Sets the From email address for the message
//  $mail->FromName = 'The PathoLab';   //Sets the From name of the message
//  $mail->AddAddress($email);  //Adds a "To" address
//  $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
//  $mail->IsHTML(true);       //Sets message type to HTML    
// //  $mail->AddAttachment($file_name); 
//  $mail->addStringAttachment($output,$file_name,$encoding,$type);        //Adds an attachment from a path on the filesystem
//  $mail->Subject = 'Customer Details';   //Sets the Subject of the message
//  $mail->Body = 'Please Find Customer details in attach PDF File.';    //An HTML or plain text message body
//  if($mail->Send())        //Send an Email. Return true on success or false on error
//  {
//   $message = '<label class="text-success">Customer Details has been send successfully...</label>';
//  }
//  unlink($file_name);
// }
?>
