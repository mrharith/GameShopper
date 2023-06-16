<?php
include("php/connect.php");
$product_id = $_GET['product_id'];
require_once "./template/header.php";

$query = "SELECT * FROM product WHERE product_id = '$product_id'";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
}

$row = mysqli_fetch_assoc($result);
if (!$row) {
    echo "Empty product";
    exit;
}
?>

<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-3">
            <img src="./image/<?php echo $row['product_image']; ?>" class="img-thumbnail img-fluid" alt="Responsive image">
        </div>
        <div class="col-5 align-middle">
            <h1 class="h2 mb-3 font-weight-bold">Product Title: <?php echo $row['product_name']; ?></h1>
            <h1 class="h4 mb-3 font-weight-normal">Product Description:</h1>
            <p> <?php echo $row['product_description']; ?></p>
            <h1 class="h5 mb-3 font-weight-normal">Product Release Date: <?php echo $row['product_release_date']; ?></h1>
            <h1 class="h5 mb-3 font-weight-normal">Language: <?php echo $row['product_language']; ?></h1>
            <h1 class="h5 mb-3 font-weight-bold text-primary">Product Price: MYR <?php echo $row['product_price']; ?></h1>

            <form method="post" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input type="submit" value="Add to cart" name="cart" class="btn btn-primary" style="margin-top: 10px;">
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