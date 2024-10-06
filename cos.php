<?php
include 'user_meniu.php';
include 'connect.php';
session_start();

echo "<br><H2><center> Afisare articole din Cos</center></h2>";

$user_name=$_SESSION["user_id"];
$id_sesiune=session_id();


if(array_key_exists('button1', $_POST))// Elimina din Cos
{
      //Elimina din cos
      $user=$_SESSION["user_id"];
      if($_SESSION["este_logat"]==1)
      {

        $cod_art=$_POST['button1'];
        $sql = "DELETE FROM cos WHERE user_name='$user' AND cod_art_cos=$cod_art AND achizitionat=0";
        //echo "<br>".$sql;
        if ($conn->query($sql) === TRUE) {
          //echo "<br>Successfully DELETE cos";
        }
        else{//echo "<br>Error DELETE: " . $conn->error;
            }
        $conn->close();
      }//else{ echo "Nu sunteti logat!\nNu puteti adauga articole in cos!";}
}

if(array_key_exists('button2', $_POST))//Buton Comanda
{
  //echo "<h2>Coamda a fost lansata !<br>Veti primi pe email factura.<br><br>Multumim !</h2>";
  // Schimbarea atributului achizitionat din 0 in 2 (articolul nu se mai afla in cos ci a fost cumparat)
  // urmeaza intocmirea facturii (2 pt facturare, 1 a fost facuturat)
  $sql = "UPDATE cos SET achizitionat=2 WHERE user_name='$user_name' AND achizitionat=0";
  if ($conn->query($sql) === TRUE) {
          //echo "<br>Successfully UPDATE cos";
  }
  else{//echo "<br>Error UPDATE: " . $conn->error;
      }

  $conn->close();
  include 'connect.php';
  ////////////////////////////////////////////////////
  // Scade cantitatea din articolele ce au fost cumparate
  //$sql = "UPDATE articol SET cantitate=cantitate-(SELECT cantitate_cos FROM cos WHERE cos.user_name='$user_name' AND achizitionat=2 AND cod_art=cod_art_cos) ";
  //$sql = "UPDATE articol SET articol.cantitate=articol.cantitate-(SELECT cantitate_cos FROM cos WHERE cos.user_name='$user_name' AND achizitionat=2) WHERE articol.cod_art=(SELECT cod_art_cos FROM cos WHERE cos.user_name='$user_name' AND achizitionat=2)";
  //$sql = "MERGE INTO articol art USING (SELECT * FROM cos WHERE cos.user_name='$user_name' AND achizitionat=2 ) c ON (art.cod_art = c.cod_art_cos) WHEN MATCHED THEN UPDATE SET art.cantitate=art.cantitate-c.cantitate_cos";
  //" WHERE cod_art=ANY(SELECT cod_art_cos,  FROM cos WHERE cos.user_name='$user_name' AND achizitionat=2)";
  //////////////////////////////////////////////////////////
  $sql2 = "SELECT * FROM cos WHERE cos.user_name='$user_name' AND achizitionat=2";
  //echo $sql2;
  $result = $conn->query($sql2);// pentru fiecare articol din cos voi scade cantitatea din stocul de articole
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $sql3 = "UPDATE articol SET cantitate=cantitate-".$row['cantitate_cos']." WHERE cod_art=".$row['cod_art_cos'];
        if ($conn->query($sql3) === TRUE) {
          //echo "<br>Successfully UPDATE ";
        }
        else{
            //echo "<br>Error DELETE: " . $conn->error;
        }
        //echo $sql3;
      }//while
  }//if
  $conn->close();
  include "date_expediere.html";
  // Trimite e-mail.
}

if(array_key_exists('button_plus', $_POST))
{
      //echo "buton+",$_SESSION["user_id"];
      $user=$_SESSION["user_id"];
      if($_SESSION["este_logat"]==1)
      {
        $cod_art=$_POST['button_plus'];
        //echo "Bt +";
        include 'connect.php';
        $sql = "UPDATE cos SET cantitate_cos=cantitate_cos+1 WHERE user_name='$user' AND cod_art_cos=$cod_art";
        //echo "<br>".$sql;
        if ($conn->query($sql) === TRUE) {
          //echo "<br>Successfully DELETE cos";
        }
        else{//echo "<br>Error DELETE: " . $conn->error;
            }
        $conn->close();
      }//else{ echo "Nu sunteti logat!\nNu puteti adauga articole in cos!";}
}

if(array_key_exists('button_minus', $_POST))
{
      //echo "buton-",$_SESSION["user_id"];
      $user=$_SESSION["user_id"];
      if($_SESSION["este_logat"]==1)
      {
        $cod_art=$_POST['button_minus'];
        //echo "Bt +";
        include 'connect.php';
        $sql = "UPDATE cos SET cantitate_cos=ABS(cantitate_cos-1) WHERE user_name='$user' AND cod_art_cos=$cod_art";
        //echo "<br>".$sql;
        if ($conn->query($sql) === TRUE) {
          //echo "<br>Successfully DELETE cos";
        }
        else{//echo "<br>Error DELETE: " . $conn->error;
            }
        $conn->close();
      }//else{ echo "Nu sunteti logat!\nNu puteti adauga articole in cos!";}
}

include 'connect.php';
//Curata cosul de articolele scazute (care au valoarea 0)
$sql = "DELETE FROM cos  WHERE cos.user_name='$user_name' AND cos.achizitionat=0 AND cantitate_cos=0";
$result = $conn->query($sql);

$sql = "SELECT * FROM articol, images, cos  WHERE articol.cod_art = images.cod_art AND articol.cod_art = cos.cod_art_cos AND cos.user_name='$user_name' AND cos.achizitionat=0 AND cantitate_cos>0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $total_plata=0;
  while($row = $result->fetch_assoc()) {
    echo '<br><p align="center">
              <table border="1">
                  <tr><td colspan="3">Denumire articol:' . $row["denumire_articol"]. '</td></tr>
                  <tr>
                    <td rowspan="6"><center><img src="data:image/jpeg;base64,'.base64_encode($row['image_data']).'"width="180" height="180" ></center></td>
                    <td colspan="3">cod produs:' . $row["cod_art"]. '</td>
                  </tr>

                  <tr><td colspan="3">Animalut: ' . $row["tip_animal"].  ' </td></tr>
                  <tr><td colspan="3">Utilitate: ' . $row["utilitate"]. ' </td></tr>
                  <tr><td colspan="3">Producator: ' . $row["brand"]. ' </td></tr>
                  <tr><td colspan="3">Cantitate: ' . $row["cantitate"]. ' </td></tr>
                  <tr><td colspan="3">Pret: ' . $row["pret"]. ' Lei</td></tr>
                  <tr><td height="100" width="450" colspan="3">'.$row["descriere"].'</td></tr>
                  <tr>
                    <td width="274">
                      <form method="post">
                        <p align="center"><button type="submit" name="button1" value="'.$row["cod_art"].'"> Elimina din cos</button></p>
                      </form>
                    </td>
                    <td width="108">Cantitate: '.$row["cantitate_cos"].'</td>
                    <td width="56">
                    <form method="post">
                    <center>
                      <button type="submit" name="button_plus" value="'.$row["cod_art"].'"> + </button>
                      <button type="submit" name="button_minus" value="'.$row["cod_art"].'"> - </button>
                    </center>
                    </form>
                    </td>
                  </tr>
               </table>
               </p>';
    $total_plata+=$row["pret"] * $row["cantitate_cos"];

  }//while
  echo "<center><h1>Total de plata: ", $total_plata, " Lei</h1></center>";
  echo '<form method="post">
          <p align="center">
            <button type="submit" name="button2" value="'.$row["cod_art"].'"> Comanda</button>
          </p>
        </form>';
} else {
  echo "0 results";
}
$conn->close();
/*<td colspan="2"> &nbsp;*/
?>



