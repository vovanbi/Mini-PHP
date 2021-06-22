<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database ="crud";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);

if($conn === false)
{
	die('Connection not success'.mysqli_connect_error());
}
?>