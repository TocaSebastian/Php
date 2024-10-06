<?php
include 'connect.php';

// Create Tables

echo "<br>Creare Tabela Cos cumparaturi: ";

$sql = "CREATE TABLE cos (
          nr_crt INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          user_name VARCHAR(35) NOT NULL,
          cod_art_cos INT(6),
          cantitate_cos INT(6) DEFAULT 1,
          achizitionat INT(1) DEFAULT 0,
          id_sesiune VARCHAR(30),
          data DATE DEFAULT CURRENT_TIMESTAMP
        )";

if ($conn->query($sql) === TRUE) {
  echo "Successfully created TABLE cos";
} else {
  echo "Error creating TABLE cos: " . $conn->error;
}

$conn->close();
ob_clean();
include "index.php";
?> 
