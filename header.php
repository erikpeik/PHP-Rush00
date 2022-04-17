<?PHP
	session_start();
	require_once("connect_db.php");
	function	product_count($basket)
	{
		$count = 0;
		foreach ($basket as $product)
		{
			$count += $product["count"];
		}
		return $count;
	}

	function	total_price()
	{
		$sql = "SELECT * FROM products";
		$result = mysqli_query($con, $sql);
		$total = 0;
		while ($row = mysqli_fetch_assoc($result))
		{
			foreach ($_SESSION["cart"] as $product)
			{
				if ($row['id'] == $product['product_id'])
					$total += $row['price'] * $product["count"];
			}
		}
	}
?>

<div class="navbar">
	<a class="active" href="index.php">Home</a>
	<div class="dropdown">
		<button class="dropbtn">Products</button>
		<div class="dropdown-content">
			<a href="components.php">Components</a>
			<a href="peripherals.php">Peripherals</a>
		</div>
	</div>
	<a class="active" href="basket.php">Basket ( <?= product_count($_SESSION['cart']) ?> )</a>
	<div style="float: right">
	<?php
		if($_SESSION["username"] === "admin") { ?>
			<a class="active" href="admin.php">Admin Panel</a> <?php } ?>
			<?PHP
			if($_SESSION["username"]) { ?>
				<a class="active" href="user_settings.php">Hello, <?php echo $_SESSION["username"]; ?></a>
				<a class="active" href="logout.php">Log Out</a>
				<?PHP }
			else { ?>
			<a class="active" href="login.php">Log In</a>
		<?PHP } ?>
	</div>
</div>
