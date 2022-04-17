<html>
	<head>
		<title>PHP Store</title>
		<link rel="stylesheet" href="css/nav.css">
		<link rel="stylesheet" href="css/index.css">
		<meta charset="UTF-8">
	</head>
	<body>
<?PHP require("header.php") ?>
<a href="index.php"><img class="logo" src="img/logo.png"></a>
</body>
</html>

<?php
session_start();
if ($_GET["submit"] == "OK")
{
    $_SESSION["login"] = $_GET["login"];
    $_SESSION["passwd"] = $_GET["passwd"];
}
?>
<html>
    <body>
    <form method="GET">
        Username: <input type="text" name="login" value="<?php echo ($_SESSION["login"]); ?>" />
        <br \>
        Password: <input type="text" name="passwd" value="<?php echo ($_SESSION["passwd"]); ?>"/>
        <br \>
        <input type="submit" name="submit" value="OK">
    </form>
    </body>
</html>
