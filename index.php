<!DOCTYPE HTML>
<html>
<head>
    <title>Magazin Sportiv</title>
    <link href="meniu.css" rel="stylesheet" type="text/css">
<style>
body {
  background-image: url(gif/minge1.gif);
  height: 500px;
  background-position: center;
  background-repeat: no-repeat, repeat;
  background-size: auto;
  position: relative;
  }
</style>

</head>
<body>
<?php
   session_start();
   $_SESSION['user_id']="";
   $_SESSION['este_logat']=null;
   $_SESSION["admin"]=null;
   unset($_SESSION['user_id']);
   unset($_SESSION['este_logat']);
   unset($_SESSION['admin']);
   $_SESSION['user_id']=null;
   $_SESSION['este_logat']=null;
   $_SESSION["admin"]=null;
   session_destroy();
   session_commit();
?>
<center>
<ul id="menu">

    <li><a href="index.php">Home</a></li>


    <li><a href="#">Recomandari de Sezon</a>
      <ul>
        <li><a href="sezon_primavara.php"> Sezon primavara </a></li>
        <li><a href="sezon_vara.php"> Sezon vara </a></li>
        <li><a href="sezon_toamna.php"> Sezon toamna </a></li>
        <li><a href="sezon_iarna.php"> Sezon iarnara </a></li>
        <li><a href="sezon_sala.php"> In sala </a></li>
      </ul>
    </li>

    <li><a href="#">Tipuri de Activitati</a>
      <ul>
        <li><a href="drumetie.php">Drumetie</a></li>
        <li><a href="tenis_camp.php">Tenis de Camp</a></li>
        <li><a href="tenis_masa.php">Tenis de Masa</a></li>
        <li><a href="fotbal.php">Fotbal</a></li>
        <li><a href="baschet.php">Baschet</a></li>
        <li><a href="handbal.php">Handbal</a></li>
        <li><a href="contact.php">Sporturi de contact</a></li>
        <li><a href="fitness.php">Fitness</a></li>
        <li><a href="echipa.php">Sporturi de echipa</a></li>
        <li><a href="individual.php">Individuale</a></li>
      </ul>
    </li>

    <li><a href="despre.php">DESPRE NOI</a></li>

    <li><a href="login.html">Login</a></li>

</ul>
</center>
</body>
</html>
