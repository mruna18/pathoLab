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


?>
