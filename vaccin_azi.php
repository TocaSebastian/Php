<?php
include 'admin_meniu_s.php';
include 'connect.php';
session_start();
echo "<br><H2><center> Afisare planificare vaccinari pentru azi ".date("d-m-Y")." </center></h2>";
$data = date("Y-m-d");

if(array_key_exists('realizat', $_POST))//Buton "confirmare data "
{
      if ($_SESSION["este_logat"]==1)
      {
        include 'connect.php';
        $nr_crt=$_POST['realizat'];
        $sql2 = "UPDATE vaccinare SET este_programat=3 WHERE nr_crt_v='$nr_crt' AND data_vaccinare='$data'";
        //echo $sql2;
        if ($conn->query($sql2) === TRUE) {
            //echo "<br>Successfully UPDATE vaccinare";
        }else{ echo "<br>Error UPDATE: " . $conn->error; }
        $conn->close();
      }//else{ echo "Nu sunteti logat!\nNu puteti adauga articole in cos!";}
}//buton Programeaza
////////////////////////////////////////////////////////////////////////////////////////////////////////


$sql = "SELECT * FROM articol, vaccinare  WHERE articol.cod_art = vaccinare.cod_art_vaccin AND este_programat=1 AND data_vaccinare='$data'";
$result = $conn->query($sql);
$nr=1;
if ($result->num_rows > 0)
{
   echo '<center>
            <table border="1">
            <tr>
                <td width="33"><center>Nr crt</center></td>
                <td width="120"><center>Nume utilizator</center></td>
                <td width="230"><center>Denumire vaccin</center></td>
                <td width="150"><center>Animal de vaccinat</center></td>
                <td><center>Obs</center></td>
            </tr>';

    while($row = $result->fetch_assoc())
    {
        echo "<tr>";
        echo "<td><center>".$nr."</center></td>";
        echo "<td> <font color='red'>".$row["user_name"]."</font> </td>";
        echo "<td> <font color='blue'>".$row["denumire_articol"]."</font></td>";
        echo "<td>".$row["tip_animal"]."</td>";
        echo '<td><center>
                <form method="post">
                  <button type="submit" name="realizat" value="'.$row["nr_crt_v"].'"> Realizat</button>
                </form>
              </center> </td>';
        echo "</tr>";
        $nr+=1;
    }//while
    echo "<table></center>";
}//if
$conn->close();
?>
