<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    

    <title>Book Test</title>

    <style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 25%;
  padding: 0 10px;
}

/* Remove extra left and right margins, due to padding in columns */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); /* this adds the "card" effect */
  padding: 16px;
  text-align: center;
  background-color: #f1f1f1;
}

/* Responsive columns - one column layout (vertical) on small screens */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}
      </style>
  </head>
  <body>
    
     <?php
      // connection
      include 'partials/_dbconn.php'; 
    ?>
    
    <?php
    // connection
    include 'partials/_nav.php'; 
    ?>

    
<div class="container my-3">
<h2 style="text-align:center; color: #151c48"><u><strong>Book Test</strong></u></h2>
<div class="row p-md-3 justify-content-lg-center">


   <?php 
      $sql = "SELECT * FROM `test`";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)){
        
        $id=  $row['test_id'];
        $test = $row['test_name'];
        $desc = $row['test_description'];
        $price = $row['fee'];

echo

'


  <div class="column">
<div class="card my-3" style="width: 15rem; height: 14rem; margin-left: 20px; background-color: #cdecf4">
<div class="card-body">
  
  <h5 class="card-title"> ' . $test . '</h5>
  <p class="card-text"> Rs. '.$price.'</p>
  </div>
  <div class="card-footer ">
  <a href="test.php?testid=' . $id .' " class="btn btn-primary" style="background-color:#151c48; color:white; border-radius: 12px;">Book Test</a>
</div>
</div>
</div>


'

;


      }
    


      
    ?>
    </div>
    </div>


    <div class="card" style="background-color:#151c48; color:white;">
      <div class="card-footer" >
       <h5 style="text-align: center"> Terms & Conditions</h5>
       <hr>
          <ul  style="font-size: 14px;text-align: left">
<li>By applying for The Patho Lab's Home Service, you are allowing The Patho Lab counsellor to call you back at your convenient time.</li>
<li>Our Health counsellor will guide you in process selection of a test or health checkup as per your requirement and assist you to a home visit appointment.</li>
<li>Once you confirm your booking, one of our trained Phlebotomists will be assigned to visit your home/ office on given date and time for the collection of samples.</li>
<li>Your sample will then be transported to the nearest collection center and will be centrifuged before sending to the lab for processing.</li>
<li>Once the results are processed in the The Patho Lab's Lab, our medical experts at Metropolis will verify the results will be shared with you via email or you can download the report by login into our website -<a href="/pathology/index.php" style="color:#dfe296"> www.ThePathoLab.com</a></li>
<li>In case of any queries, you can reach our customer support team by calling at +91 7892-234-567 or write an email at <a href="" style="color:#dfe296"> thepatholab@customercare.com</a>.</li>
<li>Thank you for choosing The Patho Lab. By entering your phone number, you agree that we may send you text notifications to send offers test or health checkup reminders. By signing up you provide your consent to receive communication from The Patho Lab.</li>
<li><mark>For Home Visit Appointment <i style="color:red">Rs. 200 </i>will be charged. </mark></li>
</ul>

        <br> 
        
      </div>

      <!-- footer -->
    <?php
    include 'partials/_footer.php';
    ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  </body>
</html>

  

<!-- echo Part if the added one does look good -->
<!-- '<div class="col-md-4 my-3">
        <div class="card" style="width: 18rem;">
          <img src="img/profile.png' . $test . ',medicine" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"> <a href="user/test.php?testid=' . $id .' ">' . $test . '</a></h5>
            <p class="card-text">' . substr($desc,0 , 150 ).'...</p>
            <a href="user/test.php?testid=' . $id .' " class="btn btn-primary">Book Test</a>
          </div>
        </div>
      </div>' -->

<!-- 
      <div class="col-auto">
        <div class="card" style="width: 18rem;">
          
          <div class="card-body">
            <h5 class="card-title"> <a href="test.php?testid=' . $id .' ">' . $test . '</a></h5>
            <a href="test.php?testid=' . $id .' " class="btn btn-primary">Book Test</a>
          </div>
        </div>
      </div> -->

      <!-- // <div class="col-auto">
// <div class="card-deck">
// <div class="card" style="width: 18rem;">
  
//   <div class="card-body">
//     <h5 class="card-title"> <a href="test.php?testid=' . $id .' ">' . $test . '</a></h5>
//     <a href="test.php?testid=' . $id .' " class="btn btn-primary">Book Test</a>
//   </div>
// </div>
// </div>
// </div> ' -->


<!--         // $img=$row['image'];
        // Use the for loop to iterate


//         echo ''<div class="card" style="width: 15rem; margin-bottom: 2rem;
//         margin-left: 2rem;">'
// 	<img class="card-img-top" src="..."
// 			alt="Card image cap">
// 	<div class="card-block">
// 		<h4 class="card-title">' . $test . '</h4>
// 		<p class="card-text">
// 			Some quick example text to build
// 			on the card title and make up the
// 			bulk of the cards content.
// 		</p>
// 		<a href="user/test.php?testid=' . $id .' " class="btn btn-primary">
// 			Book Test
// 		</a>
// 	</div>
// </div>'; -->