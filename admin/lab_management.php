<?php
include("partials/_dbconn.php");

$db= $conn;
$tableName="lab_management";
$columns= ['sno','lab_instrument','items_available','tstamp'];
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
<style>
#head, #btnn{
  display: inline-block;
}

  th{
    background-color: #373737;
    color: white;
  }
    tr:nth-child(odd) {
            background-color:#C5C6D0;
        }
        </style>

</head>
<body>
<div class="container">
 <div class="row">
   <div class="col-lg-12">
    <?php echo $deleteMsg??''; ?>
    <div class="table-responsive">
    <h3 id="head" class="text-center">Lab Instruments Available</h3>
      <button id="btnn" type="button" onclick="window.location.href = 'labupdate_table.php';" class="btn btn-info" style="float: right;">Manage Lab</button>
      <table  class="table table-bordered table-hover">
    
       <thead><tr><th>#</th>
       <th>Lab Instruments</th>
         <th>Items Available</th>
         <th>Time</th>
         </thead>
    <tbody>
  <?php
      if(is_array($fetchData)){      
      $sn=1;
      foreach($fetchData as $data){
    ?>
      <tr>
      <td><?php echo $sn; ?></td>
      <td><?php echo $data['lab_instrument']??''; ?></td>
      <td><?php echo $data['items_available']??''; ?></td>
      <td><?php echo $data['tstamp']??''; ?></td>
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