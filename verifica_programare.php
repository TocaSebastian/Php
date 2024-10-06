<?php
include 'connect.php';
session_start();
$user_name=$_SESSION["user_id"];
if ($_SESSION["este_logat"]==1)
{
    $data = date("Y-m-d");
    $luna = date("m");
    $anul = date("Y");
    $data1 = "$anul-$luna-".date("d");
    $data2 = "$anul-$luna-".date("t");
    $sql = "SELECT * FROM articol, vaccinare  WHERE articol.cod_art = vaccinare.cod_art_vaccin AND este_programat=1 AND vaccinare.user_name='$user_name' AND data_vaccinare>='$data1' AND data_vaccinare<='$data2' AND data_vaccinare<>'$data'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        echo "<br><br>Luna aceasta aveti urmatoarele programari:";
        echo "<br>";
        while($row = $result->fetch_assoc())
        {
            echo "<br>";
            echo "In data de ".$row["data_vaccinare"]." aveti programare la vaccin cu <font color='magenta'>".$row["tip_animal"];
            echo " </font>!";
        }//while
    }//if
    $sql = "SELECT * FROM articol, vaccinare  WHERE articol.cod_art = vaccinare.cod_art_vaccin AND vaccinare.user_name='$user_name' AND este_programat=1 AND data_vaccinare='$data'";
    //echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            echo "<br><h2>";
            echo "Azi aveti programare la vaccin !";
            echo " </font>!</h2>";
        }//while
    }//if
    $conn->close();
}//if

?>
