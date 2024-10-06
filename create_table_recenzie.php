<?php
include 'connect.php';

// Create Tables

echo "<br>Creare Tabela Recenzii pentru articol ";

$sql = "CREATE TABLE recenzie (
          nr_crt INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          user_name VARCHAR(35) NOT NULL,
          cod_art INT(6),
          text_recenzie VARCHAR(500),
          data TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

if ($conn->query($sql) === TRUE) {
  echo "Successfully created TABLE recenzie";
} else {
  echo "Error creating TABLE recenzie: " . $conn->error;
}

$conn->close();
ob_clean();
include "index.php";
?> 
