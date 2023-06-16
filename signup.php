<?php
include("php/connect.php");
require_once "./template/header.php";
?>

<?php
if (isset($_POST["registerbtn"])) {
  $dname = $_POST["dname"];
  $demail = $_POST["demail"];
  $dbirthday = $_POST["dbirthday"];
  $dpword = base64_encode($_POST["dpword"]);
  $daddress = $_POST["daddress"];
  $dstate = $_POST["dstate"];
  $dcity = $_POST["dcity"];
  $dpostcode = $_POST["dpostcode"];
  $dphone = $_POST["dphone"];

  $sql = "select * from customer where customer_email = '$demail'";
  $result = mysqli_query($conn, $sql);


  if (mysqli_num_rows($result) != 0) {
  ?>

    <script>
      $(document).ready(function() {
        bootbox.alert({
          size: "small",
          title: "Register Error",
          message: "The email has an account"
        })
      });
    </script>

  <?php
  } else {
    mysqli_query($conn, "insert into customer (customer_name,customer_email,customer_birthday,customer_password,customer_address,customer_state,customer_city,customer_postcode,customer_contactNo) values ('$dname','$demail','$dbirthday','$dpword','$daddress','$dstate','$dcity','$dpostcode','$dphone')") or die(mysqli_error());
  ?>

    <script>
      $(document).ready(function() {
        bootbox.alert({
          size: "small",
          title: "Register Successful",
          message: "Please proceed to login."
        })
      });
    </script>

<?php
  }
}
?>
<style type="text/css">
  .my-error-class {
    color: red;
  }
</style>
<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col">
      <form method="post" id="registerform">
        <h1 class="h3 mb-3 font-weight-normal">Signup new account</h1>

        <h1 class="h5 mb-3 font-weight-normal">Personal Information</h1>
        <label class="sr-only">Name</label>
        <input type="text" name="dname" class="form-control" placeholder="Name" required autofocus>

        <br><label>Birthday</label>
        <input type="date" name="dbirthday" min="1950-01-01" max="2002-12-31" class="form-control" placeholder="Name" required autofocus>

        <h1 class="h5 mb-3 font-weight-normal">Login Credential</h1>
        <label class="sr-only">Email address</label>
        <input type="email" name="demail" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>

        <label class="sr-only">Password</label>
        <input type="password" name="dpword" id="password" class="form-control" placeholder="Password" required>

        <label class="sr-only">Re-enter Password</label>
        <input type="password" name="con_dpword" class="form-control" placeholder="Re-enter Password" required>

        <h1 class="h5 mb-3 font-weight-normal">Shipping & Billing Address</h1>
        <label class="sr-only">Address</label>
        <input type="text" name="daddress" class="form-control" placeholder="Address" required>

        <label class="sr-only">State</label>
        <select class="form-control" name="dstate">
          <option value="Johor">Johor</option>
          <option value="Kedah">Kedah</option>
          <option value="Kelantan">Kelantan</option>
          <option value="Melaka">Melaka</option>
          <option value="Negeri Sembilan">Negeri Sembilan</option>
          <option value="Pahang">Pahang</option>
          <option value="Penang">Penang</option>
          <option value="Perak">Perak</option>
          <option value="Perlis">Perlis</option>
          <option value="Sabah">Sabah</option>
          <option value="Sarawak">Sarawak</option>
          <option value="Selangor">Selangor</option>
          <option value="Terengganu">Terengganu</option>
        </select>

        <label class="sr-only">City</label>
        <input type="text" name="dcity" class="form-control" placeholder="City" required>

        <label class="sr-only">Postcode</label>
        <input type="text" name="dpostcode" class="form-control" placeholder="Postcode" required>

        <label class="sr-only">Phone number</label>
        <input type="text" pattern="\d*" maxlength="11" name="dphone" class="form-control" placeholder="Phone number" required>

        <button name="registerbtn" class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top: 10px;">Signup</button>

      </form>
    </div>
  </div>
</div>

<?php
if (isset($conn)) {
  mysqli_close($conn);
}
require_once "./template/footer.php";
?>

<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/lib/jquery.js"></script>
<script src="bootstrap/js/jquery.validate.js"></script>
<script>
  $(document).ready(function() {
    //alert('a');
    $("#registerform").validate({
      errorClass: "my-error-class",
      validClass: "my-valid-class",
      rules: {
        dname: {
          required: true
        },
        dpword: {
          required: true
        },
        demail: {
          required: true,
          email: true
        },
        dphone: {
          required: true,
          number: true,
          minlength: 10
        },
        daddress: {
          required: true
        },
        postcode: {
          required: true,
          minlength: 5,
          maxlength: 5,
          number: true
        },
        dbirthday: {
          required: true
        },
        dstate: {
          required: true
        },
        dcity: {
          required: true
        },
        con_dpword: {
          equalTo: "#password"
        }
      },
      messages: {
        dname: {
          required: "Please Enter your name"
        },
        dpword: {
          required: "Please Enter your password"
        },
        demail: {
          required: "Please Enter your email"
        },
        dphone: {
          required: "Please Enter your phone"
        },
        postcode: {
          required: "Please Enter your postcode"
        },
        dstate: {
          required: "Please select your status."
        },
        dbirthday: {
          required: "Please select your Birthday."
        },
        dcity: {
          required: "Please select your city."
        },
        con_dpword: {
          equalTo: "Please enter the same password with above"
        }
      }
    });
  });
</script>
</body>

</html>