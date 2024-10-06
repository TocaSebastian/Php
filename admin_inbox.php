<DOCTYPE HTML>
<?php
ob_clean();
echo" <style>
        body {
            background-image: url();
            height: 400px;
            background-position: center;
            background-repeat: no-repeat, repeat;
            background-size: auto;
            position: relative;
        }</style>";

session_start();
include 'admin_meniu_s.php';
include 'connect.php';
//echo $catre;
echo "<br><H2><center> Mesaje inbox</center></h2>";
$sql = "SELECT * FROM mesaje WHERE catre='admin' ORDER BY data DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{
    echo '<table border="3" width="800">';
    echo '<tr>
            <td height="25" width="95" align="center">Data</td>
            <td height="25" width="95" align="center">Ora</td>
            <td height="25" width="265" align="center">
                <p align="left">Expeditor
            </td>
            <td height="25" width="429" align="center">
                <p align="left">Subiect
            </td>
        </tr>';
    while($row = $result->fetch_assoc())
    {
        $de_la=$row["de_la"];
        $data=$row["data"];
        $mesaj=$row["text"];


        //echo "mesaj=",$mesaj;
        $subiect=$row["subiect"];
        echo '<tr>';
        //echo '<a href="afisare_mesaj.php?mesaj='.$row["text"].'">';
        echo '<td height="27" width="95">&nbsp;'.$row["data"].'</td>';
        echo '<td height="27" width="95">&nbsp;'.$row["ora"].'</td>';
        echo '<td height="27" width="265">&nbsp;'.$row["de_la"].'</td>';
        echo '<td height="27" width="429">&nbsp;<a href="afisare_mesaj.php?catre=admin';
        echo '&data='.$data;
        echo '&nr_crt='.$row["nr_crt"];
        echo '&de_la='.$de_la;
        echo '&subiect='.$subiect;
        echo '&mesaj='.$mesaj.'">'.$row["subiect"].'</a></td>';
        //echo '</a>';
        echo '</tr>';
    }//while

    echo "</table>";
}//if
else {echo "Nu aveti mesaje.";}

$conn->close();

?>

