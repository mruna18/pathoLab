
<div data-role="page" id="pageone">
  <div data-role="main" class="ui-content">
    <a href="welcome.php" class="ui-btn" data-rel="back" style="background-color:black; color:white; width:150px;">Go Back</a>
  </div>
</div> 

<?php
require 'partials/_dbconn.php';
      if(isset($_POST['submit'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        // $gender = $_POST['gender'];
        $username = $_POST['username'];
        $address = $_POST['address'];
        $email = $_POST['email'];;
        $city = $_POST['city'];
        $state = $_POST['state'];
        $phone = $_POST['mob'];
        $birthday = $_POST['dob'];
      $query = "UPDATE `user` SET `fname` = '$fname', `lname` = '$lname',
     `address` = '$address', `email`='$email', `city`='$city', `state`='$state',`mob`='$phone', `dob`='$birthday'
                      WHERE `user`.`username` = '$username'";
                    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                    ?>
                     <script type="text/javascript">
            alert("Update Successfull.");
            // window.location = "index.php";
        </script>
        <?php
             }               
?>
