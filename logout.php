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
   include "index.php";
?>
