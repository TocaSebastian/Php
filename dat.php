<?php

  include "connect.php";
  $sql2 = "SELECT data FROM cos";
  $result2 = $conn->query($sql2);
  if ($result2->num_rows > 0) {
      $row = $result2->fetch_assoc();
      echo $row["data"];
      echo "<br>";
      echo date("Y-m-d");
  }
  $conn->close();
?>
