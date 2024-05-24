<!-- <?php
$insert = false;
$update = false;
$delete = false;

// connection
include 'partials/_dbconn.php';

//for GET DELETE
  if(isset($_GET['delete'])){
    $appointment_id = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `lab_appointment` WHERE `appointment_id` = $appointment_id";
    $result = mysqli_query($conn, $sql);
}

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset( $_POST['appointment_idEdit'])){
    $appointment_id = $_POST["appointment_idEdit"];
    $username = $_POST["usernameEdit"];
    $test_name = $_POST["test_nameEdit"];
    $fee = $_POST["feeEdit"];
    $appointmentDate = $_POST["appointmentDateEdit"];
    $appointmentTime = $_POST["appointmentTimeEdit"];
    $status = $_POST["status"];
  
    //sql query
    $sql = "UPDATE `lab_appointment` SET `username`='$username',`test_name` = '$test_name', `appointmentDate` = '$appointmentDate',`fee`='$fee',`appointmentTime`='$appointmentTime',`timestamp`=current_timestamp(),`status`='$status' WHERE `lab_appointment`.`appointment_id` = $appointment_id;";
    
    $result = mysqli_query($conn,$sql);
    if($result){
      $update = true;
    
  }
  else{
      echo "We could not update the record successfully";
  }
  }
  else{
    $username = $_POST['username'];
    $test_name = $_POST['test_name'];

    //sql query
    $sql = "INSERT INTO `lab_appointment` (`username`, `email`,`test_name`, `fee`, `appointmentTime`,`appointmentDate`, `timestamp`,`status`) VALUES ('$username','$email', '$test_name', '$fee', '$appointmentTime', '$appointmentDate', current_timestamp(),'$status');";
    
    $result = mysqli_query($conn,$sql);

    if($result){
      // echo "record successfully inserted<br>";
      $insert=true;
    }
    else{
      echo "not inserted -->" . mysqli_connect_error($conn);
    }
  }
}
    ?> -->

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Link for CSS From DataTables jQuery Site -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <title>Appointment</title>
    <style>
#head, #btnn{
  display: inline-block;
}
.table thead th  {
    vertical-align: bottom;
    /* border: 0.5px solid black; */
}

  th{
    background-color: grey;
    color: black;
  }
    td{
            background-color:#f2f2f2;
           
        }

        .table-bordered td, .table-bordered th {
    border: 0.5px solid black;
}
        </style>
    
  </head>
  <body>
    
 <?php
    if($insert){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Added Successfully!</strong> Note has been Added.
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
    }
    ?>
     <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>

<!-- FORM IS THERE BUT CHECK THE ERROR STUFF WE DONT NEED FORM HWERE THOU IDK -->

    <div class="container my-4">
    <h3 id="head" class="text-center">Lab Appointments</h3>
    <a href="apt_management.php" id="btnn" class="btn" role="button" aria-pressed="true" style="float: right; background-color: #151c48; color:#fff  ">Appointment Management</a>
      <table class="table" id="myTable">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Test Name</th>
            <th scope="col">Fee</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Actions</th>
            <!-- <th scope="col">Conform</th> -->
          </tr>
        </thead>
        <tbody>
        <?php
          $sql = "SELECT * FROM `lab_appointment`";
          $result = mysqli_query($conn,$sql);
          $appointment_id = 0 ; //so even if the gap come or got anything deleted it will be in order its come from here and not database

  while($row = mysqli_fetch_assoc($result)){
      $appointment_id = $appointment_id + 1;
          echo  "<tr>
            <td scope='row'>". $appointment_id . " </td>
            <td>". $row['username'] . "</td>
            <td>". $row['email'] . "</td>
            <td>". $row['test_name'] . "</td>
            <td>". $row['fee'] . "</td>
            <td>". $row['appointmentDate'] . "</td>
            <td>". $row['appointmentTime'] . "</td>
            <td>". $row['status'] . "</td>
           
            ";
          }

          
          ?>
        
       <!--  <td>". $row['Register on'] . "</td> -->
        </tbody> 
      </table>
      </div>
      <hr>
<hr>

      <div class="container my-4">
    <h3 id="head" class="text-center">Home Appointments</h3>
    <a href="apt_managementHome.php" id="btnn" class="btn" role="button" aria-pressed="true" style="float: right; background-color: #151c48; color:#fff">Appointment Management</a>
      <table class="table" id="myTable">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Username</th>
            <!-- <th scope="col">Email</th> -->
            <th scope="col">Test Name</th>
            <th scope="col">Fee</th>
            <th scope="col">Extra Charge</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Actions</th>
            <!-- <th scope="col">Conform</th> -->
          </tr>
        </thead>
        <tbody>
        <?php
          $sql = "SELECT * FROM `home_appointment`";
          $result = mysqli_query($conn,$sql);
          $happointment_id = 0 ; //so even if the gap come or got anything deleted it will be in order its come from here and not database

  while($row = mysqli_fetch_assoc($result)){
      $happointment_id = $happointment_id + 1;
          echo  "<tr>
            <td scope='row'>". $happointment_id . " </td>
            <td>". $row['username'] . "</td>
            <td>". $row['test_name'] . "</td>
            <td>". $row['fee'] . "</td>
            <td>". $row['extra_charge'] . "</td>
            <td>". $row['appointmentDate'] . "</td>
            <td>". $row['appointmentTime'] . "</td>
            <td>". $row['status'] . "</td>
           
            ";
          }
          ?>
      <!--  <td>". $row['Register on'] . "</td> -->
      </tbody> 
      </table>
      
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Data table sites jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
      let table = new DataTable('#myTable');
    </script>
   
  </body>
</html>