<?php
include "functions.php";
    //session_start();
    require_once("connect_db.php");

    //  Without "isset($_POST["username"]" site would add empty users. //
    if ($_POST["submit"] == "OK" && isset($_POST["username"]) && isset($_POST["password"]))
    {
        // Something was posted
        $username = $_POST["username"];
        $encrypted_password = hash_password($_POST["password"]);

        if (!empty($username) && !empty($encrypted_password)) // !is_numeric could be added to deny numeric users
        {
            $num = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `users` WHERE ( `username` = '$username')"));
            if ($num < 1)
            {
                // Save to database
                $query = "insert into users (username,password, admin) values ('$username', '$encrypted_password',0)";
                mysqli_query($con, $query);
                unset($_POST);
                unset($username);
                unset($encrypted_password);
                header("Location: login.php");
                die;
            }
            else
                echo '<script> alert("User already exist!")</script>';
            }
            else
                echo '<script> alert("Fill both fields please!")</script>';
    }
?>
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
        <form method="POST" action="signup.php">
        <div class="container">
            <div class="form_input">
                <h1 style="color: #6F2232">Sign In</h1>
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