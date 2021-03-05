<?php
if(!defined('PERMIS'))
	die('Accesul direct interzis!');

include ('core/database/connect.php');

$id = $_GET['id'];
if (isset($_GET['id'])){
	mysqli_query($con, "DELETE FROM `utilizatori` WHERE `id` = $id");
	
	header("Location: admin-lista-utilizatori");
} else
	header("Location: admin-lista-utilizatori");
 
?>