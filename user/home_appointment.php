<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <title>Home Service</title>

    <style>

    body{
      background-color:#48e6c8;
    }
    </style>
    
  </head>
  <body>
    <?php
      include 'partials/_nav.php';
    ?>
    
    <img src="/pathology/img/home_service.png" alt="home service header" width=100%  >
    <!-- <button class="btn" type="button" href="/pathology/user/home_registeration.php" >Book Appointment</button> -->

    <hr style="border: 1px  purple">
    <div class="container my-5" >
<div class="text-center" style="margin-bottom:10px;">
      <h2>Book the Appointment</h2><button type="button" class="btn btn-info"  data-toggle="modal" data-target="#Modal" style="background-color:#151c48; color:white; width:200px; font-size:16px; border-radius: 12px;">
  
        <!-- <a href="home_registeration.php" style="color:black">Make Appointment</a> -->
        Make Appointment
      </button>
      </div>
      
      <!-- modal -->
        <!-- The Modal -->
  <div class="modal fade" id="Modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">To make the Home Appointment</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        To ensure a smooth appointment booking process, we kindly request you to log in first. By doing so, you can effortlessly secure your preferred time slot.
        <a href="login.php" class="link">login here</a>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <!-- Modal ended -->
      
      <br><hr>
      <div class="card">
        <div class="card-header">
        <h4>The Patho Lab's Home Service</h4>
          <p>
          The Patho Lab offers the convenience of home sample collection services. We understand that some patients may find it challenging to visit our center, so we have a dedicated team that can collect samples from your home.
</br>
          Our home service covers a wide range of tests, including blood tests, urine tests, and more. To book a home sample collection, please call our customer care team at the number provided below, or you can fill out the conta</strong> ct form for inquiries and appointment requests.
          </p>
        </div>
  </div>
    <div class="card my-3">
    <div class="card-header"><h4>Contact Information</h4></div>
            <div class="card-body">
              <p>
              <strong>Phone: </strong>+91 7892-234-567
    <br>
    <strong>Email: </strong> thepatholab@customercare.com
    <br>
    <strong>Address: </strong> 1234 Greenwood Street, Mumbai, Maharastra
    </p>
   
            </div>
          </div>
          </div>

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
        
   
 




    <?php
    require 'partials/_footer.php';
    ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  </body>
</html>