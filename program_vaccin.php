<?php
session_start();
include "admin_meniu_s.php";
$user_name=$_SESSION["user_id"];
include 'connect.php';
echo "<br><p> <center><h2>ADMIN: Confirmari/Programari vaccinare.</h2></center>";
/////////////////////////////////////////////////////////////////////////////////////////////
if(array_key_exists('de_acord', $_POST))//Buton "De acord"
{

      if($_SESSION["este_logat"]==1)
      {
        include 'connect.php';
        $returnare=$_POST['de_acord'];
        $dim_sir = strlen($returnare);
        $poz_separator = strpos($returnare,"&");
        $cod_art = substr($returnare,0,$poz_separator);
        $user=substr($returnare,$poz_separator+1);
        $sql2 = "UPDATE vaccinare SET este_programat=1 WHERE user_name='$user' AND cod_art_vaccin=$cod_art";
        //echo $sql2;
        if ($conn->query($sql2) === TRUE) {
            //echo "<br>Successfully INSERT favorites";
          }else{ echo "<br>Error INSERT: " . $conn->error; }
        $conn->close();
      }//else{ echo "Nu sunteti logat!\nNu puteti adauga articole in cos!";}
}//buton De_acord
/////////////////////////////////////////////////////////////////////////////////////////////////////

if(array_key_exists('button_reprogramare', $_POST))//Buton "button_Reprogramare"
{
      if( ($_SESSION["este_logat"]===1) && (strlen($_POST["an"])>0) && (strlen($_POST["luna"])>0) && (strlen($_POST["zi"])>0))
      {
        include 'connect.php';
        $returnare=$_POST['button_reprogramare'];
        $dim_sir = strlen($returnare);
        $poz_separator = strpos($returnare,"&");
        $cod_art = substr($returnare,0,$poz_separator);
        $user=substr($returnare,$poz_separator+1);
        $data = $_POST["an"]."-".$_POST["luna"]."-".$_POST["zi"];
        $sql2 = "UPDATE vaccinare SET este_programat=2, data_programare_admin='$data', mesaj_admin='".$_POST["mesaj_admin"]."' WHERE user_name='$user' AND cod_art_vaccin=$cod_art";
        if ($conn->query($sql2) === TRUE) {
            //echo "<br>Successfully INSERT favorites";
          }else{ echo "<br>Error INSERT: " . $conn->error; }
        $conn->close();
      }//else{ echo "Nu sunteti logat!\nNu puteti adauga articole in cos!";}
}//buton De_acord
/////////////////////////////////////////////////////////////////////////////////////////////////////


// Afisare programarile care asteapta confirmarea din partea Administratorului
$sql = "SELECT * FROM vaccinare, articol WHERE este_programat=0 AND cod_art=cod_art_vaccin";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo '<center>
          <table border="1">
            <tr>
                <td>User: <font color="blue">'.$row["user_name"].'</font></td>
                <td>Data aleasa:<font color="red">'.$row["data_vaccinare"].'</font></td>
                <td height="31" width="72">
                    <form method="post">
                      <p align="center">
                        <button type="submit" name="de_acord" value='.$row["cod_art"].'&'.$row["user_name"].'> De acord</button>
                      </p>
                    </form>
                </td>
            </tr>
            <tr>
                <td>Animal: '.$row["tip_animal"].'</td>
                <td colspan="2">Vaccin: '.$row["denumire_articol"].'</td>
            </tr>
            <tr>
                <td colspan="3"><br>
                    <center>In caz de reprogramare si modificare data vaccinare.</center>
                    Lasati un mesaj utilizatorului.
                </td>
            </tr>
            <tr>
                <form method="post">
                    <td height="136" width="323" colspan="2">
                       <textarea rows="10" cols="50" name="mesaj_admin" maxlength="50">  Din motive ce nu tin de noi, va propunem o alta data pentru vaccinarea animalutuli dvs.
                        Va multumesc.
                       </textarea>
                    </td>
                    <td width="160">
                        <center><strong>Reprogramare Vaccin</strong><br>
                        Zi   /   Luna / An<br>

                        <input type="text" name="zi" size="2">/
                        <input type="text" name="luna" size="2">/
                        <input type="text" name="an" size="4">
                        <p align="center">
                          <button type="submit" name="button_reprogramare" value='.$row["cod_art"].'&'.$row["user_name"].'> REprogrameaza</button></p>
                    </td>
                </form>
            </tr>
        </table>
        </cneter><br>';
  }//while
}//if
$conn->close();
?>
