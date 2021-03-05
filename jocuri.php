<?php
//Preluam numele fisierului pe care il includem
$link = $_GET['link'];

//Verificam daca exista in link numele fisierului sau daca fisierul exista
if(!isset($link) || !file_exists("jocuri_surse/".$link.".php"))
	header('Location: ./');

define('PERMIS', TRUE);
include ('core/init.php');
protectie_nelogat();
include('includes/head.php');
include('includes/header.php');
include('includes/meniu.php');

include("jocuri_surse/$link.php");

include('includes/footer.php');
?>