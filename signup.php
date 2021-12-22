<?php

include_once('config/conf.php');

$error = false;

if(isset($_POST['submit_button']))
{

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $first_password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if($confirm_password === $first_password)
        {
            $sql_insert = 'INSERT INTO users_db(username, email, password_usr) VALUES (?, ?, ?)';

            if($st = $connect->prepare($sql_insert))
            {
                $st->bind_param('sss', $username, $email, $hash_password);

                $username = $_POST['username'];
                $email = $_POST['email'];
                $hash_password = password_hash($first_password, PASSWORD_DEFAULT);
                $st->execute();

                header('location: sign.php?sign=true');
            }
        }else
        {
            $error = true;
        }
    }
}

function error_fun()
{
    echo '
        <div class="alert">
            <span>passwords do not match</span>
        </div>
    ';
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
    <title>Signup</title>
</head>
<body>

<div class="box_form">
    <h1 id="title_form">Signup</h1>

    <?php
        if($error === true)
        {
            error_fun();
        }
    ?>

    <!--Form-->
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" rquired>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <input type="submit" name="submit_button" value="Continue" class="submit_btn">
    </form>

    <span id="string_account">
        You have account? <a href="sign.php">Sign!</a>
    </span>
</div>

</body>
</html>