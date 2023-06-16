<?php
include("php/connect.php");
require "./template/header.php";
require_once "./php/cart_functions.php";

// product_id got from form post method, change this place later.
if (isset($_POST['product_id'])) {
  $product_id = $_POST['product_id'];
}

function getProductByID($conn, $product_id)
{
  $query = "SELECT product_id, product_name, product_price FROM product WHERE product_id = '$product_id'";
  $result = mysqli_query($conn, $query);
  if (!$result) {
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }
  return $result;
}

// function getProductPrice($product_id)
// {
//   $conn = mysqli_connect("localhost", "root", "", "gameshopper");
//   $query = "SELECT product_price FROM product WHERE product_id = '$product_id'";
//   $result = mysqli_query($conn, $query);
//   if (!$result) {
//     echo "get product price failed! " . mysqli_error($conn);
//     exit;
//   }
//   $row = mysqli_fetch_assoc($result);
//   return $row['product_price'];
// }

if (isset($product_id)) {
  // new iem selected
  if (!isset($_SESSION['cart'])) {
    // $_SESSION['cart'] is associative array that bookisbn => qty
    $_SESSION['cart'] = array();

    $_SESSION['total_items'] = 0;
    $_SESSION['total_price'] = '0.00';
  }

  if (!isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id] = 1;
  } elseif (isset($_POST['cart'])) {
    $_SESSION['cart'][$product_id]++;
    unset($_POST);
  }
}

// if save change button is clicked , change the qty of each bookisbn
if (isset($_POST['save_change'])) {
  foreach ($_SESSION['cart'] as $product_id => $qty) {
    if ($_POST[$product_id] == '0') {
      unset($_SESSION['cart']["$product_id"]);
    } else {
      $_SESSION['cart']["$product_id"] = $_POST["$product_id"];
    }
  }
}

if (isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))) {
  $_SESSION['total_price'] = total_price($_SESSION['cart']);
  $_SESSION['total_items'] = total_items($_SESSION['cart']);

?>
  <?php
  if ($check) { ?>
    <div class="container">
      <form action="cart.php" method="post">
        <table class="table">
          <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
          </tr>
          <?php
          foreach ($_SESSION['cart'] as $product_id => $qty) {
            $newqty = 0;
            if ($qty) {
              $newqty = $qty;
            }
            $product = mysqli_fetch_assoc(getProductByID($conn, $product_id));
          ?>
            <tr>
              <td><?php echo $product['product_name']; ?></td>
              <td><?php echo "MYR" . $product['product_price']; ?></td>
              <td><input type="text" value="<?php echo $newqty; ?>" size="2" name="<?php echo $product_id; ?>"></td>
              <td><?php echo "MYR " . $newqty * $product['product_price']; ?></td>
            </tr>
          <?php } ?>
          <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th><?php echo $_SESSION['total_items']; ?></th>
            <th><?php echo "MYR " . $_SESSION['total_price']; ?></th>
          </tr>
        </table>
        <input type="submit" class="btn btn-primary" name="save_change" value="Save Changes">
      </form>
      <br /><br />
      <a href="checkout.php" class="btn btn-success">Go To Checkout</a>
      <a href="catalog.php" class="btn btn-success">Continue Shopping</a>
    </div>

  <?php
  } else {
  ?>
    <h1>hello</h1>
<?php
  }
} else {

  echo "<script>alert(\"helo\");</script>";

  header("Location:catalog.php");
}
?>
<?php
if (isset($conn)) {
  mysqli_close($conn);
}
require_once "./template/footer.php";
?>