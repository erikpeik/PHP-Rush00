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
        // something was posted
        $username = $_POST["username"];
        $encrypted_password = hash_password($_POST["password"]);

        if (!empty($username) || !empty($encrypted_password)) // !is_numeric could be added
        {
            $query = "insert into users (username,password) values ('$username', '$encrypted_password')";
            // Save to database
            mysqli_query($con, $query);
            unset($_POST);
            header("Location: login.php");
            die;
            // Refreshing won't add same user again.
            // unset($_POST["username"]);
            // unset($_POST["password"]);
            //unset($username);
            //unset($encrypted_password);
            // unset($_POST["submit"]);
            // echo $_POST["username"];
            // echo $_POST["password"];
            // echo $username;
            // echo $encrypted_password;
            // echo $_POST["submit"];
        }
        else
        {
            // Wrong information added
        }

    }
?>
<html>
    <body>
        <form method="POST" action="signup.php">
        <div class="container">
            <div class="form_input">
        <!-- CHECK FOR SQL INJECTION -->
        <input type="text" name="username" placeholder="Username"value="" />
        </div>
        <br \>
        <div class="form_input">
        <input type="password" name="password" placeholder="Password" value="" /></div>
        <br \>
        <input type="submit" name="submit" value="OK">
        </form>
        </div>
    </body>
</html>