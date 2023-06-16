<?php
    include("php/connect.php");
	$product_id = $_GET['product_id'];

	$query = "DELETE FROM product WHERE product_id = '$product_id'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "delete data unsuccessfully " . mysqli_error($conn);
		exit;
	}
	header("Location: adminpanel.php");
?>