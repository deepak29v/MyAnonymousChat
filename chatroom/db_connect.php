<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "chatroom";

// Creating database connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check Connection

if(!$conn)
{
	die("Failed to connect". mysqli_connect_error());
}

?>