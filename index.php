<?PHP

	$con = mysqli_connect('localhost', 'root', 'phppiscine');
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}

	mysqli_select_db($con, 'rush_store');
	$sql = "SELECT * FROM products WHERE featured=1";
	$featured = mysqli_query($con, $sql);
?>

<html>
	<head>
		<title>PHP Store</title>
		<link rel="stylesheet" href="style.css">
		<meta charset="UTF-8">
	</head>
	<body>
		<ul>
			<li><a class="active" href=".">Home</a></li>
			<li><a href="#product">Products</a></li>
			<li><a href="#signin">Sign in</a></li>
			<li><a href="#basket">Basket</a></li>
		</ul>
		<img class="logo" src="img/logo.png">
		<h2 style="text-align: center; color: #C3073F">TOP PRODUCTS</h2>
		<div class="featured_container">
			<?PHP while($product = mysqli_fetch_assoc($featured)) { ?>
			<div class="product_div">
				<h4><?=$product['title']; ?></h4>
				<img class="product_image" src="<?= $product['image']; ?>" alt="<?= $product['title']; ?>" />
				<p>Price: <?= $product['price']; ?>€</p>
			</div>
			<?PHP } ?>
		</div>
	</body>
</html>
