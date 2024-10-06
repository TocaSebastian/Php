<?php
include 'connect.php';

// Create Tables

echo "<br>Creare Tabela ARTICOL: ";

$sql = "CREATE TABLE articol (
          nr_crt INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          tip_echipament VARCHAR(30) NOT NULL,
          denumire_echipament VARCHAR(30) NOT NULL,
          utilitate VARCHAR(30) NOT NULL,
          anotimp VARCHAR(30) NOT NULL,
          cantitate INT(6),
          brand  VARCHAR(30) NOT NULL,
          pret INT(6),
          descriere VARCHAR(500),
          cod_art INT(6)
        )";

if ($conn->query($sql) === TRUE) {
  echo "Successfully created TABLE Articol";
} else {
  echo "Error creating TABLE Articol: " . $conn->error;
}

echo "<br>Creare Tabela images: ";
$sql = "CREATE TABLE images (
            id INT AUTO_INCREMENT PRIMARY KEY,
            cod_art INT(6),
            image_name VARCHAR(255),
            image_data LONGBLOB,
            image_type VARCHAR(255)
        )";

if ($conn->query($sql) === TRUE) {
  echo "Successfully created TABLE images";
} else {
  echo "Error creating TABLE: " . $conn->error;
}

$conn->close();
ob_clean();
include "admin_produs.html";
?> 
