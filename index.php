<?php
define('PERMIS', TRUE);
include_once('core/init.php');

if(!logat()) 
	include('includes/logare/login.php');
else 
	include('includes/logare/logat.php');
?>