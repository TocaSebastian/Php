<!DOCTYPE HTML>
<HTML>
<BODY>
<?php
session_start();
$id_sesiune=session_id();
include 'admin_meniu_s.php';
include 'connect.php';

echo "<br><H2><center> Afisare articole din baza (Interogare baza)</center></h2>";

$sql = "SELECT * FROM articol, images WHERE articol.cod_art = images.cod_art";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '<br><table border="1">
                  <tr><td colspan="2">Denumire articol:  ' . $row["denumire_articol"]. '</td></tr>
                  <tr>
                    <td rowspan="7"><center><img src="data:image/jpeg;base64,'.base64_encode($row['image_data']).'"width="200" height="200" ></center></td>
                    <td>cod produs:' . $row["cod_art"]. '</td>
                  </tr>

                  <tr><td>Animalut: ' . $row["tip_animal"].  ' </td></tr>
                  <tr><td>Utilitate: ' . $row["utilitate"]. ' </td></tr>
                  <tr><td>Producator: ' . $row["brand"]. ' </td></tr>
                  <tr><td>Cantitate: ' . $row["cantitate"]. ' </td></tr>
                  <tr><td>Pret: ' . $row["pret"]. ' Lei</td></tr>
                  <tr><td height="100" width="450" colspan="2">'.$row["descriere"].'</td></tr>
                  <td colspan="2">
                    <p align="right"><a class="top" href="#"><img src="top_button.png"></p></a>
                  </td>
               </table>';
  }//while
  //echo '<br><center><a class="top" href="#"><img src="top_button.png"></a></center>';
} else {
  echo "0 results";
}
$conn->close();
?> 
</BODY>
</HTML>
