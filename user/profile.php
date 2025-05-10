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
  <!-- db connection -->
<?php
require 'partials/_dbconn.php';

 
// Starting the session, necessary
// for using session variables
session_start();
if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
      $sql = "SELECT * FROM `user` WHERE username = '$username'";
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
      $state = $row['state'];
      $mob= $row['mob'];
      $dob = $row['dob'];
      $city = $row['city'];
    

echo'

<hr class="mt-0 mb-4">
    <div class="row">

        <div class="col-xl-8" style="background-color:#f2f2f2; box-shadow: 10px 10px 5px grey; margin-left:170px; margin-bottom:60px;>
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header"><strong>Account Details</strong></div>
                <div class="card-body">
                <form action="profileupdate.php" method="post">
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Username</label>
                            <input class="form-control" id="inputUsername" type="text" name="username" placeholder="Enter your username" value="' . $username .'">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">First name</label>
                                <input class="form-control" id="inputFirstName" type="text" name="fname" placeholder="Enter your first name" value=' . $fname .'>
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Last name</label>
                                <input class="form-control" id="inputLastName" type="text" name="lname" placeholder="Enter your last name" value="' . $lname .'">
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                  
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">City</label>
                                <input class="form-control" id="inputOrgName" type="text" name="city" placeholder="Enter your city" value="' . $city .'">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">State</label>
                                <input class="form-control" id="inputOrgName" type="text" name="state" placeholder="Enter your state" value="' . $state .'">
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Address</label>
                                <input class="form-control" id="inputLocation" type="text"  name="address" placeholder="Enter your address" value="' . $address .'">
                            </div>

                            <div class="col-md-6">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <input class="form-control" id="inputEmailAddress" type="email" name="email" placeholder="Enter your email address" value="' . $email .'">
                            </div>
                        </div>
                        <!-- Form Group (email address)-->

                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control" id="inputPhone" type="tel" name="mob" placeholder="Enter your phone number" value="' . $mob .'">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <input class="form-control" id="inputBirthday" type="text" name="dob" placeholder="Enter your birthday" value="' . $dob .'">
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <div class="text-center">
                        <button class="btn" style="background-color:#151c48; color:white; width:150px; font-size:16px; border-radius: 12px;" type="submit" name="submit">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
   ';
    } else {
        echo "User not found."; // Handle the case when the user is not found in the database.
      }
    }
    else {
      echo "Username not found in the session.";}
    ?>
</body>
</html>


            