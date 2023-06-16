<?php
include("php/connect.php");

if ($_SESSION["loggedin"] != 1)
	header("Location: login.php");

$sess_memid = $_SESSION["sess_memid"];

function select4LatestProduct($conn)
{
  $row = array();
  $query = "SELECT product_id, product_image,product_name,product_price FROM product ORDER BY product_id DESC";
  $result = mysqli_query($conn, $query);
  if (!$result) {
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }
  for ($i = 0; $i < 4; $i++) {  
    array_push($row, mysqli_fetch_assoc($result));
  }
  return $row;
}

$row = select4Latestproduct($conn);

require_once "./template/headerlogin.php";
?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div id="carouselExampleIndicators" class="carousel slide col-12" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="image\freeshipping.png" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="image\preorderbanner.png" alt="Second slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

  <div class="row" style="margin-top:20px">
    <?php foreach ($row as $product) {
    ?>
      <div class="col-3">
        <div class="card text-center">
          <img class="card-img-top  " src="./image/<?php echo $product['product_image']; ?>" alt="Card image cap" style="height:250px; "></img>
          <div class="card-body">
            <p class="card-text">
              <a href="product.php" style="text-decoration: none; color:black; font-weight: bold;"><?php echo $product['product_name'] ?><br>MYR <?php echo $product['product_price'] ?></a>
            </p>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

  <!-- <div class="row justify-content-center" style="text-align: center; margin-top:30px;">
    <div class="col" style="padding-left: 25px;">
      <div class="card" style="width: 15rem;">
        <img class="card-img-top" src="image/fifa20.jpg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text"><a href="product.php" style="text-decoration: none; color:black; font-weight: bold;">FIFA 20<br>MYR 120.00</a></p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card" style="width: 15rem;">
        <img class="card-img-top" src="image/fifa20.jpg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text"><a href="product.php" style="text-decoration: none; color:black; font-weight: bold;">FIFA 20<br>MYR 120.00</a></p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card" style="width: 15rem;">
        <img class="card-img-top" src="image/fifa20.jpg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text"><a href="product.php" style="text-decoration: none; color:black; font-weight: bold;">FIFA 20<br>MYR 120.00</a></p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card" style="width: 15rem;">
        <img class="card-img-top" src="image/fifa20.jpg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text"><a href="product.php" style="text-decoration: none; color:black; font-weight: bold;">FIFA 20<br>MYR 120.00</a></p>
        </div>
      </div>
    </div>
  </div> -->
</div>

<?php
if (isset($conn)) {
  mysqli_close($conn);
}
require_once "./template/footer.php";
?>