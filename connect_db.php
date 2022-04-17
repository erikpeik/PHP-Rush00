<?PHP

	$host = "localhost";
	$username = "root";
	$passwd = "hmaronen";
	$con = mysqli_connect($host, $username, $passwd);
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}
	mysqli_select_db($con, 'rush_store');
	$sql = "SELECT * FROM products WHERE featured=1";
	$featured = mysqli_query($con, $sql);

?>
