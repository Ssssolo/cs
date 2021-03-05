<?php
define('PERMIS', TRUE);
include ('../../../core/database/connect.php');
include ('../../../core/functions/general.php');

$id  = e_d('decrypt', $_GET['x']);
$id2 = e_d('decrypt', $_GET['x5']);
if (isset($_GET['x']) && is_numeric($id)){
	mysqli_query($con, "DELETE FROM `tichete_raspuns` WHERE `id` = $id");
	
	header("Location: ../../../tichet-$id2");
} else
	header("Location: ../../../tichet-$id2");
 
?>