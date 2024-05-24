<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Test on Liver</title>

  </head>
  <body>
  <?php
      // connection
      include 'partials/_dbconn.php'; 
  ?>
  <?php
    //nav bar
    include 'partials/_nav.php';
  ?>
 


<div class="container my-3 ">
  <div class="row" style="width: 100%; background-color: : #fbf7f7;">
   <div style=" width: 15%;">
      <img src="img/liver.png" alt="liver">
    </div>
  <div style=" width: 80%;">
   <h4> Liver</h4>
    <p>

    Liver tests, also known as liver function tests or liver chemistries, are carried out to diagnose liver damage and associated diseases. The tests typically involve drawing blood samples to measure specific proteins, enzymes, and other substances produced by the liver.
<br>

Liver tests, also known as liver function tests or liver chemistries, are carried out to diagnose liver damage and associated diseases. The tests typically involve drawing blood samples to measure specific proteins, enzymes, and other substances produced by the liver.</p>
  </div>
</div>
</div>
<hr>
<div class="container">
<div class="row p-md-3 justify-content-lg-center">
<?php 
      $sql = "SELECT * FROM `liver_test`";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)){
        
        $id=  $row['test_id'];
        $test = $row['test_name'];
        $overview = $row['overview'];
        $cost = $row['cost'];
        echo '
              <div class="card" style="width: 15rem; margin-left: 20px; background-color: #cdecf4">
        <div class="card-body">
          <h5 class="card-title"> ' . $test . '</h5>
          <p class="card-text"> Rs. '.$cost.'</p>
          </div>

          <div class="card-footer">
          <a href="high-risk-liver.php?liverid=' . $id .' " class="btn" style="background-color:#151c48; color:white; border-radius: 12px;">Book</a>
        </div>
      </div>';


      }
    ?>

</div>  
</div>

<hr>
<div  style="background-color:#151c48;">
<div class="card" style="background-color:#151c48; color:white;">
      <div class="card-footer" >
       <h5 style="text-align: center"> Terms & Conditions</h5>
       <hr>
        <p>
          <ul>
<li>By applying for The Patho Lab's Home Service, you are allowing The Patho Lab counsellor to call you back at your convenient time.</li>
<li>Our Health counsellor will guide you in process selection of a test or health checkup as per your requirement and assist you to a home visit appointment.</li>
<li>Once you confirm your booking, one of our trained Phlebotomists will be assigned to visit your home/ office on given date and time for the collection of samples.</li>
<li>Your sample will then be transported to the nearest collection center and will be centrifuged before sending to the lab for processing.</li>
<li>Once the results are processed in the The Patho Lab's Lab, our medical experts at Metropolis will verify the results will be shared with you via email or you can download the report by login into our website -<a href="/pathology/index.php"> www.ThePathoLab.com</a></li>
<li>In case of any queries, you can reach our customer support team by calling at +91 7892-234-567 or write an email at <a href=""> thepatholab@customercare.com</a>.</li>
<li>Thank you for choosing The Patho Lab. By entering your phone number, you agree that we may send you text notifications to send offers test or health checkup reminders. By signing up you provide your consent to receive communication from The Patho Lab.</li>
<li><mark>For Home Visit Appointment <i style="color:red">Rs. 200 </i>will be charged. </mark></li>
</ul>
</p>
        <br> 
        
      </div>
      <hr>
        </div>
        </div>
<?php
require 'partials/_footer.php';
?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <!-- for tooltip -->
    <!-- <script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });
    </script> -->

  </body>
</html>