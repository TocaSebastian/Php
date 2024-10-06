<?php

include 'connect.php';
// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO images (cod_art, image_name, image_data, image_type) VALUES ( ?, ?, ?, ?)");
$stmt->bind_param("ssss",$cod_art, $image_name, $image_data, $image_type);
$image_name = $_FILES["image"]["name"];
$image_data = file_get_contents($_FILES["image"]["tmp_name"]);
$image_type = $_FILES["image"]["type"];
$cod_art = $_POST['cod_art'];
// Execute the prepared statement
if ($stmt->execute()) {
    echo "Image stored in the database successfully!";
} else {
    echo "Error storing the image in the database: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();

include 'connect.php';

//echo "<br>INSERT Articol <br>";



$tip_animal = $_POST["tip_animal"];
$denumire_articol = $_POST['denumire_articol'];
$utilitate = $_POST['utilitate'];
$cantitate = $_POST['cantitate'];
$brand = $_POST['brand'];
$pret = $_POST['pret'];
$descriere = $_POST['descriere'];

//echo "[".$tip_animal." - ".$denumire_articol." - ".$utilitate." - ".$cantitate." - ".$brand." - ".$pret."]";
//echo $descriere;

// Execute the prepared statement
$sql = "INSERT INTO articol ( tip_animal , denumire_articol, utilitate, cantitate, brand, pret, descriere, cod_art) VALUES ('$tip_animal', '$denumire_articol' , '$utilitate' , $cantitate , '$brand' , $pret, '$descriere',$cod_art)";

//echo "<br>".$sql;
if ($conn->query($sql) === TRUE) {
  echo "<br>Successfully INSERT articol";
} else {
  echo "<br>Error INSERT: " . $conn->error;
}

// Close the statement and database connection
//$stmt->close();
$conn->close();

//time_sleep_until(time()+3);
sleep(3);// asteapta 3 secunde apoi deschide pagina noua
ob_clean(); // curata pagina de browser (cls)
include "admin_meniu.php";

?> 
