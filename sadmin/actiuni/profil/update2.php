<?php
if(!isset($_SESSION)) 
	session_start();

if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] == $_POST['token'] && $_SESSION['token']>=(time()-600)){
	include('../../../core/database/connect.php');
	date_default_timezone_set('Europe/Bucharest');

	// Verificam daca s-a modificat starea
	if($_POST['stare'] != $_POST['stare2']){
		if(empty($_POST['stare']))
			$stare = '<i>Stare null</i>';
		else
			$stare = $_POST['stare'];
		
		if(empty($_POST['stare2']))
			$stare = '<i>Stare null</i>';
		
		//Adaugam o notificare utilizatorului
		mysqli_query($con, "INSERT INTO `notificari_utilizator`(`imagine`, `culoare`, `titlu`, `text`, `destinatar`, `data`) VALUES ('fa fa-edit', 'info', 'Stare modificată', 'Starea dvs. actuală tocmai a fost modificată (\'". $_POST['stare2'] ."\' <i class=\"fa fa-long-arrow-right\"></i> \'". $stare ."\') de către un administrator!', '". $_POST['username'] ."', '". date("Y-m-d H:i:s") ."')");
		
		//Adaugam o notificare administratorului
		mysqli_query($con, "INSERT INTO `notificari` (`imagine`, `culoare`, `titlu`, `text`, `data`) VALUES ('fa fa-edit', 'info', 'Stare utilizator modificată', 'Starea utilizatorului \'". $_POST['username'] ."\' tocmai a fost modificată (\'". $_POST['stare2'] ."\' <i class=\"fa fa-long-arrow-right\"></i> \'". $stare ."\') de către <b>\'". $_POST['admin'] ."\'</b>!', '". date("Y-m-d H:i:s") ."')");
	}
	
	// Verificam daca s-a modificat creditul
	if($_POST['credit'] != $_POST['credit2']){
		if(!$_POST['credit'])
			$credit = 0;
		else
			$credit = $_POST['credit'];
		//Adaugam o notificare utilizatorului
		mysqli_query($con, "INSERT INTO `notificari_utilizator`(`imagine`, `culoare`, `titlu`, `text`, `destinatar`, `data`) VALUES ('fa fa-edit', 'info', 'Credit modificat', 'Creditul dvs. actual tocmai a fost modificat (". $_POST['credit2'] ." <i class=\"fa fa-eur\"></i> <i class=\"fa fa-long-arrow-right\"></i> ". $credit ." <i class=\"fa fa-eur\"></i>) de către un administrator!', '". $_POST['username'] ."', '". date("Y-m-d H:i:s") ."')");
		
		//Adaugam o notificare administratorului
		mysqli_query($con, "INSERT INTO `notificari` (`imagine`, `culoare`, `titlu`, `text`, `data`) VALUES ('fa fa-edit', 'info', 'Credit utilizator modificat', 'Creditul utilizatorului \'". $_POST['username'] ."\' tocmai a fost modificat (". $_POST['credit2'] ." <i class=\"fa fa-eur\"></i> <i class=\"fa fa-long-arrow-right\"></i> ". $credit ." <i class=\"fa fa-eur\"></i>) de către <b>\'". $_POST['admin'] ."\'</b>!', '". date("Y-m-d H:i:s") ."')");
	}
	
	//Facem update datelor
	mysqli_query($con, "UPDATE `utilizatori` SET `stare` = '". $_POST['stare'] ."', `credit` = '". $_POST['credit'] ."' WHERE `id` = '". $_POST['id'] ."'");
	
	
} else 
	echo 'Accesul direct interzis!';
?>