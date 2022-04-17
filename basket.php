<?PHP
	session_start();
	if (isset($_POST["remove"]) && isset($_GET['id']))
	{
		unset($_SESSION["cart"][$_GET["id"]]);
	}
	if (isset($_POST["decrease"]) && isset($_GET['id']))
	{
		if ($_SESSION["cart"][$_GET["id"]]["count"] > 1)
			$_SESSION["cart"][$_GET["id"]]["count"] -= 1;
	}
	if (isset($_POST["increase"]) && isset($_GET['id']))
	{
		if ($_SESSION["cart"][$_GET["id"]]["count"] < 99)
			$_SESSION["cart"][$_GET["id"]]["count"] += 1;
	}
?>

<?PHP require_once("connect_db.php") ?>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/basket.css">
		<link rel="stylesheet" href="css/nav.css">
		<title>Basket</title>
	</head>
	<body>
		<?PHP require("header.php") ?>
		<div class="holder">
		<div class="container">
			<h2 style="width: 10vw">The Basket</h2>
			<div>
				<?PHP
				if (isset($_SESSION["cart"]) && count($_SESSION["cart"]) != 0)
				{
					$sql = "SELECT * FROM products";
					$result = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_assoc($result))
					{
						foreach ($_SESSION["cart"] as $product)
						{
							/* print($product); */
							if ($_POST["count"])
								$product["count"] = $_POST["count"];
							if ($row['id'] == $product['product_id'])
							{
								?>
									<form action="basket.php?id=<?= $row['id'] ?>" method="POST" class="items">
									<div class="product_div">
											<h4><?=$row['title']; ?></h4>
											<img class="product_image" src="<?= $row['image']; ?>" alt="<?= $row['title']; ?>" />
											<p>Price: <?= $row['price']; ?>€</p>
											<div class="button-div">
												<button type="submit" class="button" name="decrease" style="width: 1.5vw">-</button>
												<input type="button" class="button" name="count" value="<?= $product["count"] ?>" style="width: 1.5vw" \>
												<button type="submit" class="button" name="increase" style="width: 1.5vw">+</button>
												<button type="submit" class="button" name="remove" style="margin-left: 0.5vw">Remove</button>
											</div>
										</div>
									</form>
								<?PHP
							}
						}
					}
				}
				else
					echo '<h5 style="color: white;">Basket is Empty</h5>';
				?>
			</div>
		</div>
		<div class="summary">
			<h2>Summary</h2>
			<?PHP
			$sql = "SELECT * FROM products";
			$result = mysqli_query($con, $sql);
			$total = 0;
			while ($row = mysqli_fetch_assoc($result))
			{
				foreach ($_SESSION["cart"] as $product)
				{
					if ($row['id'] == $product['product_id'])
					{ ?>
						<p style="color: white; margin-left: 1vw;"><?=$row['title']; ?> ( x <?= $product["count"] ?> ) : <?= number_format($row['price'] * $product["count"], 2, '.', '') ?>€</p>

				<?PHP	$total += $row['price'] * $product["count"];
					}
				}
			}
			?>
			<h2>Total: <?= number_format($total, 2, '.', ''); ?>€</h2>
			<?PHP if ($total != 0) { ?>
			<form method="POST" action="checkout.php">
				<button type="submit" class="checkout" name="submit" >Checkout</button>
			</form>
			<?PHP } ?>
		</div>
		</div>
	</body>
</html>
