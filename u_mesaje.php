<?php
include 'connect.php';
include "user_meniu.php";
session_start();
$user_name=$_SESSION["user_id"];
if ($_SESSION["este_logat"]==1)
{
    $sql = "SELECT * FROM mesaje WHERE citit = 0 AND catre='$user_name' ORDER BY data DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
       echo "<br><br>";
       echo '<table border="1" width="800">';
       echo '<tr>
                <td height="25" width="95" align="center">Data</td>
                <td height="25" width="265" align="center">
                    <p align="left">de_la
                </td>
                <td height="25" width="429" align="center">
                    <p align="left">subiect
                </td>
            </tr>';
        while($row = $result->fetch_assoc())
        {
            echo '<tr>';
            echo '<a href="afisare_mesaj.php?mesaj='.$row["text"].'">';
            echo '<td height="27" width="95">&nbsp;'.$row["data"].'</td>';
            echo '<td height="27" width="265">&nbsp;'.$row["de_la"].'</td>';
            echo '<td height="27" width="429">&nbsp;'.$row["subiect"].'</td>';
            echo '</a>';
            echo '</tr>';
        }//while

        echo "</table>";
    }//if
    $conn->close();
}//if

?>
