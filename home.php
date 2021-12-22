<?php

session_start();

if(!isset($_SESSION['access']) || $_SESSION['access'] !== true)
{
    header('location: sign.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        *{padding: 0;margin: 0;}
        header{
            width: 100%;
            height: 10vh;
            display: flex;
            justify-content: right;
            align-items: center;
            background-color: rgb(11, 190, 122);
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        h2{
            padding-right: 20px;
        }
        a{
            color: #222;
        }
        a:hover{
            color: blue;
        }
    </style>
</head>
<body>
    
<header>
    <h2>
        Hello <?php echo $_SESSION['username']?>,
        <a href="disconnect.php">disconnect?</a>
    </h2>
</header>

</body>
</html>