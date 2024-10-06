<DOCTYPE HTML>
<html>
<head>
<title>Trimitere e-mail catre Adminstrator</title>
</head>
<body>
<?php
session_start();
$user_name=$_SESSION["user_id"];
$email="$user_name@magazin_virtual";
if ($_SESSION["admin"] == 1)
{
    //include 'admin_produs.php';
    echo" <style>
        body {
            background-image: url();
            height: 400px;
            background-position: center;
            background-repeat: no-repeat, repeat;
            background-size: auto;
            position: relative;
        }</style>";
	$email="admin@magazin_virtual";
    //echo '"<form action="admin.php" method="post">';
}else{ include "user_meniu.php";}

$trimit_date='data='.date("Y-m-d").'&de_la='.$_GET["de_la"].'&subiect='.$_GET["subiect"];
/////////////////////////////////////////////////////////////////////////////////////////////////
if(array_key_exists('button_send', $_POST))// Send mesaj
{
	ob_start();
	//echo $_POST['button_replay'];
	//echo $_POST['button_replay'];
	//echo "<br>";
	//echo $_POST["rmesaj"];
	$to=$_POST["catre"];
	$from=$_GET["de_la"];
	$subiect = $_POST["subiect"];
	$mesaj = $_POST["mesaj"];
	$nume = $_POST["nume"];
	include 'connect.php';
	$sql = "INSERT INTO mesaje ( catre, de_la, subiect, nume, email, text, citit) VALUES ('".$to."', '".
    $from."' , '".$subiect."' , '".$nume."' , '".$email."' , '".$mesaj."' , 0)";
   // echo "<br><br>".$sql;
	if ($conn->query($sql) === TRUE) {
      echo '<script type="text/javascript">alert("Mesaj trimis.");</script>';
    } else { echo "<br>Error INSERT: " . $conn->error;  }
	$conn->close();
	//echo '<script type="text/javascript"> window.history.go(-2); </script>';
	echo '<script type="text/javascript">window.location.href = "user_meniu.php"</script>';
}//Raspunde la mesaj
?>
<form method="post">
<br><br>
<table border="1" width="600" height="380">
	<tr>
		<td colspan="3" align="center"><h2>Trimitere e-mail</h2></td>
	</tr>
	<tr>
		<td height="27" width="94" align="center">Data</td>
		<td height="27" width="540">&nbsp;<?php echo date("Y-m-d");?></td>
		<td height="27" width="97" align="center">
            <button type="submit" name="button_send" value="<?php echo $trimit_date;?>"> Send </button>
		</td>
	</tr>
	<tr>
		<td height="27" width="94" align="center">Numele</td>
		<td height="27" width="540">&nbsp;<input type="text" name="nume"> (Optional)</td>
		<td height="27" width="97" align="center" rowspan="3">
			<img src="/gif/plic.jpg" height="60" width="80">
		</td>
	<tr>
		<td height="27" width="94" align="center">De la</td>
		<td height="27" width="540">&nbsp;<?php echo $_GET["de_la"];?></td>
		<!--td height="27" width="97" align="center" rowspan="2"-->
		</td>
	</tr>
	<tr>
		<td height="27" width="94" align="center">Catre</td>
		<td height="27" width="540">&nbsp;<input type="text" name="catre"> (user)</td>
		<!--td height="27" width="97" align="center"-->
		</td>
	</tr>
	<tr>
		<td height="35" width="94" align="center">subiect</td>
		<td height="35" width="540">&nbsp;<input type="text" name="subiect"></td>
		<td height="35" width="97" align="center">
			<button onclick="history.back()">Back</button>
		</td>
	</tr>
	<tr>
		<td height="270" width="653" colspan="3">
            <textarea cols="90" rows="15" name="mesaj" cols="30"></textarea>
		</td>
	</tr>
</table>
</form>

</body>
</html>
