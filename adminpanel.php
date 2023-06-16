<?php
include("php/connect.php");

if ($_SESSION["admin"] != true)
  header("Location: adminlogin.php");

$sess_memid = $_SESSION["sess_memid"];

$query = "SELECT admin_name FROM admin DESC";

function getAll($conn)
{
  $query = "SELECT * from product ORDER BY product_id DESC";
  $result = mysqli_query($conn, $query);
  if (!$result) {
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }
  return $result;
}

$result = getAll($conn);
require_once "./template/headeradmin.php";
?>

<div class="container" style="margin-top:30px">
  <a href="adminadd.php" class="btn btn-primary btn-info" style="margin-top: 20px;" role="button">Add Product</a>
  <!-- <a href="signout.php" class="btn btn-secondary btn-info" style="margin-top: 20px;" role="button">Sign out</a> -->
  <table class="table" style="margin-top: 10px;">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Product ID</th>
        <th scope="col">Product Category</th>
        <th scope="col">Product Image</th>
        <th scope="col">Product Name</th>
        <th scope="col">Product Description</th>
        <th scope="col">Product Release Date</th>
        <th scope="col">Product Language</th>
        <th scope="col">Product Price</th>
        <th scope="col">Option</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row['product_id']; ?></td>
          <td><?php echo $row['category_id']; ?></td>
          <td><?php echo $row['product_image']; ?></td>
          <td><?php echo $row['product_name']; ?></td>
          <td><?php echo $row['product_description']; ?></td>
          <td><?php echo $row['product_release_date']; ?></td>
          <td><?php echo $row['product_language']; ?></td>
          <td><?php echo $row['product_price']; ?></td>
          <td><a href="adminedit.php?product_id=<?php echo $row['product_id']; ?>">Edit</a><br><a href="admindelete.php?product_id=<?php echo $row['product_id']; ?>">Delete</a></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php
if (isset($conn)) {
  mysqli_close($conn);
}
?>