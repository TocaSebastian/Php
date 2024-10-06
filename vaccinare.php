<?php
session_start();
$id_sesiune=session_id();
include 'user_meniu.php';
include 'connect.php';

echo "<br><p> <center><h2>Afisare VACCINURI achizitionate si Programari pentru Vaccinare.</h2></center>";

$user_name=$_SESSION["user_id"];
/////////////////////////////////////////////////////////////////////////////////////////////////////
if(array_key_exists('button_programare', $_POST))//Buton "Programeaza"
{
      $user=$_SESSION["user_id"];
      if( ($_SESSION["este_logat"]==1) && (strlen($_POST["an"])>0) && (strlen($_POST["luna"])>0) && (strlen($_POST["zi"])>0))
      {
        include 'connect.php';
        $cod_art=$_POST['button_programare'];
        $data_curenta = date("Y-m-d");
        $data = $_POST["an"]."-".$_POST["luna"]."-".$_POST["zi"];
        if((strcmp($_POST["an"],"")==0)||(strcmp($_POST["luna"],"")==0)||(strcmp($_POST["zi"],"")==0))
        {
          echo "<script>alert('Data incorecta');</script>";
        }elseif(strcmp($data,$data_curenta)>=0)
        {
          $sql2 = "INSERT INTO vaccinare ( user_name , cod_art_vaccin, este_programat, data_vaccinare) VALUES ('$user', $cod_art, 0, '$data')";
          //echo $sql2;
          if ($conn->query($sql2) === TRUE) {
            //echo "<br>Successfully INSERT favorites";
          }else{ echo "<br>Error INSERT: " . $conn->error; }
          $conn->close();
        }else
        {
          echo "<script>alert('Data este veche (trebuie aleasa dupa ziua de".$data_curenta.")');</script>";

        }
      }//else{ echo "Nu sunteti logat!\nNu puteti adauga articole in cos!";}
}//buton Programeaza
////////////////////////////////////////////////////////////////////////////////////////////////////////
if(array_key_exists('button_ok', $_POST))//Buton "confirmare data "
{
      $user=$_SESSION["user_id"];
      if ($_SESSION["este_logat"]==1)
      {
        include 'connect.php';
        $nr_crt=$_POST['button_ok'];
        $data = $_POST["an"]."-".$_POST["luna"]."-".$_POST["zi"];
        //$sql = "SELECT * FROM vaccinare WHERE
        $sql2 = "UPDATE vaccinare SET este_programat=1 , data_vaccinare=data_programare_admin WHERE user_name='$user' AND nr_crt_v=$nr_crt";
        //echo $sql2;
        if ($conn->query($sql2) === TRUE) {
            //echo "<br>Successfully UPDATE ";
        }else{ echo "<br>Error UPDATE: " . $conn->error; }

        $conn->close();
      }//else{ echo "Nu sunteti logat!\nNu puteti adauga articole in cos!";}
}//buton Confirmare Data
////////////////////////////////////////////////////////////////////////////////////////////////////////
if(array_key_exists('button_no', $_POST))//Buton "confirmare data "
{
      $user=$_SESSION["user_id"];
      if ($_SESSION["este_logat"]==1)
      {
        include 'connect.php';
        $nr_crt=$_POST['button_no'];
        $data = $_POST["an"]."-".$_POST["luna"]."-".$_POST["zi"];
        $sql2 = "DELETE FROM vaccinare WHERE user_name='$user' AND nr_crt_v=$nr_crt";
        //echo $sql2;
        if ($conn->query($sql2) === TRUE) {
            //echo "<br>Successfully DELETE ";
        }else{ echo "<br>Error DELETE: " . $conn->error; }
        echo "<script> alert('Va rog sa alegeti alta data pentru vaccin\nVa multumesc!');</script>";
        $conn->close();
      }//else{ echo "Nu sunteti logat!\nNu puteti adauga articole in cos!";}
}//buton Programeaza
////////////////////////////////////////////////////////////////////////////////////////////////////////
include 'connect.php';
//$sql = "SELECT * FROM articol, images, cos, vaccinare  WHERE articol.cod_art = images.cod_art AND articol.cod_art = cos.cod_art_cos AND articol.cod_art = vaccinare.cod_art_vaccin AND cos.user_name='$user_name' AND cos.achizitionat=1 AND  utilitate='vaccin' ORDER BY data";
$user=$_SESSION["user_id"];
$data = date("Y-m-d");
// daca avem data depasita de vaccinare se considera ca neefectuat vaccinul
$sql2 = "UPDATE vaccinare SET este_programat=-1  WHERE user_name='$user' AND data_vaccinare<'$data'";
if ($conn->query($sql2) === TRUE) {
  //echo "<br>Successfully Update ";
}else{ echo "<br>Error Update: " . $conn->error; }

$sql2="SELECT * FROM vaccinare WHERE user_name='$user_name'";

if ($conn->query($sql2) === TRUE){
  $sql = "SELECT * FROM articol, images, cos, vaccinare  WHERE articol.cod_art = images.cod_art AND articol.cod_art = cos.cod_art_cos AND cos.user_name='$user_name' AND cos.achizitionat=1 AND  utilitate='vaccin' AND vaccinare.cod_art_vaccin=cod_art_cos AND este_programat=-1 AND  vaccinare.user_name='$user_name' AND cos.data<=vaccinare.data_vaccinare ORDER BY data";
}else {
  $sql="SELECT * FROM articol, images, cos WHERE articol.cod_art = images.cod_art AND articol.cod_art = cos.cod_art_cos AND cos.user_name='$user_name' AND cos.achizitionat=1 AND  utilitate='vaccin' ORDER BY data";
}//if
//echo $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '<br><p align="center">
            <table border="1">
                  <tr>
                    <td colspan="2">Denumire articol: <font color="blue">' . $row["denumire_articol"]. '   </font><font color="green">[Achizitionat: '.$row["data"].']</font></td>
                    <td width="199" rowspan="4">';
                      $sql2 = "SELECT * FROM vaccinare WHERE cod_art_vaccin =".$row["cod_art"]." AND user_name='$user_name' AND este_programat>=0 AND este_programat<3";
                       // echo $sql2;
                      $result2 = $conn->query($sql2);
                      if ($result2->num_rows > 0) {
                        while($row2 = $result2->fetch_assoc())
                        {
                          if ($row2["este_programat"]==0)
                          {
                            // User asteapta confirmarea din partea Administratorului
                            echo "Data posibila: ".$row2["data_vaccinare"];
                            echo "<br>";
                            echo "<center>Se asteapta confirmarea Adminstratorului.</center>";
                          }elseif ($row2["este_programat"]==1)
                          {
                            echo '<center><strong>Data programare:</strong> <font color="red">';
                            echo $row2["data_vaccinare"];
                            echo "</font></center>";
                          }elseif ($row2["este_programat"]==2)
                          {
                            echo '<center><strong>Va pot programa la data </strong> <font color="red">';
                            echo $row2["data_programare_admin"];
                            echo "</font></center>";
                            echo "<br>".$row2["mesaj_admin"];
                            echo "Rog comfirmati.";
                            echo '<form method="post"><center>';
                            echo '<button type="submit" name="button_ok" value="'.$row2["nr_crt_v"].'"> Da</button>';
                            echo '<button type="submit" name="button_no" value="'.$row2["nr_crt_v"].'"> Nu</button>';
                            echo "</center></form>";
                          }

                        }//while
                      }
                      else{  echo "<center>Nu exista programare.</center>"; }//if
                  echo '  </td>
                  </tr>
                  <tr>
                    <td rowspan="7"><center><img src="data:image/jpeg;base64,'.base64_encode($row['image_data']).'"width="180" height="180" ></center></td>
                    <td>cod produs:' . $row["cod_art"]. '</td>
                  </tr>

                  <tr><td>Animalut: ' . $row["tip_animal"].  ' </td></tr>
                  <tr><td>Utilitate: ' . $row["utilitate"]. ' </td></tr>
                  <tr></tr>
                  <tr>
                    <td>Cantitate: ' . $row["cantitate_cos"]. ' </td>
                    <td rowspan="2"><p align="center">
                      <a class="top" href="#"><img src="top_button.png"></a></p>
                    </td>
                  </tr>
                  <tr>
                    <td>Producator: ' . $row["brand"]. ' </td>

                  </tr>
                  <tr>
                    <td>Pret: ' . $row["pret"]. ' </td>
                    <td rowspan="3">
                      <center><strong>Programare Vaccin</strong><br>
                      Zi   /   Luna / An<br>
                      <form method="post">
                        <input type="text" name="zi" size="2">/
                        <input type="text" name="luna" size="2">/
                        <input type="text" name="an" size="4">
                        <p align="center">
                          <button type="submit" name="button_programare" value="'.$row["cod_art"].'"> Programeaza</button></p>
                      </form>
                      </center>
                    </td>
                  </tr>
                  <tr><td height="100" width="450" colspan="2">'.$row["descriere"].'</td></tr>
               </table>
               </p>';
  }//while
  //echo '<br><center><a class="top" href="#"><img src="top_button.png"></a></center>';
} else {
  echo "0 results";
}
$conn->close();
?>
