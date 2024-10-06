<?php
include 'connect.php';

// Create Tables

echo "<br>Creare Tabela Vaccinare: ";

$sql = "CREATE TABLE vaccinare (
          nr_crt_v INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          user_name VARCHAR(35) NOT NULL,
          cod_art_vaccin INT(6),
          este_programat INT(1) DEFAULT -1,
          data_vaccinare DATE,
          data_programare_admin DATE,
          mesaj_admin VARCHAR(400)
        )";
// este_programat = 0 (neconfirmat de Admin)
//                = 1 (programat)
//                = 2 (asteapta confirmarea USER)
//                = 3 (realizat)
//                = -1 (nu este programare facuta)
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
// Pas1:  USER   ------> [alege data] [este_programat=0]
// Pas2:  ADMIN  ------> Confirma [este_programat=1] ----> Stop
// Pas3:         ------> Nu confirma [este_programat=2]--->[Admin alege o alta data][Mesaj text de la admin]
// Pas4:  USER --->[confirma] [este_programat=1]--->Stop
// Pas5:       --->[nu confirma]--->Merge la [Pas1]
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($conn->query($sql) === TRUE) {
  echo "Successfully created TABLE Vaccinare";
} else {
  echo "Error creating TABLE Vaccinare: " . $conn->error;
}

$conn->close();
ob_clean();
include "index.html";
?> 
