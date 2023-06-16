<?php
include("php/connect.php");
require "./template/headeradmin.php";

if ($_SESSION["admin"] != true)
	header("Location: adminlogin.php");

if (isset($_POST['add'])) {
	$name = trim($_POST['name']);
	$name = mysqli_real_escape_string($conn, $name);

	$catid = trim($_POST['category_id']);
	// $catid = mysqli_real_escape_string($conn, $name);

	$reldate = trim($_POST['reldate']);
	$reldate = mysqli_real_escape_string($conn, $reldate);

	$language = trim($_POST['language']);
	$language = mysqli_real_escape_string($conn, $language);

	$description = trim($_POST['description']);
	$description = mysqli_real_escape_string($conn, $description);

	$price = floatval(trim($_POST['price']));
	$price = mysqli_real_escape_string($conn, $price);

	// add image
	if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
		$image = $_FILES['image']['name'];
		$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
		$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "image/";
		$uploadDirectory .= $image;
		move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
	}
	echo $catid;
	$query = "INSERT INTO product (product_name,product_price,product_release_date,product_description,product_language,product_image,category_id) values ('$name','$price','$reldate','$description','$language','$image', '$catid')";
	
	
	// $query = "INSERT INTO product (product_name,product_price,product_release_date,product_description,product_language,product_image,category_id) select ('$name','$price','$reldate','$description','$language','$image', '$catid') from category where category_id = $catid";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		echo "Can't add new data " . mysqli_error($conn);
		exit;
	} else {
		header("Location: adminpanel.php");
	}
}
?>
<form method="post" action="adminadd.php" enctype="multipart/form-data">
	<table class="table">
		<tr>
			<th>Name</th>
			<td><input type="text" name="name"></td>
		</tr>
		<tr>
			<th>Category ID</th>
			<td>
				<select name="category_id">
					<option value="1">1 - PC</option>
					<option value="2">2 - PlayStation</option>
					<option value="3">3 - XBOX</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>Release Date</th>
			<td><input type="date" name="reldate" required></td>
		</tr>
		<tr>
			<th>Language</th>
			<td><input type="text" name="language" required></td>
		</tr>
		<tr>
			<th>Image</th>
			<td><input type="file" name="image"></td>
		</tr>
		<tr>
			<th>Description</th>
			<td><textarea name="description" cols="40" rows="5"></textarea></td>
		</tr>
		<tr>
			<th>Price</th>
			<td><input type="text" name="price" required></td>
		</tr>
	</table>
	<input type="submit" name="add" value="Add new product" class="btn btn-primary">
	<input type="reset" value="Reset" class="btn btn-default">
</form>
<br />

<a href="adminpanel.php" class="btn btn-success">Return</a>

<?php
if (isset($conn)) {
	mysqli_close($conn);
}
?>