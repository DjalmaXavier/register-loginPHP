<?php

$host = "localhost";
$username = "root";
$pass = "";
$db = "website";

try {
    $conn = mysqli_connect($host, $username, $pass, $db);
} catch (mysqli_sql_exception) {
    echo "Could not connect!";
}


function checkUser($conn, $username)
{
    $sql = "SELECT * FROM users WHERE user = '{$username}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}
