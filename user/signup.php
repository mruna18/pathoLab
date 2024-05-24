<?php
  include 'partials/_dbconn.php';
  $showAlert = false;
  $showDanger = false;
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $mob = $_POST['mob'];
    $dob = $_POST['dob'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $gender = $_POST['gender']; //look for gender radio button so how it will get enter in the db
    $email = $_POST['email'];
    //mobile one please try to fetch noworking

    $existSql = "SELECT * FROM `user` WHERE username= '$username' ";
    $result= mysqli_query($conn,$existSql);
 
    $numExistsRows = mysqli_num_rows($result);
    if ($numExistsRows > 0 ){
        // $exists = true;
        $showDanger = "Username already Exits. ";
    }
    else {
        $exists = false;
        if(($password == $cpassword)){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = " INSERT INTO `user` (`username`, `password`, `reg_time`, `fname`, `lname`, `address`,`mob`,`dob`,`state`,`city`, `gender`, `email`) VALUES ('$username', '$hash', current_timestamp(), '$fname', '$lname', '$address','$mob','$dob','$state','$city','$gender' , '$email');";
        
        $result = mysqli_query($conn,$sql);

        if($result){
            $showAlert = true;
          }
      
      }
      else {
        $showDanger = "Incorrect Password.";
      }
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

  <title>User-Registration</title>

  <style>
    #message {
  display:none;
  color: #000;
  position: relative;
  padding: 10px;
  line-height: 1pt;
}

#message p {
  padding: 10px 35px;
  font-size: 15px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" icon when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
  
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Fieldset */
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

    input {
      margin: 5px;
    }

    /* rounded border */
    #rcorners2 {
      border-radius: 25px;
      border: 2px solid #969695;
      padding: 20px;
      width: 200px;
      height: 150px;
    }

    body {
    background-image: url("background.png"); 
    background-size: cover; 
     background-repeat: no-repeat;
  } 
</style>

</head>

<body>

  <?php
  require 'partials/_nav.php'
  ?>

  <?php 
   if($showAlert){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your Account Is Created. You can now <a href="login.php"> login </a>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
   }
   if($showDanger){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> '. $showDanger.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';

   }
   
    ?>

  <!-- Signup Form -->
  <div class="container " >
    <fieldset class='col-md-10 my-3 container-fluid' style="box-shadow: 10px 10px 5px grey">
      <legend >&nbsp;<strong> SignUp </strong>&nbsp;</legend>
      <hr>
      <!-- <h1 class="text-center">SignUp for the website</h1> -->
      <form action="/pathology/user/signup.php" method="post" class="g-3 needs-validation" novalidate>
        <div class="form-group my-4">
          <!--col-md-6  [for small box]-->
          <!-- Registeration -->

          <h5><strong>Enter Your Personal details below: </strong></h5>
          <div class="row gx-3 mb-3">
          <!-- Form Group (first name)-->
          <div class="col-md-6">
            <label for="fname">First Name </label>
            <input type="text" maxlength="20" class="form-control" id="fname" aria-describedby="usernameHelp"
              name="fname" required style="border: 2px solid #ccc;">
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
          <div class="col-md-6">
            <label for="lname">Last Name </label>
            <input type="text" maxlength="20" class="form-control" id="firstname" aria-describedby="usernameHelp"
              name="lname" required style="border: 2px solid #ccc;">
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
  </div>
          
          <div class="form-group md-6">
            <label for="email">Email </label>
            <input type="email" class="form-control" id="email" name='email' required style="border: 2px solid #ccc;">
            <div class="invalid-feedback">
              Please provide a valid email.
            </div>
          </div>
          <div class="row gx-3 mb-3">
          <!-- Form Group (first name)-->
          <div class="col-md-6">
            <label for="mob">Mobile Number </label>
            <input type="text" class="form-control" id="mob" name='mob' pattern="[7-9]{1}[0-9]{9}" required style="border: 2px solid #ccc;">
            <div class="invalid-feedback">
              Please provide a valid Mobile Number.
            </div>
          </div>
          <div class="col-md-6">
            <label for="dob">Birth Date </label>
            <input type="date" class="form-control" id="dob" name='dob' required style="border: 2px solid #ccc;">
            <div class="invalid-feedback">
              Please provide a valid DOB.
            </div>
          </div>
  </div>

          <div class="form-group md-6">
            <label for="address">Address </label>
            <input type="text" class="form-control" id="address"  name='address' required style="border: 2px solid #ccc;">
            <div class="invalid-feedback">
              Please provide a valid address.
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-5">
              <label for="city">City</label>
              <input type="text" class="form-control" id="city" name="city" required style="border: 2px solid #ccc">
              <div class="invalid-feedback">
                Please provide a valid city.
              </div>
            </div>
            <div class="form-group col-md-4">
              <label for="state">State</label>
              <select id="state" class="form-control"  name="state" required style="border: 2px solid #ccc;">
                <option> </option>
                <option>Maharastra</option>
                <option>Delhi</option>
                
                <option>Kerla</option>
                <option>Goa</option>
                <option>Uttar Pradesh</option>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="pin">Pin Code</label>
              <input type="integer" class="form-control" id="pin" required style="border: 2px solid #ccc;">
            </div>
            <div class="invalid-feedback">
              Please provide a valid Pin.
            </div>
          </div>
          <div>
            <label>Gender</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="female" value="F" <?php if (isset($gender) && $gender=="female") echo "checked";?> required style="border: 2px solid #ccc;">
            <label class="form-check-label" for="female">
              Female
            </label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="Male" value="M" <?php if (isset($gender) && $gender=="male") echo "checked";?> style="border: 2px solid #ccc;">
            <label class="form-check-label" for="Male">Male
            </label>
          </div>

          <hr>
          <h5><strong>Enter your User deatils below:</strong></h5>
          <div class="md-4">
            <label for="username" class="form-label">Username </label>
            <div class="input-group has-validation">
              <input type="text" maxlength="20" class="form-control" id="username" aria-describedby="usernameHelp"
                name="username" required style="border: 2px solid #ccc;">
              <div class="invalid-feedback">
                Please choose a username.
              </div>

            </div>
      
            <div class="md-4">
            <label for="password">Password</label>
            <input
              type="password"
              maxlength="20"
              name="password"
              class="form-control"
              id="password"
              style="border: 2px solid #ccc;"
              pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
              title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
              required
              >
              <div id="message">
  <h6>Password must contain the following:</h6>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>
          </div>
            <div class="md-4">
              <label for="cpassword">Confirm Password</label>
              <input type="password" name="cpassword" class="form-control" id="cpassword" required style="border: 2px solid #ccc;">
              <div id="cpassword" class="form-text"><small>Write the same password written above.</small></div>
            </div>
            <div class="text-center">
            <button type="submit" class="btn" style="background-color:#151c48; color:white; width:150px; font-size:16px; border-radius: 12px;">SignUp</button>
            <div><small>Already have account? <a href="login.php">login</a></small></div>
  </div>
      </form>

    </fieldset>
  </div>

  <!-- footer -->
   <div class="container-fluid text-light " style="background-color:#151c48; height:50px;">
  <p class="text-center py-2 my-0">Copyright The PathoLab-2023 | All Right Reserved </p>
</div>

<?php
// require 'partials/_footer.php';
?>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
  </script>

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
  var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
</body>

</html>