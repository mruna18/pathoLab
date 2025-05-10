<?php
require 'partials/_dbconn.php';
session_start();
$username = $_SESSION['username'];
$select="SELECT * FROM visited_patients WHERE `visited_patients`.`username`= '$username'";
$run=$conn->query($select);
// if(!$run)die("Error".mysqli_error());
if ($run->num_rows > 0){
    $row = $run->fetch_assoc();
        $contentinvoice=
       '
       <!DOCTYPE html>
       <html>
       <head>
           <meta charset="UTF-8">
       <style>
           footer{
               position: fixed; 
                       bottom: 100px; 
                       left: 0px; 
                       right: 0px;
                       height: 50px; 
             }
             body {
         background-image: url("MJ.jpeg");
         background-size: cover;
         opacity: 1.0;
       }
       </style>
       </head>
       <body>
       <div>
           <table>
               <tr>
                   <td>
                       <p>
                       <strong style="font-size:35px; color:#5ce1e6;">The PathoLab</strong>
                   </p>
                   </td>
                   <td><img  style="float: right;  margin-top:0px; margin-left: 18em; width:170px;" src="pathoLab.jpeg"  alt="My Image"></td>
               </tr>
           </table>
       <p style="display:inline-block; color:#004AAD;">
           <i><b>where excellence in diagnostics meets compassionate healthcare!</b></i>  
       </p>
       </div>
       <hr>
       
       <h4><u>Patients Demographics</u></h4>
       
       
           <table style="width:100%">
               <tr>
                 <td><b>Name:</b></td>
                 <td>'.$row['fname'].'</td>
                 <td><b>Gender: </b></td>
                 <td>'.$row['gender'].'</td>
               </tr>
               <tr>
                   <td><b>Date of Birth:</b></td>
                   <td>'.$row['dob'].'</td>
                   <td><b>Patient Id: </b></td>
                   <td>'.$row['patient_id'].'</td>
               </tr>
               <tr>
                   <td><b>Sample Collected at:</b></td>
                   <td>'.$row['sample_collected_at'].'</td>
                   <td><b>Registration Date: </b></td>
                   <td>'.$row['reg_date'].'</td>
               </tr>
               <tr>
                   <td><b>Registration Time:</b></td>
                 <td>'.$row['reg_time'].'</td>
                 <td><b>Refered By: </b></td>
                 <td>Dr. MJ</td>
               </tr>
             </table>
             <br>
       <hr>
       <p style="text-align: center;"><strong ><u>'.$row['test_name'].'</u></strong></p>
       <table style="width:100%">
           <tr>
             <th>Investigation</th>
             <th>Observed Value</th>
             <th>Unit</th>
             <th>Biological Reference</th>
           </tr>
           <tr>
             <td>'.$row['investigation'].'</td>
             <td>'.$row['observed_value'].'</td>
             <td>'.$row['unit'].'</td>
             <td>'.$row['biological_ref'].'</td>
           </tr>
         </table>
         <div style="text-align: center;">
         <p>***End Of Report***</p>
       </div>
         <div>
         
         <footer>
         <div style="background-color: pink; width: 50px; height: 100%; margin-bottom: 50px;"  >
        
            <img src="s.png" alt="stamp is there" width="140px" margin-bottom:80px; >
        </div>
           
               <p>Checked by
                   <br>
                   <b>(Pathologist)</b>
               </p>
               
           <hr>
           <!-- Copyright -->
           <p> <strong>Phone:</strong> +91 7892-234-567<br>
               <strong>Email:</strong><a href="add the mail link idk"> thepatholab@gmail.com</a><br>
               <strong>Address: </strong> 1234 Greenwood Street, Mumbai, Maharastra<br>
             
               <strong>In-Person:</strong> Visit our The Patho Lab location to speak with a customer service representative in person.
           </p>
               <!-- Copyright -->
         
         </footer>
       </div>
       </body>
       </html>';
    }

require ('C:\xampp\htdocs\pathology\admin\dompdf\vendor\autoload.php ');

use Dompdf\Dompdf;
use Dompdf\Options;

$dompdf = new Dompdf();
$options = new Options;
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);
// $options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
 $dompdf->load_html(ob_get_clean());
 $dompdf->load_html($contentinvoice, 'UTF-8');
 $dompdf->set_paper('A4');
 $dompdf->render();
 $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
