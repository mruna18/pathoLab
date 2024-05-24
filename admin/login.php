<?php
$login = false;
$showDanger = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      include 'partials/_dbconn.php';
    
      $admin_name= $_POST['admin_name'];
      $admin_pass = $_POST['admin_pass'];

      $sql = " SELECT * FROM `admin` WHERE admin_name = '$admin_name' " ;

      $result = mysqli_query($conn,$sql);
      //for record to fetch
      $num = mysqli_num_rows($result);

      // if($num == 1){

        while ($row = mysqli_fetch_assoc($result)) {

          // if (password_verify($admin_pass,$row['admin_pass'])){
            $login = true;
            // session start
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['admin_name'] =$admin_name;
  
            // to redirect the page
            header("location: welcome_a.php ");
  
          // }
          
          // else  {
          //   $showDanger = "Invalid Credentials";
          // }
        
        }
      // }

        // else{
        //   $showDanger = "Invalid Credentials";
        // }
      
  }

    // INSERT INTO `admin` (`sno`, `admin_name`, `admin_pass`, `tstamp`) VALUES (NULL, 'add2', '4567', current_timestamp());

    ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Admin Login</title>
    <style>
    body {
    background-image: url("background.png");
    background-size: cover; 
    background-repeat: no-repeat;
  }
  fieldset {
      background-color: #f2f2f2;
      border: 2px solid #151c48;
      border-radius: 10px ;
      background-image: url("main.png"); 
      background-size: cover; 
     background-repeat: no-repeat;
     height:350px;
     box-shadow: 10px 10px 5px grey;
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
  </head>
  <body>
   
    <?php
    require 'partials/_navbar.php';
    ?>

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
<div class="container my-3">
<fieldset class='col-md-6 container-fluid'>
    <legend class="text-center my-2"> &nbsp; Login &nbsp;</legend>
    <!-- After clicking on btn where it will go is the path in actions -->
      <form action="/pathology/admin/login.php" method="post" class="g-3 needs-validation" novalidate> 
        <div class="form-group my-4 "> <!--col-md-6  [for small box]-->
          <label for="admin_name" ><b>Admin Name</b> </label>
          <input type="text" class="form-control" id="admin_name" aria-describedby="unameHelp" name="admin_name" required style="border: 2px solid #ccc;">
          <div class="invalid-feedback">
                Invalid admin name.
          </div>
          
        </div>
        <div class="my-3">
          <label for="admin_pass" ><b>Password</b></label>
          <input type="password" name="admin_pass" class="form-control" id="admin_pass" required style="border: 2px solid #ccc;">
        </div>
        <div class="invalid-feedback">
                Invalid password.
          </div>
        
          <div class="text-center">
        <button type="submit" class="btn" style="background-color:#151c48; color:white; width:150px; font-size:16px; border-radius: 12px;">Login</button>
  </div>
      </form>
      
</fieldset>
    </div>

    <!-- footer -->
<?php
 require 'partials/_footer.php';
?>


    <!-- Optional JavaScript; choose one of the two! -->

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
  </body>
</html>