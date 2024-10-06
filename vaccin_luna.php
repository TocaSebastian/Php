<?php
include 'admin_meniu_s.php';
include 'connect.php';
session_start();
$user=$_SESSION["user_id"];
echo "<br><H2><center> Afisare planificare vaccinari pana la finalul lunii ".date("M")." </center></h2>";
$luna = date("m");
$anul = date("Y");
$data1 = "$anul-$luna-".date("d");
$data2 = "$anul-$luna-".date("t");
echo "<h2><center>[".$data1."] - [".$data2."]</center></h2>";
$sql = "SELECT * FROM articol, vaccinare  WHERE articol.cod_art = vaccinare.cod_art_vaccin AND este_programat=1 AND data_vaccinare>='$data1' AND data_vaccinare<='$data2'";
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
                <td>Data</td>
                <td>Obs</td>
            </tr>';

    while($row = $result->fetch_assoc())
    {
        echo "<tr>";
        echo "<td><center>".$nr."</center></td>";
        echo "<td> <font color='red'>".$row["user_name"]."</font> </td>";
        echo "<td> <font color='blue'>".$row["denumire_articol"]."</font></td>";
        echo "<td>".$row["tip_animal"]."</td>";
        echo "<td>".$row["data_vaccinare"]."</td>";
        echo "<td> </td>";
        echo "</tr>";
        $nr+=1;
    }//while
    echo "<table></center>";
}//if
$conn->close();
?>
