<?php
if(!isset($_SESSION)) 
	session_start();

if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] == $_POST['token'] && $_SESSION['token']>=(time()-600)){
	include('../../../core/database/connect.php');
	define('PERMIS', TRUE);
	include('../../../core/functions/general.php');
	date_default_timezone_set('Europe/Bucharest');

	
	// Verificam daca s-a modificat username-ul
	if($_POST['username'] != $_POST['username2']){
		if(empty($_POST['username']))
			$username = '<i>Username null</i>';
		else
			$username = $_POST['username'];
		
		//Adaugam o notificare utilizatorului
		mysqli_query($con, "INSERT INTO `notificari_utilizator`(`imagine`, `culoare`, `titlu`, `text`, `destinatar`, `data`) VALUES ('fa fa-edit', 'info', 'Username modificat', 'Username-ul dvs. actual tocmai a fost modificat (\'". $_POST['username2'] ."\' <i class=\"fa fa-long-arrow-right\"></i> \'". $username ."\') de către un administrator!', '". $_POST['username'] ."', '". date("Y-m-d H:i:s") ."')");
		
		//Adaugam o notificare administratorului
		mysqli_query($con, "INSERT INTO `notificari` (`imagine`, `culoare`, `titlu`, `text`, `data`) VALUES ('fa fa-edit', 'info', 'Username utilizator modificat', 'Username-ul utilizatorului \'". $_POST['username2'] ."\' tocmai a fost modificat (\'". $_POST['username2'] ."\' <i class=\"fa fa-long-arrow-right\"></i> \'". $username ."\') de către <b>\'". $_POST['admin'] ."\'</b>!', '". date("Y-m-d H:i:s") ."')");
	}
	
	// Verificam daca s-a modificat parola
	$parola2 = e_d('decrypt',$_GET['x2']);
	if($_POST['parola'] != $parola2){
		if(empty($_POST['username']))
			$parola = '<i>Parola null</i>';
		else
			$parola = $_POST['parola'];
		
		//Adaugam o notificare utilizatorului
		mysqli_query($con, "INSERT INTO `notificari_utilizator`(`imagine`, `culoare`, `titlu`, `text`, `destinatar`, `data`) VALUES ('fa fa-edit', 'info', 'Parola modificata', 'Parola dvs. actuală tocmai a fost modificată de către un administrator!', '". $_POST['username'] ."', '". date("Y-m-d H:i:s") ."')");
		
		//Adaugam o notificare administratorului
		mysqli_query($con, "INSERT INTO `notificari` (`imagine`, `culoare`, `titlu`, `text`, `data`) VALUES ('fa fa-edit', 'info', 'Parolă utilizator modificată', 'Parola utilizatorului \'". $_POST['username2'] ."\' tocmai a fost modificată (\'". $parola2 ."\' <i class=\"fa fa-long-arrow-right\"></i> \'". $parola ."\') de către <b>\'". $_POST['admin'] ."\'</b>!', '". date("Y-m-d H:i:s") ."')");
	}
	
	// Verificam daca s-a modificat email-ul
	if($_POST['email'] != $_POST['email2']){
		if(empty($_POST['email']))
			$email = '<i>Email null</i>';
		else
			$email = $_POST['email'];
		
		//Adaugam o notificare utilizatorului
		mysqli_query($con, "INSERT INTO `notificari_utilizator`(`imagine`, `culoare`, `titlu`, `text`, `destinatar`, `data`) VALUES ('fa fa-edit', 'info', 'Email modificat', 'Email-ul dvs. actual tocmai a fost modificat (\'". $_POST['email2'] ."\' <i class=\"fa fa-long-arrow-right\"></i> \'". $email ."\') de către un administrator!', '". $_POST['username'] ."', '". date("Y-m-d H:i:s") ."')");
		
		//Adaugam o notificare administratorului
		mysqli_query($con, "INSERT INTO `notificari` (`imagine`, `culoare`, `titlu`, `text`, `data`) VALUES ('fa fa-edit', 'info', 'Email utilizator modificat', 'Email-ul utilizatorului \'". $_POST['username2'] ."\' tocmai a fost modificat (\'". $_POST['email2'] ."\' <i class=\"fa fa-long-arrow-right\"></i> \'". $email ."\') de către <b>\'". $_POST['admin'] ."\'</b>!', '". date("Y-m-d H:i:s") ."')");
	}
	
	// Verificam daca s-a modificat contul acitv/inactiv
	$avertizari = e_d('decrypt',$_GET['x4']);
	if($_POST['avertizari'] != $activ2){
		if(!$_POST['avertizari']){
			$avertizari = '<i>Avertizari null</i>';
			
			//Adaugam o notificare utilizatorului
			mysqli_query($con, "INSERT INTO `notificari_utilizator`(`imagine`, `culoare`, `titlu`, `text`, `destinatar`, `data`) VALUES ('fa fa-warning', 'info', 'Avertisment(e) șters(e)', 'Bună ziua, numărul dvs de avertizări tocmai a fost redus (\'". $avertizari2 ."\' <i class=\"fa fa-long-arrow-right\"></i> \'". $avertizari ."\') de către <b>\'". $_POST['admin'] ."\'</b>!', '". $_POST['username'] ."', '". date("Y-m-d H:i:s") ."')");
		} else {
			$avertizari = $_POST['avertizari'];
			
			//Adaugam o notificare utilizatorului
			mysqli_query($con, "INSERT INTO `notificari_utilizator`(`imagine`, `culoare`, `titlu`, `text`, `destinatar`, `data`) VALUES ('fa fa-warning', 'danger', 'Ați primit o avertizare!', 'Bună ziua, tocmai ați fost avertizat (\'". $avertizari2 ."\' <i class=\"fa fa-long-arrow-right\"></i> \'". $avertizari ."\') de către <b>\'". $_POST['admin'] ."\'</b>! Dacă considerați această acțiune o greșeală, deschideți un tichet și vă vom răspunde în cel mai scurt timp!', '". $_POST['username'] ."', '". date("Y-m-d H:i:s") ."')");
		}
		
		//Adaugam o notificare administratorului
		mysqli_query($con, "INSERT INTO `notificari` (`imagine`, `culoare`, `titlu`, `text`, `data`) VALUES ('fa fa-warning', 'danger', 'Avertizări utilizator modificate', 'Avertizările utilizatorului \'". $_POST['username2'] ."\' tocmai au fost modificat (\'". $avertizari2 ."\' <i class=\"fa fa-long-arrow-right\"></i> \'". $avertizari ."\') de către <b>\'". $_POST['admin'] ."\'</b>!', '". date("Y-m-d H:i:s") ."')");
	}
	
	// Verificam daca s-a modificat contul acitv/inactiv
	$activ2 = e_d('decrypt',$_GET['x9']);
	if($_POST['activ'] != $activ2){
		if(!$_POST['activ'])
			$activ = '<i>Activ null</i>';
		else
			$activ = $_POST['activ'];
		
		//Adaugam o notificare administratorului
		mysqli_query($con, "INSERT INTO `notificari` (`imagine`, `culoare`, `titlu`, `text`, `data`) VALUES ('fa fa-edit', 'info', 'Cont utilizator modificat (activ/inactiv)', 'Contul utilizatorului \'". $_POST['username2'] ."\' tocmai a fost modificat (\'". $activ2 ."\' <i class=\"fa fa-long-arrow-right\"></i> \'". $activ ."\') de către <b>\'". $_POST['admin'] ."\'</b>!', '". date("Y-m-d H:i:s") ."')");
	}
	
	// Verificam daca s-a modificat accesul
	$acces2 = e_d('decrypt',$_GET['x5']);
	if($_POST['acces_up'] != $acces2){
		if(!$_POST['acces_up'])
			$acces = '<i>Acces null</i>';
		else
			$acces = $_POST['acces_up'];
		
		//Adaugam o notificare administratorului
		mysqli_query($con, "INSERT INTO `notificari` (`imagine`, `culoare`, `titlu`, `text`, `data`) VALUES ('fa fa-warning', 'danger', 'Acces utilizator modificat', 'Accesul utilizatorului \'". $_POST['username2'] ."\' pe acest website tocmai a fost modificat (\'". $acces2 ."\' <i class=\"fa fa-long-arrow-right\"></i> \'". $acces ."\') de către <b>\'". $_POST['admin'] ."\'</b>!', '". date("Y-m-d H:i:s") ."')");
	}
	
	//Facem update datelor
	mysqli_query($con, "UPDATE `utilizatori` SET `username` = '". $_POST['username'] ."', `parola` = '". $_POST['parola'] ."', `email` = '". $_POST['email'] ."', `avertizari` = '". $_POST['avertizari'] ."', `activ` = ". $_POST['activ'] .", `acces` = '". $_POST['acces_up'] ."', `motiv_banare` = '". $_POST['motiv'] ."' WHERE `id` = '". $_POST['id'] ."'");
	
} else 
	echo 'Accesul direct interzis!';
?>