<!-- <?php
  session_start();

    if (isset($_SESSION['username'])){
      $username = $_SESSION['username'];
        $sql = "SELECT `user_id`, `username`, `password`, `reg_time`, `fname`, `lname`, `address`, `gender`, `email` FROM `user` WHERE username = '$username'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $username = $row['username']; 
        $email = $row['email'];
        $reg = $row['reg_time'];
    }
      else {
        echo "User not found."; // Handle the case when the user is not found in the database.
      }
    }
    else {
      echo "Username not found in the session.";
    }
    
  
?> -->

<?php
$to_email = "janhavi1102singh@gmail.com";
$subject = "Appointment Notice";
$body = "Hello,\n\nThanks for scheduling your appointment with us.\n\nYour appointment has been confirmed.";
$headers = "From: thepatholabmj@gmail.com";

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}
?>

<!-- <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $email = $data['email'];
    $subject = $data['subject'];
    $message = $data['message'];

    $headers = 'From: your_email@example.com' . "\r\n" .
               'Reply-To: your_email@example.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    if (mail($email, $subject, $message, $headers)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?> -->
