<?php
if(!isset($_SESSION)) 
	session_start();

if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] == $_POST['token'] && $_SESSION['token']>=(time()-600)){
	include('../../core/database/connect.php');
	$sql = mysqli_query($con, "SELECT `username` FROM `utilizatori` WHERE `username` = '" . $_POST["username"] . "'");

	$exista = mysqli_num_rows($sql);
	if($exista)
		echo 'false';
	else
		echo 'true';
} else 
	echo 'Accesul direct interzis!';
?>