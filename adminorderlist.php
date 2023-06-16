<?php
include("./php/connect.php");
require "./template/headeradmin.php";

if ($_SESSION["admin"] != true)
  header("Location: adminlogin.php");

$sess_memid = $_SESSION["sess_memid"];

$query = "SELECT admin_name FROM admin DESC";

function getAll($conn)
{
  $query = "SELECT * from `order` ORDER BY order_id DESC";
  $result = mysqli_query($conn, $query);
  if (!$result) {
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }
  return $result;
}

$result = getAll($conn);


?>

<div class="container bg-light" style="margin-top:30px">
<a href="generate_pdf.php" class="btn btn-primary btn-info" style="margin-top: 20px;" role="button">Generate Report</a>
  <table class="table" style="margin-top: 10px;">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Order ID</th>
        <th scope="col">Order Total Price</th>
        <th scope="col">Order Status</th>
        <th scope="col">Option</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row['order_id']; ?></td>
          <td>MYR <?php echo $row['order_total_price']; ?></td>
          <td><?php echo $row['order_status']; ?></td>
          <td><a href="adminorderdetail.php?order_id=<?php echo $row['order_id']; ?>">View Order</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>