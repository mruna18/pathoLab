<?php
$insert = false;
$update = false;
$delete = false;
 
include 'partials/_dbconn.php'; 

//for GET DELETE
  if(isset($_GET['delete'])){
    $user_id = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `user` WHERE `user_id` = $user_id";
    $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['user_idEdit'])){
  // Update the record
  $user_id=$_POST['user_idEdit'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  // $gender = $_POST['gender'];
  $username = $_POST['username'];
  $address = $_POST['address'];
  $email = $_POST['email'];;
  $city = $_POST['city'];
  
  $mob = $_POST['mob'];
  $dob = $_POST['dob'];
  
 
  //sql query
  $sql = "UPDATE `user` SET `fname` ='$fname',`lname`= '$lname', `address`='$address',`email`='$email',`city`='$city',`mob`='$mob',`dob`='$dob' WHERE `user`.`user_id` = $user_id";
  $result = mysqli_query($conn,$sql);
  if($result){
    $update = true;
   
}
else{
    echo "We could not update the record successfully";
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

.table thead th  {
    vertical-align: top;
    border-top: 1px solid #dee2e6;
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
        <h5 class="modal-title" id="editModalLabel">User Management</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="userupdate_table.php" method="post">
        <input type="hidden" name="user_idEdit" id="user_idEdit">
        <div class="form-group">
        <label class="small mb-1" for="username">Username</label>
  <input class="form-control" id="username" type="text" name="username">
  </div>
        <div class="form-group">
        <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <label class="small mb-1" for="fname">First name</label>
            <input class="form-control" id="fname" type="text" name="fname">
            </div>
                            <!-- Form Group (last name)-->
            <div class="col-md-6">
              <label class="small mb-1" for="lname">Last name</label>
              <input class="form-control" id="lname" type="text" name="lname">
            </div>
          </div>
                        <!-- Form Row        -->
          <div class="row gx-3 mb-3">
                  
          <div class="col-md-6">
          <label class="small mb-1" for="city">City</label>
          <input class="form-control" id="city" type="text" name="city">
          </div>

                            <!-- Form Group (location)-->
                <div class="col-md-6">
                    <label class="small mb-1" for="address">Address</label>
                    <input class="form-control" id="address" type="text"  name="address">
                            </div>

                        </div>
                        <!-- Form Group (email address)-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (mob number)-->
                            <div class="col-md-6">
                            <label class="small mb-1" for="email">Email address</label>
                            <input class="form-control" id="email" type="email" name="email">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="gender">Gender</label>
                            <input class="form-control" id="gender" type="gender" name="gender">
                        </div>
</div>


                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (mob number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="mob">Mobile number</label>
                                <input class="form-control" id="mob" type="tel" name="mob">
                            </div>
                            <!-- Form Group (dob)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="dob">Date of birth</label>
                                <input class="form-control" id="dob" type="text" name="dob">
                            </div>
                        </div>
        </div>
        </div>
        <button type="submit" class="btn btn-info">Update</button><br>
        </div>
        
      </form>



    </div>
  </div>
</div>

    <!-- For showing the alert -->
    <?php
    if($insert){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Added Successfully!</strong> user has been Added.
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
    }
    ?>
     <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your user has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your user has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>




    <div class=" my-4" style="margin: 0 50px 0 50px;backgroud-color: #f2f2f2">

      <table class="table" id="myTable">
        <thead>
          <tr>
        <th scope="col">User_id</th>
        <th scope="col">Username</th>
         <th scope="col">First Name</th>
         <th scope="col">Last Name</th>
         <th scope="col">Gender</th>
         <th scope="col">Email</th>
         <th scope="col">Address</th>
         <th scope="col">City</th>
        
         <th scope="col">Mobile</th>
         <th scope="col">DOB</th>
         <th scope="col">Edit</th>
         <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $sql = "SELECT * FROM `user`";
          $result = mysqli_query($conn,$sql);
          $user_id = 0 ; //so even if the gap come or got anything deleted it will be in order its come from here and not database

          while($row = mysqli_fetch_assoc($result)){
          $user_id = $user_id + 1;
          echo  "<tr>
          <td>". $user_id . " </td>
            <td>". $row['username'] . "</td>
            <td>". $row['fname'] . "</td>
            <td>". $row['lname'] . "</td>
            <td>". $row['gender'] . "</td>
            <td>". $row['email'] . "</td>
            <td>". $row['address'] . "</td>
            <td>". $row['city'] . "</td>
          
            <td>". $row['mob'] . "</td>
            <td>". $row['dob'] . "</td>

            <td><button class='edit btn btn-sm btn-info' id=". $row['user_id'] .">Edit</button> </td>
            <td><button class='delete btn btn-sm btn-danger' id=". $row['user_id'] .">Delete</button></td>
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
          usernameEdit=tr.getElementsByTagName("td")[1].innerText;
          fnameEdit= tr.getElementsByTagName("td")[2].innerText;
          lnameEdit= tr.getElementsByTagName("td")[3].innerText;
          genderEdit=tr.getElementsByTagName("td")[4].innerText;
          emailEdit=tr.getElementsByTagName("td")[5].innerText;
          addressEdit=tr.getElementsByTagName("td")[6].innerText;
          cityEdit=tr.getElementsByTagName("td")[7].innerText;
          // statEdit=tr.getElementsByTagName("td")[7].innerText;
          mobEdit=tr.getElementsByTagName("td")[8].innerText;
          dobEdit=tr.getElementsByTagName("td")[9].innerText;
          


          console.log(fname,lname);
          username.value = usernameEdit;
          fname.value = fnameEdit;
          lname.value  = lnameEdit;
          email.value = emailEdit;
          address.value = addressEdit;
          city.value = cityEdit;
          gender.value = genderEdit;
          mob.value = mobEdit;
          dob.value = dobEdit;
          
          user_idEdit.value = e.target.id;
          console.log(e.target.id);
          $('#editModal').modal('toggle')

        })
      })

      // For deleting the record
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit " );
        user_id = e.target.id.substr(); //substr is JS ka method which 1 ko fetch karke baki sab show karega

        if (confirm("Are you sure you want to delete this user!")) {
          console.log("yes");
          window.location = `userupdate_table.php?delete=${user_id}`; 
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