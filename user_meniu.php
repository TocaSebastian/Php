<!DOCTYPE HTML>
<html>
<head>
    <title>Magazin Sportiv</title>
    <link href="meniu.css" rel="stylesheet" type="text/css">
</head>
<body>

<ul id="menu">

    <li><a href="user_meniu.php">Home</a></li>


    <li><a href="#">Recomandari de Sezon</a>
      <ul>
        <li><a href="sezon_primavara.php"> Sezon primavara </a></li>
        <li><a href="sezon_vara.php"> Sezon vara </a></li>
        <li><a href="sezon_toamna.php"> Sezon toamna </a></li>
        <li><a href="sezon_iarna.php"> Sezon iarna </a></li>
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
    <?php
      session_start();
      if (strcmp($_SESSION["user_id"],"")!=0)
      {
        echo '<li><a href="#">User: [<strong>'.$_SESSION["user_id"].'</strong>]</a>
                <ul>
                  <li><a href="logout.php"><strong>Logout: '.$_SESSION["user_id"].'</strong></a></li>';
        echo '    <li><a href="w_mesaje.php?de_la='.$_SESSION["user_id"].'">Scrie Mesaj</a></li>
                  <li><a href="mesaje_necitite.php?catre='.$_SESSION["user_id"].'">Mesaje necitite</a></li>
                  <li><a href="mesaje_inbox.php?catre='.$_SESSION["user_id"].'">Mesaje (Inbox)</a></li>
                </ul></li>';
        echo '<li><a href="#">Cos_Favorite</a>
        <ul>
          <li><a href="cos.php">Cosul meu</a></li>
          <li><a href="achizitionate.php">Achizitionate</a></li>
          <li><a href="favorite.php">Favorite</a></li>
        </ul>
        </li>';
      }
      else
      {
        echo '<li><a href="login.html">Login</a></li>';
      }

    ?>
</ul>
</body>
</html>
