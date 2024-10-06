<?php

include 'connect.php';

$cod_art = $_POST['cod_art'];
$tip_animal = $_POST['tip_animal'];
$denumire_articol = $_POST['denumire_articol'];
$utilitate = $_POST['utilitate'];
$cantitate = $_POST['cantitate'];
$brand = $_POST['brand'];
$pret = $_POST['pret'];
$descriere = $_POST['descriere'];

$ok=0;
$sir="";

if (strlen($tip_echipament)!=0){
  $ok=1;
  $sir="tip_animal='$tip_animal'";
}


$len=strlen($denumire_articol);
echo $len;

if ($len > 0){
  if ($ok) $sir=$sir.", ";
  $sir=$sir."denumire_articol='$denumire_articol'";
  $ok=1;
}

if(strcmp($utilitate,"Alege o optiune")!=0){
  if ($ok)  $sir=$sir.", ";
  $sir=$sir."utilitate='$utilitate'";
  $ok=1;
}


if(strcmp($brand,"")!=0){
  if ($ok) $sir=$sir.", ";
  $sir=$sir."brand='$brand'";
  $ok=1;
}

if(strcmp($descriere,"")!=0){
  if ($ok) $sir=$sir.", ";
  $sir=$sir."brand='$descriere'";
  $ok=1;
}

if(strcmp($pret,"")!=0){
  if ($ok) $sir=$sir.", ";
  $sir=$sir."pret=$pret";
  $ok=1;
}

if(strcmp($cantitate,"")!=0){
  if ($ok) $sir=$sir.", ";
  $sir=$sir."cantitate=$cantitate";
  $ok=1;
}


// Execute the prepared statement
$sql = "UPDATE articol SET $sir WHERE cod_art=".$cod_art;
//echo "<br>".$sql;

if ($conn->query($sql) === TRUE) {
  echo "<br>Successfully UPDATED articol";
} else {
  echo "<br>Error UPDATE: " . $conn->error;
}


$conn->close();

//time_sleep_until(time()+3);
sleep(3);// asteapta 3 secunde apoi deschide pagina noua
ob_clean(); // curata pagina de browser (cls)
include "admin_meniu.php";
echo "<br>Comanda SQL:<br>   ".$sql;

?> 
