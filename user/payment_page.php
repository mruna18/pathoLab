<?php
  // connection
  include 'partials/_dbconn.php';

  if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $cn_no = $_POST['cn_no'];
    $exp_month = $_POST['exp_month'];
    $exp_year = $_POST['exp_year'];
    $cvv = $_POST['cvv'];
    // $test_name = $_POST['test_name'];
    $fee = $_POST['fee'];
    // $payment_date = $_POST['payment_date'];



    // Create an SQL INSERT query
    $sql = "INSERT INTO `payment`(`username`, `email`, `mobile`, `address`, `city`, `zip`, `cn_no`, `exp_month`, `exp_year`, `cvv`, `fee`, `payment_date`) 
        VALUES ('$username','$email','$mobile','$address','$city','$zip','$cn_no','$exp_month','$exp_year','$cvv','$fee',current_timestamp())";

  $result = mysqli_query($conn,$sql);

  if ($result) {
    // Redirect to the loader page after processing
    echo '<script>window.location.href = "loader_transaction.html";</script>';
    exit(); // Stop executing further code
  } else {
    $showDanger = "Error!";
  }

  // Close the database connection
  $conn->close();
}
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Gateway</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <div class="container">
    <div class="left">
      <h3>BILLING ADDRESS</h3>

    <script>
      function redirectToLoader() {
        window.location.href = 'loader_transaction.html';
      }
    </script>
    
      <!-- if directed here on same page it is giving 2 time insertion of the same data and timestap is not adding if use this T_T -->
      <form action="/pathology/user/payment_page.php" method="post">
      <!-- <form action="/pathology/user/payment_process.php" method="post" onsubmit="redirectToLoader()"> -->
        Full name
        <input type="text" name="username" placeholder="Enter name" required>
        Email
        <input type="text" name="email" placeholder="Enter email" required>
        Mobile
        <input type="text" name="mobile" placeholder="Enter mobile" required>
        Address
        <input type="text" name="address" placeholder="Enter address" required>
        City
        <input type="text" name="city" placeholder="Enter city" required>
        <div id="zip">
          <label>
            State
            <select required>
              <option>Choose State</option>
              <option>Maharashtra</option>
              <option>Delhi</option>
              <option>Kerla</option>
              <option>Goa</option>
              <option>Uttar Pradesh</option>
            </select>
          </label>
          <label >
            Zip Code
            <input type="number" name="zip" placeholder="Enter zipcode" required>
          </label>
        </div>
      <!-- </form> -->
    </div>

    <div class="right">
      <h3>PAYMENT</h3>
      <!-- <form action="payment_process.php" method="post"> -->
        Accepted Card
        <!-- Will add image -->
        <img src="img/card.png" alt="">
        
        <br><br>
        Amount<br>
        <input type="text" name="fee" placeholder="Enter Amount" style="width:370px; height:30px;" required><br><br>
        Credit Card Number<br>
        <input type="text" name="cn_no" placeholder="Enter Card Number" style="width:370px; height:30px;" required><br><br>
  
        Exp month<br>
        <input type="text" name="exp_month" placeholder="Enter Expiry Month" style="width:370px; height:30px;" required><br><br>
        <div id="zip"><br>
          <label>
            Exp year
            <select style="width:150px; height:30px;" required>
              <option>Choose Year..</option>
              <option>2022</option>
              <option>2023</option>
              <option>2024</option>
              <option>2025</option>
              <option>2026</option>
            </select>
          </label>
          <label >
            CVV
            <input type="password" name="cvv" placeholder="CVV" style="width:150px; height:30px;" required>
          </label>
        </div>
        <input type="submit" value="Proceed to Checkout">
      </form>
    </div>
  </div>
</header>
</body>
</html>
