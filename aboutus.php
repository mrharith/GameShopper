<?php
include("php/connect.php");

require_once "./template/header.php";
?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col bg-light">
      <h1 class="h3 mb-3 font-weight-bold">About Us</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in augue a mi maximus lacinia. Sed quis erat vestibulum, condimentum eros eget, pulvinar nisl. In imperdiet tristique semper. Aenean a semper turpis, eu dignissim nisl. Ut placerat eleifend leo vel elementum. Maecenas venenatis, tortor eu feugiat mattis, elit nunc maximus lectus, sollicitudin placerat enim augue posuere sem. Maecenas lobortis sit amet nulla mattis hendrerit. Nulla non placerat nunc. Nam elementum vulputate libero, in faucibus metus fringilla sit amet. Nam vehicula accumsan suscipit. Donec eu justo ac orci pulvinar mollis quis eget sapien. Fusce commodo augue vitae ligula feugiat, maximus suscipit est venenatis.</p>
    </div>
  </div>
</div>

<?php
if (isset($conn)) {
  mysqli_close($conn);
}
require_once "./template/footer.php";
?>