<?php
require "./php/connect.php";
require "./template/header.php";

$cust_id = $_SESSION["sess_memid"];

function getAll($conn, $cust_id)
{
    $query = "SELECT * from `order` where customer_id = $cust_id ORDER BY order_id DESC";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "Can't retrieve data " . mysqli_error($conn);
        exit;
    }
    return $result;
}

$result = getAll($conn, $cust_id);

?>

<div class="container bg-light" style="margin-top:30px">
    <div class="row">
        <div class="col">
            <table class="table" style="margin-top: 10px;">
                <thead class="thead-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Total Price</th>
                        <th>Order Status</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td>MYR <?php echo $row['order_total_price']; ?></td>
                            <td><?php echo $row['order_status']; ?></td>
                            <td><a href="orderdetail.php?order_id=<?php echo $row['order_id']; ?>">View Order</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require "./template/footer.php";
?>