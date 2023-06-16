<?php
include("php/connect.php");

$customer_id = $_SESSION["sess_memid"];

$result = mysqli_query($conn, "SELECT * FROM customer WHERE customer_id = $customer_id");
$row = mysqli_fetch_assoc($result);

require_once "./template/header.php";
?>

<div class="container bg-light" style="margin-top:30px">
    <div class="row">
        <div class="col">
            <form>
                <h1 class="h3 mb-3 font-weight-bold">User Profile</h1>

                <h1 class="h5 mb-3 font-weight-normal">Personal Information</h1>
                
                <p hidden><?php echo $row['customer_id']; ?></p>

                <label class="font-weight-bold">Email: </label>
                <p><?php echo $row['customer_email']; ?></p>
                
                <label class="font-weight-bold">Name: </label>
                <p><?php echo $row['customer_name']; ?></p>

                <label class="font-weight-bold">Birthday: </label>
                <p><?php echo $row['customer_birthday']; ?></p>

                <h1 class="h5 mb-3 font-weight-normal">Shipping & Billing Address</h1>
                <label class="font-weight-bold">Address: </label>
                <p><?php echo $row['customer_address']; ?></p>

                <label class="font-weight-bold">State: </label>
                <p><?php echo $row['customer_state']; ?></p>

                <label class="font-weight-bold">City: </label>
                <p><?php echo $row['customer_city']; ?></p>

                <label class="font-weight-bold">Postcode: </label>
                <p><?php echo $row['customer_postcode']; ?></p>

                <label class="font-weight-bold">Phone number: </label>
                <p><?php echo $row['customer_contactNo']; ?></p>

                <a href="profileedit.php?customer_id=<?php echo $row['customer_id']; ?>" class="btn btn-secondary btn-info" style="margin-top: 20px;" role="button">Edit Profile</a>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($conn)) {
    mysqli_close($conn);
}
require_once "./template/footer.php";
?>