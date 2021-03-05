<?php
if(!isset($_SESSION)) 
    session_start(); 
ob_start();

date_default_timezone_set('Europe/Bucharest');

include_once('database/connect.php');
include_once('functions/general.php');
include_once('functions/utilizatori.php');

accesare_directa();


/* --------- Utilizatori online --------- */

// Stergere randuri mai vechi de 60 secunde
mysqli_query($con, "DELETE FROM `utilizatori_online` WHERE `timp` < ".(time()-120));

/* --------- Sfarsit utilizatori online --------- */

if(logat()){
	$date_utilizator = date_utilizator($_SESSION['id']);
	
	// Preluam locatia actuala
	$locatie_actuala = explode('/', $_SERVER['SCRIPT_NAME']);
	$locatie_actuala = end($locatie_actuala);
	
	// Verificam daca utilizatorul nu are contul activat
	if(!$date_utilizator['activ'] && $locatie_actuala != 'index.php')
		header('Location: ./');
	
	// Daca utilizatorul este logat si contul cu sesiunea respectiva nu exista in baza de date, il delogam
	$sql = mysqli_query($con,"SELECT `id` FROM `utilizatori` WHERE `id` = '". $_SESSION['id'] ."'");
	if(!mysqli_num_rows($sql))
		unset($_SESSION['id']);
	
	/* --------- Utilizatori online --------- */
	
	$session_id = session_id();
	$timp = time();
	
	$sql = mysqli_query($con, "SELECT `username` FROM `utilizatori_online` WHERE `session_id` = '$session_id' LIMIT 1");
	$rand = mysqli_fetch_assoc($sql);
	// Se verifica daca `session_id()` si `username` al utilizatorului corespunde cu valoarea din baza de date
	if(!mysqli_num_rows($sql) || (mysqli_num_rows($sql) && $rand['username'] != $date_utilizator['username'])){
		// Stergem sesiunea
		unset($_SESSION['id']);
		// Stergem tabelul din baza de date
		mysqli_query($con, "DELETE * FROM `utilizatori_online` WHERE `session_id` = '$session_id'");
	}
	
	/* --------- Sfarsit utilizatori online --------- */
	
	// Stergere notificari dupa 20 de zile
	sterge_notificari();
	
	//Daca utilizatorul este banat, ii interzicem accesul la toate paginilie inafara de 'tichet.php'
	$sql = mysqli_query($con,"SELECT `logIP`, `username` FROM `utilizatori` WHERE `acces` = -1");
	while($rand = mysqli_fetch_assoc($sql)){
		if(($_SERVER["REMOTE_ADDR"] == $rand['logIP'] || $date_utilizator['username'] == $rand['username']) && basename($_SERVER['PHP_SELF']) != 'banned.php'){
			if(basename($_SERVER['PHP_SELF']) != 'adauga-tichet.php' && basename($_SERVER['PHP_SELF']) != 'tichet.php')
				header('Location: banned');
		}
	}
}
$erori = array();
?>
