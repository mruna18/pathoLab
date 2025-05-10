<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>High Risk</title>
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
      $id = $_GET['riskid'];
      $sql = "SELECT * FROM `heart_test` WHERE `test_id` = $id";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)){
        $testname = $row['test_name'];
        $overview = $row['overview'];
        $cost = $row['cost'];
        $parameter = $row['parameter'];
        // $covers = $row['parameter_cover'];
        // $overview = $row['overview'];
        $precaution = $row['precaution'];

     }
    ?>

    <div class="container my-3" >
      <div class="jumbotron" style="background-color:#cdecf4;" >
       
          <h1><?php echo $testname ;?></h1> 
        <p class="lead"><?php echo $overview ;?></p>
        <h4>Special Instruction : <?php echo $precaution ;?></h4>
          <h4>  Parameters covered : <?php echo $parameter ;?></h4>
      


        <h4><?php echo'Rs.'. $cost;?></h4>
        <hr class="m-auto" >
    
      <div class="text-center">
<button type="button" class="btn my-3"  style="background-color:#151c48; color:white; width:150px; font-size:16px; border-radius: 12px;" data-toggle="modal" data-target="#Modal" >
        Make Appointment
      </button>
    </div>
        </div> 
     

  
      <!-- modal -->
        <!-- The Modal -->
  <div class="modal fade" id="Modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">To make the Appointment</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        To ensure a smooth appointment booking process, we kindly request you to log in first. By doing so, you can effortlessly secure your preferred time slot.
        <a href="login.php" class="link">login here</a>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <!-- Modal ended -->
        </div>
      </div>
      </div>
      <hr>

       <!-- for overvirew -->

       <div class="container">
   <div class="card-body" style='background-color: #c4ede6; margin-bottom:30px'>
     <h2>Overview</h2>      
     <p><?php echo $overview;?></p>
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

