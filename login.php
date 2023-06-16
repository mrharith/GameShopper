<?php
include("php/connect.php");

require_once "./template/header.php";
?>

<?php
if (isset($_POST["loginbtn"])) {
  $demail = $_POST["demail"];
  $dpword = base64_encode($_POST["dpword"]);

  $sql = "select * from customer where customer_email= '$demail' and customer_password='$dpword'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  if (mysqli_num_rows($result) != 1) {
?>
    <script>
      $(document).ready(function() {
        bootbox.alert({
          size: "small",
          title: "Login Error",
          message: "Please Enter the correct email/password."
        })
      });
    </script>
<?php
  } else {
    $_SESSION["sess_memid"] = $row["customer_id"];
    $_SESSION["loggedin"] = true;
    header("Location: index.php");
  }
}
?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-4"></div>
    <div class="col-4 ">
      <form style="text-align: center;" method="post" name="loginfrm">
        <img class="mb-4" src="image\avatar.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please log in</h1>

        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="demail" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="dpword" id="inputPassword" class="form-control" placeholder="Password" required>

        <a href="forgot.php" style="text-decoration: none;color: black; text-align: right;">Forgot password?</a>

        <button class="btn btn-lg btn-primary btn-block" name="loginbtn" type="submit" style="margin-top: 20px;">Log in</button>
        <br>

      </form>
      <h1 class="h5 mb-3 font-weight-normal text-center">No Account? Signup here.</h1>
      <a href="signup.php" class="btn btn-lg btn-secondary btn-block btn-info" style="margin-top: 20px; margin-bottom:10px;" role="button">Sign up</a>
      <p class="text-center"><a href="adminlogin.php" style="text-decoration:none; color:black;">Admin Login</a></p>
    </div>
  </div>
</div>

<?php
if (isset($conn)) {
  mysqli_close($conn);
}
require_once "./template/footer.php";
?>

<!-- jQuery -->
<script src="bootstrap/js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Contact Form JavaScript -->
<!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
<script src="bootstrap/js/jquery.validate.js"></script>
<script>
  $(document).ready(function() {
    //alert('a');
    $("#loginfrm").validate({
      errorClass: "my-error-class",
      rules: {
        demail: {
          required: true,
          demail: true
        },
        dpword: {
          required: true,
        }
      },
      messages: {
        demail: {
          required: "Please Enter your email"
        },
        dpword: {
          required: "Please Enter your password"
        }
      }
    });
  });
</script>