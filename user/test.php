<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="styles.css">


    <title>Book Test</title>
  </head>
  <body>
    <?php
      require 'partials/_nav.php';
    ?>
     <?php
      // connection
      include 'partials/_dbconn.php'; 
    ?>
    <?php
      $id = $_GET['testid'];
      $sql = "SELECT * FROM `test` WHERE `test_id` = $id";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)){
        $testname = $row['test_name'];
        $testdesc = $row['test_description'];
        $testprice = $row['fee'];
        $parameter = $row['parameter'];
        $covers = $row['parameter_cover'];
        $overview = $row['overview'];
        $instruction = $row['instruction'];

     }
    ?>

    <div class="container my-3" >
      <div class="jumbotron">
        <h2>Book Test For  </h2>
          <h1><?php echo $testname ;?></h1> 
        <p class="lead"><?php echo $testdesc ;?></p>
        <h4>Special Instruction : <?php echo $instruction ;?></h4>
          <h4>  Parameters covered : <?php echo $covers ;?></h4>
          <!-- <h4>   Report Frequency : [Daily]</h4> -->


        <h4><?php echo'Rs.'. $testprice;?></h4>
        <hr class="m-auto">
        </div>
     <hr>
   
     <!-- header -->
    <div class="card-header my-2">
     <h4>Appointment: </h4>
     <div class="p-md-2">
     <a href="" class="btn btn-outline-success"  data-toggle="modal" data-target="#loginModal">Lab Service</a>
     <!-- <a href="lab_appointment.php" class="btn btn-outline-success">Lab Service</a> -->
     <a href="home_appointment.php" class="btn btn-outline-success">Home Service</a>
     </div>
    </div>

    <div class="container">
   <!-- The Modal -->      
  <div class="modal fade" id="loginModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <div class="modal-header">
          <h4 class="modal-title">To make the Appointment</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body">
        To ensure a smooth appointment booking process, we kindly request you to log in first. By doing so, you can effortlessly secure your preferred time slot.
        <a href="/pathology/user/login.php" class="link">login here</a>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
          
        </div>
      </div>
    </div>
    <!-- Modal ended -->
  </div>

      <!-- for overvirew -->
      <div class="card-body" style='background-color: #c4ede6'>
        <h2>Overview</h2>      
        <p><?php echo $overview;?></p>
      </div>
<hr>

      <!-- for parameter -->
          <div class="card bg-light text-dark mb-5">
        <div class="card-body">
          <h3>Parameters</h3>
          <p><?php echo $parameter ;?></p>
        </div>
      </div>
     </div>




        <!-- footer -->
        <?php
        require 'partials/_footer.php';
        ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  </body>
</html>
