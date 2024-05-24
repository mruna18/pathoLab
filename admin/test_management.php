<?php
include("partials/_dbconn.php");

$db= $conn;
$tableName="test";
$columns= ['test_id','test_name','test_code','test_description','fee','instruction','parameter_cover','parameter','overview'];
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
$query = "SELECT ".$columnName." FROM $tableName"." ORDER BY test_id DESC";
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
      <h3 id="head" class="text-center">Tests available</h3>
      <button id="btnn" type="button" onclick="window.location.href = 'testupdate_table.php';" class="btn btn-info" style="float: right; background-color:#151c48; color:white; width:150px; font-size:16px; border-radius: 12px;">Manage Tests</button>

       <thead><tr><th>S.N</th>

         <th>Test Name</th>
         <th>Test Code</th>
         <th class="w-100">Description</th>
         <th>Price</th>
         <!-- <th class="w-100">Instruction</th>
         <th>Parameter Cover</th>
         <th class="w-100">Parameter</th> -->
         <!-- <th>overview</th> -->
         

    </thead>
    <tbody>
  <?php
      if(is_array($fetchData)){      
      $sn=1;
      foreach($fetchData as $data){
    ?>
      <tr>
      <td><?php echo $sn; ?></td>
      <td><?php echo $data['test_name']??''; ?></td>
      <td><?php echo $data['test_code']??''; ?></td>
      <td><?php echo $data['test_description']??''; ?></td>
      <td><?php echo $data['fee']??''; ?></td>
      <!-- <td class="w-100"><?php //echo $data['instruction']??''; ?></td>-->
      <!-- <td><?php //echo $data['parameter_cover']??''; ?></td> -->
      <!-- <td><?php //echo $data['mobile']??''; ?></td> -->
      <!-- <td><?php //echo $data['parameter']??''; ?></td> -->
      <!-- <td><?php //echo $data['overview']??''; ?></td>   -->
      
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
   </div>
</div>
</div>
</div>

</body>
</html>

<?php

$db= $conn;
$tableName="user";
if(isset($_GET['delete']))
{
  $id= validate($_GET['delete']);
  $condition =['user_id'=>$id];
  $deleteMsg=delete_data($db, $tableName, $condition);
  header("location:form.php");

}
function delete_data($db, $tableName, $condition){

    $conditionData='';
    $i=0;
    foreach($condition as $index => $data){
        $and = ($i > 0)?' AND ':'';
         $conditionData .= $and.$index." = "."'".$data."'";
         $i++;
    }

  $query= "DELETE FROM ".$tableName." WHERE ".$conditionData;
  $result= $db->query($query);
  if($result){
    $msg="data was deleted successfully";
  }else{
    $msg= $db->error;
  }
  return $msg;
}

function validate($value) {
$value = trim($value);
$value = stripslashes($value);
$value = htmlspecialchars($value);
return $value;
}
?>