<?php
require_once("../../../core/database/connect.php");

$sql = mysqli_query($con, "SELECT `credit` FROM `utilizatori` WHERE `username` = '" . $_GET["username"] . "'");
$rand = mysqli_fetch_assoc($sql);

$credit =  $rand['credit'] - 1;
if($credit >= 0){
	mysqli_query($con, "UPDATE `utilizatori` SET `credit` = `credit` - 1 WHERE `username` = '" . $_GET["username"] . "'");
	
	if(!$credit)
		echo '0';
	else
		echo $credit;
} else
	echo 'EROARE';
	


?>