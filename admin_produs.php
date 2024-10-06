 <html>
<head>
    <title>Magazin Sportiv - Pagina ADMIN</title>
    <link href="meniu.css" rel="stylesheet" type="text/css">
    <style>
      body {
        background-image: url(gif/pag_admin.png);
        height: 400px;
        background-position: center;
        background-repeat: no-repeat, repeat;
        background-size: auto;
        position: relative;
    }
</style>
</head>
<body>
<ul id="menu">

    <li><a href="admin_produs.php">Home</a></li>

    <li><a href="#">Administrare Articole</a>
      <ul>

        <li><a href="insert_articol.html">Insert Articol</a></li>
        <li><a href="actualizare.html">Actualizare stocuri articol</a></li>
        <li><a href="select.php">Afisare Articol</a></li>

      </ul>
    </li>

    <li><a href="#">Corespondenta</a>
      <ul>
        <li><a href="mesaje_necitite.php?catre=<?php session_start();echo $_SESSION["user_id"];?>">Mesaje Necitite</a></li>
        <li><a href="mesaje_inbox.php?catre=<?php session_start();echo $_SESSION["user_id"];?>">Mesaje inbox</a></li>

      </ul>
    </li>

    <li><a href="despre.php">DESPRE NOI</a></li>
    <?php
      session_start();
      if (strcmp($_SESSION["user_id"],"")!=0)
      {
        echo '<li><a href="logout.php"><strong>Logout: '.$_SESSION["user_id"].'</strong></a></li>';

      }else {echo '<li><a href="login.html">Login</a></li>';}
    ?>
</ul>
<br>

<center>
<!--h1>ATENTIE !!!</h1>
<h2>Pagina ADMINISTRATOR</h2-->

</center>


</body>
</html> 
