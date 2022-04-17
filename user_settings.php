<?php
session_start();
require_once("connect_db.php");

if ($_POST["submit"] == "OK" && isset($_POST["oldpw"]) && isset($_POST["newpw"]))
{
    $oldpassword = hash("whirlpool", $_POST["oldpw"]);
    $username = $_SESSION["username"];
    $query = "SELECT password FROM users where password='$oldpassword' and username='$username'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0)
    {
        $encrypted_newpw = hash('whirlpool', $_POST["newpw"]);
        $query = "UPDATE users SET password='$encrypted_newpw' where username='$username'";
        $result = mysqli_query($con, $query);
        
    }
}

?>
<html>
<head>
	<title>User Settings</title>
	<link rel="stylesheet" href="css/nav.css">
	<link rel="stylesheet" href="css/index.css">
	<meta charset="UTF-8">
</head>
    <body>
    <?PHP require("header.php") ?>
        <a href="index.php"><img class="logo" src="img/logo.png"></a>

        <html>
    <body>
    <form method="POST" action="">
        <div class="form_container">
            <div class="form_input">
                <h1 style="color: #6F2232">Change your password</h1>
        <input type="password" name="oldpw" placeholder="Old password"value="" required/>
        </div>
        <br \>
        <div class="form_input">
        <input type="password" name="newpw" placeholder="New password" value=""required/></div>
        <br \>
        <input type="submit" name="submit" value="OK">
        </form>
        </div>
    </form>
    </body>
</html>
</body>
</html>
