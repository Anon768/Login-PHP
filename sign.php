<?php

include_once('config/conf.php');

if(isset($_POST['sign_submit']))
{
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $username = $connect->real_escape_string($_POST['username']);
        $password = $connect->real_escape_string($_POST['password']); // strtolower()

        $sql_select = "SELECT * FROM users_db WHERE username='$username'";

        if($st = $connect->query($sql_select))
        {
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
                    echo '<script>alert("the password is wrong")</script>';
                }
            }else{
                echo '<script>alert("there are no users with this username")</script>';
            }
        }
        else
        {
            echo '<script>alert("error with login")</script>';
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