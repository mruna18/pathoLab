<!-- localhost/pathology/admin/testupdate_table.php -->
<?php
$insert = false;
$update = false;
$delete = false;

include 'partials/_dbconn.php';

//for GET DELETE
  if(isset($_GET['delete'])){
    $test_id = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `test` WHERE `test_id` = $test_id";
    $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['test_idEdit'])){
  // Update the record
  $test_id = $_POST['test_idEdit'];
  $test_name=$_POST['test_nameEdit'];
  $test_code=$_POST['test_codeEdit'];
  $test_description=$_POST['test_descriptionEdit'];
  $fee=$_POST['feeEdit'];
  $instruction=$_POST['instructionEdit'];
  $parameter_cover=$_POST['parameter_coverEdit'];
  $parameter=$_POST['parameterEdit'];
  $overview=$_POST['overviewEdit'];

  //sql query
  $sql = "UPDATE `test` SET `test_name`='$test_name',`test_code`='$test_code',`test_description`='$test_description', `fee`='$fee',`instruction`='$instruction',`parameter_cover`='$parameter_cover',`parameter`='$parameter',`overview`='$overview' WHERE `test`.`test_id` = $test_id";
  $result = mysqli_query($conn,$sql);
  if($result){
    $update = true;
   
}
else{
    echo "We could not update the record successfully";
}
}
else{
$test_id = $_POST['test_id'];
  $test_name=$_POST['test_name'];
  $test_code=$_POST['test_code'];
  $test_description=$_POST['test_description'];
  $fee=$_POST['fee'];
  $instruction=$_POST['instruction'];
  $parameter_cover=$_POST['parameter_cover'];
  $parameter=$_POST['parameter'];
  $overview=$_POST['overview'];

    //sql query
    
    $sql = "INSERT INTO `test` (`test_id`, `test_name`, `test_code`, `test_description`, `fee`,`instruction`, `parameter_cover`, `parameter`, `overview`) VALUES ('$test_id','$test_name','$test_code','$test_description','$fee','$instruction','$parameter_cover','$parameter','$overview')";
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
  background-color: grey;
  color: black;
  padding: 8px 15px;
}


.table thead th  {
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}

  th{
    background-color:grey;
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

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand mb-0 h1" href="welcome_a.php">The PathoLab</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Test</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="testupdate_table.php" method="post">
        <input type="hidden" name="test_idEdit" id="test_idEdit">
        <div class="form-group">
        <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <label class="small mb-1" for="test_nameEdit">Test Name</label>
            <input class="form-control" id="test_nameEdit" type="text" name="test_nameEdit">
            </div>
                            <!-- Form Group (last name)-->
            <div class="col-md-6">
              <label class="small mb-1" for="test_codeEdit">Test Code</label>
              <input class="form-control" id="test_codeEdit" type="text" name="test_codeEdit">
            </div>
          </div>
                        <!-- Form Row        -->
          <div class="row gx-3 mb-3">
                  
          <div class="col-md-6">
          <label for="test_descriptionEdit">Decsription</label>
  <textarea class="form-control rounded-0" id="test_descriptionEdit" name="test_descriptionEdit" rows="3"></textarea>
          </div>
          <div class="col-md-6">
          <label for="parameterEdit">Parameter</label>
  <textarea class="form-control rounded-0" id="parameterEdit" name="parameterEdit" rows="3"></textarea>
          </div>
                            <!-- Form Group (location)-->
          <div class="col-md-6">
                    <label class="small mb-1" for="instructionEdit">Instruction</label>
                    <input class="form-control" id="instructionEdit" type="text"  name="instructionEdit">
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="feeEdit">Fee</label>
                                <input class="form-control" id="feeEdit" type="number" name="feeEdit">
                            </div>
                        </div>
                  
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (overview number)-->
                            <div class="col-md-6">
                            <label class="small mb-1" for="parameter_coverEdit">Parameter Cover</label>
                            <input class="form-control" id="parameter_coverEdit" type="number" name="parameter_coverEdit">
                        </div>
                            <!-- Form Group (dob)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="overviewEdit">Overview</label>
                                <textarea class="form-control rounded-0"  id="overviewEdit" type="text" name="overviewEdit" rows="3"></textarea>
                            </div>
                        </div>
        </div>
        </div>

        <button type="submit" class="btn btn-info">Update</button>
      </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

    <!-- For showing the alert -->
    <?php
    if($insert){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Added Successfully!</strong> test has been Added.
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
    }
    ?>
     <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your test has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>

  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your test has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>


    <div class="my-4" style="margin: 0 50px 0 50px">
      
  <form action="testupdate_table.php" method="post">
  <input type="hidden" name="test_id" id="test_id">
  <fieldset >
      <legend>Add Test:</legend>
        <div class="form-group">
        <div class="row gx-3 mb-3">
        <div class="col-md-6" >
            <label class="small mb-1" for="test_name">Test Name</label>
            <input class="form-control" id="test_name" type="text" name="test_name">
            </div>
                            <!-- Form Group (last name)-->
            <div class="col-md-6">
              <label class="small mb-1" for="test_code">Test Code</label>
              <input class="form-control" id="test_code" type="text" name="test_code">
            </div>
          </div>
                        <!-- Form Row        -->
          <div class="row gx-3 mb-3">
                  
          <div class="col-md-6">
          <label for="test_description">Decsription</label>
  <textarea class="form-control rounded-0" id="test_description" name="test_description" rows="3"></textarea>
          </div>
          <div class="col-md-6">
          <label for="parameter">Parameter</label>
  <textarea class="form-control rounded-0" id="parameter" name="parameter" rows="3"></textarea>
          </div>
                            <!-- Form Group (location)-->
                <div class="col-md-6">
                    <label class="small mb-1" for="instruction">Instruction</label>
                    <input class="form-control" id="instruction" type="text"  name="instruction">
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="fee">Fee</label>
                                <input class="form-control" id="fee" type="number" name="fee">
                            </div>
                        </div>
                       
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (overview number)-->
                            <div class="col-md-6">
                            <label class="small mb-1" for="parameter_cover">Parameter Cover</label>
                            <input class="form-control" id="parameter_cover" type="number" name="parameter_cover">
                        </div>
                            <!-- Form Group (dob)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="overview">Overview</label>
                                <textarea class="form-control rounded-0" id="overview"  name="overview" rows="3"></textarea>
                            </div>
                        </div>
        </div>
        <div class="text-center">
        <button type="submit" class="btn" style="background-color:#151c48; color:white; width:150px; font-size:16px; border-radius: 12px; margin-bottom:10px;">Add</button>
</div>
        </fieldset>
      </form>
    </div>
<hr>
    <div style="margin: 50px 50px 50px 50px">

      <table class="table" id="myTable">
        <thead>
          <tr>
            <th scope="col">Test Id</th>
            <th scope="col">Test Name</th>
            <th scope="col">Test Code</th>
            <th scope="col">Description</th>
            <th scope="col">Fee</th>
            <th scope="col">Instruction</th>
            <th scope="col">Parameter Cover</th>
            <th scope="col">Parameter</th>
            <th scope="col">Overview</th>
            <th scope="col">Edit</th>
         <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $sql = "SELECT * FROM `test`";
          $result = mysqli_query($conn,$sql);
          $test_id = 0 ; //so even if the gap come or got anything deleted it will be in order its come from here and not database

          while($row = mysqli_fetch_assoc($result)){
          $test_id = $test_id + 1;
          echo  "<tr>
            <td>". $test_id . " </td>
            <td>". $row['test_name'] . "</td>
            <td>". $row['test_code'] . "</td>
            <td>". $row['test_description'] . "</td>
            
            <td>". $row['fee'] . "</td>
            <td>". $row['instruction'] . "</td>
            <td>". $row['parameter_cover'] . "</td>
            <td>". $row['parameter'] . "</td>
            <td>". $row['overview'] . "</td>
            
            <td><button class='edit btn btn-sm btn-info' id=". $row['test_id'] .">Edit</button> </td>
            <td><button class='delete btn btn-sm btn-danger' id=". $row['test_id'] .">Delete</button></td>
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
          test_name= tr.getElementsByTagName("td")[1].innerText;
          test_code= tr.getElementsByTagName("td")[2].innerText;
          test_description= tr.getElementsByTagName("td")[3].innerText;
          fee= tr.getElementsByTagName("td")[4].innerText;
          instruction= tr.getElementsByTagName("td")[5].innerText;
          parameter_cover= tr.getElementsByTagName("td")[6].innerText;
          parameter= tr.getElementsByTagName("td")[7].innerText;
          overview= tr.getElementsByTagName("td")[8].innerText;

          console.log(test_name,test_code);
          test_nameEdit.value = test_name;
          test_codeEdit.value  = test_code;
          test_descriptionEdit.value=test_description;
          feeEdit.value  = fee;
          instructionEdit.value  = instruction;
          parameter_coverEdit.value  = parameter_cover;
          parameterEdit.value  = parameter;
          overviewEdit.value  = overview;

          test_idEdit.value = e.target.id;
          console.log(e.target.id);
          $('#editModal').modal('toggle')

        })
      })

      // For deleting the record
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit " );
        test_id = e.target.id.substr(); //substr is JS ka method which 1 ko fetch karke baki sab show karega

        if (confirm("Are you sure you want to delete this test!")) {
          console.log("yes");
          window.location = `testupdate_table.php?delete=${test_id}`; 
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