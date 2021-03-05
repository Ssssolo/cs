<?php
if($_SERVER['REQUEST_METHOD'] == 'GET')
	die("Accesul direct interzis!");

define('PERMIS', TRUE);
include('../../core/database/connect.php');
include('../../core/functions/general.php');

$username = e_d('decrypt', $_GET['x']);
$x        = $_GET['x3'];

if(is_numeric($x))
	if($x)
		mysqli_query($con, "UPDATE `notificari` SET `vazut` = 1");
	else
		mysqli_query($con, "UPDATE `notificari_utilizator` SET `vazut` = 1 WHERE `destinatar` = '". $username ."'");
		

?>