<?php
include 'connect.php';

// Create Tables

echo "<br>Creare Tabela Favorites: ";

$sql = "CREATE TABLE fav (
          nr_crt INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          user_name VARCHAR(35) NOT NULL,
          cod_art INT(6),
          id_sesiune VARCHAR(30),
          data DATE DEFAULT CURRENT_TIMESTAMP
        )";

if ($conn->query($sql) === TRUE) {
  echo "Successfully created TABLE Fav";
} else {
  echo "Error creating TABLE Fav: " . $conn->error;
}

$conn->close();
ob_clean();
include "index.html";
?> 
