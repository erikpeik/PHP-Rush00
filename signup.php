<html>
	<head>
		<title>Sign In</title>
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
include "functions.php";
    session_start();
    require_once("connect_db.php");

    //  Without "isset($_POST["username"]" site would add empty users. //
    if ($_POST["submit"] == "OK" && isset($_POST["username"]) && isset($_POST["password"]))
    {
        // Something was posted
        $username = $_POST["username"];
        $encrypted_password = hash_password($_POST["password"]);

        if (!empty($username) && !empty($encrypted_password)) // !is_numeric could be added
        {
            //check_dublicate_users();
            $query = "insert into users (username,password) values ('$username', '$encrypted_password')";
            // Save to database
            mysqli_query($con, $query);
            unset($_POST);
            unset($username);
            unset($encrypted_password);
            header("Location: login.php");
            die;
        }
        else
        {
            // Empty username or password inputted
            echo "Fill both fields please!";
        }

    }
?>
<html>
    <body>
        <form method="POST" action="signup.php">
        <div class="container">
            <div class="form_input">
        <!-- CHECK FOR SQL INJECTION -->
        <input type="text" name="username" placeholder="Username"value="" required/>
        </div>
        <br \>
        <div class="form_input">
        <input type="password" name="password" placeholder="Password" value="" required/></div>
        <br \>
        <input type="submit" name="submit" value="OK">
        </form>
        </div>
    </body>
</html>