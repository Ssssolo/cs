<?php
define('PERMIS', TRUE);
include 'core/init.php';

if($date_utilizator['acces'] != -1){
	// Stergem din `utilizatori_online`
	mysqli_query($con, "DELETE FROM `utilizatori_online` WHERE `id` = '". $_SESSION['id'] ."' ");

	// Distrugem toate sesiunile
	session_destroy();

	// Redirectionare
	header('Location: ./');
}
?>