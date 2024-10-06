<!DOCTYPE HTML>
<?php
session_start();
ob_clean();
if ($_SESSION["admin"] == 1)
{
    include 'admin_meniu_s.php';
    echo" <style>
        body {
            background-image: url();
            height: 400px;
            background-position: center;
            background-repeat: no-repeat, repeat;
            background-size: auto;
            position: relative;
        }</style>";
}else
{
    include 'user_meniu.php';
}

?>

<br>
    <br><center><strong><h1><i>FARMA VET</h1></i></strong></center>
    <h3>Ne gasiti in Craiova, str. Amaradia, bl. F3, jud. Dolj</h3>
    <center><img src="farmavet_harta.png" width=500></center>

</body>
