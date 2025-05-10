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
      $sql = "SELECT `v_id`, `username`, `email`,`test_name`,`fname`,`lname`,`gender`,`sample_collected_at`,`patient_id`,`dob`,`reg_date`,`reg_time`,`investigation`,`observed_value`,`unit`,`biological_ref` FROM `visited_patients` WHERE `visited_patients`.`username`= '$username'ORDER BY 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $username = $row['username']; 
      $email = $row['email'];
      $test_name = $row['test_name'];
      $v_id = $row['v_id'];
      $fname = $row['fname'];
      $lname = $row['lname'];
      $gender = $row['gender']; 
      $sample_collected_at = $row['sample_collected_at'];
      $patient_id = $row['patient_id'];
      $dob = $row['dob'];
      $reg_time = $row['reg_time'];
      $reg_date = $row['reg_date'];
      $investigation = $row['investigation'];
      $observed_value = $row['observed_value'];
      $unit = $row['unit'];
      $biological_ref = $row['biological_ref'];
      

      echo'<div class="container">
      <div class="row">
        <div class="col-lg-12">
        <div class="table-responsive">
    <h3 id="head" class="text-center">Your Test Results are Here!</h3>
    <table  class="table table-bordered table-hover">
    
      
       <th>First Name</th>
         <th>Last Name</th>
         <th>Pateint Id</th>
         <th>Sample Collected At</th>
         <th>Report</th>

         </thead>
    <tbody>
    
    <td>' . $fname .'</td>
    <td>' . $lname .'</td>
    <td>' . $patient_id .'</td>
    <td>' . $sample_collected_at .'</td>
    <td> <form action="Gen_pdf.php" method=post>
            
    <button class="mail btn" style="background-color:#151c48; color:white; width:150px; font-size:16px; border-radius: 12px;" id='. $row['v_id'] .' name="act" >View</button>
    </form></td>';
} else {
    echo "
    <div class='jumbotron jumbotron-fluid' style='background-color: #cdecf4'>
    <div class='container'>
      <h1 class='display-4'>No Test Result Found.</h1>
      <p class='lead'>Start here from Booking Appointment <a href='/pathology/user/welcome.php'>click here</a></p>
    </div>
  </div>
    
    
    ";// Handle the case when the user is not found in the database.
  }
}
else {
  echo "No test results to display";}

  
?>


</body>
</html>

