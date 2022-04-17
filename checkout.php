<?PHP require_once("connect_db.php") ?>
<?PHP
	date_default_timezone_set('Europe/Helsinki');
	session_start();
	if (!$_SESSION["username"])
	{
		header('Location: login.php?redirect="checkout.php"');
	}
	if ($_GET["order"] == "OK" && count($_SESSION["cart"]) != 0)
	{
		$sql = "SELECT * FROM products";
		$result = mysqli_query($con, $sql);
		$total = 0;
		$order_array = array();
		while ($row = mysqli_fetch_assoc($result))
		{
			foreach ($_SESSION["cart"] as $product)
			{
				if ($row['id'] == $product['product_id'])
				{
					$order_array[] = array("id" => $row['id'], "name" => $row['title'], "count" => $product['count'], "price" => $row['price']);
					$total += $row['price'] * $product["count"];
				}
			}
		}
		$order_array = serialize($order_array);
		$sql = "INSERT INTO orders VALUES (NULL, '".$_SESSION["username"]."', '".$_POST["fname"]."', '".$_POST["address"]."', '".$_POST["number"]."', '".date('m/d/Y h:i:s', time())."', '".$order_array."', '".number_format($total, 2, '.', '')."')";
		mysqli_query($con, $sql);
		unset($_SESSION["cart"]);
		header("Location: index.php?order=placed");
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/checkout.css">
		<link rel="stylesheet" href="css/nav.css">
		<title>Basket</title>
	</head>
	<body>
		<?PHP require("header.php") ?>
		<a href="index.php"><img class="logo" src="img/logo.png"></a>
		<form method="POST" action="checkout.php?order=OK">
			<div class="container">
				<div class="row">
					<label class="input" for="fname">Full Name</labal>
					<input class="input" type="text" id="fname" name="fname" placeholder="Joe Average" required>
					<label for="email">Email</labal>
					<input class="input" type="text" id="email" name="email" placeholder="joe.avarage@gmail.com" required>
					<label for="address">Address</labal>
					<input class="input" type="text" id="address" name="address" placeholder="Joe Apartment 1c 213 HEL" required>
					<label for="number">Phone Number</labal>
					<input class="input" type="text" id="number" name="number" placeholder="+358 123 456789" required>
					<label for="cardnumber">Card Number</labal>
					<input class="input" type="text" id="cardnumber" name="cardnumber" placeholder="0123 4567 8912 3456" required>
					<label for="expiry">Expiry Date</labal>
					<input class="input" type="text" id="expiry" name="expiry" placeholder="MM/YY Example. 05/23" required>
					<label for="nameoncard">Name on card</labal>
					<input class="input" type="text" id="nameoncard" name="nameoncard" placeholder="Joe Average" required>
					<label for="securitycode">Card security code</labal>
					<input class="input" type="text" id="nameoncard" name="nameoncard" placeholder="The last 3 digits on the back of the card" required>
					<input class="input" style="margin-top: 1vw;" type="submit" id="submit" name="submit" value="Submit">
				</div>
				<div class="row">
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
				</div>
			</div>

	</body>
</html>
