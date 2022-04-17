<link rel="stylesheet" type="text/css" href="login.css" />
<html>
</html>

<?php
include "functions.php";
    session_start();

    require_once("connect_db.php");

    //  Without "isset($_POST["username"]" site would add empty users. //
    //echo $_POST["username"];
    if ($_POST["submit"] == "OK" && isset($_POST["username"]) && isset($_POST["password"]))
    {
        // something was posted
        $username = $_POST["username"];
        $encrypted_password = hash_password($_POST["password"]);
        
        if (!empty($username) || !empty($encrypted_password)) // !is_numeric could be added
        {
            // Read database
            $query = "select * from users where username = '$username' limit 1";
            $result = mysqli_query($con, $query);

            if ($result)
            {
                if ($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);
                    if ($user_data["password"] === $encrypted_password)
                    {
                        $_SESSION["username"] = $user_data["username"];
                        header("Location: index.php");
                        die;
                    }
                }
            }
            echo '<script> alert("Wrong Username or Password")</script>';
        }
        else
        {
            echo '<script> alert("Wrong Username or Password")</script>';
        }

    }
?>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" href="css/nav.css">
	<link rel="stylesheet" href="css/index.css">
	<meta charset="UTF-8">
</head>
    <body>
        <?PHP require("header.php") ?>
        <a href="index.php"><img class="logo" src="img/logo.png"></a>
        
        <form method="POST" action="">
        <div class="form_container">
            <div class="form_input">
                <h1 style="color: #6F2232">Log In</h1>
        <input type="text" name="username" placeholder="Username"value="" required/>
        </div>
        <br \>
        <div class="form_input">
        <input type="password" name="password" placeholder="Password" value=""required/></div>
        <br \>
        <a href="signup.php">Signup</a>
        <br \>
        <input type="submit" name="submit" value="OK">
        </form>
        </div>
    </body>
</html>
