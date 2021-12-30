<?php

include_once('config/conf.php');

$error_password = false;
$error_username = false;
$error_login = false;

if(isset($_POST['sign_submit']))
{
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {

        $username = $connect->real_escape_string($_POST['username']);
        $password = $connect->real_escape_string($_POST['password']); // strtolower()

        $sql_select = "SELECT * FROM users_db WHERE username='$username'";

        if($st = $connect->query($sql_select))
        {
            $error;

            if($st->num_rows === 1)
            {
                $row = $st->fetch_array(MYSQLI_ASSOC);
                if(password_verify($password, $row['password_usr']))
                {
                    session_start();

                    $_SESSION['username'] = $username;
                    $_SESSION['access'] = true;

                    header("location: home.php?username=$username");
                }else
                {
                    $error_password = true;
                }
            }else{
                $error_username = true;
            }
        }
        else
        {
            $error_login = true;
        }
    }
}

$connect->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Sign</title>
</head>
<body>
    
<div class="box_form">
    <h1 id="title_form">Sign</h1>

    <?php
    if($error_password === true)
    {
        echo '
            <div class="alert">
                <span>The password is wrong</span>
            </div>
        ';
    }
    if($error_username === true)
    {
        echo '
            <div class="alert">
                <span>There are no users with this username</span>
            </div>
        ';
    }
    if($error_login === true)
    {
        echo '
            <div class="alert">
                <span>Error with login</span>
            </div>
        ';
    }
    ?>

    <!--Form-->
    <form method="POST">
        <input type="text" name="username" placeholder="Username" class="username" required>
        <input type="password" name="password" placeholder="Password" class="password" required>
        <input type="submit" name="sign_submit" value="Continue" class="submit_btn">
    </form>

    <span id="string_account">
        You don't have account? <a href="signup.php">Signup!</a>
    </span>
</div>

</body>
</html>
