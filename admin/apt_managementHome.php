
<?php
// session_start();
// connection
include 'partials/_dbconn.php';

$delete = false;
$mail = false;
// for GET DELETE
if(isset($_GET['delete'])){
    $appointment_id = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `home_appointment` WHERE `appointment_id` = $appointment_id";
    $result = mysqli_query($conn, $sql);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['done'])) {
    $appointment = $_POST['appointment_id'];
         $SQL = "INSERT INTO `visited_patients` (`username`, `email`, `test_name`, `reg_date`, `reg_time`)
         SELECT `username`, `email`, `test_name`, `appointmentDate`, `appointmentTime`
         FROM `home_appointment`
         WHERE `appointment_id`=$appointment;";
         mysqli_query($conn, $SQL);
  
         $updateQuery = "UPDATE home_appointment SET apt_status = 'Done' WHERE appointment_id = $appointment";
          mysqli_query($conn, $updateQuery);
        }    
      
    elseif (isset($_POST['confirm'])) {
        $appointmentId = $_POST['appointment_id'];
        // Update the status of the appointment to "Confirmed" in the database
        $updateQuery = "UPDATE home_appointment SET status = 'Confirmed' WHERE appointment_id = $appointmentId";
        mysqli_query($conn, $updateQuery); 
    } elseif (isset($_POST['reject'])) {
        $appointmentId = $_POST['appointment_id'];
        // Update the status of the appointment to "Pending" in the database
        $updateQuery = "UPDATE home_appointment SET status = 'Pending' WHERE appointment_id = $appointmentId";
        mysqli_query($conn, $updateQuery);
    }
    else{
      echo "ERRORR";
    }
}



// Fetch appointments from the database
$selectQuery = "SELECT * FROM home_appointment";
$result = mysqli_query($conn, $selectQuery);
$appointment_id = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Management</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Link for CSS From DataTables jQuery Site -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
#head, #btnn{
  display: inline-block;
}
.table thead th  {
    vertical-align: bottom;
    border: 0.5px solid black;
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
  <!-- Edit Modal -->
<div class="modal fade" id="mailModal" tabindex="-1" aria-labelledby="mailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mailModalLabel">Send Mail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="send_mailHome.php" method="post">
        <input type="hidden" name="appointment_idEdit" id="appointment_idEdit">
        <div class="form-group">
          <label for="usernameEdit">Username</label>
          <input
            type="text"
            name="usernameEdit"
            class="form-control"
            id="usernameEdit"
            aria-describedby="emailHelp"
          />
        </div>
        <div class="form-group">
          <label for="emailEdit">Email</label>
          <input
            type="text"
            name="emailEdit"
            class="form-control"
            id="emailEdit"
            aria-describedby="emailHelp"
          />
        </div>
       
        <div class="form-group">
          <label for="test_nameEdit">Test</label>
          <input
            type="text"
            name="test_nameEdit"
            class="form-control"
            id="test_nameEdit"
            aria-describedby="emailHelp"
          />
        </div>

        <div class="form-group">
          <label for="feeEdit">Fee</label>
          <input
            type="number"
            name="feeEdit"
            class="form-control"
            id="feeEdit"
            aria-describedby="emailHelp"
          />
        </div>
        <div class="form-group">
          <label for="extra_chargeEdit">Extra Charge</label>
          <input
            type="number"
            name="extra_chargeEdit"
            class="form-control"
            id="extra_chargeEdit"
            value="200"
            aria-describedby="emailHelp"
            disabled
          />
        </div>
        <div class="form-group">
          <label for="appointmentDateEdit">Date</label>
          <input
            type="varchar"
            name="appointmentDateEdit"
            class="form-control"
            id="appointmentDateEdit"
            aria-describedby="emailHelp"
          />
        </div>

        <button type="submit" class="btn btn-primary" onclick="sendMail()">Send Mail</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand mb-0 h1" href="welcome_a.php">The PathoLab</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>

<!-- For showing the alert -->
<?php
if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Appointment has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
}
if($mail){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Email have been sent successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
}
?>

<div class="mx-4 my-3">
<table class="table" id="myTable">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col">Test Name</th>
        <th scope="col">Fee</th>
        <th scope="col">Extra Charges</th>
        <th scope="col">Date</th>
        <th scope="col">Time</th>
        <th scope="col">Status</th>
        <th scope="col">Process</th>
        <th scope="col">Apt Status</th>
        <!-- <th scope="col">Apt Process</th> -->
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    while($row = mysqli_fetch_assoc($result)){
        $appointment_id = $appointment_id + 1;
        echo  "<tr>
          <th scope='row'>". $appointment_id . " </th>
          <td>". $row['username'] . "</td>
          <td>". $row['email'] . "</td>
          <td>". $row['test_name'] . "</td>
          <td>". $row['fee'] . "</td>
          <td>". $row['extra_charge'] . "</td>
          <td>". $row['appointmentDate'] . "</td>
          <td>". $row['appointmentTime'] . "</td>
          <td>". $row['status'] . "</td>
          <td>
              <form method='post'>
                <input type='hidden' name='appointment_id' value='{$row['appointment_id']}'>
                <button type='submit' name='confirm'>Confirm</button>
                <button type='submit' name='reject'>Reject</button>
                <button type='submit'id='btn1' name='done'>Done</button>
              </form>
          </td>
          <td>". $row['apt_status'] . "</td>
          <td><button class='mail btn btn-sm btn-primary' id='". $row['appointment_id'] ."'>Mail</button> <button class='delete btn btn-sm btn-primary' id='d". $row['appointment_id'] ."'>Delete</button></td>
          </tr>";
    }    
  ?>
    </tbody>
    </div>
  </table>

  <button class="btn btn-secondary hBack" type="button">Back</button>

<div class="container-fluid bg-dark text-light fixed-bottom">
  <p class="text-center py-2 my-0">&copy;  ThePathoLab-2023 | All Right Reserved </p>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
  let table = new DataTable('#myTable');
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const mailButtons = document.querySelectorAll('.mail');

    mailButtons.forEach((button) => {
        button.addEventListener("click", (event) => {
            const tr = event.target.closest("tr");
            const username = tr.querySelector("td:nth-child(2)").textContent;
            const email = tr.querySelector("td:nth-child(3)").textContent;
            const test_name = tr.querySelector("td:nth-child(4)").textContent;
            const fee = tr.querySelector("td:nth-child(5)").textContent;
            const extra_charge = tr.querySelector("td:nth-child(6)").textContent;
            const appointmentDate = tr.querySelector("td:nth-child(7)").textContent;
            const appointmentId = event.target.id;

            document.querySelector("#usernameEdit").value = username;
            document.querySelector("#emailEdit").value = email;
            document.querySelector("#feeEdit").value = fee;
            document.querySelector("#extra_chargeEdit").value = extra_charge;
            document.querySelector("#test_nameEdit").value = test_name;
            document.querySelector("#appointmentDateEdit").value = appointmentDate;
            document.querySelector("#appointment_idEdit").value = appointmentId;

            $('#mailModal').modal('toggle');

            console.log('Click event triggered');
        });
    });

    // Function to send the email
    function sendMail() {
        const email = document.querySelector("#emailEdit").value;
        const subject = "Your appointment confirmation";
        const message = "Your appointment has been confirmed.";

        // Use AJAX to send the email data to a PHP script on the server
        $.ajax({
            url: 'send_mailHome.php', // Replace with your email sending script
            type: 'POST',
            data: {
                email: email,
                subject: subject,
                message: message
            },
            success: function (response) {
                if (response === 'success') {
                    alert("Email sent successfully!");
                    $('#mailModal').modal('hide');
                } else {
                    alert("Failed to send email. Please try again later.");
                }
            },
            error: function (error) {
                console.error("Error:", error);
                alert("An error occurred while sending the email.");
            }
        });
    }
});



</script>

<script>
// For deleting the record
deletes = document.getElementsByClassName('delete');
Array.from(deletes).forEach((element) => {
  element.addEventListener("click", (e) => {
    console.log("delete" );
    appointment_id = e.target.id.substr(1); // substr is JS ka method which 1 ko fetch karke baki sab show karega

    if (confirm("Are you sure you want to delete this appointment!")) {
      console.log("yes");
      window.location = `apt_managementHome.php?delete=${appointment_id}`; 
      
    }
    else {
      console.log("no");
    }
  })
})
</script>

<script>
  // JS for back but it brings back to entire dashboard wala page but still works
  $(".hBack").on("click", function(e){
      e.preventDefault();
      window.history.back();
  });
</script>
</body>
</html>
