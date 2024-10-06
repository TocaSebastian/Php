<?php
include 'user_meniu.php';
include 'connect.php';
session_start();

echo "<br><H2><center> Afisare articole favorite</center></h2>";
$user_name=$_SESSION["user_id"];
$id_sesiune=session_id();
//echo $id_sesiune;
$sql = "SELECT * FROM articol, images, fav  WHERE articol.cod_art = images.cod_art AND articol.cod_art = fav.cod_art AND fav.user_name='$user_name'";
$result = $conn->query($sql);

if(array_key_exists('button1', $_POST))//Elimina din Favorite
{
      //Stergere articol de la favorite
      $user=$_SESSION["user_id"];
      if($_SESSION["este_logat"]==1)
      {
        include 'connect.php';
        $cod_art=$_POST['button1'];
        $sql = "DELETE FROM fav WHERE user_name='$user' AND cod_art=$cod_art";
        //echo "<br>".$sql;
        if ($conn->query($sql) === TRUE) {
          //echo "<br>Successfully INSERT favorites";
        }
        else{//echo "<br>Error INSERT: " . $conn->error;
            }
        $conn->close();
      }//else{ echo "Nu sunteti logat!\nNu puteti adauga articole in cos!";}

}

if(array_key_exists('button2', $_POST))
{
  echo "<h2>Articolele sunt in cosul dumneavoatra! !<br>Intrati in cos pentru a finaliza comanda !</h2>";
  $user=$_SESSION["user_id"];
  $cod_art=$_POST['button2'];
  include 'connect.php';
  //$sql = "INSERT INTO cos (user_name,cod_art,id_sesiune,data) SELECT user_name,cod_art,id_sesiune,data FROM fav WHERE user_name='$user' AND id_sesiune='$id_sesiune'";
  $sql = "INSERT INTO cos ( user_name , cod_art_cos, id_sesiune) VALUES ('$user', $cod_art,'$id_sesiune')";

  if ($conn->query($sql) === TRUE) {
         // echo "<br>Successfully INSERT cos";
  }
  else{//echo "<br>Error INSERT: " . $conn->error;
      }
  $conn->close();
  // Trimite e-mail.
}

if ($result->num_rows > 0) {
  // output data of each row
  $total_plata=0;
  while($row = $result->fetch_assoc()) {
    echo '<br><p align="center">
            <table border="1">
                  <tr>
                    <td colspan="2">Denumire articol: <font color="blue">' . $row["denumire_articol"]. '</font></td>
                    <td width="199" rowspan="4">
                      <form method="post">
                        <p align="center"><button type="submit" name="button1" value="'.$row["cod_art"].'"> Elimina din favorite</button></p>
                      </form>
                    </td>
                  </tr>
                  <tr>
                    <td rowspan="7"><center><img src="data:image/jpeg;base64,'.base64_encode($row['image_data']).'"width="180" height="180" ></center></td>
                    <td>cod produs:' . $row["cod_art"]. '</td>
                  </tr>

                  <tr><td>Animalut: ' . $row["tip_animal"].  ' </td></tr>
                  <tr><td>Utilitate: ' . $row["utilitate"]. ' </td></tr>
                  <tr> </tr>
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
                  <tr>
                    <td height="100" width="350" colspan="2">'.$row["descriere"].'
                    </td>
                    <td>
                      <form method="post">
                        <p align="center">
                          <button type="submit" name="button2" value="'.$row["cod_art"].'"> Adauga la Comanda</button>
                        </p>
                      </form>
                    </td>
                  </tr>
               </table>
               </p>';
  }//while
} else {
  echo "0 results";
}
$conn->close();
?>
