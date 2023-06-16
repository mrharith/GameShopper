<?php
include("php/connect.php");

require_once "./template/header.php";
?>

<div class="container" style="margin-top:30px">
  <div class="col bg-light">
    <h1 class="h3 mb-3 font-weight-bold">Delivery Information</h1>
    <p><b>Shipment</b></p>
    <p>We deliver games using Poslaju. For bulkier items, we use Citylink. After your order has been processed, you can check your tracking number under your order.</p>
    <p><b>Shipping Schedule</b></p>
    <p>
      <table>
        <tr>
          <th>Payment</th>
          <th>Shipment</th>
        </tr>
        <tr>
          <td>Before 1pm, working day</td>
          <td>Same day</td>
        </tr>
        <tr>
          <td>After 1pm, working day</td>
          <td>Next working day</td>
        </tr>
        <tr>
          <td>Non-working day</td>
          <td>Next working day</td>
        </tr>
      </table>
    </p>
    <p>Delivery takes 1-2 working days for Semenanjung Malaysia and 1-3 working days for Sabah/Sarawak.</p>
    <p>We handle all items with utmost care. Items are wrapped with one layer of bubble wrap and another wrap of thick paper or cling wrap.</p>

  </div>
</div>

<?php
if (isset($conn)) {
  mysqli_close($conn);
}
require_once "./template/footer.php";
?>