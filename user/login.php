<?php
$login = false;
$showDanger = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      include 'partials/_dbconn.php';
    
      $username= $_POST['username'];
      $password = $_POST['password'];

      $sql = " SELECT * FROM `user` WHERE username = '$username' " ;
      $result = mysqli_query($conn,$sql);
      //for record to fetch
      $num = mysqli_num_rows($result);
      if($num == 1){
        while ($row = mysqli_fetch_assoc($result)) {
          if (password_verify($password,$row['password'])){
            $login = true;
            // session start
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
  
            // to redirect the page
            header("location: welcome.php ");
  
          }
          else  {
            $showDanger = "Invalid Credentials";
          }
        }
          }

  else  {
    $showDanger = "Invalid Credentials";
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
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <style>
    body {
    background-image: url("background.png"); 
    background-size: cover; 
    background-repeat: no-repeat;
    
  } 
  fieldset {
      background-color: #151c48;
      border: 2px solid #151c48;
      border-radius: 10px ;
      background-image: url("main.png"); 
      background-size: cover; 
     /* background-repeat: no-repeat; */
    
    }

    legend {
      background-color:#151c48;
      color:#f2f2f2;
      padding: 5px 10px;
      display: block;
      padding-left: 2px;
      padding-right: 2px;
      border:2px solid rgb(224, 205, 205);
      border-radius: 5px;
      width: auto;
      
    }

    
  </style>

    <title>PMS</title>
   
  </head>
  <body>
   
  <?php
  require 'partials/_nav.php';
  ?>
  <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
  <a class="navbar-brand mb-0 h1" href="/pathology/index.php">The Patho Lab(temp)</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav> -->
  



  <?php 
   if($login){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your Logged In.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
   }
   if($showDanger){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Invalid Credentials.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';

   }
   
    ?>
    
<!-- Login form -->
<div class="container my-5"  >
    <fieldset class='col-md-6 container-fluid'  style="background-color: #f2f2f2; box-shadow: 10px 10px 5px grey; background-image: url('main.png');  background-repeat: no-repeat; border:solid 1px" >
      <legend>&nbsp; Login &nbsp;</legend>
    
    <!-- After clicking on btn where it will go is the path in actions -->
      <form action="/pathology/user/login.php" method="post" class="g-3 needs-validation" novalidate> 
        <div class="form-group my-4 "> <!--col-md-6  [for small box]-->
          <label for="username" ><b>User Name</b> </label>
          <input type="text" class="form-control" id="username" aria-describedby="usernameHelp" name="username" required style="border: 1px solid #000;">
          <div class="invalid-feedback">
                Invalid username.
          </div>
          
        </div>
        <div class="my-3">
          <label for="password" ><b>Password</b></label>
          <input type="password" name="password" class="form-control" id="password" required style="border: 1px solid #000;">
          <div class="invalid-feedback">
                Invalid password.
          </div>
          <input type="checkbox" onclick="myFunction()"><small>Show Password </small>
          <br>
          
        </div>
        <div class="text-center">
        
        <button type="submit" class="btn" style="background-color:#151c48; color:white; width:150px; font-size:16px; border-radius: 12px;">Login</button><br>
        <small><b>Forgot Password?</b> <a href="forgot_password.php">click here.</a></small>  
      </div>
        <hr>
        <small>Do not have account? <a href="signup.php">Create an account.</a></small>
        <br><br>
      </fieldset>
    </form>
  </div>
    <!-- footer -->
<?php
 include 'partials/_footer.php';
?>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  <script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function(form) {
        form.addEventListener('submit', function(event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
  })()
  </script>

  <script>
  function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
  </script>

  </body>
</html>