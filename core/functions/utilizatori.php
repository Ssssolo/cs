<?php
if(!defined('PERMIS'))
	die('Direct access not permitted');

function date_utilizator($id){
	include('./core/database/connect.php');
	$data = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `utilizatori` WHERE `id` = '$id'"));
	return $data;
}

function grad_notificare($acces){
	if(empty($acces))
		return 'Fără accese';
	
	if($acces == 'abcdefghijklmnopqrstu')
		return 'Owner';
	else
		if($acces == 'bcdefghijmnoqrstu')
			return 'God';
	else
		if($acces == 'bcdefijmnopqrt')
			return 'Super-Moderator';
	else
		if($acces == 'bcdefijm')
			return 'Moderator';
	else
		if($acces == 'bcdefim')
			return 'Administrator';
	else
		if($acces == 'cefim')
			return 'Helper';
	else
		if($acces == 'b') 
			return 'Nume rezervat';
	else
		return 'EROARE #3N626J40';
}

function grad($username){
	include('./core/database/connect.php');
	$sql   = mysqli_query($con, "SELECT `access` FROM `admins` WHERE `auth` = '$username'");
	$rand  = mysqli_fetch_assoc($sql);
				
	if($rand['access'] == 'abcdefghijklmnopqrstu')
		echo '<span class="label label-danger">Owner</span>';
	else
		if($rand['access'] == 'bcdefghijmnoqrstu')
			echo '<span class="label label-primary">God</span>';
	else
		if($rand['access'] == 'bcdefijmnopqrt')
			echo '<span class="label label-success">Super-Moderator</span>';
	else
		if($rand['access'] == 'bcdefijm')
			echo '<span class="label label-success">Moderator</span>';
	else
		if($rand['access'] == 'bcdefim')
			echo '<span class="label label-warning"><b>Administrator</b></span>';
	else
		if($rand['access'] == 'cefim')
			echo '<span class="label label-info">Helper</span>';
	else
		if($rand['access'] == 'b') 
			echo '<span class="label label-default">Nume rezervat</span>';
	else
		echo '<span class="label label-danger">EROARE #3N626J40</span>';				
}

function logat() {
	return (isset($_SESSION['id']) ? true : false);
}
?>
