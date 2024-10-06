<!DOCTYPE HTML>
<html>
<head>
<title>Trimitere email catre Adminstrator</title>
</head>
<body>
<?php
session_start();
   $from=$_SESSION["user_id"];
   $to="admin";
   $email = $_POST["email"];
   $subiect = $_POST["subiect"];
   $mesaj = $_POST["mesaj"];
   $nume .= $_POST["nume"];
   include 'connect.php';
   $sql = "INSERT INTO mesaje ( catre, de_la, subiect, nume, email, text, citit) VALUES ('".$to."', '".$from."' , '".$subiect."' , '".$nume."' , '".$email."' , '".$mesaj."' , 0)";
//echo "<br>".$sql;
   if ($conn->query($sql) === TRUE) {
      echo "<br>Successfully INSERT articol";
   } else { echo "<br>Error INSERT: " . $conn->error;  }
$conn->close();
   include "user_meniu.php"
?>
</body>
</html>
