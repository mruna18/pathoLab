<!-- localhost/pathology/admin/reportgen_table.php -->
<?php
$insert = false;
$update = false;
$delete = false;

include 'partials/_dbconn.php';

//for GET DELETE
  if(isset($_GET['delete'])){
    $v_id = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `visited_patients` WHERE `v_id` = $v_id";
    $result = mysqli_query($conn, $sql);
}

// ### record updation ###
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['v_idEdit'])){
  // Update the record
  $v_id = $_POST['v_idEdit'];
  $email = $_POST['emailEdit'];
  $test_name = $_POST['test_nameEdit'];
  $fname=$_POST["fnameEdit"];
  $lname=$_POST['lnameEdit'];
  $gender=$_POST['genderEdit'];
  $sample_collected_at=$_POST['sample_collected_atEdit'];
  $patient_id=$_POST['patient_idEdit'];
  $dob=$_POST['dobEdit'];
  $reg_date=$_POST['reg_dateEdit'];
  $reg_time=$_POST['reg_timeEdit'];
  $investigation = $_POST['investigationEdit'];
  $observed_value = $_POST['observed_valueEdit'];
  $unit = $_POST['unitEdit'];
  $biological_ref = $_POST['biological_refEdit'];

  //sql query
  $sql = "UPDATE `visited_patients` SET `email`='$email',`test_name`='$test_name',`fname`='$fname',`lname`='$lname',`gender`='$gender', `sample_collected_at`='$sample_collected_at',`patient_id`='$patient_id',`dob`='$dob',`reg_date`='$reg_date',`reg_time`='$reg_time',`investigation`='$investigation',`observed_value`='$observed_value',`unit`='$unit',`biological_ref`='$biological_ref' WHERE `visited_patients`.`v_id` = $v_id";
  $result = mysqli_query($conn,$sql);
  if($result){
    $update = true;
   
}
else{
    echo "We could not update the record successfully";
}
}
else{
  //  ### INSERT DATA ###
$v_id = $_POST['v_id'];
$email=$_POST['email'];
  $test_name=$_POST['test_name'];
  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $gender=$_POST['gender'];
  $sample_collected_at=$_POST['sample_collected_at'];
  $patient_id=$_POST['patient_id'];
  $dob=$_POST['dob'];
  $reg_date=$_POST['reg_date'];
  $reg_time=$_POST['reg_time'];
  $investigation = $_POST['investigation'];
  $observed_value = $_POST['observed_value'];
  $unit = $_POST['unit'];
  $biological_ref = $_POST['biological_ref'];


    //sql query
    
    $sql = "INSERT INTO `visited_patients` (`v_id`, `fname`, `lname`, `gender`, `sample_collected_at`,`patient_id`, `dob`, `reg_date`, `reg_time`,`investigation`,`observed_value`,`unit`,`biological_ref`) VALUES ('$v_id','$fname','$lname','$gender','$sample_collected_at','$patient_id','$dob','$reg_date','$reg_time','$investigation','$observed_value','$unit','$biological_ref')";
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

// ### HTML PART ###
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
    <!--### CSS PART ###-->
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
<!-- ### BODY STARTS ###  -->
  <body>
<!-- ### Navbar ### -->
  <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
  <div class="container-fluid">
  <a class="navbar-brand mb-0 h1" href="welcome_a.php">The PathoLab</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</div>
</nav>
    
<!-- ### UPDATE/Edit Modal ###-->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Create Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form action="reportgen_table.php" method="post"> 
        <input type="hidden" name="v_idEdit" id="v_idEdit">
        <div class="form-group">
        <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <label class="small mb-1" for="emailEdit">Email</label>
            <input class="form-control" id="emailEdit" type="email" name="emailEdit">
            </div>
                            <!-- Form Group (last name)-->
            <div class="col-md-6">
              <label class="small mb-1" for="test_nameEdit">Test Name</label>
              <input class="form-control" id="test_nameEdit" type="text" name="test_nameEdit">
            </div>
          </div>
        <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <label class="small mb-1" for="fnameEdit">First Name</label>
            <input class="form-control" id="fnameEdit" type="text" name="fnameEdit">
            </div>
                            <!-- Form Group (last name)-->
            <div class="col-md-6">
              <label class="small mb-1" for="lnameEdit">Last Name</label>
              <input class="form-control" id="lnameEdit" type="text" name="lnameEdit">
            </div>
          </div>
                        <!-- Form Row  -->
          <div class="row gx-3 mb-3">
                  
          <div class="col-md-6">
          <label for="genderEdit">Gender</label>
          <input class="form-control" id="genderEdit" name="genderEdit" ></input>
          </div>
          <div class="col-md-6">
          <label for="reg_dateEdit">Registration Date</label>
          <input type="date" class="form-control" id="reg_dateEdit" name="reg_dateEdit"></input>
          </div>
                            <!-- Form Group (pATIENT)-->
          <div class="col-md-6">
          <label class="small mb-1" for="patient_idEdit">Patient Id</label>
          <input class="form-control" id="patient_idEdit" type="text"  name="patient_idEdit">
          </div>

          <div class="col-md-6">
          <label class="small mb-1" for="sample_collected_atEdit">Sample Collected At</label>
          <input class="form-control" id="sample_collected_atEdit" type="text" name="sample_collected_atEdit">
          </div>
          </div>
                  
          <div class="row gx-3 mb-3">
                            <!-- Form Group (dob)-->
          <div class="col-md-6">
          <label class="small mb-1" for="dobEdit">Date of Birth</label>
          <input class="form-control" id="dobEdit" type="Date" name="dobEdit">
          </div>
                            <!-- Form Group ( rED TIME)-->
          <div class="col-md-6">
          <label class="small mb-1" for="reg_timeEdit">Registration Time</label>
          <input class="form-control" id="reg_timeEdit" type="time" name="reg_timeEdit">
          </div>
          </div>

          <div class="row gx-3 mb-3">
          <div class="col-md-6">
          <label for="investigationEdit">Investigation</label>
          <textarea class="form-control rounded-0" id="investigationEdit" name="investigationEdit" rows="3"></textarea>
          </div>
          <div class="col-md-6">
          <label for="observed_valueEdit">Observed value</label>
          <textarea class="form-control rounded-0" id="observed_valueEdit" name="observed_valueEdit"  rows="3"></textarea>
          </div>      

          <div class="col-md-6">
          <label for="unitEdit">Unit</label>
          <textarea class="form-control rounded-0" id="unitEdit" name="unitEdit" rows="3"></textarea>
          </div>
          <div class="col-md-6">
          <label for="biological_refEdit">Biological Reference</label>
          <textarea class="form-control rounded-0" id="biological_refEdit" name="biological_refEdit"  rows="3"></textarea>
          </div>      
        </div>
        </div>
</div>

        <button type="submit" class="btn btn-info" >Update</button>
      </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<!-- ### For Generating Report ### -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset( $_POST['v_idGen'])){
    // Update the record
    $v_id = $_POST['v_idGen'];
    $fname=$_POST["fnameGen"];
    $lname=$_POST['lnameGen'];
    $gender=$_POST['genderGen'];
    $sample_collected_at=$_POST['sample_collected_atGen'];
    $patient_id=$_POST['patient_idGen'];
    $dob=$_POST['dobGen'];
    $reg_date=$_POST['reg_dateGen'];
    $reg_time=$_POST['reg_timeGen'];
    $investigation = $_POST['investigationGen'];
    $observed_value = $_POST['observed_valueGen'];
    $unit = $_POST['unitGen'];
    $biological_ref = $_POST['biological_refGen'];
  }
  }
  ?>

<!-- ### Modal for report generation ###-->
<div class="modal fade" id="editModalgen" tabindex="-1" aria-labelledby="editModalgenLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalgenLabel">Create Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="Generate_pdf.php" method="post"> 
        <input type="hidden" name="v_idGen" id="v_idGen">
        <div class="form-group">
        <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <label class="small mb-1" for="emailGen">Email</label>
            <input class="form-control" id="emailGen" type="email" name="emailGen">
            </div>
                            <!-- Form Group (last name)-->
            <div class="col-md-6">
              <label class="small mb-1" for="test_nameGen">Test Name</label>
              <input class="form-control" id="test_nameGen" type="text" name="test_nameGen">
            </div>
          </div>
        <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <label class="small mb-1" for="fnameGen">First Name</label>
            <input class="form-control" id="fnameGen" type="text" name="fnameGen">
            </div>
                            <!-- Form Group (last name)-->
            <div class="col-md-6">
              <label class="small mb-1" for="lnameGen">Last Name</label>
              <input class="form-control" id="lnameGen" type="text" name="lnameGen">
            </div>
          </div>
                        <!-- Form Row        -->
          <div class="row gx-3 mb-3">
                  
          <div class="col-md-6">
          <label for="genderGen">Gender</label>
          <input class="form-control" id="genderGen" name="genderGen">
          </div>
          <div class="col-md-6">
          <label for="reg_dateGen">Registration Date</label>
          <input type="date" class="form-control" id="reg_dateGen" name="reg_dateGen">
          </div>
                            <!-- Form Group (location)-->
          <div class="col-md-6">
          <label class="small mb-1" for="patient_idGen">Patient Id</label>
          <input class="form-control" id="patient_idGen" type="text"  name="patient_idGen">
          </div>

          <div class="col-md-6">
          <label class="small mb-1" for="sample_collected_atGen">Sample Collected At</label>
          <input class="form-control" id="sample_collected_atGen" type="text" name="sample_collected_atGen">
          </div>
          </div>
                  
          <div class="row gx-3 mb-3">
         <div class="col-md-6">
          <label class="small mb-1" for="dobGen">Date of Birth</label>
          <input class="form-control" id="dobGen" type="Date" name="dobGen">
          </div>
                            <!-- Form Group (dob)-->
          <div class="col-md-6">
          <label class="small mb-1" for="reg_timeGen">Registration Time</label>
          <input class="form-control" id="reg_timeGen" type="time" name="reg_timeGen">
          </div>
          </div>

          <div class="row gx-3 mb-3">
          <div class="col-md-6">
          <label for="investigationGen">Investigation</label>
          <textarea class="form-control rounded-0" id="investigationGen" name="investigationGen" rows="3"></textarea>
          </div>
          <div class="col-md-6">
          <label for="observed_valueGen">Observed value</label>
          <textarea class="form-control rounded-0"  id="observed_valueGen" name="observed_valueGen"  rows="3"></textarea>
          </div>      

          <div class="col-md-6">
          <label for="unitGen">Unit</label>
          <textarea class="form-control rounded-0" id="unitGen" name="unitGen" rows="3"></textarea>
          </div>
          <div class="col-md-6">
          <label for="biological_refGen">Biological Reference</label>
          <textarea class="form-control rounded-0"  id="biological_refGen" name="biological_refGen"  rows="3"></textarea>
          </div>      
        </div>
        </div>
</div>
        <button type="submit" class="btn btn-info" name='action'>Generate</button><hr>
      </form>
      <form action='phpmailer.php' method='post'>
        <div class="mb-1">
      <label class="mb-1" for="emailGenn" style="margin-left:50px;"><b>Email <small style="color:red">(To send the notification for available report) </small> </b></label>
      <input class="form-control" id="emailGenn" type="email" name="emailGenn" style="width:350px; margin-left:50px; margin-right:50px;">  
</div>
<div class="text-center">
        <button class='mail btn' style="background-color:#151c48; color:white; width:150px; font-size:16px; border-radius: 12px; margin-bottom:10px;" name='action' >Mail</button><br>
</div>
</form> 
      </div>
    </div>
  </div>
</div>

    <!-- For showing the alert -->
    <?php
    if($insert){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Successfully!</strong> created new User report
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
    }
    ?>
     <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Record has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your report has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>


<div class="my-4" style="margin: 0 50px 0 50px">
      
  <form action="reportgen_table.php" method="post">
  <input type="hidden" name="v_id" id="v_id">
  <fieldset>
      <legend>Add New Report</legend>
        <div class="form-group">
        <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <label class="small mb-1" for="email">Email</label>
            <input class="form-control" id="email" type="email" name="email">
            </div>
                            <!-- Form Group (last name)-->
            <div class="col-md-6">
              <label class="small mb-1" for="test_name">Test Name</label>
              <input class="form-control" id="test_name" type="text" name="test_name">
            </div>
          </div>
        <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <label class="small mb-1" for="fname">First Name</label>
            <input class="form-control" id="fname" type="text" name="fname">
            </div>
                            <!-- Form Group (last name)-->
            <div class="col-md-6">
              <label class="small mb-1" for="lname">Last Name</label>
              <input class="form-control" id="lname" type="text" name="lname">
            </div>
          </div>
                        <!-- Form Row        -->
          <div class="row gx-3 mb-3">
                  
          <div class="col-md-6">
          <label for="gender">Gender</label>
          <input class="form-control" id="gender" name="gender" >
          </div>
          <div class="col-md-6">
          <label for="reg_date">Registration Date</label>
          <input type="date" class="form-control" id="reg_date" name="reg_date">
          </div>
                            <!-- Form Group (location)-->
          <div class="col-md-6">
          <label class="small mb-1" for="patient_id">Patient Id</label>
          <input class="form-control" id="patient_id" type="text"  name="patient_id">
          </div>

            <div class="col-md-6">
            <label class="small mb-1" for="sample_collected_at">Sample Collected At</label>
            <input class="form-control" id="sample_collected_at" type="text" name="sample_collected_at">
            </div>
            </div>
                  
            <div class="row gx-3 mb-3">
                            <!-- Form Group (reg_time number)-->
            <div class="col-md-6">
            <label class="small mb-1" for="dob">Date of Birth</label>
            <input class="form-control" id="dob" type="Date" name="dob">
            </div>
                            <!-- Form Group (dob)-->
            <div class="col-md-6">
            <label class="small mb-1" for="reg_time">Registration Time</label>
            <input class="form-control" id="reg_time" type="time" name="reg_time">
            </div>
            </div>
            <div class="row gx-3 mb-3">
            <div class="col-md-6">
          <label for="investigation">Investigation</label>
          <textarea class="form-control rounded-0" id="investigation" name="investigation" rows="3"></textarea>
          </div>
          <div class="col-md-6">
          <label for="observed_value">Observed value</label>
          <textarea class="form-control rounded-0" class="form-control" id="observed_value" name="observed_value"  rows="3"></textarea>
          </div>      

          <div class="col-md-6">
          <label for="unit">Unit</label>
          <textarea class="form-control rounded-0" id="unit" name="unit" rows="3"></textarea>
          </div>
          <div class="col-md-6">
          <label for="biological_ref">Biological Reference</label>
          <textarea class="form-control rounded-0" class="form-control" id="biological_ref" name="biological_ref"  rows="3"></textarea>
          </div>      
        </div>
        </div>
        <div class="text-center">
        <button type="submit" class="btn" style="background-color:#151c48; color:white; width:150px; font-size:16px; border-radius: 12px; margin-bottom:10px;">Add</button>
        
</div>
        </fieldset>
      </form>
    </div>

    <div style="margin: 30px 30px 30px 30px; font-size:12px">

      <table class="table" id="myTable">
        <thead>
          <tr>
          <th scope="col">#</th>
          <th scope="col">Username</th>
          <th scope="col">Email</th>
          <th scope="col">Test Name</th>
            <th scope="col">FName</th>
            <th scope="col">LName</th>
            <th scope="col">Gender</th>
            <th scope="col">Sample Collected At</th>
            <th scope="col">Patient Id</th>
            <th scope="col">DOB</th>
            <th scope="col">Registration Date</th>
            <th scope="col">Registration Time</th>
            <th scope="col">Investigation</th>
            <th scope="col">Observed Value</th>
         <th scope="col">Unit</th>
         <th scope="col">Biological Reference</th>
         <th scope="col">Actions</th>
         <th scope="col">Mail/Generate Report</th>
         
         </tr>
        </thead>

        <tbody>
        <?php
          $sql = "SELECT * FROM `visited_patients`";
          $result = mysqli_query($conn,$sql);
          $v_id = 0 ; //so even if the gap come or got anything deleted it will be in order its come from here and not database
          $patient_id=20231811030;
          while($row = mysqli_fetch_assoc($result)){
          $v_id = $v_id + 1;
          $patient_id=$patient_id+1;
          echo  "<tr>
            <td>". $v_id . " </td>
            <td>". $row['username'] . "</td>
            <td>". $row['email'] . "</td>
            <td>". $row['test_name'] . "</td>
            <td>". $row['fname'] . "</td>
            <td>". $row['lname'] . "</td>
            <td>". $row['gender'] . "</td>
            <td>". $row['sample_collected_at'] . "</td>
            <td scope='row'>". $patient_id . " </td>
            <td>". $row['dob'] . "</td>
            <td>". $row['reg_date'] . "</td>
            <td>". $row['reg_time'] . "</td>
            <td>". $row['investigation'] . "</td>
            <td>". $row['observed_value'] . "</td>
            <td>". $row['unit'] . "</td>
            <td>". $row['biological_ref'] . "</td>


            
            <td><button class='edit btn btn-sm btn-info' id=". $row['v_id'] .">Edit</button><br><button class='delete btn btn-sm btn-danger' id=". $row['v_id'] ." style='font-size: 12px;'>Delete</button> </td>
            <td><form method=post>
            </form><button class='Gen btn btn-sm btn-dark' id=". $row['v_id'] ." style='font-size: 12px;'>Generate Report</button></td>
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
          email= tr.getElementsByTagName("td")[2].innerText;
          test_name= tr.getElementsByTagName("td")[3].innerText;
          fname= tr.getElementsByTagName("td")[4].innerText;
          lname= tr.getElementsByTagName("td")[5].innerText;
          gender=tr.getElementsByTagName("td")[6].innerText;
          sample_collected_at=tr.getElementsByTagName("td")[7].innerText;
          patient_id=tr.getElementsByTagName("td")[8].innerText;
          dob=tr.getElementsByTagName("td")[9].innerText;
          reg_date=tr.getElementsByTagName("td")[10].innerText;
          reg_time=tr.getElementsByTagName("td")[11].innerText;
          investigation=tr.getElementsByTagName("td")[12].innerText;
          observed_value=tr.getElementsByTagName("td")[13].innerText;
          unit=tr.getElementsByTagName("td")[14].innerText;
          biological_ref=tr.getElementsByTagName("td")[15].innerText;

          emailEdit.value = email;
          test_nameEdit.value  = test_name;
          fnameEdit.value = fname;
          lnameEdit.value  = lname;
          genderEdit.value = gender;
          sample_collected_atEdit.value = sample_collected_at;
          patient_idEdit.value= patient_id;
          dobEdit.value= dob;
          reg_dateEdit.value= reg_date;
          reg_timeEdit.value= reg_time;
          investigationEdit.value=investigation;
          observed_valueEdit.value=observed_value;
          unitEdit.value=unit;
          biological_refEdit.value=biological_ref;
          v_idEdit.value = e.target.id;
          console.log(e.target.id);
          $('#editModal').modal('toggle')

        })
      })
</script>

<script>
      Gens = document.getElementsByClassName('Gen');
      Array.from(Gens).forEach((element)=> {
        element.addEventListener("click",(e) =>{
          console.log("edit ", );
          tr = e.target.parentNode.parentNode;
          email= tr.getElementsByTagName("td")[2].innerText;
          test_name= tr.getElementsByTagName("td")[3].innerText;
          fname= tr.getElementsByTagName("td")[4].innerText;
          lname= tr.getElementsByTagName("td")[5].innerText;
          gender=tr.getElementsByTagName("td")[6].innerText;
          sample_collected_at=tr.getElementsByTagName("td")[7].innerText;
          patient_id=tr.getElementsByTagName("td")[8].innerText;
          dob=tr.getElementsByTagName("td")[9].innerText;
          reg_date=tr.getElementsByTagName("td")[10].innerText;
          reg_time=tr.getElementsByTagName("td")[11].innerText;
          investigation=tr.getElementsByTagName("td")[12].innerText;
          observed_value=tr.getElementsByTagName("td")[13].innerText;
          unit=tr.getElementsByTagName("td")[14].innerText;
          biological_ref=tr.getElementsByTagName("td")[15].innerText;
          emaill=tr.getElementsByTagName("td")[2].innerText;

          console.log(fname,lname);
          emailGenn.value = emaill;
          emailGen.value = email;
          test_nameGen.value = test_name;
          fnameGen.value = fname;
          lnameGen.value  = lname;
          genderGen.value= gender;
          sample_collected_atGen.value=sample_collected_at;
          patient_idGen.value=patient_id;
          dobGen.value=dob;
          reg_dateGen.value=reg_date;
          reg_timeGen.value=reg_time;
          investigationGen.value=investigation;
          observed_valueGen.value=observed_value;
          unitGen.value=unit;
biological_refGen.value=biological_ref;
          v_idGen.value = e.target.id;
          console.log(e.target.id);
          $('#editModalgen').modal('toggle')

        })
      })
</script>

<script>
      // For deleting the record
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit " );
        v_id = e.target.id.substr(); //substr is JS ka method which 1 ko fetch karke baki sab show karega

        if (confirm("Are you sure you want to delete this user record!")) {
          console.log("yes");
          window.location = `reportgen_table.php?delete=${v_id}`; 
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