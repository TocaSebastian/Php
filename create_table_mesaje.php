<?php
include 'connect.php';

echo "<br>Creare Tabela mesaje: ";

$sql = "CREATE TABLE mesaje (
          nr_crt INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          de_la VARCHAR(30) NOT NULL,
          catre VARCHAR(30) NOT NULL,
          subiect VARCHAR(255),
          nume VARCHAR(50) NOT NULL,
          email VARCHAR(255),
          text VARCHAR(3000) NOT NULL,
          data DATE DEFAULT CURRENT_TIMESTAMP,
          ora TIME DEFAULT CURRENT_TIMESTAMP,
          citit INT(1) DEFAULT 0
        )";
// citit = 0 (mesajul nu a fost citit)
//       = 1 (mesajul a fost citit)
echo $sql;
if ($conn->query($sql) === TRUE) {
  echo "Successfully created TABLE mesaje";
} else { echo "Error creating TABLE mesaje: " . $conn->error; }

$conn->close();
ob_clean();
include "index.php";
?> 
