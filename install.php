<hmtl>
	<body>
		<h1> Install Database </h1>
		<form method="GET">
			Servername: <input type="text" name="servername" required />
			<br />
			Username: <input type="text" name="login" required />
			<br />
			Password: <input type="password" name="password" required />
			<input type="submit" name="submit" value="OK" />
		</form>
		<?PHP
			$database = "rush_store";
			if (!$_GET["servername"] || !$_GET["login"] || !$_GET["password"])
			{
				echo "Please give information about your DB location".PHP_EOL;
				return ;
			}
			$servername = $_GET["servername"];
			$username = $_GET["login"];
			$password = $_GET["password"];
			echo "Trying to connect database...<br />";
			$con = mysqli_connect($servername, $username, $password);
			echo "Connection successful!<br />";
			echo "Recreating database...";
			$sql = "DROP DATABASE IF EXISTS $database";
			mysqli_query($con, $sql);
			echo "Trying to create new database called: $database<br />";
			$sql = "CREATE DATABASE IF NOT EXISTS $database";
			mysqli_query($con, $sql);
			mysqli_select_db($con, $database);
			$sql ="CREATE TABLE products (
				  id INT(11) NOT NULL AUTO_INCREMENT,
				  title VARCHAR(255) NOT NULL ,
				  price DECIMAL(10,2) NOT NULL ,
				  brand VARCHAR(100) NOT NULL ,
				  image VARCHAR(255) NOT NULL ,
				  description TEXT NOT NULL ,
				  featured TINYINT NOT NULL ,
				  PRIMARY KEY (`id`)) ENGINE = InnoDB";
			mysqli_query($con, $sql);

			$sql = "CREATE TABLE users (
				username VARCHAR(20) NOT NULL ,
				password VARCHAR(128) NOT NULL ,
				admin INT(1) NOT NULL ) ENGINE = InnoDB;";	
				//whirlpool
			mysqli_query($con, $sql);

			echo "Adding items to database...<br />";
			$sql = "INSERT INTO products VALUES (NULL, 'Asus GeForce RTX 3090 Ti TUF Gaming OC Edition',
			 '2599.90', 'Asus', 'img/asus-3090.png',
			 'TUF Gaming GeForce RTX 3090 Ti OC Edition 24GB GDDR6X offers a buffed-up design that delivers chart-topping thermal performance.', '1')";
			mysqli_query($con, $sql);
			$sql = "INSERT INTO products VALUES (NULL, 'Intel Core i9-12900K', '699.90', 'Intel', 'img/intel-i9.png',
			'Built for the next generation of gaming. 12th Gen Intel Core i9-12900K desktop processor', '1')";
			mysqli_query($con, $sql);
			$sql = "INSERT INTO products VALUES (NULL, 'G.Skill 32GB (2 x 16GB) Trident Z5 RGB, DDR5 6400MHz',
			 '666.66', 'G.skill', 'img/gskill.png',
			 'Trident Z5 RGB series DDR5 memory is the latest G.SKILL flagship memory kits designed for ultra-high extreme performance on next-gen DDR5', '1')";
			mysqli_query($con, $sql);
			$sql = "INSERT INTO products VALUES (NULL, 'Asus PRIME Z690-P D4', '299.90', 'Asus', 'img/asus-prime.png',
			'Intel Z690 (LGA 1700) ATX motherboard with PCIe 5.0, three M.2 slots, 14+1 DrMOS, DDR4, HDMI, DisplayPort, 2.5 Gb Ethernet, USB 3.2 Gen 2x2 Type C, front USB 3.2 Gen 1 Type C, Thunderbolt 4 support and Aura Sync RGB lighting.', '1')";
			mysqli_query($con, $sql);
			echo "Everything is ready to start!<br />";
		?>

	</body>
</html
