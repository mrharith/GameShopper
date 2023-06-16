<?php
include("php/connect.php");

require 'PHPMailer/vendor/autoload.php';
require 'PHPMailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'PHPMailer/vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST) & !empty($_POST)) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $sql = "SELECT * FROM customer WHERE customer_email = '$email'";
  $res = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($res);
  if ($count == 1) {
    $r = mysqli_fetch_assoc($res);
    $password = $r['customer_password'];

    $mail = new PHPMailer;
    // $mail->SMTPDebug = 3;
    $mail->isSMTP();
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    // $mail->Host = 'ssl:smtp.gmail.com';
    $mail->Host = gethostbyname('smtp.gmail.com');
    $mail->Port = 587;

    $mail->Username = 'noreplygameshopper@gmail.com';
    $mail->Password = 'GameShopper123';
    $mail->setFrom('harithdanialpoh@gmail.com');
    $mail->addAddress($r['customer_email']);
    $mail->Subject = 'GameShopper Password';
    $mail->Body = 'Please use this password to login = ' . base64_decode($password);
    //send the message, check for errors
    if (!$mail->send()) {
      echo "ERROR: " . $mail->ErrorInfo;
    } else {
      ?>
      <script>
      alert("Please Check your email for password.");
      </script>
      <?php
    }

    // $to = $r['customer_email'];
    // $subject = "Your Recovered Password";

    // $message = "Please use this password to login " . $password;
    // $headers = "From : harithdanialpoh@gmail.com";
    // if(mail($to, $subject, $message, $headers)){
    // 	echo "Your Password has been sent to your email id";
    // }else{
    // 	echo "Failed to Recover your password, try again";
    // }

  } else {
    echo "User name does not exist in database";
  }
}

require "./template/header.php";
?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col">
      <form method="post">
        <h1 class="h3 mb-3 font-weight-normal">Forgot password?</h1>
        <h1 class="h5 mb-3 font-weight-normal">Please fill in this form to recover your password</h1>

        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>

        <button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top: 20px;">Recover Password</button>
      </form>
    </div>
  </div>
</div>

<?php
require "./template/footer.php";
?>