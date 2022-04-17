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
		<div class="container">
			<h2>The Basket</h2>
				<div>
					<?PHP
						if (isset($_SESSION["cart"]) && count($_SESSION["cart"]) != 0)
						{
							$product_id = array_column($_SESSION["cart"], "product_id");
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
	</body>
</html>
