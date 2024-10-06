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

if(array_key_exists('button1', $_POST))
{
      //echo $_SESSION["user_id"];
      $user=$_SESSION["user_id"];
      if($_SESSION["este_logat"]==1)
      {

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
  $sql2 = "SELECT * FROM cos WHERE user_name='$user' AND cod_art_cos=$cod_art AND achizitionat=0";
  $result2 = $conn->query($sql2);
  if ($result2->num_rows <= 0) {//Daca produsul nu se afla in Cos atunci il adaug
      $sql = "INSERT INTO cos ( user_name , cod_art_cos, id_sesiune) VALUES ('$user', $cod_art,'$id_sesiune')";
      if ($conn->query($sql) === TRUE) {
           // echo "<br>Successfully INSERT cos";
      }
      else{//echo "<br>Error INSERT: " . $conn->error;
         }
  }//if
  $conn->close();
  // Trimite e-mail.
}

if ($result->num_rows > 0) {
  // output data of each row
  $total_plata=0;
  while($row = $result->fetch_assoc()) {
    echo '<center>
              <table border="1">
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
                  <td colspan="2">
                    <form method="post">
                      <p align="center">
                        <button type="submit" name="button1" value="'.$row["cod_art"].'"> Elimina din favorite</button>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" name="button2" value="'.$row["cod_art"].'"> Adauga la Comanda</button>
                      </p>
                    </form>
                  </td>
               </table>
               </center><br>';
  }//while
} else {
  echo "0 results";
}
$conn->close();
?>
