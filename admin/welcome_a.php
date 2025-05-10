<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  
  header("location: login.php");
  exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="styles_a.css">

    <!-- Link for CSS From DataTables jQuery Site -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

   <!-- awesome font -->
    <script src="https://kit.fontawesome.com/351dd8f265.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    

    <title><?php echo''. $_SESSION['admin_name'] .' - Dashboard ';?></title>


  </head>
  <body>
    <div class="content">
    <header>
      <h1>Welcome  <?php echo $_SESSION['admin_name']?>!</h1>
    </header>

    <!--sidebar  -->      
   <?php
       include 'partials/navBoard_a.php';
    ?>
        
    <!-- to show content -->
    <section id="main-content">
    <?php include 'dashboard_a.php'; ?> <!-- by default welcome page-->
    </section>

    </div>
   
    <!-- footer -->
  <div class="container-fluid bg-dark text-light fixed-bottom">
    <p class="text-center py-2 my-0">Copyright The PathoLab-2023 | All Right Reserved </p>
  </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    
    <!-- Script for onclicking performance of the dashboard content area -->
    <script src="jsscript.js"></script>

    <!-- Data table sites jQuery -->
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
      let table = new DataTable('#myTable');
    </script>
    <script>
      // edits = document.getElementsByClassName('edit');
      // Array.from(edits).forEach((element)=> {
      //   element.addEventListener("click",(e) =>{
      //     console.log("edit ", );
      //     tr = e.target.parentNode.parentNode;
      //     username= tr.getElementsByTagName("td")[0].innerText;
      //     test_name= tr.getElementsByTagName("td")[1].innerText;
      //     // fee= tr.getElementsByTagName("td")[2].innerText;
      //     // appintmentDate = tr.getElementsByTagName("td")[3].innerText;
      //     // appintmentTime = tr.getElementsByTagName("td")[4].innerText;
      //     console.log(username,test_name,fee,appointmentDate,appointmentTime);
      //     test_nameEdit.value = test_name;
      //     usernameEdit.value  = username;
      //     // feeEdit.value  = fee;
      //     // appointmentDateEdit.value  = appointmentDate;
      //     // appointmentTimeEdit.value  = appointmentTime;
      //     appointment_idEdit.value = e.target.id;
      //     console.log(e.target.id);
      //     $('#editModal').modal('toggle')

      //   })
      // })
      
       // For deleting the record
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit " );
        appointment_id = e.target.id.substr(1); //substr is JS ka method which 1 ko fetch karke baki sab show karega

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `apt_management.php?delete=${appointment_id}`; 
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

