<!DOCTYPE html>
<html>
<head>
  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
#head, #btnn{
  display: inline-block;
}

  th{
    background-color: #373737;
    color: white;
  }
    tr:nth-child(odd) {
            background-color:#C5C6D0;
        }
        </style>

</head>
<body>

<?php
include("partials/_dbconn.php");

session_start();
if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
      $sql = "SELECT `sno`,`username`,`email`,`payment_date` from `payment` WHERE `payment`.`username`= '$username' ORDER BY 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $sno=$row['sno']; 
      $username = $row['username']; 
      $email=$row['email'];
      $pay_date=$row['payment_date'];
      
      

      echo'<div class="container">
      <div class="row">
        <div class="col-lg-12">
        <div class="table-responsive">
    <h3 id="head" class="text-center">Payment History</h3>
    <table  class="table table-bordered table-hover">
    <thead>
       <th>Username</th>
         <th>Email</th>
         <th>Payment Date</th>
         <th>View</th>
    </thead>
    <tbody>
    
    <td>' . $username .'</td>
    <td>' . $email .'</td>
    <td>' . $pay_date .'</td>
    <td> <form action="receipt_genPDF.php" method=post>
            
    <button class="mail btn" style="background-color:#151c48; color:white; border-radius: 12px;" id='. $row['sno'] .' name="act" >View</button>
    </form></td>
    </tbody>';
    
} else {
  echo "
  <div class='jumbotron jumbotron-fluid' style='background-color: #cdecf4'>
  <div class='container'>
    <h1 class='display-4'>No Payment History.</h1>
    <p class='lead'>Start here from Booking Appointment <a href='/pathology/user/welcome.php'>click here</a></p>
  </div>
</div>
  "; // Handle the case when the user is not found in the database.
  }
}
else {
  echo "
  <div class='jumbotron jumbotron-fluid' >
  <div class='container'>
    <h1 class='display-4'>No Data Found</h1>
    <p class='lead'>Start here from Booking Appointment <a href='user/lab_appointment.php'>click here</a></p>
  </div>
</div>
  
  
  ";}

  
?>


</body>
</html>

