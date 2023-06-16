<?php
	/*
		loop through array of $_SESSION['cart'][book_isbn] => number
		get isbn => take from database => take book price
		price * number (quantity)
		return sum of price
	*/
	
	function getProductPrice($product_id)
	{
	  $conn = mysqli_connect("localhost", "root", "", "gameshopper");
	  $query = "SELECT product_price FROM product WHERE product_id = '$product_id'";
	  $result = mysqli_query($conn, $query);
	  if (!$result) {
		echo "get product price failed! " . mysqli_error($conn);
		exit;
	  }
	  $row = mysqli_fetch_assoc($result);
	  return $row['product_price'];
	}

	function total_price($cart){
		$price = 0.0;
		$newqty = 0;
		if(is_array($cart)){
		  	foreach($cart as $product_id => $qty){
		  		$bookprice = getProductPrice($product_id);
		  		if($bookprice){
					  if($qty)
					  {
						  $newqty=$qty;
					  }
		  			$price += $bookprice * $newqty;
		  		}
		  	}
		}
		return $price;
	}

	/*
		loop through array of $_SESSION['cart'][book_isbn] => number
		$_SESSION['cart'] is associative array which is [book_isbn] => number of books for each book_isbn
		calculate sum of books 
	*/
	function total_items($cart){
		$items = 0;
		$newqty = 0;
		if(is_array($cart)){
			foreach($cart as $product_id => $qty){
				if($qty)
					  {
						  $newqty=$qty;
					  }
				$items += $newqty;
			}
		}
		return $items;
	}
?>