<?php
define('PERMIS', TRUE);
include ('../../../core/database/connect.php');
include ('../../../core/functions/general.php');

$id  = e_d('decrypt', $_GET['x']);

if (isset($_GET['x']) && is_numeric($id)){
	mysqli_query($con, "DELETE FROM `tichete` WHERE `id` = $id");
	mysqli_query($con, "DELETE FROM `tichete_raspuns` WHERE `id_tichet` = $id");
	
	header("Location: ../../../admin-tichete");
} else
	header("Location: ../../../admin-tichete");
 
?>