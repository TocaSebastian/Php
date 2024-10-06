<?php
$servername = "localhost";
$username = "user";
$password = "user";
$database = "myDB";
// Create connection        mysqli(host, username, password, dbname, port, socket)
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//echo "<br>Connected....<br>";


?>
