<?php

$connect = new mysqli('127.0.0.1', 'root', '', 'login_db');

if($connect === false)
{
    echo '<script>alert("error with connect database")</script>';
}

?>