<?php
$server     ="localhost";
$username   ="";
$password   ="";
$db         ="database";

$conn = mysqli_connect($server, $username, $password, $db);

if(!$conn)
{
    die("connection failed: " . mysqli_connect_error());
}
?>