
<?php
$insert = false;
$update = false;
$delete = false;
   
include 'partials/_dbconn.php';

//for GET DELETE
  if(isset($_GET['delete'])){
    $sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `lab_management` WHERE `sno` = $sno";
    $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['snoEdit'])){
  // Update the record
  $sno = $_POST["snoEdit"];
  $lab_instrument = $_POST["lab_instrumentEdit"];
  $items_available = $_POST["items_availableEdit"];
 
  //sql query
  $sql = "UPDATE `lab_management` SET `lab_instrument` ='$lab_instrument',`items_available`= '$items_available' WHERE `lab_management`.`sno` = $sno";
  $result = mysqli_query($conn,$sql);
  if($result){
    $update = true;
   
}
else{
    echo "We could not update the record successfully";
}
}
else{
    $lab_instrument = $_POST['lab_instrument'];
    $items_available = $_POST['items_available'];

    //sql query
    $sql = "INSERT INTO `lab_management`(`lab_instrument`, `items_available`) VALUES ('$lab_instrument','$items_available')";
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
    <style>
    fieldset {
  background-color: #eeeeee;
}

legend {
  background-color: gray;
  color: white;
  padding: 8px 15px;
}
  </style>

  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand mb-0 h1" href="welcome_a.php">The PathoLab</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>
    <!-- Edit Button trigger modal
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
Edit Modal
</button> -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Lab Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="labupdate_table.php" method="post">
        <input type="hidden" name="snoEdit" id="snoEdit">
        <div class="form-group">
        <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <label class="small mb-1" for="lab_instrumentEdit">Lab Instrument</label>
            <input class="form-control" id="lab_instrumentEdit" type="text" name="lab_instrumentEdit">
            </div>
                            <!-- Form Group (last name)-->
            <div class="col-md-6">
              <label class="small mb-1" for="items_availableEdit">No. of Items Available</label>
              <input class="form-control" id="items_availableEdit" type="text" name="items_availableEdit">
            </div>
          </div>

</div>
        <button type="submit" class="btn btn-info">Update</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Save changes</button>
      </div>
    </div>
  </div>
</div>
    

    <!-- For showing the alert -->
    <?php
    if($insert){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Added Successfully!</strong> Lab Item has been Added.
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
    }
    ?>
     <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Lab Item has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Lab Item has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>


    <div class="container my-4">
      
  <form action="labupdate_table.php" method="post">
  <fieldset>
      <legend>Add Lab Item:</legend>
  <div class="form-group">
        <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <label class="small mb-1" for="lab_instrument">Lab Instrument</label>
            <input class="form-control" id="lab_instrument" type="text" name="lab_instrument">
            </div>
                            <!-- Form Group (last name)-->
            <div class="col-md-6">
              <label class="small mb-1" for="items_available">Items Available</label>
              <input class="form-control" id="items_available" type="number" name="items_available">
            </div>
          </div>

        
          <div class="text-center">
        <button type="submit" class="btn btn-warning">Add</button>
</div>
</fieldset>
      </form>
    </div>

    <div class="container my-4">

      <table class="table" id="myTable">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Lab Instrument</th>
            <th scope="col">Items Available</th>
            <th scope="col">Time</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $sql = "SELECT * FROM `lab_management`";
          $result = mysqli_query($conn,$sql);
          $sno = 0 ; //so even if the gap come or got anything deleted it will be in order its come from here and not database

          while($row = mysqli_fetch_assoc($result)){
          $sno = $sno + 1;
          echo  "<tr>
            <th scope='row'>". $sno . " </th>
            <td>". $row['lab_instrument'] . "</td>
            <td>". $row['items_available'] . "</td>
            <td>". $row['tstamp'] . "</td>
            <td><button class='edit btn btn-sm btn-info' id=". $row['sno'] .">Edit</button> </td>
            <td><button class='delete btn btn-sm btn-danger' id=". $row['sno'] .">Delete</button></td>
            </tr>"; 
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
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element)=> {
        element.addEventListener("click",(e) =>{
          console.log("edit ", );
          tr = e.target.parentNode.parentNode;
          lab_instrument= tr.getElementsByTagName("td")[0].innerText;
          items_available= tr.getElementsByTagName("td")[1].innerText;

          console.log(lab_instrument,items_available);
          items_availableEdit.value = items_available;
          lab_instrumentEdit.value  = lab_instrument;
          snoEdit.value = e.target.id;
          console.log(e.target.id);
          $('#editModal').modal('toggle')

        })
      })

      // For deleting the record
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit " );
        sno = e.target.id.substr(); //substr is JS ka method which 1 ko fetch karke baki sab show karega

        if (confirm("Are you sure you want to delete this Lab Item!")) {
          console.log("yes");
          window.location = `labupdate_table.php?delete=${sno}`; 
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
    </script>
    
  </body>
</html>