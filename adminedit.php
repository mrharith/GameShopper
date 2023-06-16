<?php
include("php/connect.php");
$conn = mysqli_connect("localhost", "root", "", "gameshopper");

require_once "./template/headeradmin.php";

if ($_SESSION["admin"] != 1)
	header("Location: adminlogin.php");

if (isset($_GET['product_id'])) {
	$prod_id = $_GET['product_id'];
} else {
	echo "Empty query!";
	exit;
}

if (!isset($prod_id)) {
	echo "Empty product_id! check again!";
	exit;
}

// get product data
$query = "SELECT * FROM product WHERE product_id = '$prod_id'";
$result = mysqli_query($conn, $query);
if (!$result) {
	echo "Can't retrieve data " . mysqli_error($conn);
	exit;
}

$row = mysqli_fetch_assoc($result);
?>

<form method="post" action="edit_product.php" enctype="multipart/form-data">
	<table class="table">
		<tr>
			<td><input type="hidden" name="prod_id" value="<?php echo $row['product_id']; ?>"></td>
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
			<th>Name</th>
			<td><input type="text" name="name" value="<?php echo $row['product_name']; ?>" required></td>
		</tr>
		<tr>
			<th>Image</th>
			<td><input type="file" name="image"></td>
		</tr>
		<tr>
			<th>Description</th>
			<td><textarea name="description" cols="40" rows="5"><?php echo $row['product_description']; ?></textarea>
		</tr>
		<tr>
			<th>Price</th>
			<td><input type="text" name="price" value="<?php echo $row['product_price']; ?>" required></td>
		</tr>
		<tr>
			<th>Release Date</th>
			<td><input type="date" name="reldate" value="<?php echo $row['product_release_date']; ?>" required></td>
		</tr>
		<tr>
			<th>Language</th>
			<td><input type="text" name="language" value="<?php echo $row['product_language']; ?>" required></td>
		</tr>
	</table>
	<input type="submit" name="save_change" value="Change" class="btn btn-primary">
	<input type="reset" name="reset_change" value="Reset" class="btn btn-default">
</form>
<br />

<a href="adminpanel.php" class="btn btn-success">Confirm</a>

<?php
if (isset($conn)) {
	mysqli_close($conn);
}
?>