<?php
if(!isset($_SESSION)) 
	session_start();

if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] == $_POST['token'] && $_SESSION['token']>=(time()-600)){
	define('PERMIS', TRUE);
	include('../../../core/database/connect.php');
	include('../../../core/functions/utilizatori.php');
	date_default_timezone_set('Europe/Bucharest');
	
	$grad  = $_POST['grad'];
	$grad2 = $_POST['grad2'];
	
	// Verificam daca s-a modificat gradul
	if($grad != $grad2){
		//Adaugam o notificare utilizatorului
		mysqli_query($con, "INSERT INTO `notificari_utilizator`(`imagine`, `culoare`, `titlu`, `text`, `destinatar`, `data`) VALUES ('fa fa-edit', 'info', 'Grad modificat', 'Gradul dvs. pe server tocmai a fost modificat (\'". grad_notificare($grad2) ."\' <i class=\"fa fa-long-arrow-right\"></i> \'". grad_notificare($grad) ."\') de către un administrator!', '". $_POST['username'] ."', '". date("Y-m-d H:i:s") ."')");
		
		//Adaugam o notificare administratorului
		mysqli_query($con, "INSERT INTO `notificari` (`imagine`, `culoare`, `titlu`, `text`, `data`) VALUES ('fa fa-warning', 'warning', 'Grad utilizator modificat', 'Gradul utilizatorului \'". $_POST['username'] ."\' pe server tocmai a fost modificat (\'". grad_notificare($grad2) ."\' <i class=\"fa fa-long-arrow-right\"></i> \'". grad_notificare($grad) ."\') de către <b>\'". $_POST['admin'] ."\'</b>!', '". date("Y-m-d H:i:s") ."')");
	
		//Facem update datelor
		mysqli_query($con, "UPDATE `admins` SET `access` = '". $grad ."' WHERE `auth` = '". $_POST['username'] ."'");
	}
} else 
	echo 'Accesul direct interzis!';
?>