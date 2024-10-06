<?php
include 'user_meniu.php';
include 'connect.php';
session_start();

echo "<br><H2><center> Articole achizitionate anterior</center></h2>";
$user_name=$_SESSION["user_id"];
$sql = "SELECT * FROM articol, images, cos  WHERE articol.cod_art = images.cod_art AND articol.cod_art = cos.cod_art_cos AND cos.user_name='$user_name' AND cos.achizitionat=1 ORDER BY data";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '<br><p align="center">
            <table border="1">
                  <tr>
                    <td colspan="2">Denumire articol: <font color="blue">' . $row["denumire_articol"]. '</font></td>
                    <td width="199" rowspan="4">
                      <form method="post">
                        <center>Acizitionat la data de:'.$row["data"].'</center>
                      </form>
                    </td>
                  </tr>
                  <tr>
                    <td rowspan="7"><center><img src="data:image/jpeg;base64,'.base64_encode($row['image_data']).'"width="180" height="180" ></center></td>
                    <td>cod produs:' . $row["cod_art"]. '</td>
                  </tr>

                  <tr><td>Animalut: ' . $row["tip_animal"].  ' </td></tr>
                  <tr><td>Utilitate: ' . $row["utilitate"]. ' </td></tr>
                  <tr></tr>
                  <tr>
                    <td>Cantitate: ' . $row["cantitate"]. ' </td>
                    <td rowspan="3"><p align="center">
                      <a class="top" href="#"><img src="top_button.png"></a></p>
                    </td>
                  </tr>
                  <tr>
                    <td>Producator: ' . $row["brand"]. ' </td>

                  </tr>
                  <tr>
                    <td>Pret: ' . $row["pret"]. ' Lei</td>

                  </tr>
                  <tr><td height="100" width="450" colspan="2">'.$row["descriere"].'</td>
                      <td rowspan="2">&nbsp;</td>
                  </tr>

               </table>
               </p>';
  }//while

} else {
  echo "0 results";
}
$conn->close();
?>
