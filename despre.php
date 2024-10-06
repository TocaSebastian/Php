<?php
session_start();
if ($_SESSION["admin"] == 1)
{
    include 'admin_produs.php';
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
<center><h1><i>MAGAZIN SPORTIV</i></h1></center>

<h3>Ne gasiti in municipiul Craiova, strada Unirii, bloc 46, judetul Dolj</h3>
<center><img src="gif/harta.png" width=600 heght=500></center>
