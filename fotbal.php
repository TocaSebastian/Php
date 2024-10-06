<?php
include 'user_meniu.php';
include 'connect.php';
echo '<a name="top_page"></a>';
session_start();
$id_sesiune=session_id();

echo "<br><h2> <center><strong>Articole pentru fotbal.</strong></center></h2>";

$sql = "SELECT * FROM articol, images WHERE utilitate='fotbal' AND articol.cod_art = images.cod_art";
$result = $conn->query($sql);

if(array_key_exists('button1', $_POST))//Buton "Adauga la Favorite"
{
      $user=$_SESSION["user_id"];
      if($_SESSION["este_logat"]==1)
      {
        include 'connect.php';
        $cod_art=$_POST['button1'];
        $sql2 = "SELECT * FROM fav WHERE user_name='$user' AND cod_art=$cod_art";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows <= 0) {//Daca produsul nu se afla in lista de favorite atunci il adaug
          $sql3 = "INSERT INTO fav ( user_name , cod_art, id_sesiune) VALUES ('$user', $cod_art,'$id_sesiune')";
          //$sql = "INSERT INTO fav ( user_name , cod_art, id_sesiune) SELECT '$user', $cod_art,'$id_sesiune' WHERE NOT EXISTS (SELECT $cod_art FROM fav WHERE user='$user' AND cod_art=$cod_art)";
          //echo "<br>".$sql;
          if ($conn->query($sql3) === TRUE) {
            //echo "<br>Successfully INSERT favorites";
          }else{ echo "<br>Error INSERT: " . $conn->error; }
        }
        else{
          echo '<script>alert("Produsul se afla deja in lista de Favorite!");</script>';
        }//if produs nu se afla in lista la Favorite
        $conn->close();
      }//else{ echo "Nu sunteti logat!\nNu puteti adauga articole in cos!";}
}//buton Favorite

if(array_key_exists('button2', $_POST))//Buton "Adauga in Cos"
{
      $user=$_SESSION["user_id"];
      if($_SESSION["este_logat"]==1)
      {
        include 'connect.php';
        $cod_art=$_POST['button2'];
        $sql2 = "SELECT * FROM cos WHERE user_name='$user' AND cod_art_cos=$cod_art AND achizitionat=0";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows <= 0) {//Daca produsul nu se afla in Cos atunci il adaug
          $sql3 = "INSERT INTO cos ( user_name , cod_art_cos, id_sesiune) VALUES ('$user', $cod_art,'$id_sesiune')";
          if ($conn->query($sql3) === TRUE) {
            //echo "<br>Successfully INSERT favorites";
          }else{ echo "<br>Error INSERT: " . $conn->error; }
        }
        else{
          echo '<script>alert("Produsul se afla deja in Cos!");</script>';
        }//if produs nu se afla in Cos
        $conn->close();
      }//else{ echo "Nu sunteti logat!\nNu puteti adauga articole in cos!";}
}//buton Adauga in Cos

if(array_key_exists('buton_recenzie', $_POST))//Buton Recenzie
{
      $user=$_SESSION["user_id"];
      if($_SESSION["este_logat"]==0)
      {
        $user="Anonim";
      }//if
      include 'connect.php';
      $cod_art=$_POST['buton_recenzie'];
      $text_recenzie=$_POST["recenzie"];
      if (strlen($text_recenzie)>0)
      {
        $sql3 = "INSERT INTO recenzie ( user_name , cod_art, text_recenzie) VALUES ('$user', $cod_art,'$text_recenzie')";
        if ($conn->query($sql3) === TRUE) {
          //echo "<br>Successfully INSERT favorites";
        }else{ echo "<br>Error INSERT: " . $conn->error; }
        $conn->close();
      }
}//buton Recenzie

include 'connect.php';
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '<center>
              <table border="1">
                  <tr>
                    <td colspan="3" width="399">Denumire articol:  <font color="blue">' . $row["denumire_echipament"]. '</font></td>
                    <td width="417" colspan="2"><p align="center">Recenzii</p></td>
                  </tr>
                  <tr>
                    <td rowspan="7"><center><img src="data:image/jpeg;base64,'.base64_encode($row['image_data']).'"width="180" height="180" ></center></td>
                    <td colspan="2">cod produs:' . $row["cod_art"]. '</td>
                    <td width="417" rowspan="8" colspan="2">
                      <textarea rows="20" name="recenzii_text" cols="57" readonly>';
                        $sql2 = "SELECT * FROM recenzie WHERE cod_art =".$row["cod_art"]." ORDER BY data DESC";
                        //echo $sql2;
                        $result2 = $conn->query($sql2);
                        if ($result2->num_rows > 0) {
                          while($row2 = $result2->fetch_assoc()) {
                            echo "                ".$row2["data"]."    \n ".$row2["user_name"].":  ";
                            echo $row2["text_recenzie"]."\n";
                            echo "-------------------------------------------------------\n";
                          }//while
                        }
                        else{
                              echo "Nu exista recenzii.";
                        }//if

                echo '</textarea></td>
                  </tr>

                  <tr><td colspan="2">Tip de sport: ' . $row["tip_echipament"].  ' </td></tr>
                  <tr><td colspan="2">Utilitate: ' . $row["utilitate"]. ' </td></tr>
                  <tr><td colspan="2">Anotimp: ' . $row["anotimp"]. ' </td></tr>
                  <tr><td colspan="2">Cantitate: ' . $row["cantitate"]. ' </td></tr>
                  <tr><td colspan="2">Producator: ' . $row["brand"]. ' </td></tr>
                  <tr><td colspan="2">Pret: ' . $row["pret"]. ' Lei</td></tr>
                  <tr><td height="100" width="450" colspan="3">'.$row["descriere"].'</td></tr>
                  <tr>
                    <form method="post">
                      <td width="150"><center><button type="submit" name="button1" value="'.$row["cod_art"].'"> Adauga la Favorite</button></center></td>
                      <td width="150"><center><button type="submit" name="button2" value="'.$row["cod_art"].'"> Adauga in cos</button></center></td>
                      <td width="120"><p align="center"><a href="#top_page"><img src="gif/sus.png" height="80" width="80" ></a></p></td>
                      <td width="371">Recenzie:<textarea cols="50" rows="5" name="recenzie" cols="30"></textarea></td>
                      <td width="42"><button type="submit" name="buton_recenzie" value="'.$row["cod_art"].'"> Send</button></td>
                    </form>
                  </tr>
               </table>
               </center><br>';
  }//while
} else {
  echo "0 results";
}
$conn->close();
?>
