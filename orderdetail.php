<?php
require "./php/connect.php";
require "./template/header.php";

$count = 1;

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

?>

<div class="container bg-light" style="margin-top:20px;">
    <div class="row">
        <div class="col">
            <h1 class="h3 mb-3 font-weight-bold">Order Detail</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p><b>Tracking Number: </b> <?php echo $orderrow['tracking_number']; ?> </p>
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
                        <td><b>Shipping: </b></td>
                        <td>MYR 0.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Subtotal: </b></td>
                        <td>MYR <?php echo $orderrow['order_total_price']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
require "./template/footer.php";
?>