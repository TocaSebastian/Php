<?php
session_start();
$id_sesiune=session_id();
include 'user_meniu.php';
include 'connect.php';

echo "<br><p> <center><h2>Hrana uscata pentru caini.</h2></center>";

$sql = "SELECT * FROM articol, images WHERE utilitate='uscata' AND tip_animal='caine' AND articol.cod_art = images.cod_art";
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

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '<br><p align="center">
            <table border="1">
                  <tr>
                    <td colspan="3">Denumire articol:  <font color="blue">' . $row["denumire_articol"]. '</font></td>
                  </tr>
                  <tr>
                    <td rowspan="7"><center><img src="data:image/jpeg;base64,'.base64_encode($row['image_data']).'"width="200" height="200" ></center></td>
                    <td colspan="2">cod produs:' . $row["cod_art"]. '</td>
                  </tr>

                  <tr><td colspan="2">Animalut: ' . $row["tip_animal"].  ' </td></tr>
                  <tr><td colspan="2">Utilitate: ' . $row["utilitate"]. ' </td></tr>
                  <tr><td colspan="2">Producator: ' . $row["brand"]. ' </td></tr>
                  <tr><td colspan="2">Cantitate: ' . $row["cantitate"]. ' </td></tr>
                  <tr><td colspan="2">Pret: ' . $row["pret"]. ' Lei</td></tr>
                  <tr><td height="100" width="450" colspan="2">'.$row["descriere"].'</td></tr>
                  <td colspan="2">
                    <form method="post">
                      <p align="center">
                        <button type="submit" name="button1" value="'.$row["cod_art"].'"> Adauga la Favorite</button>
                        <button type="submit" name="button2" value="'.$row["cod_art"].'"> Adauga in cos</button>
                      </p>
                    </form>
                  </td>
                  <td width="107">
                      <a class="top" href="#"><img src="top_button.png"></a>
                    </td>
               </table></p>';
  }//while
  //echo '<br><center><a class="top" href="#"><img src="top_button.png"></a></center>';
} else {
  echo "0 results";
}
$conn->close();
?>
