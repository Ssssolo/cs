<?php
if(!isset($_SESSION)) 
	session_start();

date_default_timezone_set('Europe/Bucharest');

if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] == $_POST['token'] && $_SESSION['token']>=(time()-600)){
	include('../../core/database/connect.php');
	define('PERMIS', TRUE);
	include('../../core/functions/general.php');
	
	//Preluam username-ul
	$username = htmlentities(strip_tags(mysqli_real_escape_string($con, e_d('decrypt',$_GET['x7']))));
	
	//Preluam id-ul tichetului
	$id_tichet = e_d('decrypt',$_GET['x5']);
	
	//Preluam acces-ul utilizatorului
	$sql = mysqli_query($con, "SELECT `acces` FROM `utilizatori` WHERE `username` = '$username'");
	$rand = mysqli_fetch_assoc($sql);
	
	//Daca este administrator permitem tagurile
	if($rand['acces'] == 1)
		$text = ucfirst(strtolower($_POST['raspuns']));
	else
		$text = htmlentities(strip_tags(mysqli_real_escape_string($con, ucfirst(strtolower($_POST['raspuns'])))));
	
	//Verificam daca cel care a trimis este administrator
	if($rand['acces'] == 1)
		mysqli_query($con, "INSERT INTO `tichete_raspuns` (`id_tichet`, `text`, `username`, `admin`, `data`) VALUES ('". $id_tichet ."', '". $text ."', '". $username ."', '1', '". date('Y-m-d H:i:s') ."')");
	else
		mysqli_query($con, "INSERT INTO `tichete_raspuns` (`id_tichet`, `text`, `username`, `admin`, `data`) VALUES ('". $id_tichet ."', '". $text ."', '". $username ."', '0', '". date('Y-m-d H:i:s') ."')");
	mysqli_query($con, "UPDATE `tichete` SET `stare` = 1 WHERE `id` = '$id_tichet'");
	mysqli_query($con, "INSERT INTO `notificari` (`imagine`, `culoare`, `titlu`, `text`, `data`) VALUES ('fa fa-gear', 'info' ,'Răspuns nou!', '<i>$username</i> tocmai a răspund unui tichet de-al său!', '". date('Y-m-d H:i:s') ."')");
} else 
	echo 'Accesul direct interzis!';
?>