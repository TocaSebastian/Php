<?php
include 'connect.php';

// Create Tables

echo "<br>Creare Tabela Detalii Expediere: ";

$sql = "CREATE TABLE expediere (
          nr_comanda INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          user_name VARCHAR(35) NOT NULL,
          id_sesiune VARCHAR(30),
          data DATE DEFAULT CURRENT_TIMESTAMP,
          nume VARCHAR(50) NOT NULL,
          judet VARCHAR(30) NOT NULL,
          localitate VARCHAR(50) NOT NULL,
          strada VARCHAR(50),
          nr_strada int(4) DEFAULT 0,
          telefon VARCHAR(11) NOT NULL,
          detalii_exped VARCHAR(500)
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
