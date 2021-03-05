<?php
if($_SERVER['REQUEST_METHOD'] == 'GET')
	die("Accesul direct interzis!");

define('PERMIS', TRUE);
include ('../../../core/database/connect.php');

mysqli_query($con, "UPDATE `tichete` SET `text` = '". $_POST['value'] ."' WHERE `id` = '". $_POST['pk'] ."'");
?>