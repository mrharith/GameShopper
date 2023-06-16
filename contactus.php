<?php
include("php/connect.php");

require_once "./template/header.php";
?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col bg-light text-center">
      <h1 class="h3 mb-3 font-weight-bold">Contact US</h1>
      <p><b>Address: </b></p>
      <p>GameShopper
        <br>No. 1, Jalan ABC,
        <br>Taman CDF, GHI,
        <br>12345, Melaka
        <br>Malaysia</p>
      <p>
        <b>Email Address:</b>
        <br>harithdanialpoh@gmail.com</p>
      <p><b>Contact Number: </b>
        <br>014 2330388</p>
    </div>
  </div>
</div>

<?php
if (isset($conn)) {
  mysqli_close($conn);
}
require_once "./template/footer.php";
?>