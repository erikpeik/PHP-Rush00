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
			$admin_pw = hash('whirlpool', "admin");

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
			// CREATE PRODUCT TABLE
			mysqli_select_db($con, $database);
			$sql ="CREATE TABLE products (
				  `id` INT(11) NOT NULL AUTO_INCREMENT,
				  `title` VARCHAR(255) NOT NULL ,
				  `price` DECIMAL(10,2) NOT NULL ,
				  `brand` VARCHAR(100) NOT NULL ,
				  `image` VARCHAR(255) NOT NULL ,
				  `description` TEXT NOT NULL ,
				  featured TINYINT NOT NULL ,
				  `category` VARCHAR(25) NOT NULL ,
				  PRIMARY KEY (`id`)) ENGINE = InnoDB";
			mysqli_query($con, $sql);
			// CREATE USERS TABLE
			$sql = "CREATE TABLE users (
					`ID` INT NOT NULL AUTO_INCREMENT ,
					`username` VARCHAR(20) NOT NULL ,
					`password` VARCHAR(128) NOT NULL ,
					`admin` INT(1) NOT NULL ,
					PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
			mysqli_query($con, $sql);
			echo "Create orders table<br />";
			$sql = "CREATE TABLE orders (
					`order_id` INT NOT NULL AUTO_INCREMENT ,
					`username` VARCHAR(20) NOT NULL ,
					`full_name` VARCHAR(50) NOT NULL ,
					`address` VARCHAR(100) NOT NULL ,
					`phone_number` VARCHAR(25) NOT NULL ,
					`order_time` VARCHAR(30) NOT NULL ,
					`orders` TEXT NOT NULL ,
					`total_price` DECIMAL(10,2) NOT NULL ,
					PRIMARY KEY (`order_id`)) ENGINE = InnoDB;";
			mysqli_query($con, $sql);
			// CREATE ADMIN USER
			$sql = "insert into users (username,password,admin) values ('admin', '$admin_pw',1)";
			mysqli_query($con, $sql);
			echo "Adding items to database...<br />";
			$sql = "INSERT INTO products VALUES (NULL, 'Asus GeForce RTX 3090 Ti TUF Gaming OC Edition',
			 '2599.90', 'Asus', 'img/asus-3090.png',
			 'TUF Gaming GeForce RTX 3090 Ti OC Edition 24GB GDDR6X offers a buffed-up design that delivers chart-topping thermal performance.', '1', 'Components')";
			mysqli_query($con, $sql);
			$sql = "INSERT INTO products VALUES (NULL, 'Intel Core i9-12900K', '699.90', 'Intel', 'img/intel-i9.png',
			'Built for the next generation of gaming. 12th Gen Intel Core i9-12900K desktop processor', '1', 'Components')";
			mysqli_query($con, $sql);
			$sql = "INSERT INTO products VALUES (NULL, 'G.Skill 32GB (2 x 16GB) Trident Z5 RGB, DDR5 6400MHz',
			 '666.66', 'G.skill', 'img/gskill.png',
			 'Trident Z5 RGB series DDR5 memory is the latest G.SKILL flagship memory kits designed for ultra-high extreme performance on next-gen DDR5', '1', 'Components')";
			mysqli_query($con, $sql);
			$sql = "INSERT INTO products VALUES (NULL, 'Asus PRIME Z690-P D4', '299.90', 'Asus', 'img/asus-prime.png',
			'Intel Z690 (LGA 1700) ATX motherboard with PCIe 5.0, three M.2 slots, 14+1 DrMOS, DDR4, HDMI, DisplayPort, 2.5 Gb Ethernet, USB 3.2 Gen 2x2 Type C, front USB 3.2 Gen 1 Type C, Thunderbolt 4 support and Aura Sync RGB lighting.', '1', 'Components')";
			mysqli_query($con, $sql);
			$sql = "INSERT INTO products VALUE (NULL, 'HyperX Cloud 2', '99.99', 'HyperX', 'img/cloud2.png', 'The HyperX Cloud was built to be an ultra-comfortable gaming headset with amazing sound.', '1', 'Peripherals')";
			mysqli_query($con, $sql);
			$sql = "INSERT INTO products VALUE (NULL, 'Logitech G915 TKL', '249.99', 'Logitech', 'img/keyboard.png', 'Less spreadsheets, more GAMING!!!', '1', 'Peripherals')";
			mysqli_query($con, $sql);
			$sql = "INSERT INTO products VALUE (NULL, 'Logitech G Pro Wireless', '133.37', 'Logitech', 'img/mouse.png', 'EZ4ENCE', '1', 'Peripherals')";
			mysqli_query($con, $sql);
			$sql = "INSERT INTO products VALUE (NULL, 'SteelSeries QcK 3XL', '133.37', 'SteelSeries', 'img/mousepad.png', 'E-GAMERS', '1', 'Peripherals')";
			mysqli_query($con, $sql);
			echo "Everything is ready to start!<br />";
		?>
	</body>
</html
