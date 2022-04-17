<?PHP

	session_start();
	if ($_GET["action"] == "remove")
	{
		foreach ($_SESSION["cart"] as $key => $val)
		{
			if ($val["product_id"] == $_GET["id"])
			{
				unset($_SESSION["cart"][$key]);
			}
		}
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
								foreach ($product_id as $id)
								{
									if ($row['id'] == $id)
									{
										?>
											<form action="basket.php?action=remove&id=<?= $row['id'] ?>" method="POST" class="items">
												<div class="product_div">
													<h4><?=$row['title']; ?></h4>
													<img class="product_image" src="<?= $row['image']; ?>" alt="<?= $row['title']; ?>" />
													<p>Price: <?= $row['price']; ?>€</p>
													<button class="button" type="submit" name="remove">Remove</button>
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
