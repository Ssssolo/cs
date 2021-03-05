<?php
if(!isset($_SESSION)) 
	session_start();

date_default_timezone_set('Europe/Bucharest');

if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] == $_POST['token'] && $_SESSION['token']>=(time()-600)){
	include('../../core/database/connect.php');
	define('PERMIS', TRUE);
	include('../../core/functions/general.php');

	$username   = htmlentities(strip_tags(mysqli_real_escape_string($con, e_d('decrypt',$_GET['x5']))));
	$subiect    = htmlentities(strip_tags(mysqli_real_escape_string($con, ucfirst(strtolower($_POST['subiect'])))));
	$prioritate = $_POST['prioritate'];
	$categorie  = $_POST['categorie'];
	$text       = htmlentities(strip_tags(mysqli_real_escape_string($con, ucfirst(strtolower($_POST['descriere'])))));
	
	mysqli_query($con, "INSERT INTO `tichete` (`username`, `subiect`, `prioritate`, `categorie`, `text`, `data`) VALUES ('". $username ."', '". $subiect ."', '". $prioritate ."', '". $categorie ."', '". $text ."', '". date('Y-m-d H:i:s') ."')");
	mysqli_query($con, "INSERT INTO `notificari` (`imagine`, `culoare`, `titlu`, `text`, `data`) VALUES ('fa fa-gear', 'info' ,'Tichet nou!', '<i>$username</i> tocmai a creat un tichet nou!', '". date('Y-m-d H:i:s') ."')");
} else 
	echo 'Accesul direct interzis!';
?>