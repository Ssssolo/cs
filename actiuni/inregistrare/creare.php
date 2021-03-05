<?php
if(!isset($_SESSION)) 
	session_start();

date_default_timezone_set('Europe/Bucharest');

if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] == $_POST['token'] && $_SESSION['token']>=(time()-600)){
	include('../../core/database/connect.php');
	define('PERMIS', TRUE);
	include('../../core/functions/general.php');
	$username = htmlentities(strip_tags(mysqli_real_escape_string($con, $_POST['username'])));
	$email    = htmlentities(strip_tags(mysqli_real_escape_string($con, $_POST['email'])));
	$parola   = htmlentities(strip_tags(mysqli_real_escape_string($con, $_POST['parola'])));
	$cod      = chr(rand(65,90)) . chr(rand(65,90)) . rand(1,974) . chr(rand(65,90)) . rand(22,51);
	mysqli_query($con, "INSERT INTO `utilizatori` (`username`, `parola`, `email`, `regIP`, `logIP`, `cod_activare`, `data_inregistrare`) VALUES ('". $username ."', '". $parola ."', '". $email ."', '". $_SERVER['REMOTE_ADDR'] ."', '[]', '". $cod ."', '". date('Y-m-d H:i:s') ."')");
	$headers  = "From: Sender Name <u373193710@srv35.main-hosting.eu>" . "\r\n";
	
	// mail($_POST['email'], 'Activare cont', "Salut ". $username ." \n Accesează linuk-ul următor pentru activarea contului: http://www.". $_SERVER['HTTP_HOST']  . "/index?x1=". e_d('encrype', $username) ."&x2=". $cod ." \n\n - NUME", $headers);
	
	mysqli_query($con, "INSERT INTO `admins` (`auth`, `password`, `access`, `flags`) VALUES ('". $username ."', '". $parola ."', 'b', 'a')");
	mysqli_query($con, "INSERT INTO `notificari` (`imagine`, `culoare`, `titlu`, `text`, `data`) VALUES ('fa fa-users', 'info' ,'Utilizator nou!', '<i>$username</i> tocmai s-a înregistrat!', '". date('Y-m-d H:i:s') ."')");
} else 
	echo 'Accesul direct interzis!';
?>