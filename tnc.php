<?php
include("php/connect.php");

require_once "./template/header.php";
?>

<div class="container" style="margin-top:30px">
  <div class="col bg-light">
    <h1 class="h3 mb-3 font-weight-bold">Delivery Information</h1>
    <p><b>1. Acceptance of terms and conditions</b></p>
    <p>By using this website, you hereby agree to be bound by the terms and conditions detailed on this page.</p>
    <p><b>2. General</b></p>
    <p>With due reason, GameShopper reserves the right to change the terms and conditions on this website as we see fit or if conditions require us to do so.</p>
    <p><b>3. Orders</b></p>
    <p>An order will only be processed after payment has been received by GameShopper.</p>
    <p><b>4. Prices</b></p>
    <p>Prices are as stated on this website but may be subject to change should there be any technical issues leading to wrong pricings.</p>
    <p><b>5. Personal information</b></p>
    <p>The information we collect on this website will be used to improve customer experience and will not be sold to third parties.</p>
    <p><b>6. Warranty</b></p>
    <p>For used games, we provide warranty of 3 days. For postage customers, the period of 3 days start from the day you receive your purchased item.
        <br>For hardware, warranty is covered by the respective manufacturers and you can contact us for assistance with the claim should there be any issues on your side.
    </p>
  </div>
</div>

<?php
if (isset($conn)) {
  mysqli_close($conn);
}
require_once "./template/footer.php";
?>