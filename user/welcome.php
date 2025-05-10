<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  
  header("location: login.php");
  exit;
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

   <!-- awesome font -->
    <script src="https://kit.fontawesome.com/351dd8f265.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    

    <title><?php echo''. $_SESSION['username'] .' - Dashboard ';?></title>


  </head>
  <body>

    <!-- <div class="container my-3" >
      <div class="alert alert-success" role="alert">
    <h4 class="alert-heading"> <?php echo 'WELCOME!!  '. $_SESSION['username'].'! to your Dashboard'?></h4>
    <p>Hey how are you doing? Welcome . You are logged in as  <?php echo $_SESSION['username']?>!
    Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
    <hr>
    <p class="mb-0">Whenever you need to, be sure to logout <a href="/pathology/user/logout.php" > using this link.</a></p>
  </div>
    </div> -->

    <!--navbar-->
    <!-- need for will leave out some space -->
    <?php
    require 'partials/_navDashboard.php';
    ?>

  <div class="content">
  <div class="card" style= "background:rgb(126 128 130 / 86%)" >
      <div class="card-body">
      <h1>Welcome  <?php echo $_SESSION['username']?>!</h1>
      </div>
    </div>
    <header>
      <!-- <h1>Welcome  <?php echo $_SESSION['username']?>!</h1> -->
    </header>

    <!--sidebar  -->      
   <?php
       include 'partials/_navDashboard.php';
    ?>
        
    <!-- to show content -->
    <section id="main-content">
    <?php include 'dashboard.php'; ?> <!-- by default welcome page-->
    </section>

    </div>
   
    <!-- footer -->
  <div class="container-fluid bg-dark text-light fixed-bottom">
    <p class="text-center py-2 my-0">Copyright The PathoLab-2023 | All Right Reserved </p>
  </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    
    <script>
    function updateFeeAndExpiration() {
        var selectedTest = document.getElementById("test_name").value;
        var feesField = document.getElementById("fee");
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

        // Calculate the expiration date (appointment date + 2 days)
        var appointmentDate = new Date(document.getElementById("appointmentDate").value);
        var expirationDate = new Date(appointmentDate);
        expirationDate.setDate(expirationDate.getDate() + 2);

        // Format the expiration date as YYYY-MM-DD
        var formattedExpirationDate = expirationDate.toISOString().split('T')[0];
        // document.getElementById("expirationDate").value = formattedExpirationDate;

        expirationField.value = formattedExpirationDate;

        
    }
</script>



    <!-- Script for onclicking performance of the dashboard content area -->
    <script src="script.js"></script>

  </body>
</html>

