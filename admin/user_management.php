<?php
include("partials/_dbconn.php");

$db= $conn;
$tableName="user";
$columns= ['user_id', 'username','fname','lname','address','mob','gender','email','state','city'];
$fetchData = fetch_data($db, $tableName, $columns);

function fetch_data($db, $tableName, $columns){
 if(empty($db)){
  $msg= "Database connection error";
 }elseif (empty($columns) || !is_array($columns)) {
  $msg="columns Name must be defined in an indexed array";
 }elseif(empty($tableName)){
   $msg= "Table Name is empty";
}else{

$columnName = implode(", ", $columns);
$query = "SELECT ".$columnName." FROM $tableName"." ORDER BY user_id DESC";
$result = $db->query($query);

if($result== true){ 
 if ($result->num_rows > 0) {
    $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
    $msg= $row;
 } else {
    $msg= "No Data Found"; 
 }
}else{
  $msg= mysqli_error($db);
}
}
return $msg;
}
?>

<!DOCTYPE html>
<html>
<head>
  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
<div class="container">
 <div class="row">
   <div class="col-lg-12">
    <?php echo $deleteMsg??''; ?>
    <div class="table-responsive">
    <h3 id="head" class="text-center">Users Signed up</h3>
      <button id="btnn" type="button" onclick="window.location.href = 'userupdate_table.php';" class="btn" style="float: right; background-color:#151c48; color:white; width:150px; font-size:16px; border-radius: 12px;">Manage Users</button>
    <FORM METHOD="POST" ACTION="userupdate_table.php">
      <table  class="table table-bordered table-hover">
    
       <thead><tr><th>S.N</th>
       <th>User ID</th>
         <th>Username</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Gender</th>
         <th>Email</th>
         <th>Address</th>
         <th>Mobile</th>
         <th>City</th>
         <!-- <th>State</th>
         -->

    </thead>
    <tbody>
  <?php
      if(is_array($fetchData)){      
      $sn=1;
      foreach($fetchData as $data){
    ?>
      <tr>
      <td><?php echo $sn; ?></td>
      <td><?php echo $data['user_id']??''; ?></td>
      <td><?php echo $data['username']??''; ?></td>
      <td><?php echo $data['fname']??''; ?></td>
      <td><?php echo $data['lname']??''; ?></td>
      <td><?php echo $data['gender']??''; ?></td>
      <td><?php echo $data['email']??''; ?></td>
      <td><?php echo $data['address']??''; ?></td>
      <td><?php echo $data['mob']??''; ?></td>
      <td><?php echo $data['city']??''; ?></td>
      
     </tr>

     
     <?php
      $sn++;}}else{ ?>
      <tr>
        <td colspan="8">
    <?php echo $fetchData; ?>
  </td>
    <tr>
    <?php
    }?>
    </tbody>
     </table>
  </form>
   </div>
</div>
</div>
</div>


</body>
</html>

<?php

function validate($value) {
$value = trim($value);
$value = stripslashes($value);
$value = htmlspecialchars($value);
return $value;
}
?>