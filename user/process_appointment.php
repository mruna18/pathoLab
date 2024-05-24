<?php

// session_start();

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// connection
include 'partials/_dbconn.php';

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Appointment Conformation</title>
  </head>
  <body>
    <?php
      include 'partials/_nav.php';
    ?>
    <!-- <h1>Appointment</h1> -->

    <div class="container my-3">
        <div class="card">
            <div class="card-header">
                The Confirmation page
            </div>     
            <div class="card-body">
              <?php
                if (isset($_SESSION['username'])){
                  $username = $_SESSION['username'];

                  // $sql = " SELECT `appointment_id`,`username`,`email`, `test_name`, `fee`, `appointmentTime`, `appointmentDate`, `timestamp` FROM `lab_appointment` WHERE username='$username'";

                  $sql ="select * from lab_appointment order by appointment_id desc limit 1;";

                  $result = $conn->query($sql);
                  if ($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $username = $row['username'] ;
                    $test_name = $row['test_name']; 
                    $fee= $row['fee'] ;
                    $appointmentDate=  $row['appointmentDate'] ;
                    $appointmentTime=  $row['appointmentTime']; 
                    $email =  $row['email'];
                
                   
                    echo  "<p>Username: $username</p>";
                    echo  "<p>Test Name: $test_name</p>";
                    echo  "<p>Fee: $fee</p>";
                    echo "<p>Date: $appointmentDate <p>";
                    echo "<p>Time: $appointmentTime <p>";
                    echo  "<p>Email: $email<p>";
                    // Display "Pending" if status is blank
                    // echo "<p>Status: " . ($status !== '' ? $status : 'Pending') . "</p>";
                    // echo "<p>Status: " . $status . "</p>";
                }
                  else {
                    echo "Appointment not found."; 
                  }
                }
                else {
                  echo "Appointment not found in the session.";
                }
              
                ?> 

<button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#conformModal">Request for conformation</button>
            </div>     
        </div>

        <button class="btn btn-secondary hBack my-3" type="button">Back</button>
    </div>
    


    <div class="container">
<!-- Modal -->
<!-- <div class="modal fade" id="conformModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NOTICE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <p> Thank You for choosing <b>The Patho Lab Services! </b></p>
    <p> A conformation mail will be send to your provided email from <a href="gmaillink">thepatholab@gmail.com</a> within <u>2 hours</u> of reqisteration.</p>
     <p> <mark>if not recieved please contact The Patho Lab customer service</mark></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> -->



<!-- Modal -->
<div class="modal fade" id="conformModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">NOTICE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p> Thank You for choosing <b>The Patho Lab Services! </b></p>
          <p> A conformation mail will be send to your provided email from <a href="gmaillink">thepatholabmj@gmail.com</a> within <u>2 hours</u> of reqisteration.</p>
          <p> <mark>if not recieved please contact The Patho Lab customer service</mark></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    </div>

<div class="container-fluid bg-dark text-light fixed-bottom">
  <p class="text-center py-2 my-0">&copy;  ThePathoLab-2023 | All Right Reserved </p>
</div>
   
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <script>
      // JS for back but it brings back to entire dashboard wala page but still works
      $(".hBack").on("click", function(e){
          e.preventDefault();
          window.history.back();
      });
    </script>
   
  </body>
</html>
