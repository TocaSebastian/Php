<?php
session_start();
$id_sesiune=session_id();
include 'user_meniu.php';
include 'connect.php';

echo "<br><p> <center><h2>Afisare VACCINURI achizitionate si Efectuate la noi.</h2></center>";

$user_name=$_SESSION["user_id"];
include 'connect.php';
$sql = "SELECT * FROM articol, vaccinare, images,cos  WHERE articol.cod_art = vaccinare.cod_art_vaccin AND articol.cod_art = images.cod_art AND articol.cod_art = cos.cod_art_cos AND vaccinare.user_name='$user_name' AND cos.user_name='$user_name' AND este_programat=3 AND cos.achizitionat=1 ORDER BY data_vaccinare";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '<br><p align="center">
            <table border="1">
                  <tr>
                    <td colspan="2">Denumire articol: <font color="blue">' . $row["denumire_articol"]. '</font></td>
                    <td width="199" rowspan="4"><center>
                    Efectuat la data de:'.$row["data_vaccinare"].'</center>
                    </td>
                  </tr>
                  <tr>
                    <td rowspan="7"><center><img src="data:image/jpeg;base64,'.base64_encode($row['image_data']).'"width="180" height="180" ></center></td>
                    <td>cod produs:' . $row["cod_art"]. '</td>
                  </tr>

                  <tr><td>Animalut: ' . $row["tip_animal"].  ' </td></tr>
                  <tr><td>Utilitate: ' . $row["utilitate"]. ' </td></tr>
                  <tr>
                    <td>Cantitate: ' . $row["cantitate_cos"]. ' </td>
                    <td rowspan="3"><p align="center">
                      <a class="top" href="#"><img src="top_button.png"></a></p>
                    </td>
                  </tr>
                  <tr>
                    <td>Producator: ' . $row["brand"]. ' </td>

                  </tr>
                  <tr>
                    <td>Pret: ' . $row["pret"]. ' </td>
                  </tr>
                  <tr>
                    <td height="100" width="450" colspan="2">'.$row["descriere"].'</td>

                  </tr>
               </table>
               </p>';
  }//while
  //echo '<br><center><a class="top" href="#"><img src="top_button.png"></a></center>';
} else {
  echo "0 results";
}
$conn->close();
?>
