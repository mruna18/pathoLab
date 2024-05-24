<?php
// session_start();

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>


<!-- db connection -->
<?php
require 'partials/_dbconn.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://localhost/pathology//user/styles.css"/>
</head>
<body>


<!-- UPCOMING APPOINTMENT -LAB-->
<div class="card">
  <div class="card-header" style="background-color: #282727; color: #f2f2f2 ">
    <h4>Your Appointment - Lab
      <button type="button" class="btn btn-light" style="float:right" onclick="window.location.href = 'lab_cancellation.php';">Cancel Appointment</a></button></h4>
  </div>
  <div class="card-content" >
    <ul class='my-2'>

    <?php
  
    if (isset($_SESSION['username'])){
      $username = $_SESSION['username'];
        // $sql = "SELECT `username`, `fee`, `appointmentDate`, `appointmentTime`, `timestamp`, `userStatus`, `updationDate` FROM `lab_appointment` WHERE username = '$username'";
        $sql = "SELECT `username`, `test_name`, `fee`, `appointmentTime`, `appointmentDate`, `timestamp` FROM `lab_appointment` WHERE username='$username'";
        
      $result = $conn->query($sql);
      if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $user = $row['username'];    
        $appointmentDate = $row['appointmentDate'];    
        $appointmentTime= $row['appointmentTime'];
        $test_name= $row['test_name'];
        $fee = $row['fee'];
        

        echo  "<p>Username: $username</p>"; //this was for checking purpose
        echo  "<p>Test name: $test_name</p>"; //ADD THIS IN TABLE
        echo  "<p>Prefered Date: $appointmentDate</p>";
        echo  "<p>Prefered Time: $appointmentTime</p>";
        echo  "<p>Fee: $fee</p>";

        // echo  "<p>Last updated Date: $updationDate</p>";
       
    }
      else {
        echo "No upcoming appointment found."; // Handle the case when the user is not found in the database.
      }
    }
    else {
      echo "Appointment not found in the session.";
    }

?>
    
  </ul>
  </div>
</div>




<!-- UPCOMING APPOINTMENT -HOME-->
<section class="my-3">
<div class="card">
  <div class="card-header" style="background-color: #282727; color: #f2f2f2 ">
    <h4>Your Appointment - Home
    <button type="button" class="btn btn-light" style="float:right" onclick="window.location.href = 'home_cancellation.php';" >Cancel Appointment</button></h4>
  </div>
  <div class="card-content" >
    <ul class='my-2'>

    <?php


    if (isset($_SESSION['username'])){
      $username = $_SESSION['username'];
        // $sql = "SELECT `username`, `fee`, `appointmentDate`, `appointmentTime`, `timestamp`, `userStatus`, `updationDate` FROM `lab_appointment` WHERE username = '$username'";
        $sql = "SELECT `username`, `test_name`, `fee`, `appointmentTime`, `appointmentDate`, `timestamp` FROM `home_appointment` WHERE username='$username'";
        
      $result = $conn->query($sql);
      if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $user = $row['username'];    
        $appointmentDate = $row['appointmentDate'];    
        $appointmentTime= $row['appointmentTime'];
        $test_name= $row['test_name'];
        $fee = $row['fee'];
        

        echo  "<p>Username: $username</p>"; //this was for checking purpose
        echo  "<p>Test name: $test_name</p>"; //ADD THIS IN TABLE
        echo  "<p>Prefered Date: $appointmentDate</p>";
        echo  "<p>Prefered Time: $appointmentTime</p>";
        echo  "<p>Fee: $fee</p>";

        // echo  "<p>Last updated Date: $updationDate</p>";
       
    }
      else {
        echo "No upcoming appointment found."; // Handle the case when the user is not found in the database.
      }
    }
    else {
      echo "Appointment not found in the session.";
    }

?>
    
  </ul>
  </div>
</div>
</section>


<!-- PERSONAL INFORMATION -->
<section class='my-3'>
<div class="card">
  <div class="card-header" style="background-color: #282727; color: #f2f2f2 ">
    <h4>Personal Information</h4>
  </div>
  <div class="card-content">
    <ul class='my-2'>

    <?php
// $user_id = 1;
// $sql = "SELECT `user_id`, `username`, `password`, `reg_time`, `fname`, `lname`, `address`, `gender`, `email` FROM `user` WHERE user_id= '$user_id'";

if (isset($_SESSION['username'])){
  $username = $_SESSION['username'];
    $sql = "SELECT `user_id`, `username`, `password`, `reg_time`, `fname`, `lname`, `address`, `gender`, `email` FROM `user` WHERE username = '$username'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $username = $row['username']; 
    $fname = $row['fname'];
    $lname = $row['lname'];
    $address = $row['address'];
    $gender = $row['gender']; 
    $email = $row['email'];
    $reg = $row['reg_time'];

    // echo  "<p>Username: $username</p>"; //this was for checking purpose
    echo  "<p>First name: $fname</p>";
    echo  "<p>Last name: $lname</p>";
    echo  "<p>Address: $address</p>";
    echo "<p>Email: $email <p>";
    echo "<p>Gender: $gender <p>";
    echo  "<p>Registerd on: $reg<p>";
}
  else {
    echo "User not found."; // Handle the case when the user is not found in the database.
  }
}
else {
  echo "Username not found in the session.";
}

?>

  </ul>
  </div>
</div>
<section>

</body>
</html>