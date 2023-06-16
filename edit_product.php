<?php
include("php/connect.php");
$conn = mysqli_connect("localhost", "root", "", "gameshopper");

// if save change happen
if (!isset($_POST['save_change'])) {
    echo "Something wrong!";
    exit;
}

$prod_id = trim($_POST['prod_id']);
$name = trim($_POST['name']);
$catid = trim($_POST['category_id']);
$reldate = trim($_POST['reldate']);
$language = trim($_POST['language']);
$description = trim($_POST['description']);
$price = floatval(trim($_POST['price']));

if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
    $image = $_FILES['image']['name'];
    $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
    $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "image/";
    $uploadDirectory .= $image;
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
}

$query = "UPDATE product SET  
	product_name = '$name', 
	product_release_date = '$reldate', 
	product_language = '$language', 
    product_description = '$description',
    product_price = '$price',
    category_id = '$catid'";

if (isset($image)) {
    $query .= ", product_image='$image' WHERE product_id = '$prod_id'";
} else {
    $query .= " WHERE product_id = '$prod_id'";
}
// two cases for file , if file submit is on => change a lot
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "Can't update data " . mysqli_error($conn);
    exit;
} else {
    header("Location: adminedit.php?product_id=$prod_id");
}
