<?php
include('../core/database/connect.php');
$session_id = $_GET['session_id'];
$timp = time();
mysqli_query($con, "UPDATE `utilizatori_online` SET `timp` = '$timp' WHERE `session_id` ='$session_id'");

$sql = mysqli_query($con, "SELECT `username` FROM `utilizatori_online` WHERE `session_id` = '$session_id' LIMIT 1");

if(!mysqli_num_rows($sql))
	echo 'sesiune';
?>