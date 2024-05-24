<?php
session_start();
// connection
include 'partials/_dbconn.php';

$showAlert = false;
$showDanger = false;
$is_available = false;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['username'])){
        $username = $_POST['username'];
    }
    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }
    if(isset($_POST['fee'])){
        $fee = $_POST['fee'];
    }
    if(isset($_POST['extra_charge'])){
      $extra_charge= $_POST['extra_charge'];
  }
    if(isset($_POST['test_name'])){
        $test_name = $_POST['test_name'];
    }
    if(isset($_POST['appointmentTime'])){
        $appointmentTime = $_POST['appointmentTime'];
    }
    if(isset($_POST['appointmentDate'])){
        $appointmentDate = $_POST['appointmentDate'];
    }

    $is_available = true;
    if ($is_available) {
      $sql = "INSERT INTO `home_appointment` (`username`,`email`, `test_name`, `fee`,`extra_charge`, `appointmentTime`,`appointmentDate`, `timestamp`) VALUES ('$username','$email', '$test_name', '$fee','$extra_charge', '$appointmentTime', '$appointmentDate', current_timestamp());";

      $result = mysqli_query($conn, $sql);
      
      if ($result) {
        // Data inserted successfully
        // Redirect to the confirmation page or display a success message
        header("Location: home_reg_process.php"); 
        exit();
      } else {
        echo "Error inserting data into the database.". mysqli_error($conn);
      }
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="styles.css">
   
        
    <title>Appointment</title>
  </head>
  <body>

 
<!--   THIS ISN'T IN USE AS IT IS GETTING DIRECTED TO THE CONFORMATION PAGE SO 
  <?php 
   if($showAlert){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your appointment is done.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
   }
   if($showDanger){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> '. $showDanger.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';

   }
   
    ?> -->


    <div class="container my-3">
        <div class="card">
            <div class="card-header" style="color:white; background-color:black;">
                Fill the details for Home Appointments<br>
                <small><span class="badge badge-warning">Extra charges will be applied for home appoinment!</span></small>
            </div>      
        </div>
    </div>

    <!-- Appointment Form -->
    <div class="container my-4 ">
    <fieldset class='col-md-12 container-fluid'  style="background-color: #f2f2f2; box-shadow: 10px 10px 5px grey;" >
      <!-- <legend>&nbsp; Login &nbsp;</legend> -->
      <br>
   <h4><b>Appointment for Home Testing</b></h4>
   <hr>
<!-- /pathology/user/demo.php     process-->
 <form action="home_registeration.php" method="post">
<div class="form-group ">
<!-- <div class="form-group">
             <label for="type">Test Type:</label><br>
             <select id="type" name="type" required>
                 <option value="">Select a Type</option>
                 <option value="type1">Heart</option>
                 <option value="type2">Liver</option>
                 <option value="type3">Kidney</option>
                 <option value="type4">Tyroid</option>               
             </select>
         </div> -->

<!-- <div class="form-group">
 <label for="username" name="username" >username:<?php //echo''. $_SESSION['username'] .'';?> </label>
 <input type="text" name="username" id="username">
 <input type="text" class="form-control" id="username" aria-describedby="username" required readonly>
</div> -->


<div class="form-group">
    <label for="username"><strong>Username: <?php echo $_SESSION['username']; ?></strong></label>
    <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
</div>
<!-- <div class="form-group">
    <label for="email">Email: <?php echo $_SESSION['email']; ?></label>
    <input type="email" name="email" value="<?php echo $_SESSION['email']; ?>">
</div> -->
<div class="form-group">
    <label for="email">Email: </label>
    <input type="email" name="email" aria-describedby="email" required>
    <small style="color:red;">Enter the correct email to receive appointment confirmation and payment link mail!</small>
</div>

<div class="form-group">
             <label for="test_name">Test Name:</label><br>
             <select id="test_name" name="test_name" required onchange="updateFeeAndExpiration()">
             <option value="">Select the test</option>
             <option value="Complete Blood Count Test (CBC)">Complete Blood Count Test (CBC)</option>
             <option value="Lipid Profile - Basic">Lipid Profile - Basic</option>
             <option value="C-Reactive Protein (CRP) Test">C-Reactive Protein (CRP) Test</option>
             <option value="Serum Glutamic Pyruvic Transam">Serum Glutamic Pyruvic Transam</option>
             <option value="Liver Function Test (LFT)">Liver Function Test (LFT)</option>
             <option value="Cardiac Injury Profile-Mini">Cardiac Injury Profile-Mini</option>
             <option value="Cardiac Test">Cardiac Test</option>
             <option value="Lipid Profile -MINI">Lipid Profile -MINI</option>
             <option value="Lipid Screen Cholesterol and Triglycerides Serum">Lipid Screen Cholesterol and Triglycerides Serum</option>
             <option value="Routine Examination Urine">Routine Examination Urine</option>
             <option value="Renal (Kidney) Function Tests">Renal (Kidney) Function Tests</option>
             <option value="Stone screening profile">Stone screening profile</option>
             <option value="Liver Function Test-3 (LIVER SCREEN)">Liver Function Test-3 (LIVER SCREEN)</option>
             <option value="Liver Function Test-2">Liver Function Test-2</option>
             <option value="TSH (Ultrasensitive) ECLIA Serum">TSH (Ultrasensitive) ECLIA Serum</option>
             <option value="Thyroid Panel-3 (Reflex)">Thyroid Panel-3 (Reflex)</option>
             <option value="Thyroid Panel-4">Thyroid Panel-4</option>
             </select>
         </div>

<!-- <div class="form-group">
 <label for="fee">Fee: </label>
 <input type="text" class="form-control" id="fee" aria-describedby="fee" required readonly>
</div> -->

<div class="form-group ">
 <label for="appointmentDate">Preferred Date: </label>
 <input class="form-control "  type="date" name="appointmentDate" min="2023-09-01" max="2023-12-31" aria-describedby="prefer_date" data-date-format="yyyy-mm-dd" required>
 <small>time you want to vist the lab for test</small>
</div>

  <div class="form-group ">
  <label for="appointmentTime">Preferred Time: </label>
  <input class="form-control" type="time" id="appointmentTime" min="08:00" max="19:00" aria-describedby="prefer_date" name="appointmentTime" required>
  eg : 10:00 PM
  <small>time you want to vist the lab for test</small>
  </div> 
  <!-- book appointment -->
<div class="text-center">
<button type="submit" class="btn" style="background-color:#151c48; color:white; width:250px; font-size:16px; border-radius: 12px;">Book Appointment</button>
  </div>
      <br><br>

      <div class="form-group" >
         <label for="fee">Fee: </label>
         <input type="text" class="form-control" id="fee" name="fee" aria-describedby="fee" readonly required style="border: 1px solid #000">
      </div>

      <div class="form-group" >
         <label for="extra_charge">Extra Charge: </label>
         <input type="number" class="form-control" id="extra_charge" name="extra_charge" aria-describedby="extra_charge" value="200" readonly required style="border: 1px solid #000">
      </div>
      <div class="form-group">
        <label for="test">Test Sample: </label>
        <input type="name" class="form-control" id="test" aria-describedby="name" placeholder="Blood Test" disabled style="border: 1px solid #000">
      </div>
      <!-- EXPIRE DATE KA NAHI HORA t_t -->
      <!-- <div class="form-group">
         <label for="expirationDate">Expiration Date: </label>
         <input type="text" class="form-control" id="expirationDate" name="expirationDate" readonly required>
      </div> -->
   </form>
</div>
  </fieldset>
 </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <script>
    function updateFeeAndExpiration() {
        var selectedTest = document.getElementById("test_name").value;
        var feesField = document.getElementById("fees");
        var expirationField = document.getElementById("expirationDate");

        // Define the fee values for different tests
        var feeMapping = {
            "TSH (Ultrasensitive) ECLIA Serum": 380,
            "Complete Blood Count Test": 399,
            "Thyroid Panel-3 (Reflex)": 400,
            "Thyroid Panel-4": 440,
            "Lipid Profile - Basic": 324,
            "C-Reactive Protein (CRP) Test": 400,
            "Serum Glutamic Pyruvic Transam": 100,
            "Liver Function Test (LFT)": 650,
            "Liver Function Test-3 (LIVER SCREEN)": 575,
            "Liver Function Test-2": 1100,
            "Routine Examination Urine": 165,
            "Renal (Kidney) Function Tests": 1100,
            "Stone screening profile": 2150,
            "Lipid Screen Cholesterol and Triglycerides Serum": 450,
            "Cardiac Test": 1400,
            "Lipid Profile -MINI": 800,
            "Cardiac Injury Profile-Mini": 1400
            
        };

        // Update the fee field based on the selected test
        if (feeMapping.hasOwnProperty(selectedTest)) {
            feesField.value = feeMapping[selectedTest];
        } else {
            feesField.value = ""; // Clear the fee field if no test is selected
        }

  
    }
</script> 

<!-- <script>
let x = updateFeeAndExpiration();
let z = x + 200;
document.getElementById("demo").innerHTML = z;
</script>
 -->

   
  </body>
</html>

