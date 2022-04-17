<ul>
	<li><a class="active" href="index.php">Home</a></li>
	<li><a href="#product">Products</a></li>
	<li><a href="#signin">Sign in</a></li>
	<li><a href="basket.php">Basket ( <?PHP
	if(isset($_SESSION['cart'])) {
		$count = count($_SESSION["cart"]);
	}
	else
		$count = 0;
	echo $count;?> )</a></li>
</ul>
