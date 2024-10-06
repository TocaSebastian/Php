<!DOCTYPE HTML>
<html>
<head>
<title>FarmaVet</title>
<link href="farma_vet_meniu.css" rel="stylesheet" type="text/css">
<style>
body {
  background-image: url(fundal2.jpg);
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
<?php
   session_start();
   $_SESSION['user_id']="";
   $_SESSION['este_logat']=0;
   $_SESSION["admin"]=0;
   unset($_SESSION['user_id']);
   unset($_SESSION['este_logat']);
   unset($_SESSION['admin']);
   $_SESSION['user_id']=null;
   $_SESSION['este_logat']=null;
   $_SESSION["admin"]=null;
   session_destroy();
   session_commit();
?>

<ul id="menu">
   <li><a href="index.php">Acasa</a></li>
   <li><a href="#"> Caini</a>
   <ul>
      <li><a href="c_hrana_umeda.php">Hrana umeda</a></li>
      <li><a href="c_hrana_uscata.php">Hrana uscata</a></li>
      <li><a href="c_recompense.php">Recompense</a></li>
      <li><a href="c_jucarii.php">Jucarii pentru caini</a></li>
   </ul>
   </li>
   <li><a href="#"> Pisici</a>
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
      <li><a href="c_vaccinuri.php">Vaccinuri pentru caini</a></li>
      <li><a href="p_vaccinuri.php">Vaccinuri pentru pisici</a></li>
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
        echo '<li><a href="logout.php">Logout: '.$_SESSION["user_id"].'</a></li>';
        echo '<li><a href="#">Cos_Favorite</a>
        <ul>
          <li><a href="cos.php">Cosul meu</a></li>
          <li><a href="achizitionate.php">Achizitionate</a></li>
          <li><a href="favorite.php">Favorite</a></li>
          <li><a href="vaccinare.php">Vaccinuri</a></li>
          <li><a href="email.html">Scrie e-mail</a></li>
        </ul>
        </li>';
      }
      else
      {
        echo '<li><a href="login.html">Login</a></li>';
      }
    ?>
   <!--li><a href="https://www.purina.ro"><img src="purina.png" width="81" height="18" ></a></li-->
</ul>

</body>
</html>
