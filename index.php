<?php
// Establish a database connection
include 'partials/_dbconn.php';

$alert= FALSE;
$preAlert = FALSE;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['submitContact'])) {
    // Handle contact form data
    $name = $_POST['name'];
    $mob = $_POST['mob'];
    $message = $_POST['message'];
    
   $sql1= "INSERT INTO `contact`(`name`, `mob`, `message`, `tstamp`) VALUES ('$name','$mob','$message',current_timestamp())";
  
  
  $result = mysqli_query($conn, $sql1);

  if ($result) {
    // Data inserted successfully
    // echo "
    // <div class='container' >
    // <div class='alert alert-success alert-dismissible fade show' role='alert' style='margin-top:50px;'>
    // <strong>Success!</strong> Message Send successfully.
    // <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    // <span aria-hidden='true'>&times;</span>
    // </button>
    // </div>
    // </div>
    // ";
    $alert= TRUE;
  } else {
    // Error inserting data
    echo "Error: " . mysqli_error($conn);
  }

    
  } elseif (isset($_POST['submitPrescription'])) {
    // Handle prescription upload form data
    $patient = $_POST['patient'];
    $patient_email = $_POST['patient_email'];
    $mob = $_POST['mob'];
    
    // Check if a file was uploaded
  if (!empty($_FILES['file']['name'])) {
    // session_start();
    $file_name = basename($_FILES['file']['name']);
    $fileSize = $_FILES["file"]["size"];
    $tmpName = $_FILES["file"]["tmp_name"];
    $uploadDirectory = 'uploads/'; // Relative path to the "uploads" directory
    $targetFilePath = $uploadDirectory . $file_name;
    
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    
    if (in_array($fileType, $allowTypes)) {
      // Upload file to server
      if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
        // File uploaded successfully, now insert data into the database
        $sql = "INSERT INTO `uploaded_prescription` (`patient`, `patient_email`, `mob`, `file_name`, `uploaded_on`) VALUES ('$patient', '$patient_email', '$mob', '$file_name', current_timestamp())";
        $result = mysqli_query($conn, $sql);

        if ($result) {
          // Data inserted successfully
          // echo "
          // <div class='alert alert-success alert-dismissible fade show' role='alert'>
          //   <strong>Success!</strong> Data inserted successfully.
          //   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          //     <span aria-hidden='true'>&times;</span>
          //   </button>
          // </div>
          //           ";
          $preAlert = TRUE;
        } else {
          // Error inserting data
          echo "Error: " . mysqli_error($conn);
        }
      } else {
        // File upload failed
        echo "Sorry, there was an error uploading your file.";
      }
    } else {
      // Invalid file format
      echo 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
    }
  } else {
    // No file selected for upload
    echo 'Please select a file to upload.';
  }
    
  }
}
?>

<!-- modal for prescription -->
<div class="container">
  <!-- The Modal -->
  <div class="modal fade" id="presModal">
    <div class="modal-dialog" style="width: 1250px;">
      <div class="modal-content">
        <div class="modal-header"  style="background-color:cdecf4">
          <h4 class="modal-title"> To Choose the Test...</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- Modify the form action to point to the current page -->
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="patient"><i class="fa-solid fa-user"></i> Patient Name</label>
              <input type="text" class="form-control" name="patient" id="patient" aria-describedby="patient_emailHelp" required>
            </div>
            <div class="form-group">
              <label for="patient_email"><i class="fa-solid fa-inbox"></i> Email address</label>
              <input type="email" class="form-control" name="patient_email" id="patient_email" aria-describedby="patient_emailHelp" required>
              <small style="color:red;">We'll never share your email with anyone else.</small >
            </div>
            <div class="form-group">
              <label for="mob"><i class="fa-solid fa-phone"></i> Mobile Number</label>
              <input type="text" class="form-control" name="mob" id="mob" pattern="[7-9]{1}[0-9]{9}" required >
            </div>
            <div class="form-group">
              <label for="exampleFormControlFile1"><i class="fa-solid fa-clipboard"></i> Upload the prescription</label>
              <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1" accept=".jpg, .jpeg, .png" value="" required>
            </div>
            <button type="submit"  name="submitPrescription"  class="btn" style="background-color:#151c48; color:white; border-radius: 12px;">Upload</button>
          </form>
        </div>
        
        <div class="modal-footer"  style="background-color:#cdecf4">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal ended -->
</div>

</div>

<!-- ################################################## Main ######################################### -->

<!DOCTYPE html>
<html lang="en" id="csstag">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    
    <link rel="icon" type="image/x-icon" href="img/favicon.ico" >

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="CSS\style.css">
      <link
      rel=" stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
      integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
      crossorigin="anonymous"/>

   <!-- awesome font -->
   <script src="https://kit.fontawesome.com/351dd8f265.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- font -->
    <style>
    body{
      /* font-family: 'DM Serif Display', serif; */
      /* font-family: 'Raleway', sans-serif; */
      /* font-family: 'Roboto', sans-serif; */

      font-family: 'AR One Sans', sans-serif;       

    }  
    
    </style>
    
    

    <!-- about us part -->
    <style>
      .social-links{
    position: absolute;
    right: 40%;
    bottom: 20%;
}
.social-links::before{
    /* content: ""; */
    width: 80%;
    height: 3px;
    position: absolute;
    top:42%;
    left: -150px;
    background-color: #494234;
}
.social-links i{
    margin-left: 10px;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background-color: #cdecf4;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: 0.5s;
}
.social-links i:hover{
    transform: translateY(-5px);
}
  
.panel-footer {
 margin-top: 30px;
 padding-top: 35px;
 padding-bottom: 30px;
 background-color: #151c48;
 border-top: 0;
 color: white;
}
.panel-footer div.row {
 margin-bottom: 35px;
}
#hours, #address {
 line-height: 2;
}
#hours > span, #address > span {
 font-size: 1.3em;
}
#address p {
 color: #FFFFFF;
 font-size: .8em;
 line-height: 1.8;
}
#testimonials {
 font-style: italic;
}
#testimonials p:nth-child(2) {
 margin-top: 25px;
}
     .collapsible {
      background-color: #777;
      color: white;
      cursor: pointer;
      padding: 18px;
      width: 100%;
      border: none;
      text-align: left;
      outline: none;
      font-size: 15px;
    }
    .collapsible:after {
      content: '\02795'; /* Unicode character for "plus" sign (+) */
      font-size: 13px;
      color: white;
      float: right;
      margin-left: 5px;
    }

    .active:after {
      content: "\2796"; /* Unicode character for "minus" sign (-) */
    }
     .active, .collapsible:hover {
      background-color: #555;
    }

    .content {
      padding: 0 18px;
      display: none;
      overflow: hidden;
      background-color: #f1f1f1;
      transition: max-height 0.2s ease-out;
    }

  /* for the section */
#fig img{
  width:200px;
  height:150px;
}
    .box {
  padding: 20px;
  border-radius: 5px;
  margin: 10px;
  position: relative;
  overflow: hidden;
  transition: transform .8s all ease-in-out;
  border: 2px solid pink;
  background-color: #fff;
  
}

.box:hover{
  transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
  }  

  /* a:hover {
  background-color: #373d64;
} */

body {
    background-image: url("img/1.png");
    background-size: cover; /* Adjust the background size as needed */
    background-repeat: no-repeat;
  }
/* for top 3 gole */
  .bx{
    margin-top:-7px;
    display: flex;
    align-items: center;
}
.right .bx .imge img{
    width: 100%;
}
/* for about us ke 5 gole */

.box1{
 
  margin-left: 10px;
  border-radius: 50%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    transition: 0.5s;
    background-color:white;
}

.image1:hover{
    background-color: #fbd221;
}
.box1 .image1 img{
    width: 100%;
}

.image1{
  border-radius: 50%;
  box-shadow: -5px 5px 17px rgba(0,0,0,0.3);
  display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.5s;
    width: 80px;
    height: 80px;
}
 
.imge {
    margin-top: 2rem;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    /* background:# */
    box-shadow: -5px 5px 17px rgba(0,0,0,0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.5s;
}
.imge:hover{
    background-color: #FFFFFF
}
.bx .inner-box{
    margin: 1.5rem 0 0 1rem;
}
.bx .inner-box p{
  
    font-size: 10px;
    font-weight: 500;
}

/* .main-text button{
    margin-top: 2.5rem;
    outline: none;
    border: none;
    font-size: 18px;
    padding: 0.5rem 2.5rem 0.5rem 1rem;
    border-radius: 0 50% 50% 0;
    background-color: #fff;
    color: #000;
    cursor: pointer;
} */

nav ul a{
    text-decoration: none;
    padding: 0.3rem 1.3rem;
    /* font-size: 17px; */
    font-weight: bold;
    color: #494234;
    position: relative;
    z-index: 1;
}
nav ul a::after{
    content: "";
    width: 0%;
    height: 100%;
    position: absolute;
    top:0;
    left:0px;
    border-radius: 20px;
    background-color: #373d64;
    z-index: -1;
    transition: 0.5s;
}
nav ul a:hover:after{
    width: 100%;
}

/* Ribbon */

.btnR {
  border: none;
  border-radius: 5px;
  padding: 12px 20px;
  font-size: 14px;
  cursor: pointer;
  background-color: #343a40;
  color: white;
  position: relative;
}

.ribbon {
  width: 60px;
  font-size: 12px;
  padding: 4px;
  position: absolute;
  right: -25px;
  top: -12px;
  text-align: center;
  border-radius: 25px;
  transform: rotate(20deg);
  background-color: red;
  color: white;
}
.glow {
  color: #fff;
  text-align: center;
  animation: glow 1s ease-in-out infinite alternate;
}

@-webkit-keyframes glow {
  from {
    text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;
  }
  
  to {
    text-shadow: 0 0 20px #fff, 0 0 30px #ff4da6, 0 0 40px #ff4da6, 0 0 50px #ff4da6, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6;
  }
}


  </style>

<title>The Patho Lab</title>
  </head>

  <body>
    
  <nav class="navbar navbar-expand-lg navbar-light p-md-2 fixed-top " style="background-color:#151c48">
     <a class="navbar-brand ml-3" href="#">
      <img src="img/logo1.png" alt="logo" width="150" height="60">
     </a> 
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav m-auto  " >
          <li class="nav-item ">
          <h5>  <a class="nav-link" href="#"  style="color:#f2f2f2">Home <span class="sr-only">(current)</span></a></h5>
          </li>
    
          <li class="nav-item">
          <h5><a class="nav-link" href="#highrisk" style="color:#f2f2f2">About Us</a></h5>
          </li>
          
          <li class="nav-item">
          <h5><a class="nav-link" href="#footer" style="color:#f2f2f2">Contact Us</a></h5>
          </li>
          <!--<li class="nav-item">
            <a class="nav-link" href="#login">Logins</a>
          </li>-->
          <h5><li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false" style="color:#f2f2f2">
          Logins
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="user/login.php">User Login</a>
          <a class="dropdown-item" href="admin/login.php">Admin Login</a>
          <div class="dropdown-divider"></div>
          
        </div>
      </li></h5>
          
        </ul>
  
      <!-- <button class="btnR" >Now we provide home appoinment facility<span class="ribbon">NEW</span></button> -->
     
        <a href="/user/login.php" class="btn btn-info mr-2" data-toggle="modal" data-target="#loginModal">Book Appointment</a>

       
        <a href="user/signup.php" class="btn btn-outline-info mr-3">Sign Up</a>
        <!-- <a href="user/login.php" class="btn btn-outline-light m-2">Login</a> -->
        

      </div>
        
    </nav>
  
    

<div class="container">
   <!-- The Modal for Book Appointment DIrected to login -->     
  <div class="modal fade" id="loginModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
      
        <div class="modal-header"  style="background-color:cdecf4">
          <h4 class="modal-title">To make the Appointment</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body">
        To ensure a smooth appointment booking process, we kindly request you to log in first. By doing so, you can effortlessly secure your preferred time slot.
        <a href="user/login.php" class="link"><mark><b>Login here</b></mark></a>
        </div>
        <div class="modal-footer"  style="background-color:#cdecf4"> 
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <!-- Modal ended -->
</div>

<!-- Modal for contact us (lets start)-->
<div class="container">  
  <div class="modal fade" id="contactus">
    <div class="modal-dialog">
      <div class="modal-content">
      
      
        <div class="modal-header"  style="background-color:cdecf4">
          <h4 class="modal-title">Contact Us</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body">
        <div class="container">
        <form method="POST" action="">
          <div class="form-group">
          <div class="form-group">
            <label for="name"><i class="fa-solid fa-user"></i> Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
            <label for="mob"><i class="fa-solid fa-phone"></i> Mobile Number</label>
            <input type="text" class="form-control" id="mob" aria-describedby="mobHelp" name="mob" pattern="[7-9]{1}[0-9]{9}" required>
            
          </div>
          <div class="form-group">
            <label for="message"><i class="fa-solid fa-envelope"></i> Message</label>
            <br>
          <textarea name="message" id="message" cols="52" rows="6" required></textarea>
          </div>
        <button type="submit" class="btn" name="submitContact" style="background-color:#151c48; color:white; border-radius: 12px;">Submit</button>
      </form>
        </div>
        </div>
        <div class="modal-footer"  style="background-color:#cdecf4">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <!-- Modal ended -->
</div>

<!-- Modal ends -->

  <div class="container">
<!-- Modal  cutomer care -->
<div class="modal fade" id="contact" role="dialog">
 <div class="modal-dialog modal-lg">
   <div class="modal-content">
     <div class="modal-header" style="background-color:#cdecf4">
       <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
       <h4 class="modal-title"><strong>Welcome to The Patho Lab Customer Service!</strong></h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>

     </div>
     <div class="modal-body">
       <p> 
At <mark>ThePathoLab</mark>, we prioritize your health and well-being. Our dedicated customer service team is here to assist you every step of the way, ensuring a seamless and comfortable experience during your pathology testing journey. Whether you have questions about our services, need assistance with scheduling, or want to understand your test results, we're here to help.
<hr>
<strong><mark>Our Services:</mark></strong>
<br>
<strong>1. Scheduling and Appointment Assistance:</strong> Our customer service representatives are available to help you schedule appointments for your tests, ensuring convenient time slots that work best for you. 
<br>
<strong>2. Test Information and Preparation:</strong> Unsure about the preparations needed for a specific test? Our team can provide you with detailed information about the test requirements, fasting guidelines, and any other necessary preparations.
<br>
<strong>3. Billing and Insurance Queries:</strong> Have questions about billing, payment methods, or insurance coverage? We can guide you through the billing process, assist with insurance-related inquiries, and provide cost estimates for tests.
<br>
<strong>4. Results Explanation:</strong> Once your test results are ready, we can help you understand what the results mean, explain any medical terminology, and address any concerns you might have.
<br>
<strong>5. Follow-up and Consultation:</strong> If your results require further attention or consultation with a medical professional, we can assist you in scheduling follow-up appointments and providing the necessary information.
       <hr>

        <strong><mark>Your Feedback Matters:</mark></strong>
<br>
At The Patho Lab, we are committed to continuously improving our services. If you have any feedback, suggestions, or concerns, please feel free to reach out to our customer service team. Your input helps us provide you with the best possible experience.
<br>
<strong>Thank you for choosing The Patho Lab for your healthcare needs. We look forward to serving you and ensuring your testing process is smooth and stress-free.</strong>
       </p>
     </div>
     <hr>
     <div class="modal-footer"  style="background-color:#cdecf4">
       <a data-dismiss="modal" class="btn btn-warning" style="cursor: pointer;">Close</a>
     </div>
   </div>
 </div>
</div>
</div>
  </div>
<!-- Ended the modal and contact us part -->
<!-- <hr> -->
<!-- Start of Special TesT -->
<!-- <h2>Special Test</h2> -->
<!-- End OF Special Test -->


<!-- Book Test -->
<!-- <section>
  <div class="container my-3" id="bookTest">
    <h2 class="text-center mb-4">Book Test</h2>
    <div class="row">

    
      <?php
      // include 'user/bookTest.php';
      ?>

      
      </div>
    </div>
</section> -->
    <!-- Book Test ends -->

<!-- ################################ end of Navbar ################################# -->


<!-- ################################ start of display page ################################# -->

 <div style=" width: auto; height: 700px; background-image: url('img/3.png');
background-size: cover; background-repeat: no-repeat;margin-top:80px;">

<div class="container">
<div style="width: 100%; height: 400px;">

<?php
if($alert){
  echo "
  
  <div class='alert alert-success alert-dismissible fade show' role='alert''>
  <strong>Success!</strong> Message Send successfully.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
  </button>
  </div>
  ";
  
}

if($preAlert){
  echo"
  
  <div class='alert alert-success alert-dismissible fade show my-3' role='alert' >
            <strong>Success!</strong> Data inserted successfully.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
  
  ";

}

?>
  <div style="float: left;width: 50%;height: 0px;  background-color:red">
    <div class="container" >
    <div class="main-text" >
     <h1 style="font-size: 60px;letter-spacing: 1px;
      color: #ffffff; font-family: 'DM Serif Display', serif;
" >ThePathoLab</h1>
      <p style="margin-top: 10px;
      font-size: 15px;
      letter-spacing: 1px; color: #ffffff;">Your health is our priority, and we are here to serve you.</p>
      <button type="button" class="btn btn-light" data-toggle="modal" data-target="#contactus">Let's Start</button>
      <div class="my-3" style="color: #f8f9fa; ">
      <i class="fa-solid fa-phone" > +91 7892-234-567</i>
      </div>
      <div>
      <a href="user/home_appointment.php" class="glow" style="color:#f2f2f2">The Patho Lab's Home Service</a>
      </div>
      </div>
   </div>
  </div>
  <!-- jsdiojglkdsmg,sg, -->

  
<!-- ### SERVICES ###-->

<div style="float:right; width: 50%; height:0px ;color:#f2f2f2; background-color:green">
<div class="right" style="margin-left:150px;" >
            <div class="bx">
                <div class="imge">
                  <img src="img/wp.png">
                </div>
                <div class="inner-box">
                  <h3>100+</h3>
                <h6>Instruments use for QC monitoring</h6>
                </div>
            </div>
            <div class="bx">
                <div class="imge">
                  <img src="img/pp.png">
                  
                </div>
                <div class="inner-box">
                  <h3> 5+</h3>
                    <h6>Quality indicator monitor on daily basis</h6>
                    
                </div>
            </div>
            <div class="bx">
                <div class="imge">
                  <img src="img/tt.png">

                </div>
                <div class="inner-box">
                  <h3>4.5 avg.</h3>
                    <h6> 
                      lab serviced
                      rating.</h6>
                    
                </div>
            </div>
         </div>
         </div>
</div>
</div>

<!-- ### UPLOAD PRESCRPTION ### -->
<div style="display: flex; height: 500px;" class="my-3">
  <div style="flex: 1; height: 250px;">
  <div style="width: 18rem; margin-left: 200px; background-color:#cdecf4">
        <div >
          <h4>Don't know which test to choose?</h4>
          <a href="" class="btn btn-primary " data-toggle="modal" data-target="#presModal"  style="background-color:#151c48;">Upload Prescription..</a>
          <p>Already know which test to choose? <br><a href="#highrisk">click here</a></p>
        </div>
        <p>
      </div>

</div>


  <div style="flex: 1; ; height: 250px;">
  

  <div class="my-4" style="width:450px; margin-left: 120px;">
  <h4>Search the test available!!!</h4>
    <div  class="my-3">
      
        <form method="GET" style="background-color:#FFCC70">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search test" style="border-color:#151c48;">
                <div class="input-group-append">
                    <input type="submit" class="btn btn-info" value="Search">
                </div>
            </div>
        </form>

    

        <?php
        // Check if the search form is submitted
        if (isset($_GET['search'])) {
            // Get the search term from the form
            $searchTerm = $_GET['search'];

            // Establish a database connection
            include 'partials/_dbconn.php';

            // SQL query to search for items containing the search term
            $sql = "SELECT * FROM test WHERE test_name LIKE '%$searchTerm%'";

            // Execute the query
            $result = $conn->query($sql);

            // Display search results as a dropdown
            if ($result->num_rows > 0) {
              echo "<h4>Search Results:</h4>";
              echo '<select class="form-control">';
              while ($row = $result->fetch_assoc()) {
                  echo '<option value="' . $row['test_name'] . '">' . $row['test_name'] . '</option>';
              }
              echo '</select>';
          } else {
              echo "<p>No results found</p>";
          }

            // Close the database connection
            $conn->close();
        }
        ?>
    </div>
</div>


  </div>
</div>
 </div>
 
</div>


</div>
<!-- ################################ end of display page################################# -->


<!-- ################################ start of high risk################################# -->


    <!-- High Test Tests for particular body part -->
    <div class="container mt-3" id="highrisk">
      <div class="row" >
    <div class="container">
      <!-- <h3 class="text-center">Test for High Risk</h3> -->
      <h3 class="text-center">
        <img src="img/4.png" alt="">
      </h3>
      <div class="container" style="display: flex; justify-content: center;">
      <div class="row">
      <div class="box">
      <a href="user/heart_test.php"><img src="img/heart.png" alt="heart" data-toggle="tooltip" title="Heart"  width="140px" ></a> 
      </div>
      <div class="box">
      <a href="user/liver_test.php"><img src="img/liver.png" alt="liver" data-toggle="tooltip" title="Liver"  width="140px"></a> 
      </div>
      <div class="box">
      <a href="user/kidney_test.php">  <img src="img/kidney.png" alt="kidney" data-toggle="tooltip" title="Kidney"  width="140px"></a> 
      </div>
      <div class="box">
      <a href="user/tyroid_test.php"><img src="img/tyroid1.png" alt="tyroid" data-toggle="tooltip" title="Thyroid" width="140px"></a> 
      </div>
      </div>
    </div>
    <div class="text-center">
    <a href="user/bookTest.php" class="btn" style="background-color:#151c48; color:white; font-size:18px; border-radius: 12px;">View More Tests</a>
      </div>
    </div>


  </div>
</div>
<!-- ################################ end  of high risk################################# -->
<hr>
<!-- ################################ start of about us################################# -->

    <!-- about us -->
    <div style="margin-top:40px; margin-bottom:40px; background-image: url('img/8.png');background-size: cover;background-repeat: no-repeat; height:69%" id="aboutus" >
    <h3 class="text-center">
        <img src="img/6.png" alt="" width="150px"> </h3>
        <div class="container" style="justify-content: center; font-size:17px; float:left; margin-left: 60px; width:950px;  margin-top:100px; color:#fff">
          <p>Welcome to The Patho Lab, where excellence in diagnostics meets compassionate healthcare. Our commitment to accurate and timely pathology services is at the heart of everything we do. We are dedicated to providing you with a seamless experience from sample collection to comprehensive diagnostics.
          At The Patho Lab, our mission is to empower individuals with the knowledge they need to make informed decisions about their health. We strive to deliver accurate and reliable pathology results that aid in early detection, diagnosis, and treatment, ultimately contributing to improved patient outcomes.
          </p>
          <h3 style="margin-bottom:35px;">ThePathoLab's Quality</h3>
<div class="container" width="550px">
          <div class="box1">
                <div class="image1">
                  <!-- <img src="img/a1.png"> -->
                  <img src="img/a1.png" data-toggle="tooltip" title="Accurate Diagnostics"  width="100px"  height=100%>
                </div>
          </div>
          <div class="box1">
                <div class="image1">
                <img src="img/a2.png" data-toggle="tooltip" title="Timely Results"  width="100px" height="100%" >
                </div>
      </div>

          <div class="box1">
                <div class="image1">
                  <!-- <img src="img/a3.png" width="100px"> -->
                <img src="img/a3.png" data-toggle="tooltip" title="Compassionate Care"  width="100px" height="100%">
                </div>
            </div>
          <div class="box1">
                <div class="image1">
                <img src="img/a4.png" data-toggle="tooltip" title="Comprehensive Services"  width="100px" height="100%">
                </div>
          </div>
        
          <div class="box1">
                <div class="image1">
                <img src="img/a5.png" data-toggle="tooltip" title="Patient-Centric Approach"  width="100px" height="100%">
                </div>
          </div>
      </div>
      </div>
  
    </div>
    </div>
    <!-- aboutus ended   class="img-thumbnail" width="300" height="700" -->
<!-- ################################ start of about us################################# -->

    <hr>

<!-- ################################ start of Map ################################# -->

<!-- <h3 class="text-center">
      <img src="img/5.png" alt="" width="100px" >
    </h3> -->
<div class="container" style="display: flex; justify-content: center; width=100%">

  <div style="display: flex; justify-content: center; width=20%">
    <h3 class="text-center">
      <img src="img/11.png" alt="" width="350px" height="400px">
    </h3>
      </div>
  <div style="display: flex; justify-content: center; width=70%">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15073.742812490314!2d73.22108248715821!3d19.176162999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7931068f45361%3A0xc84ccea011e7e824!2sSRL%20Diagnostics%20Badlapur!5e0!3m2!1sen!2sin!4v1695568646508!5m2!1sen!2sin" width="1100" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
</div>
<!-- ################################ End of Map ################################# -->

<!-- ################################ start of footer################################# -->

<footer class="panel-footer" id="footer">
 <div class="container">
 <div class="row">
 <section id="hours" class="col-sm-3">
 <span>Hours:</span><br>
 <p> <strong>Monday-Friday:</strong> 8:00am - 7:00pm<br>
 <strong>Saturday:</strong> 10:00am - 5:00pm<br>
 <strong>Sunday:</strong> <mark style="color:red">CLOSE</mark> <br>
 </p>
 <hr class="visible-xs">
 </section>
 <section id="address" class="col-sm-5">
 <span>Connect With Us:</span><br>
 <p> <strong>Phone:</strong> +91 7892-234-567<br>
 <strong>Email:</strong><a href="add the mail link idk"> thepatholabmj@gmail.com</a><br>
 <strong>Address: </strong> 1234 Greenwood Street, Mumbai, Maharastra<br>
 <strong>In-Person:</strong> Visit our The Patho Lab location to speak with a customer service representative in person.<br> Find our address on our website or through a Google search.<br>

 <strong>Home Service:</strong> Visit our website at <a href="user/home_appointment.php">The Patho Lab's Home Service</a> and click on the book appointment to secure your preferred time slot. <br>

 <!-- <strong>Online Chat:</strong> Visit our website at <a href="index.php">The Patho Lab</a> and click on the chat icon to connect with a customer service representative. -->

</p>
 <hr class="visible-xs">
 </section>
<section id="testimonials" class="col-sm-4">
<i>
 For <u>after-hours inquiries</u>, you can leave us a voicemail, send us an email
 <!--, or use our online chat--> , 
 and we will get back to you as soon as possible during our next business hours.
</i>
<br>
<br>
<i>
  Thanks for Trusting our services.
  For more detail
      <a class="card-link" data-toggle="modal" data-target="#contact" style="cursor: pointer;">click here</a>
</i>

<div class="social-links">
            <i class="fab fa-instagram" style="color: #0f0f0f"></i>
            <i class="fab fa-facebook-f" style="color: #0f0f0f"></i>
            <i class="fab fa-twitter"  style="color: #0f0f0f"></i>
            <i class="far fa-envelope"  style="color: #0f0f0f"></i>
 </div>
 </section>
 </div>
 <div class="text-center">&copy; Copyright@ThePathoLab </div>
 </div>
 
 </footer>
<!-- ################################ end of footer################################# -->

  

  

    <!-- Optional JavaScript; choose one of the two!-->
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script
      src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
      crossorigin="anonymous"
    ></script>

        <!-- jQuery -->  <!-- For Toggle in LOgin part -->
        <script src="content/js/jquery.min.js"></script>
        <script src="content/js/bootstrap.min.js"></script>
   
        <script type="text/javascript">  
            $(document).ready(function () {  
                $('.dropdown-toggle').dropdown();  
            });  
      </script> 
      
      <!-- About us -->
      <script>
        var coll = document.getElementsByClassName("collapsible");
      var i;
      for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var content = this.nextElementSibling;
          if (content.style.display === "block") {
            content.style.display = "none";
          } else {
            content.style.display = "block";
          }
        });
      }
      </script>

 <!-- for tooltip -->
 <script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });
    </script>

    <!-- to search -->
    <script>
$(document).ready(function() {
    // Handle form submission
    $("#searchForm").on("submit", function(e) {
        e.preventDefault(); // Prevent the default form submission behavior
        console.log("Form submitted"); // Debugging

        // Perform an AJAX request to submit the form data
        $.ajax({
            type: "GET",
            url: "your_php_script.php", // Replace with the URL of your PHP script
            data: $(this).serialize(), // Serialize the form data
            success: function(response) {
                console.log("Success"); // Debugging
                // Handle the response here (e.g., update the search results)
                $("#searchResults").html(response);
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error); // Debugging
            }
        });
    });
});
</script>



  </body>
</html>
