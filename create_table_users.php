<?php
include 'connect.php';

// Create Tables

echo "<br>Creare Tabela Users: ";

$sql = "CREATE TABLE users (
          nr_crt INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          user_name VARCHAR(35) NOT NULL,
          passwd VARCHAR(35) NOT NULL,
          email VARCHAR(100) NOT NULL,
          admin INT(1)
        )";

if ($conn->query($sql) === TRUE) {
  echo "Successfully created TABLE Users";
} else {
  echo "Error creating TABLE Users: " . $conn->error;
}

$conn->close();
ob_clean();
include "index.html";
?> 
