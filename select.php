<?php
session_start();
if ($_SESSION["admin"] == 1)
{
    include 'admin_produs.html';
    echo" <style>
        body {
            background-image: url();
            height: 400px;
            background-position: center;
            background-repeat: no-repeat, repeat;
            background-size: auto;
            position: relative;
        }</style>";
}

include 'connect.php';

echo "<br><H2><center> Afisare articole din baza (Interogare baza)</center></h2>";

$sql = "SELECT * FROM articol, images WHERE articol.cod_art = images.cod_art";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '<br><table border="1">
                  <tr><td colspan="2">Denumire articol:' . $row["denumire_echipament"]. '</td></tr>
                  <tr>
                    <td rowspan="7"><center><img src="data:image/jpeg;base64,'.base64_encode($row['image_data']).'"width="180" height="180" ></center></td>
                    <td>cod produs:' . $row["cod_art"]. '</td>
                  </tr>

                  <tr><td>Tip de sport: ' . $row["tip_echipament"].  ' </td></tr>
                  <tr><td>Utilitate: ' . $row["utilitate"]. ' </td></tr>
                  <tr><td>Anotimp: ' . $row["anotimp"]. ' </td></tr>
                  <tr><td>Cantitate: ' . $row["cantitate"]. ' </td></tr>
                  <tr><td>Producator: ' . $row["brand"]. ' </td></tr>
                  <tr><td>Pret: ' . $row["pret"]. ' Lei</td></tr>
                  <tr><td height="100" width="450" colspan="2">'.$row["descriere"].'</td></tr>
               </table>';
  }//while
} else {
  echo "0 results";
}
$conn->close();
?> 
