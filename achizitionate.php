<?php
include 'user_meniu.php';
include 'connect.php';
echo '<a name="top_page"></a>';
session_start();

echo "<br><H2><center> Articole achizitionate anterior</center></h2>";
$user_name=$_SESSION["user_id"];
$sql = "SELECT * FROM articol, images, cos  WHERE articol.cod_art = images.cod_art AND articol.cod_art = cos.cod_art_cos AND cos.user_name='$user_name' AND cos.achizitionat=1 ORDER BY data";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '<br><center>
              <table border="1">
                  <tr><td colspan="3">Denumire articol: <font color="blue">' . $row["denumire_echipament"]. '</font></td></tr>
                  <tr>
                    <td width="250" rowspan="7"><center><img src="data:image/jpeg;base64,'.base64_encode($row['image_data']).'"width="180" height="180" ></center></td>
                    <td colspan="2">cod produs:' . $row["cod_art"]. '</td>
                  </tr>

                  <tr><td colspan="2">Tip de sport: ' . $row["tip_echipament"].  ' </td></tr>
                  <tr><td colspan="2">Utilitate: ' . $row["utilitate"]. ' </td></tr>
                  <tr><td colspan="2">Anotimp: ' . $row["anotimp"]. ' </td></tr>
                  <tr><td colspan="2">Cantitate: ' . $row["cantitate"]. ' </td></tr>
                  <tr><td colspan="2">Producator: ' . $row["brand"]. ' </td></tr>
                  <tr><td colspan="2">Pret: ' . $row["pret"]. ' Lei</td></tr>
                  <tr><td height="100" width="450" colspan="3">'.$row["descriere"].'</td></tr>
                  <tr><td colspan="2"><strong><p align="justify">Achizitionat in data de: '.$row['data'].'</strong></td>
                      <td width="42">
                        <p align="center">
                          <a href="#top_page"><img src="gif/sus.png" height="50" width="50" ></a>
                        </p>
                  </td></tr>
               </table>
               </center><br>';
  }//while

} else {
  echo "0 results";
}
$conn->close();
?>
