<?php
function    check_login($con)
{
    print_r($_SESSION);

    if (isset($_SESSION["username"]))
    {
        $username = $_SESSION["username"];
        $query = "select * from users where username = '$ID' limit 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    //redirect
    header("Location: signup.php");
    die;
}

function    hash_password($plain_pw)
{
    $crypted_pw = hash('whirlpool', $plain_pw);
    return ($crypted_pw);
}

function    duplicate_users($con, $username)
{
    $num = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `users` WHERE ( `username` = '$username')"));
    echo $num;
    if ($num >= 1)
        return (1);
    else
        return (0);
}
?>