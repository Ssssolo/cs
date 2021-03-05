<?php
if(!defined('PERMIS'))
	die('Accesul direct interzis!');

include ('core/database/connect.php');

$id = $_GET['id'];
if (isset($_GET['id'])){
	mysqli_query($con, "DELETE FROM `utilizatori_online` WHERE `id` = $id");
	
	header("Location: admin-utilizatori-online");
} else
	header("Location: admin-utilizatori-online");
 
?>