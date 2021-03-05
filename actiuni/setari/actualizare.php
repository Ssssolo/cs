<?php
if(!isset($_SESSION)) 
	session_start();

if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token']==$_POST['token'] && $_SESSION['token']>=(time()-600)){
	include('../../core/database/connect.php');

	$parola = htmlentities(strip_tags(mysqli_real_escape_string($con, $_POST['parola'])));
	$stare  = htmlentities(strip_tags(mysqli_real_escape_string($con, $_POST['stare'])));
	
	if(!empty($parola))
		mysqli_query($con, "UPDATE `utilizatori` SET `parola` = '". $parola ."' WHERE `id` = '". base64_decode($_POST['id']) ."'");
	else
		mysqli_query($con, "UPDATE `utilizatori` SET `stare` = '". $stare ."', `data_actualizare` = '". date('Y-m-d H:i') ."' WHERE `id` = '". base64_decode($_POST['id']) ."'");
} else
	echo 'Accesul direct interzis!';
?>