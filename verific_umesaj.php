<?php
include 'connect.php';
//session_start();
$user_name=$_SESSION["user_id"];
if ($_SESSION["este_logat"]==1)
{
    $sql = "SELECT * FROM mesaje WHERE citit = 0 AND catre='$user_name'";
    $result = $conn->query($sql);
    $nr_mes=0;
    if ($result->num_rows > 0)
    {
        $nr_mes=0;
        while($row = $result->fetch_assoc())
        {
            $nr_mes+=1;
        }//while
        echo "<br><br>Aveti un numar de $nr_mes mesaje necitite.";
        echo "<br>";
    }//if
    $conn->close();
}//if

?>
