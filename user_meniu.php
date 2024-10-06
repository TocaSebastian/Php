<html>
<head>
<title>FarmaVet</title>
<link href="farma_vet_meniu.css" rel="stylesheet" type="text/css">
<style>
body {
  height: 500px;
  background-position: center;
  background-repeat: no-repeat, repeat;
  background-size: auto;
  background-color: white;
  position: relative;
  }
</style>
</head>

<body>

<ul id="menu">
   <li><a href="user_meniu.php">Acasa</a></li>
   <li><a href="#">Caini</a>
   <ul>
      <li><a href="c_hrana_umeda.php">Hrana umeda</a></li>
      <li><a href="c_hrana_uscata.php">Hrana uscata</a></li>
      <li><a href="c_recompense.php">Recompense</a></li>
      <li><a href="c_jucarii.php">Jucarii pentru caini</a></li>
   </ul>
   </li>
   <li><a href="#">Pisici</a>
   <ul>
      <li><a href="p_hrana_umeda.php">Hrana umeda</a></li>
      <li><a href="p_hrana_uscata.php">Hrana uscata</a></li>
      <li><a href="p_recompense.php">Recompense</a></li>
      <li><a href="p_jucarii.php">Jucarii pentru pisici</a></li>
   </ul>
   </li>

   <li><a href="#">Brand-uri</a>
   <ul>
      <li><a href="pt_caini.php">Pentru Caini</a></li>
      <li><a href="pt_pisici.php">Pentru Pisici</a></li>
   </ul>
   </li>

   <li><a href="#">Vaccinuri</a>
   <ul>
      <li><a href="c_vaccinuri.php">Vaccinuri caini</a></li>
      <li><a href="p_vaccinuri.php">Vaccinuri pisici</a></li>
      <li><a href="schema_vaccinare.php">Schema Vaccinare</a></li>

   </ul>
   </li>

   <li><a href="#">DESPRE</a>
   <ul>
      <li><a href="despre.php">Despre Site</a></li>
      <li><a href="rase_caini.php">Rase Caini</a></li>
      <li><a href="rase_pisici.php">Rase Pisici</a></li>
   </ul>
   </li>
   <?php
      session_start();
      if (strcmp($_SESSION["user_id"],"")!=0)
      {
        echo '<li><a href="#">Logout: <strong><font color="white">'.$_SESSION["user_id"].'</font></strong></a>
                <ul>
                  <li><a href="logout.php"><b><font color="white">Logout</font></b></a></li>

                  <li><a href="mesaje_inbox.php?catre='.$_SESSION["user_id"].'">Mesaje (Inbox)</a></li>
                  <li><a href="mesaj_to_admin.php?de_la='.$_SESSION["user_id"].'">Send to Admin</a></li>
                </ul>
              </li>';
        echo '<li><a href="#">Cos_Favorite</a>
        <ul>
          <li><a href="cos.php">Cosul meu</a></li>
          <li><a href="achizitionate.php">Achizitionate</a></li>
          <li><a href="favorite.php">Favorite</a></li>
          <li><a href="vaccinare.php">Programare Vaccin</a></li>
          <li><a href="vaccinuri.php">Vaccinuri efectuate</a></li>

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
