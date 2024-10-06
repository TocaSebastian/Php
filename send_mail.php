<!DOCTYPE HTML>
<html>
<head>
<title>Trimitere email catre Adminstrator</title>
</head>
<body>
<?php
   $to = $_POST["email"];
   $subject = $_POST["subiect"];
   $message = $_POST["mesaj"];
   $header = "From:$to \r\n";
   $header .= $_POST["nume"];
   //echo $to," ",$subject;
   $retval = mail ("admin@gmail.com",$subject,$message,$header);
   if( $retval == true ){
      echo "<script> alert('Mesaj Trimis catre administrator!'); </script>";
   }else{
      echo "<script> alert('Mesaj netrimis!);'";
   }
   include "user_meniu.php"
?>
</body>
</html>
