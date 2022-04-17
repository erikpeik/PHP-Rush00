<?PHP
	session_start();
	if (!$_SESSION["username"])
	{
		header('Location: login.php?redirect="checkout.php"');
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
		<form>
			<div class="row">
				<label class="input" for="fname">Full Name</labal>
				<input class="input" type="text" id="fname" name="fname" placeholder="Joe Average">
				<label for="email">Email</labal>
				<input class="input" type="text" id="email" name="email" placeholder="joe.avarage@gmail.com">
				<label for="address">Address</labal>
				<input class="input" type="text" id="address" name="address" placeholder="Joe Apartment 1c 213 HEL">
			</div>
	</body>
</html>
