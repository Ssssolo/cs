<?php
if(!defined('PERMIS'))
	die('Accesul direct interzis!');

include ('core/database/connect.php');

$id = $_GET['id'];
if (isset($_GET['id'])){
	mysqli_query($con, "DELETE FROM `tichete` WHERE `id` = $id");
	mysqli_query($con, "DELETE FROM `tichete_raspuns` WHERE `id_tichet` = $id");
	
	header("Location: admin-tichete");
} else
	header("Location: admin-tichete");
 
?>