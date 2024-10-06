<!DOCTYPE HTML>
<html>
<head>
    <title>Farma Vet - Pagina ADMIN</title>
    <link href="farma_vet_meniu_adm.css" rel="stylesheet" type="text/css">
<style>
body {
  background-image: url(sfinxy.jpg);
  height: 400px;
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

    <li><a href="admin_meniu.php">Home</a></li>

    <li><a href="#">Administrare Articole</a>
      <ul>

        <li><a href="insert_articol.html">Introduce Articol</a></li>
      </ul>
    </li>

    <li><a href="#">Alte Activitati</a>
      <ul>
        <li><a href="program_vaccin.php">Vaccinare_confirmari</a></li>
        <li><a href="vaccin_azi.php">Vaccinari Azi</a></li>
        <li><a href="vaccin_luna.php">Vaccinari luna curenta</a></li>
      </ul>
    </li>

    <li><a href="despre.php">DESPRE SITE</a></li>

    <li><a href="#"><strong><font color="white">Logout</font></strong></a>
      <ul>
        <li><a href="logout.php">Logout:<font color="yellow"><strong>
          <?php
              session_start();
              echo $_SESSION["user_id"];
          ?></strong></font>
          </a>
        </li>
        <li><a href="admin_inbox.php">Mesaje (Inbox)</a></li>
      </ul>
    </li>

</ul>
<br>

<h1> !!!!!!      ATENTIE !!!            ATENTIE !!!</h1>
<p> <strong>       Pagina ADMINISTRATOR </strong></p>
<p> PHP Conect.</p>



</body>
</html> 
