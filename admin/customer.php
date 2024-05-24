<?php
include("partials/_dbconn.php");

$db= $conn;
$tableName="contact";
$columns= ['sno', 'name', 'mob', 'message', 'tstamp'];
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
$query = "SELECT ".$columnName." FROM $tableName"." ORDER BY sno DESC";
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
  <link rel="stylesheet" type="text/css" href="admin/styles_a.css"/>
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
   <div class="col-sm-12">
    <?php echo $deleteMsg??''; ?>
    <div class="table-responsive">
      <table class="table table-bordered">
      <h3 id="head" class="text-center">Messages: </h3>
      <!-- <button id="btnn" type="button" onclick="window.location.href = 'testupdate_table.php';" class="btn btn-info" style="float: right; background-color:#151c48; color:white; width:150px; font-size:16px; border-radius: 12px;">Manage Tests</button> -->

       <thead><tr><th>S.N</th>

         <th>Name</th>
         <th>Mobile</th>
         <th class="w-100">Message</th>
  
  

    </thead>
    <tbody>
  <?php
      if(is_array($fetchData)){      
      $sn=1;
      foreach($fetchData as $data){
    ?>
      <tr>
      <td><?php echo $sn; ?></td>
      <td><?php echo $data['name']??''; ?></td>
      <td><?php echo $data['mob']??''; ?></td>
      <td><?php echo $data['message']??''; ?></td>
    
      
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

     
<?php
$selectQuery = "SELECT * FROM uploaded_prescription";
$result = mysqli_query($conn, $selectQuery);
$sno = 0 ;
?>
<h3 id="head" class="text-center">Messages: </h3>
<table class="table" id="myTable">
<thead><tr><th>S.N</th>

         <th>Patient</th>
         <th>Email</th>
         <th>Mobile</th>
         <th>File Name</th>
         <th>Uploaded On</th>

    </thead>
    <tbody>
    
    <?php 
    // session_start();
    // $file_name = $_SESSION['file'];
        while($row = mysqli_fetch_assoc($result)){
          $sno = $sno + 1;
          echo  "<tr>";
          echo "<td>" . $sno . "</td>";
          echo "<td>". $row['patient'] . "</td>";
          echo "<td>". $row['patient_email'] . "</td>";
          echo "<td>". $row['mob'] . "</td>";
          echo "<td><img src='uploads/'. $file_name.' width='100'> </td>";
           echo "<td>". $row['uploaded_on'] . "</td>";
           echo  "</tr>";
          }    ?>
        </tbody> 
      </table>
   </div>
</div>
</div>
</div>
</body>
</html>

