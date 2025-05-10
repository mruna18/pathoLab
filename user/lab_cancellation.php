<?php
$delete = false;

//connect to database
include 'partials/_dbconn.php';

//for GET DELETE
  if(isset($_GET['delete'])){
    $appointment_id = $_GET['delete'];
    // $appointment_id = 1;
    $delete = true;
    // $sql = "DELETE FROM `lab_appointment` WHERE `appointment_id` = $appointment_id";
    $sql = "DELETE FROM `lab_appointment` WHERE `lab_appointment`.`appointment_id` = $appointment_id";
    $result = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
      integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
      crossorigin="anonymous"
    />
    <!-- Link for CSS From DataTables jQuery Site -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <title>Lab Appointment Cancellation</title>
  </head>
  <body>

    <?php
    include "partials/_nav.php";
    ?>
    <!-- For showing the alert -->

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


    <div class="container my-4">

      <table class="table" id="myTable">
        <thead>
          <tr>
            <th scope="col">S.no</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Test Name</th>
            <th scope="col">Fee</th>
            <th scope="col">Time</th>
            <th scope="col">Status</th>
            <th scope="col">Date</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php
        session_start();
        if (isset($_SESSION['username'])){
          $username = $_SESSION['username'];
          $sql = "SELECT * FROM `lab_appointment` WHERE `lab_appointment`.`username`= '$username'ORDER BY 1";
          $result = mysqli_query($conn,$sql);
          $appointment_id = 0 ; //so even if the gap come or got anything deleted it will be in order its come from here and not database

          while($row = mysqli_fetch_assoc($result)){
          $appointment_id = $appointment_id + 1;
          echo  "<tr>
            <th scope='row'>". $appointment_id . " </th>
            <td>". $row['username'] . "</td>
            <td>". $row['email'] . "</td>
            <td>". $row['test_name'] . "</td>
            <td>". $row['fee'] . "</td>
            <td>". $row['appointmentTime'] . "</td>
            <td>". $row['status'] . "</td>
            <td>". $row['appointmentDate'] . "</td>
            <td><button class='delete btn btn-sm btn-primary' id=". $row['appointment_id'] .">Delete</button></td>
            </tr>"; 
          }
        }
          ?>
        
       
        </tbody> 
      </table>
      
    </div>
    <hr>
    <!-- Optional JavaScript; choose one of the two! -->

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
     <!-- Data table sites jQuery -->
     <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
      let table = new DataTable('#myTable');
    </script>
  
    <script>
// For deleting the record
deletes = document.getElementsByClassName('delete');
Array.from(deletes).forEach((element) => {
  element.addEventListener("click", (e) => {
    console.log("delete" );
    appointment_id = e.target.id.substr(); // substr is JS ka method which 1 ko fetch karke baki sab show karega

    if (confirm("Are you sure you want to delete this note!")) {
      console.log("yes");
      window.location = `lab_cancellation.php?delete=${appointment_id}`; 
      
    }
    else {
      console.log("no");
    }
  })
})
</script>




  </body>
</html>
