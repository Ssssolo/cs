<?php
if(!isset($_SESSION)) 
	session_start();

date_default_timezone_set('Europe/Bucharest');

if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] == $_POST['token'] && $_SESSION['token']>=(time()-600)){
	include('../../core/database/connect.php');
	define('PERMIS', TRUE);
	include('../../core/functions/general.php');

	$username = e_d('decrypt',$_GET['x1']);
	$id       = e_d('decrypt',$_GET['x2']);
	$stare    = e_d('decrypt',$_GET['x6']);
	$stare2   = $_POST['stare'];
	
	mysqli_query($con, "UPDATE `tichete` SET `stare` = '". $stare2 ."' WHERE `id` = $id");
	mysqli_query($con, "UPDATE `tichete_raspuns` SET `vazut` = 1, `admin_vazut` = 1 WHERE `id_tichet` = $id");
	mysqli_query($con, "INSERT INTO `notificari` (`imagine`, `culoare`, `titlu`, `text`, `data`) VALUES ('fa fa-gear', 'info' ,'Stare tichet modificată!', '<i>$username</i> tocmai a a editat starea unui tichet (\'". $stare ."\' => \'". $stare2 ."\')!', '". date('Y-m-d H:i:s') ."')");
} else 
	echo 'Accesul direct interzis!';
?>