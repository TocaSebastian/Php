<DOCTYPE HTML>
<html>
<head></head>
<body>
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
}
else { include "user_meniu.php";}
$trimit_date='data='.$_GET["data"].'&de_la='.$_GET["de_la"].'&subiect='.$_GET["subiect"].'&mesaj='.$_GET["mesaj"];
///////////////////////////////////////////////////////////////////////////////////
if(array_key_exists('button_replay', $_POST))// Raspunde la mesaj
{
	$to=$_GET["de_la"];
	$from=$_GET["catre"];
	$email = "admin@gmail";
	$subiect = 'Re:'.$_GET["subiect"];
	$mesaj = $_POST["rmesaj"];
	$nume = $_POST["nume"];
	include 'connect.php';
	$sql = "INSERT INTO mesaje ( catre, de_la, subiect, nume, email, text, citit) VALUES ('".$to."', '".
    $from."' , '".$subiect."' , '".$nume."' , '".$email."' , '".$mesaj."' , 0)";
echo "<br><br>".$sql;
	if ($conn->query($sql) === TRUE) {
      echo '<script>alert("Mesaj trimis.");</script>';
    } else { echo "<br>Error INSERT: " . $conn->error;  }
	$conn->close();
	echo '<script type="text/javascript"> window.history.go(-2); </script>';
}//Raspunde la mesaj

///////////////////////////////////////////////////////////////////////////////////
if(array_key_exists('button_delete', $_POST))// Delete mesaj
{
	include 'connect.php';
	$sql = "DELETE FROM mesaje WHERE nr_crt=".$_GET["nr_crt"];
	$result = $conn->query($sql);
	$conn->close();
	//echo '<script type="text/javascript"> window.history.go(-2); </script>';
	echo '<script type="text/javascript">window.location.href = "mesaje_necitite.php?catre='.$_GET["catre"].'"</script>';
}//Delete mesaj
////////////////////////////////////////////////////////////////////////////////////
include 'connect.php';
$sql = "UPDATE mesaje SET citit=1 WHERE nr_crt=".$_GET["nr_crt"];
$result = $conn->query($sql);
$conn->close();
?>
<br>
<form method="post">
<table border="1" width="800" height="480">
	<tr>
		<td height="27" width="94" align="center">Data</td>
		<td colspan="2" align="center"><font color="blue"><?php echo $_GET["data"];?></font></td>

	</tr>
	<tr>
		<td height="27" width="94" align="center">Catre</td>
		<td height="27" width="640">&nbsp;<?php echo $_GET["catre"];?></td>
		<td height="27" width="97" align="center">
			<button type="submit" name="button_replay" value="<?php echo $trimit_date;?>"> Replay </button>
		</td>
	</tr>
	<tr>
		<td height="27" width="94" align="center">From</td>
		<td height="27" width="640">&nbsp;<?php echo $_GET["de_la"];?></td>
		<td height="27" width="97" align="center">
			<button type="submit" name="button_delete" value="<?php echo $trimit_date;?>"> Delete </button>
		</td>
	</tr>
	<tr>
		<td height="35" width="94" align="center">subiect</td>
		<td height="35" width="640">&nbsp;<?php echo $_GET["subiect"];?></td>
		<td height="35" width="97" align="center">
		<button onclick="history.go(-1)">Back</button>
		</td>
	</tr>
	<tr>
		<td height="371" width="853" colspan="3">
			<textarea cols="108" rows="22" name="rmesaj" ><?php	echo "mesaj=".$_GET["mesaj"];?>
---------------------------------------------------------------------
Re:
			</textarea>
		</td>
	</tr>
</table>
 </form>
</body>
