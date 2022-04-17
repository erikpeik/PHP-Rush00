<?PHP

	session_start();
	$con = mysqli_connect('localhost', 'root', 'phppiscine');
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}

	mysqli_select_db($con, 'rush_store');
	$sql = "SELECT * FROM products WHERE featured=1";
	$featured = mysqli_query($con, $sql);

	if(isset($_POST["add"]))
	{
		// print_r($_POST["product_id"]);
		if(isset($_SESSION["cart"]))
		{
			$item_array_id = array_column($_SESSION['cart'], "product_id");
			if (in_array($_POST["product_id"], $item_array_id))
			{
				echo "<script>alert('Product is already added in the card')</script>";
				echo "<script>window.location = 'index.php'</script>";
			}
			else
			{
				$item_array= array('product_id' => $_POST["product_id"]);
				$_SESSION["cart"][] = $item_array;
				print_r($_SESSION["cart"]);
			}
		}
		else
		{
			$item_array= array('product_id' => $_POST["product_id"]);
			$_SESSION["cart"][0] = $item_array;
			print_r($_SESSION["cart"]);
		}

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
		<?PHP require("header.php") ?>
		<img class="logo" src="img/logo.png">
		<h2 style="text-align: center; color: #C3073F">TOP PRODUCTS</h2>
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
