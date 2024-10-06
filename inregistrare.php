<?php
$nume = $_POST['nume'];
$email = $_POST['email'];
$pass1 = MD5($_POST['parola']);
$pass2 = MD5($_POST['parola2']);


if ($pass1 === $pass2){
  include 'connect.php';
  // verific daca este user in baza si ce drepturi are (Admin sau User)
  $sql = "INSERT INTO users ( user_name , passwd, email, admin) VALUES ('$nume','$pass1', '$email', 0)";
 // echo "<br>$sql";

  if ($conn->query($sql) === TRUE) {
    echo "<br>Successfully INSERT user";
    $conn->close();
    include "login.html";
  }
  else {
    echo "<br>Error INSERT: " . $conn->error;
  }

  // Close the statement and database connection
  $conn->close();
}
else{
  echo "<br>Parolele nu sunt identice !!!";
}
?>
