<?php
include("php/connect.php");
$conn = mysqli_connect("localhost", "root", "", "gameshopper");

// if save change happen
if (!isset($_POST['save_change'])) {
    echo "Something wrong!";
    exit;
}

$order_cust_id = trim($_POST['order_cust_id']);
$order_id = trim($_POST['order_id']);
$tracking = trim($_POST['tracking']);
$status = trim($_POST['status']);

$query = "UPDATE `order` SET  
	order_status = '$status', 
	tracking_number = '$tracking' where customer_id = '$order_cust_id' and order_id = '$order_id';";

// two cases for file , if file submit is on => change a lot
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "Can't update data " . mysqli_error($conn);
    exit;
} else {
    header("Location: adminorderdetail.php?order_id=$order_id");
}
