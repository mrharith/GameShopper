<?php
include("php/connect.php");
$conn = mysqli_connect("localhost", "root", "", "gameshopper");

// if save change happen
if (!isset($_POST['save_change'])) {
    echo "Something wrong!";
    exit;
}

$customer_id = trim($_POST['customer_id']);
$name = trim($_POST['name']);
$birthday = trim($_POST['birthday']);
$address = trim($_POST['address']);
$state = trim($_POST['state']);
$city = trim($_POST['city']);
$postcode = trim($_POST['postcode']);
$contact = trim($_POST['contact']);
$email = trim($_POST['email']);

$query = "UPDATE customer SET  
	customer_name = '$name', 
	customer_birthday = '$birthday', 
	customer_address = '$address', 
    customer_state = '$state',
    customer_city = '$city',
    customer_postcode = '$postcode',
    customer_contactNo = '$contact',
    customer_email = '$email'";

// two cases for file , if file submit is on => change a lot
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "Can't update data " . mysqli_error($conn);
    exit;
} else {
    header("Location: profile.php?customer_id=$customer_id");
}
