<?PHP

	session_start();
	require_once("connect_db.php");
	//
	//$user_data = check_login();
	//
	$sql = "SELECT * FROM products WHERE category='Components'";
	$featured = mysqli_query($con, $sql);

	if (isset($_POST["add"]))
	{
		if($_SESSION["cart"][$_POST["product_id"]])
		{
			$_SESSION["cart"][$_POST["product_id"]]["count"] += 1;
		}
		else
			$_SESSION["cart"][$_POST["product_id"]] = array('product_id' => $_POST["product_id"], 'count' => 1);
	}
?>

<html>
	<head>
		<title>PHP Store</title>
		<link rel="stylesheet" href="css/nav.css">
		<link rel="stylesheet" href="css/index.css">
		<meta charset="UTF-8">
	</head>
	<body>
		<?PHP
		require_once("header.php");
		if ($_GET['order'] == 'placed') {
			echo ('<script>alert("Order has been placed!");</script>');
		}
		?>
		<a href="index.php"><img class="logo" src="img/logo.png"></a>
		<h2 style="text-align: center; color: #C3073F">Components</h2>
		<div class="featured_container">
			<?PHP while($product = mysqli_fetch_assoc($featured)) { ?>
			<form action="index.php" method="post">
				<div class="product_div">
					<h4><?=$product['title']; ?></h4>
					<img class="product_image" src="<?= $product['image']; ?>" alt="<?= $product['title']; ?>" />
					<p>Price: <?= $product['price']; ?>€</p>
					<button class="button" type="submit" name="add">Add to Cart</button>
					<input type="hidden" name="product_id" value="<?= $product['id'] ?>">
				</div>
			</form>
			<?PHP } ?>
		</div>
	</body>
</html>
