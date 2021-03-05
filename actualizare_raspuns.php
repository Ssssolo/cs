<?php
define('PERMIS', TRUE);
include ('core/init.php');

mysqli_query($con, "UPDATE `tichete_raspuns` SET `text` = '". $_POST['value'] ."' WHERE `id` = '". $_POST['pk'] ."'");

?>