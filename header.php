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
	<li><a href="basket.php">Basket ( <?= product_count($_SESSION['cart']); ?> )</a></li>
	<!-- If statement if we are logged in to show log out button? -->
	<div style="float: right">
	<?PHP
		if($_SESSION["username"]) { ?>
			<li><a>Hello, <?php echo $_SESSION["username"]; ?></a></li>
			<li><a href="logout.php">Log Out</a></li>
		<?PHP }
		else { ?>
		<li><a href="login.php">Sign Up</a></li>
		<?PHP } ?>
	</div>
</ul>
