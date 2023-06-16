<?php
include("php/connect.php");
$conn = mysqli_connect("localhost", "root", "", "gameshopper");

require_once "./template/header.php";

if (isset($_GET['customer_id'])) {
	$customer_id = $_GET['customer_id'];
} else {
	echo "Empty query!";
	exit;
}

if (!isset($customer_id)) {
	echo "Empty customer_id! check again!";
	exit;
}

// get product data
$query = "SELECT * FROM customer WHERE customer_id = '$customer_id'";
$result = mysqli_query($conn, $query);
if (!$result) {
	echo "Can't retrieve data " . mysqli_error($conn);
	exit;
}

$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">


<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col">
            <form method="post" action="edit_profile.php" enctype="multipart/form-data">
                <h1 class="h3 mb-3 font-weight-normal">Edit Profile</h1>

                <h1 class="h5 mb-3 font-weight-normal">Personal Information</h1>
                <input type="hidden" name="customer_id" value="<?php echo $row['customer_id']; ?>">

                <label>Name: </label>
                <input type="text" name="name" value="<?php echo $row['customer_name']; ?>" required>

                <br><label>Birthday: </label>
                <input type="date" name="birthday" min="1950-01-01" max="2002-12-31" value="<?php echo $row['customer_birthday']; ?>" required>

                <h1 class="h5 mb-3 font-weight-normal">Shipping & Billing Address</h1>
                <br><label>Address: </label>
                <input type="text" name="address" value="<?php echo $row['customer_address']; ?>" required>

                <br><label>State: </label>
                <select name="state">
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelantan">Kelantan</option>
                    <option value="Melaka">Melaka</option>
                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                    <option value="Pahang">Pahang</option>
                    <option value="Penang">Penang</option>
                    <option value="Perak">Perak</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Terengganu">Terengganu</option>
                </select>

                <br><label>City: </label>
                <input type="text" name="city" value="<?php echo $row['customer_city']; ?>" required>

                <br><label>Postcode: </label>
                <input type="text" name="postcode" value="<?php echo $row['customer_postcode']; ?>" required>

                <br><label>Phone number: </label>
                <input type="text" name="contact" value="<?php echo $row['customer_contactNo']; ?>" required>

                <br><label>Email: </label>
                <input type="text" name="email" value="<?php echo $row['customer_email']; ?>" required>

                <br><input style="margin-top:10px;" type="submit" name="save_change" value="Save Changes" class="btn btn-primary">
                <input style="margin-top:10px;" type="reset" name="reset_change" value="Cancel" class="btn btn-secondary">
            </form>
            <a style="margin-top:10px;" href="profile.php" class="btn btn-success">Confirm Changes</a>
        </div>
    </div>
</div>

<?php
if (isset($conn)) {
    mysqli_close($conn);
}
require "./template/footer.php"
?>