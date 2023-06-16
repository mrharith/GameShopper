<?php
include("./php/connect.php");
require "./template/headeradmin.php";

$count = 1;

if ($_SESSION["admin"] != true)
    header("Location: adminlogin.php");

$sess_memid = $_SESSION["sess_memid"];

$query = "SELECT admin_name FROM admin DESC";

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
} else {
    echo $order_id;
    echo "Empty query!";
    exit;
}

if (!isset($order_id)) {
    echo "Empty order_id! check again!";
    exit;
}

$query = "SELECT * FROM order_detail WHERE order_id = '$order_id'";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
}

$orderquery = "SELECT * FROM `order` where order_id = '$order_id'";
$orderresult = mysqli_query($conn, $orderquery);
$orderrow = mysqli_fetch_assoc($orderresult);

$order_cust_id = $orderrow['customer_id'];
$cust = "SELECT * FROM customer where customer_id = '$order_cust_id'";
$custresult = mysqli_query($conn, $cust);
$custrow = mysqli_fetch_assoc($custresult);

?>

<div class="container bg-light" style="margin-top:30px">
    <h1 class="h3 mb-3 font-weight-bold">Order Detail</h1>
    <div class="row">
        <div class="col">
            <h1 class="h5 mb-3 font-weight-bold">Customer Details</h1>
            <p><b>Customer Name: </b> <?php echo $custrow['customer_name']; ?> </p>
            <p><b>Customer Address: </b> <?php echo $custrow['customer_address']; ?> </p>
            <p><b>Customer City: </b> <?php echo $custrow['customer_city']; ?> </p>
            <p><b>Customer State: </b> <?php echo $custrow['customer_state']; ?> </p>
            <p><b>Customer Postcode: </b> <?php echo $custrow['customer_postcode']; ?> </p>
            <p><b>Customer Contact: </b> <?php echo $custrow['customer_contactNo']; ?> </p>
        </div>
        <div class="col">
            <h1 class="h5 mb-3 font-weight-bold">Shipping Details</h1>
            <p><b>Tracking Number: </b> <?php echo $orderrow['tracking_number']; ?> </p>
            <p><label><b>Order Status: </b><?php echo $orderrow['order_status']; ?> </p>

            <form action="adminorderedit.php" method="post">
                <label><b>Insert New Tracking Number: </b> </label>
                <input type="text" name="tracking" value="<?php echo $orderrow['tracking_number']; ?>">
                <label><b>Update Order Status: </b> </label>
                <select name="status">
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <input type="hidden" name="order_id" value="<?php echo $orderrow['order_id']; ?>">
                    <input type="hidden" name="order_cust_id" value="<?php echo $orderrow['customer_id']; ?>">
                </select>
                <br>
                <input type="submit" name="save_change" value="Update" class="btn btn-primary">
                <a href="adminorderlist.php" class="btn btn-secondary btn-info" role="button">Return</a>
            </form>
        </div>
    </div>
    <div class="row">
        <table class="table" style="margin-top: 10px;">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) {
                    $product_id = $row['product_id'];
                    $product = "SELECT * FROM product where product_id = '$product_id'";
                    $productresult = mysqli_query($conn, $product);
                    $prodrow = mysqli_fetch_assoc($productresult);
                ?>
                    <tr>
                        <td><?php echo $count ?></td>
                        <td><img src="./image/<?php echo $prodrow['product_image']; ?>" class="img-thumbnail img-fluid" alt="Responsive image" style="height:250px;"></td>
                        <td><?php echo $prodrow['product_name']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $prodrow['product_price']; ?></td>
                        <td>MYR <?php echo $row['subtotal']; ?></td>
                    </tr>
                <?php $count++;
                } ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Shipping: </td>
                    <td>MYR 0.00</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Subtotal: </td>
                    <td>MYR <?php echo $orderrow['order_total_price']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>