<?php
if(!isset($_SESSION)) 
	session_start();

if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token']==$_POST['token'] && $_SESSION['token']>=(time()-600)){
	include('../../core/database/connect.php');
	$sql = mysqli_query($con, "SELECT `id`,`parola` FROM `utilizatori` WHERE `id` = '". base64_decode($_POST['id']) ."'");
	while($rand = mysqli_fetch_assoc($sql)){
		if($_POST['parola'] == $rand['parola'])
			echo "false";
		else
			echo "true";
	}
} else 
	echo 'Accesul direct interzis!';
?>