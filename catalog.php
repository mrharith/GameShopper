<?php
include("php/connect.php");

require_once "./template/header.php";

$query = "";
$count = 0;

if (isset($_GET['category'])) {
  $category = $_GET['category'];
  $query = "SELECT product_id, product_image,product_name,product_price FROM product INNER JOIN category ON category.category_id = product.category_id where category.category_name='$category' ORDER BY product_id DESC;";
} else {
  if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT product_id, product_image,product_name,product_price FROM product WHERE product_name LIKE '%$search%' ORDER BY product_id DESC";
  } else {
    $query = "SELECT product_id, product_image,product_name,product_price FROM product ORDER BY product_id DESC";
  }
}


$result = mysqli_query($conn, $query);
if (!$result) {
  echo "Can't retrieve data " . mysqli_error($conn);
  exit;
}
?>
<script>
  function getSearchCriteria()
  {
    var inputvalue = document.getElementById("search").value;
    window.location.href = "catalog.php?search="+inputvalue;
  }
</script>
<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-3">

      <div class="container border" style="margin-bottom:5px;">
        <h1 class="h3 mb-3 font-weight-bold">Search</h1>
        <input type="text" placeholder="Search..." id="search" style="margin-bottom:10px; padding:5px; width:80%">
        <a onclick="getSearchCriteria()" class="btn btn-primary" style="margin-top:0px;"><img src="./image/search.png" height="10px"></a>
      </div>

      <div class="container border">
        <h1 class="h3 mb-3 font-weight-bold">Category</h1>
        <ul class="list-group" style="margin-bottom:10px;">
          <li class="list-group-item">
            <a href="catalog.php?category=PC">PC</a>
          </li>
          <li class="list-group-item">
            <a href="catalog.php?category=PlayStation">PlayStation</a>
          </li>
          <li class="list-group-item">
            <a href="catalog.php?category=XBOX">XBOX</a>
          </li>
          <li class="list-group-item">
            <a href="catalog.php">Clear Filter</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="col">
      <div class="container border">
        <?php for ($i = 0; $i < mysqli_num_rows($result); $i++) { ?>
          <div class="row">
            <?php while ($query_row = mysqli_fetch_assoc($result)) { ?>
              <div class="col-4" style="margin-top: 20px;">
                <div class="card text-center">
                  <img class="card-img-top" src="./image/<?php echo $query_row['product_image']; ?>" alt="Card image cap" style="height:250px; "></img>
                  <div class="card-body">
                    <p class="card-text">
                      <a href="product.php?product_id=<?php echo $query_row['product_id']; ?>" style="text-decoration: none; color:black; font-weight: bold;"><?php echo $query_row['product_name'] ?><br>MYR <?php echo $query_row['product_price'] ?></a>
                    </p>
                  </div>
                </div>
              </div>
            <?php
              $count++;
              if ($count >= 3) {
                $count = 0;
                break;
              }
            } ?>
          </div>
        <?php
        } ?>
      </div>
    </div>
  </div>
</div>

<?php
if (isset($conn)) {
  mysqli_close($conn);
}
require_once "./template/footer.php";
?>