<?php
$nume = $_POST['nume'];
$pass = MD5($_POST['parola']);
$buton1 = $_POST['Trimite'];
$buton2 = $_POST['Inregistrare'];
$buton_back = $_POST['Back'];

$admin=-1; // -1 daca nu este logat ca user
           // 0 daca este utilizator
           // 1 daca este administrator

//echo "<br>Trimite=$buton1<br>Inregistrare=$buton2<br>";

if (!strcmp($buton_back,'Back')){
    //session_start('back');
}

if (!strcmp($buton2,'Inregistrare')){
  //ob_clean();
//  echo "inregistrare";
  include 'inregistrare.html';
}


if (!strcmp($buton1,'Trimite')){
  include 'connect.php';
  // verific daca este user in baza si ce drepturi are (Admin sau User)
  $sql = "SELECT * FROM users WHERE user_name='$nume' AND passwd = '$pass'";
 // echo $sql;
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // daca am gasit utilizator
    // echo "<br>[Pas 1]";
    $row = $result->fetch_assoc();
    // echo "<br>admin=".$row['admin'];
    if ($row["admin"]==1){
      // daca este administrator in baza
      $admin=1;
      $newid = session_create_id($nume);
      session_id($newid);
      session_start();
      $_SESSION["user_id"] = $nume;
      $_SESSION["este_logat"] = 1;
      $_SESSION["admin"] = 1;
      include 'admin_meniu.php';
    }
    else{
      // daca este user in baza
      $admin=0;
      // Set session variables
      //echo "Login:",$nume;
      $newid = session_create_id($nume);
      session_id($newid);
      session_start();
      $_SESSION["user_id"] = $nume;
      $_SESSION["admin"] = 0;
      //echo $_SESSION["user_id"];
      $_SESSION["este_logat"] = 1;

      include 'user_meniu.php';
      // Dupa autentificare se verifica daca avem programat vreun vaccin
      include "verifica_programare.php";
      echo '<style>
            body {
                background-image: url(lacat_deschis.jpg);
                height: 400px;
                background-position: center;
                background-repeat: no-repeat, repeat;
                background-size: auto;
                background-color: white;
                position: relative;
            }
            </style>';
    }//if_3
  }//if_2
  else{
    session_start();
    $_SESSION["user_id"] = "";
    $_SESSION["este_logat"] = 0;
    include 'index.php';
    echo "<br><center><h1>Nu sunteti inregistrat!</h1></center>";
    echo "<center><h1>Pentru inregistrare alegeti pagina Login -> Inregistrare</h1></center>";
  }//if_1
}//if buton1

?>
