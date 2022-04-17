<?PHP

function	product_count($basket)
{
	$count = 0;
	foreach ($basket as $product)
	{
		$count += $product["count"];
	}
	return $count;
}

?>

<ul>
	<li><a class="active" href="index.php">Home</a></li>
	<li><a href="#product">Products</a></li>
	<li><a href="login.php">Sign in</a></li>
	<li><a href="basket.php">Basket ( <?= product_count($_SESSION['cart']); ?> )</a></li>
</ul>
