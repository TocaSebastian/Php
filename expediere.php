<?php
session_start();
$id_sesiune=session_id();
include 'user_meniu.php';
////////////////////////////////////////

$user_name=$_SESSION["user_id"];
$nume = $_POST['nume'];
$judet = $_POST['judet'];
$localitate = $_POST['localitate'];
$strada = $_POST['strada'];
$nr_strada =  $_POST['nr_strada'];
$detalii_exped = $_POST['detalii_exped'];
$telefon = $_POST["telefon"];

include 'connect.php';
// introducere date referitoare la expedierea produselor
$sql = "INSERT INTO expediere ( user_name , id_sesiune, nume, judet, localitate, strada, nr_strada, telefon, detalii_exped) VALUES ('$user_name', '$id_sesiune', '$nume', '$judet', '$localitate', '$strada', $nr_strada, '$telefon', '$detalii_exped')";
//echo "<br><br>".$sql;

if ($conn->query($sql) === TRUE) {
    //echo "<br>Successfully INSERT expediere";
    echo "<br><h2>Comanda a fost plasata !<br>Factura este atasata mai jos.<br><br>Multumim !</h2>";
  }
  else {
    //echo "<br>Error INSERT: " . $conn->error;
  }
  // Close the statement and database connection

$conn->close();

/////////////////////////////////

echo "<br><h3>Destinatar:", $nume,"<br>";
echo "Adresa:";
echo $localitate.", ". $judet.", str. ".$strada.", nr. ".$nr_strada."<br>";
echo "Telefon:".$telefon;
echo "<br>------------------------------------------------------------------------------------------------------</h3>";
echo "<h3>Produse achizitionate:</h3>";

include 'connect.php';
$sql = "SELECT * FROM articol,cos WHERE articol.cod_art=cos.cod_art_cos AND cos.achizitionat=2 AND user_name='$user_name'";
//echo "<br>".$sql;

$result = $conn->query($sql);
if ($result->num_rows > 0) {

  echo '<table border="1" width="738" height="99">
          <tr>
            <td height="24" width="44">Nr crt</td>
            <td height="24" width="460"> <p align="center">Denumire produs</td>
            <td height="24" width="212"> <p align="center">Pret</td>
          </tr>';
  $nr_crt=0;
  $total=0;
  while($row = $result->fetch_assoc()) {
      $nr_crt+=1;
      echo '<tr>';
      echo'<td height="24" width="44">'.$nr_crt.'</td>';
      echo '<td height="24" width="460">'.$row["denumire_articol"].'</td>';
      echo '<td height="24" width="212">'.$row["pret"].' Lei</td></tr>';
      $total+=$row["pret"]*$row["cantitate_cos"];
  }//while
  echo '<tr>  <td height="33" width="504" colspan="2"> <p align="right">TOTAL</td> <td height="33" width="212">'.$total.' Lei</td>  </tr> </table>';
}//if
$conn->close();
sleep(3);
//Dupa facturare produsul trece in cos ca fiind facurat = 1
include 'connect.php';
  // Schimbarea atributului achizitionat din 2 in 1 (articolul a fost facturat)
  // urmeaza intocmirea facturii (2 pt facturare, 1 a fost facuturat)
  $sql = "UPDATE cos SET achizitionat=1 WHERE user_name='$user_name' AND achizitionat=2";
  if ($conn->query($sql) === TRUE) {
          //echo "<br>Successfully UPDATE cos";
  }
  else{//echo "<br>Error UPDATE: " . $conn->error;
      }
  $conn->close();

?>
