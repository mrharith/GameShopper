<?php

require "./php/connect.php"; 
require_once "./php/cart_functions.php";

$customer_id = $_SESSION["sess_memid"];
$cart = $_SESSION['cart'];
$totalprice = total_price($cart);
$orderstatus = "Pending";
$paymethod = "Credit Card";

$order = "insert into `order` (order_total_price,order_status,payment_method,customer_id) values ('$totalprice','$orderstatus','$paymethod','$customer_id')";
$result = mysqli_query($conn, $order);

$order_id = mysqli_insert_id($conn);

foreach ($cart as $product_id => $qty) {
    // echo "<br>{$product_id} - {$qty}";
    $productsql = "select * from product where product_id = $product_id";
    $product = mysqli_query($conn, $productsql);
    $row = mysqli_fetch_assoc($product);
    $subtotal = $row['product_price'] * $qty;

    $orderdetail = "insert into `order_detail` (product_id,quantity,subtotal,order_id) values ('$product_id','$qty','$subtotal','$order_id')";
    $resultdetail = mysqli_query($conn, $orderdetail);
}

header("Location:orderhistory.php");
?>